<?php

namespace App\Controller;

use App\Entity\Observation;
use App\Entity\Bird;
use App\Form\ObservationType;
use App\Form\ValideObservationType;
use App\Service\BreadcrumbManager;
use App\Service\ObservationManager;
use App\Service\PaginationManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;



class ObservationController extends Controller
{
    const NBR_MY_OBSERVATIONS_PER_PAGE = 6;
    const NBR_WAITING_OBSERVATIONS_PER_PAGE = 3;

    const PAGINATION_DISPLAY_OBSERVATIONS = 5;
    const PAGINATION_DISPLAY_MANAGE = 5;


    /**
     * @Route("/ajout-observation", name="ajout_observation")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addObservation(Request $request, AuthorizationCheckerInterface $checker, ObservationManager $observationManager)
    {
        $observation = new Observation();
        $form = $this->createForm(ObservationType::class, $observation);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            //dump($form['bird']->getData()); die;
            $em = $this->getDoctrine()->getManager();

            /**
             * to get and set the observer user
             */
            $currentObserver = $this->getUser();
            $observation->setObserver($currentObserver);


            if (true === $checker->isGranted(['ROLE_ADMIN', 'ROLE_NATURALIST'])){
                $observation->setStatus(1);
                $observation->setValidator($currentObserver);
                $observation->setValidationDate(new \DateTime());

            }

            /**
             * to store image in db
             */
            if (null !== $observation->getImage() && $form->has('image')) {
                $observationManager->observationUpLoadImage($observation, $form->get('image')->getData());
            }

            $em->persist($observation);
            $em->flush();

            return $this->redirectToRoute('mes_observations');
        }

        //Insert breadcrumb
        $breadcrumb = new BreadcrumbManager();
        $breadcrumb
            ->add('profil', 'Mon profil')
            ->add('ajout_observation', 'Ajouter une observation');

        return $this->render('back/add_observation.html.twig', [
            'form' => $form->createView(),
            'breadcrumb' => $breadcrumb->getBreadcrumb()
        ]);
    }

    /**
     * @Route("/mes-observations/{page}", name="mes_observations")
     * @param int $page
     * @return Response
     */
    public function showMyObservations($page=1)
    {
        $currentUserId = $this->getUser();

        $repository = $this->getDoctrine()->getRepository(Observation::class);
        $nbObservations = $repository->getNumberObservationsByUserId($currentUserId);

        $observations = $repository->findAllByUserId($currentUserId, ($page - 1) * self::NBR_MY_OBSERVATIONS_PER_PAGE, self::NBR_MY_OBSERVATIONS_PER_PAGE);

        $pagination = new PaginationManager($page, $nbObservations, self::NBR_MY_OBSERVATIONS_PER_PAGE, self::PAGINATION_DISPLAY_OBSERVATIONS, 'mes_observations');

        //Insert breadcrumb
        $breadcrumb = new BreadcrumbManager();
        $breadcrumb
            ->add('profil', 'Mon profil')
            ->add('mes_observations', 'Mes observations');

        return $this->render('back/my_observations.html.twig',[
            'observations' => $observations,
            'breadcrumb' => $breadcrumb->getBreadcrumb(),
            'pagination' => $pagination
        ]);
    }

    /**
     * @param Request $request
     * @param AuthorizationCheckerInterface $checker
     * @param ObservationManager $observationManager
     * @param $id
     * @return Response
     * @Route("/observation/{id}", name="view_observation")
     */
    public function viewObservation(Request $request, AuthorizationCheckerInterface $checker, ObservationManager $observationManager,$id){
        $breadcrumb = new BreadcrumbManager();
        $breadcrumb
            ->add('explorer', 'Exploration')
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
                        $observationManager->valide($observation);
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
                throw $this->createNotFoundException("Cette observation n'existe pas");
            }
        }
        else{
            return $this->render('front/observation.html.twig',[
                'breadcrumb' => $breadcrumb->getBreadcrumb(),
                'observation' => $observation
            ]);
        }
    }

    /**
     * @Route("/observation-attente/{page}", name="waiting-observation", requirements={"page" = "\d+"})
     */
    public function waitingObservation($page=1){

        $repository = $this->getDoctrine()->getRepository(Observation::class);
        $nbObservations = $repository->countWaintingObservation();
        $observations = $repository->findWaitingObservation(($page-1)*self::NBR_WAITING_OBSERVATIONS_PER_PAGE,self::NBR_WAITING_OBSERVATIONS_PER_PAGE);

        $pagination = new PaginationManager($page, $nbObservations, self::NBR_WAITING_OBSERVATIONS_PER_PAGE, self::PAGINATION_DISPLAY_OBSERVATIONS, 'waiting-observation');

        //Insert breadcrumb
        $breadcrumb = new BreadcrumbManager();
        $breadcrumb
            ->add('profil', 'Mon profil')
            ->add('waiting-observation', 'Observations en attente');

        return $this->render('back/waiting_observation.html.twig',[
            'breadcrumb' => $breadcrumb->getBreadcrumb(),
            'observations'=> $observations,
            'pagination' => $pagination
        ]);
    }
}
