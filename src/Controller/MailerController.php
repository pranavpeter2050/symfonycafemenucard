<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerController extends AbstractController
{
    /**
     * @Route("/mail", name="mail")
     */
    public function sendEmail(MailerInterface $mailer): Response
    {
        $email = (new Email())
                ->from('table1@menucard.wip')
                ->to('kellner@menucard.wip')
                ->subject('Order Update.')
                ->text('Extra Fries');
        $mailer->send($email);

        return new Response('email sent.');
    }
}
