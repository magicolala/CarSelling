<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarType;
use App\Repository\CarRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('front\index.html.twig');
    }

    /**
     * @Route("/search", name="search")
     * @param Request $request
     * @param CarRepository $carRepository
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function search(Request $request, CarRepository $carRepository, PaginatorInterface $paginator)
    {
        $search = $request->query->get('search');

        if ($search != '') {
            $query = $carRepository->findByTerms($search);
        } else {
            $criteria['brand'] = $request->query->get('brandSearch');
            $criteria['energie'] = $request->query->get('energieSearch');
            $criteria['category'] = $request->query->get('categorySearch');
            $criteria['year'] = $request->query->get('yearSearch');
            $criteria['nbPorte'] = $request->query->get('nbPorteSearch');
            $criteria['boite_de_vitesse'] = $request->query->get('boite_de_vitesseSearch');

            $query = $carRepository->findByCriteria($criteria);
        }

        $cars = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            18 /*limit per page*/
        );

        $allCars = $carRepository->findAll();
        $years = [];
        foreach ($allCars as $allCar) {
            $years[] = $allCar->getYear();
        }
        $energies = Car::$energies;
        $brands = Car::$brands;
        $categories = Car::$categories;
        $years = array_unique($years);

        sort($brands);
        sort($years);

        return $this->render('front\search.html.twig', [
            'search'     => $search,
            'cars'       => $cars,
            'brands'     => $brands,
            'energies'   => $energies,
            'categories' => $categories,
            'years'      => $years
        ]);
    }

    /**
     * @Route("/addCar", name="addCar")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function addCar(Request $request)
    {
        $car = new Car();

        $form = $this->createForm(CarType::class, $car);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $car = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($car);
            $entityManager->flush();

            return $this->redirectToRoute('search');
        }

        return $this->render('front/newCar.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/car/{id}", name="showCar")
     * @param $id
     * @param CarRepository $carRepository
     * @return Response
     */
    public function showCar($id, CarRepository $carRepository)
    {
        $car = $carRepository->find($id);
        $categories = Car::$categories;

        return $this->render('front/showCar.html.twig', ['car' => $car, 'categories' => $categories]);
    }

    /**
     * @Route("/sellCar/{id}", name="sellCar")
     * @param $id
     * @param CarRepository $carRepository
     * @return RedirectResponse
     */
    public function sellCar($id, CarRepository $carRepository) {
        $em = $this->getDoctrine()->getManager();

        $car = $carRepository->find($id);
        $car->setIsSelling(true);

        $em->persist($car);
        $em->flush();

        return $this->redirectToRoute('showCar', ['id' => $id]);
    }
}
