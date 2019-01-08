<?php
/**
 * Created by PhpStorm.
 * User: romain
 * Date: 09/09/18
 * Time: 14:21
 */

namespace App\Controller;


use App\Entity\Newsletter;
use App\Form\NewsletterType;
use App\Form\UnsubscribeType;
use App\Service\MailManager;
use App\Service\NewsletterForm;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class NewsletterController extends Controller
{
    /**
     * @Route("/abonnement-newletters", name="subscribing")
     * @Method({"POST"})
     */
    public function subscribing(Request $request, NewsletterForm $newsletterForm, EntityManagerInterface $entityManager, MailManager $mail){
        $form = $newsletterForm->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $newsletter = new Newsletter();
            $newsletter->setEmail($request->request->get('newsletter')['email']);
            $newsletter->setToken($request->request->get('newsletter')['_token']);
            $entityManager->persist($newsletter);
            $entityManager->flush();
            $mail->sendNewsletterValidation($newsletter);
            return $this->render('newsletter/subscribing.html.twig');
        }
        else{
            throw $this->createNotFoundException();
        }
    }

    /**
     * @Route("/newsletters-confirmation", name="subscribe-confirmation")
     * @Method({"GET"})
     */
    public function confirmation(Request $request, EntityManagerInterface $entityManager, MailManager $mail){
        $email = $request->query->get('email');
        $token = $request->query->get('token');
        $newsletter =  $entityManager
            ->getRepository(Newsletter::class)
            ->findByEmail($email);
        if ( $newsletter !== null && $newsletter->getToken() === $token){
            $newsletter
                ->setUnsubscribeToken($newsletter->getToken())
                ->setToken(null)
                ->setSubscribingDate(new \DateTime());
            $this->addFlash('success', 'Votre abonnement à la newsletter est confirmé');
            $entityManager->flush();
            $mail->sendNewsletterConfirmation($newsletter);
        }else{
            $this->addFlash('decline', "Erreur dans le processus d'abonnement");
        }
        return $this->redirectToRoute('security_login');
    }

    /**
     * @Route("/desabonnement-newletters/{token}", name="unsubscribing")
     */
    public function unsubscribing(Request $request, EntityManagerInterface $entityManager, $token){
        $newletterTarget = new Newsletter();
        $form = $this->createForm(UnsubscribeType::class, $newletterTarget);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $newsletter =  $entityManager
                ->getRepository(Newsletter::class)
                ->findByEmail($newletterTarget->getEmail());

            if ($newsletter !== null && $token === $newsletter->getUnsubscribeToken()){
                $entityManager->remove($newsletter);
                $entityManager->flush();
                $this->addFlash('success', 'Désabonnement effectué');
                return $this->redirectToRoute('homepage');
            }
            else{
                $this->addFlash('decline', 'erreur dans les données soumises');
            }
        }

        return $this->render('newsletter/unsubscribing.html.twig', [
            'form' => $form->createView()
        ]);
    }
}