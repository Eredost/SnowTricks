<?php


namespace App\Service;


use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

class Mailer
{
    /** @var MailerInterface $mailer */
    private $mailer;

    /**
     * Mailer constructor.
     *
     * @param MailerInterface $mailer
     */
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Sends an email to validate a new account
     *
     * @param string $to The recipient of the email
     *
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function signup(string $to): void
    {
        $email = (new TemplatedEmail())
            ->from('michael.coutin62@gmail.com')
            ->to(new Address($to))
            ->subject('Bienvenue dans la communauté SnowTricks !')
            ->htmlTemplate('emails/signup.html.twig')
            ->context([
                'expiration_date' => new \DateTime('+1 days'),
            ])
        ;

        $this->mailer->send($email);
    }

    /**
     * Sends an email to reset the password
     *
     * @param string $to The recipient of the email
     *
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function passwordReset(string $to): void
    {
        $email = (new TemplatedEmail())
            ->from('michael.coutin62@gmail.com')
            ->to(new Address($to))
            ->subject('Réinitialisation du mot de passe')
            ->htmlTemplate('emails/reset-password.html.twig')
            ->context([
                'expiration_date' => new \DateTime('+1 days'),
            ])
        ;

        $this->mailer->send($email);
    }
}
