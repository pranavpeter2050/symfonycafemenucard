<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class MailerController extends AbstractController
{
    /**
     * @Route("/mail", name="mail")
     */
    public function sendEmail(MailerInterface $mailer): Response
    {
        $table = 'table1';
        $text = 'Please bring more salt and Napkins.';

        $email = (new TemplatedEmail())
                ->from('table1@menucard.wip')
                ->to('kellner@menucard.wip')
                ->subject('Order Update.')
                ->text('Extra Fries')

                ->htmlTemplate('mailer/mail.html.twig')
                ->context([
                    'table' => $table,
                    'text' => $text
                ]);


        $mailer->send($email);

        return new Response('email sent.');
    }
}
