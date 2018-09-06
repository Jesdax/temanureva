<?php

namespace App\Controller;

use App\Entity\Observation;
use App\Entity\Bird;
use App\Form\ObservationType;
use App\Form\ValideObservationType;
use App\Service\BreadcrumbManager;
use App\Service\ObsrevationManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;


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
    public function viewObservation(Request $request, AuthorizationCheckerInterface $checker, ObsrevationManager $obsrevationManager,$id){
        $breadcrumb = new BreadcrumbManager();
        $breadcrumb
            ->add('exploration', 'Exploration')
            ->add('view_observation', 'Observation');

        $observation = $this->getDoctrine()
            ->getRepository(Observation::class)
            ->findById($id);

        if ($observation->getStatus() == 0){
            if (true === $checker->isGranted(['ROLE_ADMIN', 'ROLE_NATURALIST'])){
                $form = $this->createForm(ValideObservationType::class, $observation);

                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()){
                    if ($form->getClickedButton()->getName() == 'valide'){
                        $obsrevationManager->valide($observation);
                        $this->redirectToRoute('profil');
                    }
                    elseif ($form->getClickedButton()->getName() == 'delete'){

                    }
                }

                return $this->render('front/observation.html.twig',[
                    'breadcrumb' => $breadcrumb->getBreadcrumb(),
                    'observation' => $observation,
                    'form' => $form->createView()
                ]);
            }
            else{
                throw $this->createNotFoundException("Cette observartion n'existe pas");
            }
        }
        else{
            return $this->render('front/observation.html.twig',[
                'breadcrumb' => $breadcrumb->getBreadcrumb(),
                'observation' => $observation
            ]);
        }
    }
}
