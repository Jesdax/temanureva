<?php

namespace App\Controller;

use App\Entity\Observation;
use App\Form\ObservationType;
use App\Service\BreadcrumbManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface; // ??? doesn't work anymore ?



class ObservationController extends Controller
{
    /**
     * @Route("/ajout-observation", name="ajout_observation")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addObservation(Request $request)
    {
        $observation = new Observation();
        $form = $this->createForm(ObservationType::class, $observation);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $observation->setBird();
            $observation->setObservationDate();
            $observation->setLocation();
            $observation->setImage();

            $em = $this->getDoctrine()->getManager();
            $em = $this->persist($observation);
            $em = $this->flush();

            return $this->redirectToRoute('mes_observations');
        }

        return $this->render('back/add_observation.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/observation", name="view_observation")
     * @param Request $request
     */
    public function viewObservation(Request $request){
        $breadcrumb = new BreadcrumbManager();

        $breadcrumb->add('view_observation', 'Observation');
        return $this->render('front/observation.html.twig',[
            'breadcrumb' => $breadcrumb->getBreadcrumb()
        ]);
    }
}
