<?php

namespace App\Controller;

use App\Entity\Car;
use App\Repository\CarRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    /**
     * @Route("/", name="front")
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
}
