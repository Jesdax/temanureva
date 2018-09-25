<?php
/**
 * Created by PhpStorm.
 * User: rozenn
 * Date: 21/08/18
 * Time: 19:45
 */
namespace App\Controller;

use App\Entity\Bird;
use App\Entity\Observation;
use App\Form\BirdListType;
use App\Repository\BirdRepository;
use App\Service\BreadcrumbManager;
use App\Service\PaginationManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BirdController extends Controller
{
    const NBR_BIRDS_PER_PAGE = 30;
    const PAGINATION_DISPLAY_BIRDS = 5;
    const PAGINATION_DISPLAY_MANAGE = 5;
    const NBR_OBSERVATIONS_PER_PAGE = 12;
    const BEGIN_DISPLAY_OBSERVATION = 0;
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/liste-photos-especes-oiseaux-france/{page}/{sorting}", name="oiseaux", requirements={"page"="\d+"})
     */
    // rajouter l'ordre de tri >>> dans l'url
    public function showAllBirds($page = 1, $sorting = 'ASC', Request $request, BirdRepository $birdRepository)
    {

        //Insert breadcrumb
        $breadcrumb = new BreadcrumbManager();
        $breadcrumb
            ->add('oiseaux', 'Espèces');

        $form = $this->createForm(BirdListType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $nbBirds = $birdRepository->getNumberBirds();
            $sort = $form['sort']->getData();

            $sorting = $sort === 0 ? 'ASC' : 'DESC';
            
            if (isset($_GET['famille'])){
                $birds = $birdRepository->findByFamily(($page - 1) * self::NBR_BIRDS_PER_PAGE, self::NBR_BIRDS_PER_PAGE, $sorting, $_GET['famille']);
                $nbBirds = count($birds);

            } else if (isset($_GET['id'])) {
                // find bird by id
            } else {
                $birds = $birdRepository->findByVernacularName(($page - 1) * self::NBR_BIRDS_PER_PAGE, self::NBR_BIRDS_PER_PAGE, $sorting, $_GET['id']);
            }
            $pagination = new PaginationManager($page, $nbBirds, self::NBR_BIRDS_PER_PAGE, self::PAGINATION_DISPLAY_BIRDS, 'oiseaux');

            return $this->render('front/birds.html.twig', [
                'birds' => $birds,
                'pagination' => $pagination,
                'breadcrumb' => $breadcrumb->getBreadcrumb(),
                'form' => $form->createView(),
                'sorting' => $sorting
            ]);
        }
        else {
            $birds = $birdRepository->findByVernacularName(($page - 1) * self::NBR_BIRDS_PER_PAGE, self::NBR_BIRDS_PER_PAGE, $sorting);
            $nbBirds = $birdRepository->getNumberBirds();
            //Insert pagination
            $pagination = new PaginationManager($page, $nbBirds, self::NBR_BIRDS_PER_PAGE, self::PAGINATION_DISPLAY_BIRDS, 'oiseaux');
            return $this->render('front/birds.html.twig', [
                'birds' => $birds,
                'pagination' => $pagination,
                'breadcrumb' => $breadcrumb->getBreadcrumb(),
                'form' => $form->createView(),
                'sorting' => $sorting
            ]);
        }

    }
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/espece/{id}", name="oiseau")
     */
    public function birdAction($id){
        //Requete BDD
        $bird = $this->getDoctrine()
            ->getRepository(Bird::class)
            ->findBirdById($id);
        $observations = $this->getDoctrine()
            ->getRepository(Observation::class)
            ->findObservationsByBirdId($id, self::BEGIN_DISPLAY_OBSERVATION , self::NBR_OBSERVATIONS_PER_PAGE);

        return $this->render('front/specie.html.twig', [
            'bird' => $bird,
            'observations' => $observations,
        ]);
    }
    /**
     * functionality for search the name bird with the id in the url for my test AK
     * @param null $id
     * @return Response
     * @Route("/oiseaux/rechercher/{id}", name="bird_search_id", requirements={"id": "\d+"})
     */
    public function searchBirdIdAction($id = null)
    {
        $bird = $this->getDoctrine()->getRepository(Bird::class)->find($id);
        if ($bird) {
            $name = $bird->getVernacularName() . '(' . $bird->getLbName() . ')';
            return new Response($name);
        }
        return new Response('');
    }
}