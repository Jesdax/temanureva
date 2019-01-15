<?php
/**
 * Created by PhpStorm.
 * User: romain
 * Date: 28/08/18
 * Time: 19:37
 */

namespace App\Service;


use App\Entity\Demand;
use App\Entity\Newsletter;
use App\Entity\User;
use App\Utility\Contact;

class MailManager
{
    const MAIL_FROM = 'no-reply@example.fr';
    const MAIL_CONTACT = 'contact@example.fr';

    private $mailer;
    private $template;
    private $contact;
    private $name;

    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $environment)
    {
        $this->mailer = $mailer;
        $this->template = $environment;
    }

    public function send($to, $subject, $body, $from = self::MAIL_FROM){
        $message = (new \Swift_Message($subject))
            ->setFrom($from)
            ->setTo($to)
            ->setContentType('text/html')
            ->setBody($body);

        $this->mailer->send($message);
    }

    /**
     * @param Demand $demand
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function sendDemandWaiting(Demand $demand){
        $to = $demand->getUser()->getEmail();
        $subject = 'Votre demande pour devenir naturaliste';
        $body = $this->template->render('mail/demandeSubmit.html.twig', [
            'demand' => $demand
        ]);
        $this->send($to, $subject, $body);
    }

    /**
     * @param Demand $demand
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function sendDemandAccept(Demand $demand){
        $to = $demand->getUser()->getEmail();
        $subject = 'Votre demande a été acceptée';
        $body = $this->template->render('mail/demandAccept.html.twig', [
            'demand' => $demand
        ]);
        $this->send($to, $subject, $body);
    }

    /**
     * @param Demand $demand
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function sendDemandDecline(Demand $demand){
        $to = $demand->getUser()->getEmail();
        $subject = 'Votre demande a été refusée';
        $body = $this->template->render('mail/demandDecline.html.twig', [
            'demand' => $demand
        ]);
        $this->send($to, $subject, $body);
    }

    /**
     * @param User $user
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function sendReinitializeProcess(User $user){
        $to = $user->getEmail();
        $subject = 'Demande de ré-initialisation du mot de passe';
        $body = $this->template->render('mail/password.html.twig',[
            'user' => $user
        ]);
        $this->send($to, $subject, $body);
    }

    /**
     * @param User $user
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function sendReinitializeNotification(User $user){
        $to = $user->getEmail();
        $subject = 'Notification : mot de passe modifié';
        $body = $this->template->render('mail/passwordConfimation.html.twig',[
            'user' => $user
        ]);
        $this->send($to, $subject, $body);
    }

    /**
     * @param Contact $contact
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function sendContact(Contact $contact){
        $from = $contact->getEmail();
        $subject = $contact->getSubject();
        $body = $this->template->render('mail/contact.html.twig',[
            'contact' => $contact
        ]);
        $this->send(self::MAIL_CONTACT, $subject, $body, $from);
    }

    /**
     * @param Newsletter $newsletter
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function sendNewsletterValidation(Newsletter $newsletter){
        $to = $newsletter->getEmail();
        $subject = 'Validation : inscription à la newsletter NAO';
        $body = $this->template->render('mail/newsletter_validation.html.twig',[
            'newsletter' => $newsletter
        ]);
        $this->send($to, $subject, $body);
    }

    /**
     * @param Newsletter $newsletter
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function sendNewsletterConfirmation(Newsletter $newsletter){
        $to = $newsletter->getEmail();
        $subject = 'Confirmation : inscription à la newsletter NAO';
        $body = $this->template->render('mail/newsletterConfirmation.html.twig',[
            'newsletter' => $newsletter
        ]);
        $this->send($to, $subject, $body);
    }
}