<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    /**
     * @Route("/reg", name="reg")
     */
    public function reg(): Response
    {
        $regForm = $this->createFormBuilder()
            ->add('username', TextType::class, [
                'label' => 'Employee'  ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'required' =>true,
                'first_options' => ['label' => 'Password'],
                'second_options' => ['label' => 'Re-type Password'],
            ])
            ->add('register', SubmitType::class)
            ->getForm();


        return $this->render('register/index.html.twig', [
            'regform' => $regForm->createView()
        ]);
    }
}
