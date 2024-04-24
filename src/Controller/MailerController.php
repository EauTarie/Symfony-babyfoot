<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;

class MailerController extends AbstractController
{
    #[Route('/email', name: 'app_mailer')]
    public function index(): Response
    {
        return $this->render('mailer/index.html.twig', [
            'controller_name' => 'MailerController',
        ]);
    }
    #[Route('/email', name: 'app_mailer')]
    public function sendEmail(MailerInterface $mailer): Response
    {
        $email = (new Email())
            ->from('footbot@footfrenzy.com')
            ->to('you@example.com')
            ->subject('Time for Symfony Mailer')
            ->text('Sending email is fun again!')
            ->html('<p>See Twig integration for better HTML integration</p>');

        $mailer->send($email);

        return new Response(
            'Email was sent'
        );
    }
}
