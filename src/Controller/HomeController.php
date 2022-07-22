<?php

namespace App\Controller;

use App\Repository\DishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(DishRepository $dishRepository): Response
    {

        $dish = $dishRepository->findAll();

        $random = array_rand($dish, 2);

        return $this->render('home/index.html.twig', [
            'dish1' => $dish[$random[0]],
            'dish2' => $dish[$random[1]],
        ]);
    }
}
