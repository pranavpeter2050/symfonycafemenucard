<?php

namespace App\Controller;

use App\Entity\Dish;
use App\Form\DishType;
use App\Repository\DishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dish", name="dish.")
 */

class DishController extends AbstractController
{
    /**
     * @Route("/", name="edit")
     */
    public function index(DishRepository $dishRepository): Response
    {
        $dish = $dishRepository->findAll();

        return $this->render('dish/index.html.twig', [
            'dishes' => $dish,
        ]);
    }

    /**
     * @Route("/create", name="create")
     */
    public function create(Request $request) {
        $dish = new Dish();
        
        // Form
        $form = $this->createForm(DishType::class, $dish);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            // Entity Manager $em
            $em = $this->getDoctrine()->getManager();
            $em->persist($dish);
            $em->flush();

            return $this->redirect($this->generateUrl('dish.edit'));
        }



        // Response
        return $this->render('dish/create.html.twig', [
            'createform' => $form->createView(),
        ]);
    }
}
