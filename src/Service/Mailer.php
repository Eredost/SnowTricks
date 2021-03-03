<?php


namespace App\Service;


use App\Entity\User;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

class Mailer
{
    /** @var MailerInterface $mailer */
    private $mailer;

    /** @var string $applicationEmail */
    private $applicationEmail;

    /**
     * Mailer constructor.
     *
     * @param MailerInterface $mailer
     * @param string          $applicationEmail
     */
    public function __construct(MailerInterface $mailer, string $applicationEmail)
    {
        $this->mailer = $mailer;
        $this->applicationEmail = $applicationEmail;
    }

    /**
     * Sends an email to validate a new account
     *
     * @param User $user
     *
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function signup(User $user): void
    {
        $email = (new TemplatedEmail())
            ->from($this->applicationEmail)
            ->to(new Address($user->getEmail()))
            ->subject('Bienvenue dans la communauté SnowTricks !')
            ->htmlTemplate('emails/signup.html.twig')
            ->context([
                'user' => $user,
            ])
        ;

        $this->mailer->send($email);
    }

    /**
     * Sends an email to reset the password
     *
     * @param User $user
     *
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function passwordReset(User $user): void
    {
        $email = (new TemplatedEmail())
            ->from($this->applicationEmail)
            ->to(new Address($user->getEmail()))
            ->subject('Réinitialisation du mot de passe')
            ->htmlTemplate('emails/reset-password.html.twig')
            ->context([
                'user' => $user,
            ])
        ;

        $this->mailer->send($email);
    }
}
