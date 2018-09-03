<?php

namespace App\Controller;

use App\Entity\Observation;
use App\Entity\Bird;
use App\Form\ObservationType;
use App\Service\BreadcrumbManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;



class ObservationController extends Controller
{
    /**
     * @Route("/ajout-observation", name="ajout_observation")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addObservation(Request $request, EntityManagerInterface $em)
    {
        $observation = new Observation();
        $form = $this->createForm(ObservationType::class, $observation);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $em = $this->getDoctrine()->getManager();
            $currentObserver = $this->getUser();
            $observation->setObserver($currentObserver);
            $em->persist($observation);
            //$em->flush();

            return $this->redirectToRoute('mes_observations');
        }

        return $this->render('back/add_observation.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/observation/{id}", name="view_observation")
     * @param Request $request
     */
    public function viewObservation(Request $request, $id){
        $breadcrumb = new BreadcrumbManager();

        $breadcrumb->add('view_observation', 'Observation');
        return $this->render('front/observation.html.twig',[
            'breadcrumb' => $breadcrumb->getBreadcrumb()
        ]);
    }
}
