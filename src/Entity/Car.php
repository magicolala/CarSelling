<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CarRepository")
 */
class Car
{
    public static $brands = [
        0   => "Sceo",
        1   => "Oltcit",
        2   => "Ravon",
        3   => "Pontiac",
        4   => "Citroen",
        5   => "MG",
        6   => "JMC",
        7   => "Daihatsu",
        8   => "Geo",
        9   => "Pininfarina",
        10  => "Aro",
        11  => "Saab",
        12  => "Innocenti",
        13  => "Bio Auto",
        16  => "DS",
        17  => "Aixam",
        18  => "Ultima",
        19  => "Dagger",
        20  => "Fiat-Abarth",
        21  => "Rover",
        22  => "Volkswagen",
        23  => "Suzuki",
        24  => "MPM Motors",
        25  => "De Lorean",
        26  => "Rezvani",
        27  => "Artega",
        28  => "Wuling",
        29  => "Luxgen",
        31  => "Austin",
        32  => "Konecranes",
        33  => "Oldsmobile",
        34  => "KingWoo",
        35  => "Huabei",
        36  => "Detroit Electric",
        37  => "TVR",
        39  => "Gonow",
        40  => "Dadi",
        41  => "Zimmer",
        43  => "Ford",
        45  => "Daf",
        49  => "Buick",
        50  => "Hyundai",
        52  => "Triumph",
        53  => "Infiniti",
        54  => "Caterham",
        55  => "Bristol",
        57  => "Smart",
        58  => "Thunder Tiger",
        59  => "Seat",
        60  => "Lincoln",
        61  => "Austin-Healey",
        62  => "Kia",
        63  => "Iran Khodro",
        64  => "Cadillac",
        65  => "Volvo",
        67  => "Daewoo",
        68  => "Vepr",
        69  => "Xiaolong",
        70  => "Toyota",
        71  => "Fisker",
        74  => "Adler",
        77  => "Plymouth",
        78  => "Peugeot",
        81  => "Proton",
        84  => "LDV",
        88  => "Audi",
        89  => "Acura",
        90  => "Barkas (Баркас)",
        91  => "Shelby",
        93  => "SsangYong",
        97  => "Beijing",
        98  => "King Long",
        100 => "Morgan",
        102 => "Lexus",
        104 => "Daimler",
        106 => "Tofas",
        107 => "Chrysler",
        108 => "Miles",
        111 => "ItalCar",
        114 => "Haima",
        115 => "FAW",
        116 => "Maruti",
        120 => "Jaguar",
        121 => "McLaren",
        122 => "Zotye",
        123 => "Yugo",
        126 => "Humvee",
        128 => "Renault",
        130 => "Venturi",
        132 => "Pinzgauer",
        133 => "GMC",
        136 => "Subaru",
        138 => "Bentley",
        139 => "Fornasari",
        143 => "Alpine",
        144 => "Maybach",
        146 => "Pagani",
        148 => "Autobianchi",
        149 => "Mitsubishi",
        150 => "Abarth",
        151 => "Lotus",
        152 => "Packard",
        153 => "Norster",
        154 => "Maserati",
        155 => "Fiat",
        157 => "Lamborghini",
        159 => "Samand",
        162 => "Morris",
        164 => "Koenigsegg",
        167 => "Chevrolet",
        170 => "Wanfeng",
        171 => "Datsun",
        173 => "Scion",
        175 => "Saipa",
        178 => "FUQI",
        179 => "Nissan",
        180 => "Studebaker",
        181 => "Gac",
        186 => "Zastava",
        187 => "Alfa Romeo",
        194 => "Aston Martin",
        205 => "LTI",
        208 => "Hafei",
        211 => "SouEast",
        215 => "Peg-Perego",
        220 => "Dacia",
        224 => "Altamarea",
        225 => "Skoda",
        227 => "Kirkham",
        230 => "Sidetracker",
        235 => "Honda",
        236 => "Vauxhall",
        244 => "Shuanghuan",
        245 => "Ram",
        247 => "Humber",
        269 => "Dodge",
        276 => "Bertone",
        277 => "Talbot",
        283 => "Porsche",
        284 => "Soyat",
        286 => "MINI",
        296 => "Iveco",
        298 => "Praga Baby",
        306 => "Saleen",
        312 => "Hummer",
        313 => "Mahindra",
        319 => "Jinbei Minibusus",
        322 => "Ferrari",
        325 => "FSO",
        331 => "Great Wall",
        332 => "Mercury",
        343 => "Samson",
        358 => "Jeep",
        376 => "Blonell",
        392 => "Think Global",
        393 => "Mercedes-Benz",
        400 => "Land Rover",
        402 => "Geely",
        416 => "Opel",
        426 => "Renault Samsung Motors",
        428 => "Secma",
        437 => "BMW",
        441 => "Lancia",
        442 => "Bugatti",
        443 => "Rolls-Royce",
        467 => "Dr. Motor",
        485 => "Marshell"
    ];
    public static $energies = [0 => "diesel", 1 => "electric", 2 => "gas", 3 => "hybrid"];
    public static $categories = ["MPV" => "Monospace", "SUV" => "SUV", "convertible" => "Décapotable", "coupe" => "Coupé", "hatchback" => "Berline", "sedan" => "Berline Sport", "small" => "Citadine", "station wagon" => "Break"];
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $year;

    /**
     * @ORM\Column(type="integer")
     */
    private $kilometrage;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $energie;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbPorte;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $boite_de_vitesse;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbPlace;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $note;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $brand;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $model;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function setYear($year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getKilometrage(): ?int
    {
        return $this->kilometrage;
    }

    public function setKilometrage(int $kilometrage): self
    {
        $this->kilometrage = $kilometrage;

        return $this;
    }

    public function getEnergie(): ?string
    {
        return $this->energie;
    }

    public function setEnergie(string $energie): self
    {
        $this->energie = $energie;

        return $this;
    }

    public function getNbPorte(): ?int
    {
        return $this->nbPorte;
    }

    public function setNbPorte(?int $nbPorte): self
    {
        $this->nbPorte = $nbPorte;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getBoiteDeVitesse(): ?string
    {
        return $this->boite_de_vitesse;
    }

    public function setBoiteDeVitesse(?string $boite_de_vitesse): self
    {
        $this->boite_de_vitesse = $boite_de_vitesse;

        return $this;
    }

    public function getNbPlace(): ?int
    {
        return $this->nbPlace;
    }

    public function setNbPlace(?int $nbPlace): self
    {
        $this->nbPlace = $nbPlace;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getNote(): ?float
    {
        return $this->note;
    }

    public function setNote(?float $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param mixed $brand
     * @return Car
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     * @return Car
     */
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }
}
