<?php
namespace App\Controller;
use App\Entity\Bird;
use App\Repository\BirdRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
class AutocompletionController extends Controller
{
    /**
     * @Route("/autocomplete", name="autocomplete", methods={"GET", "POST"})
     */
    public function autocomplete(Request $request)
    {
        $term = $request->request->get('dataBird');
        $em = $this->getDoctrine()->getManager();
        $birdsArray = $em->getRepository(Bird::class)->findAllByVernacularName($term);
        $responseBird = new JsonResponse($birdsArray);
        return $responseBird;
    }
    /**
     * @Route("/multi-autocomplete", name="multi-autocomplete", methods={"GET"})
     */
    public function multiAutocomplete(Request $request)
    {
        $term = $request->request->get('dataBird');
        $em = $this->getDoctrine()->getManager();
        $birdsArray = $em->getRepository(Bird::class)->findAllByMultipleCriteria($term);
        $responseBird = new JsonResponse($birdsArray);
        return $responseBird;
    }

    /**
     * @Route("/familyList", name="family-list", methods={"GET"})
     */
    public function familyList()
    {
        $term = $_GET['name'];

        $em = $this->getDoctrine()->getManager();
        $familyArray = $em->getRepository(Bird::class)->findFamilyList($term);
        $responseFamily = new JsonResponse($familyArray);

        return $responseFamily;
    }

    /**
     * @Route("/orderList", name="order-list", methods={"GET"})
     */
    public function orderList()
    {
        $term = $_GET['name'];

        $em = $this->getDoctrine()->getManager();
        $familyArray = $em->getRepository(Bird::class)->findOrderList($term);
        $responseFamily = new JsonResponse($familyArray);

        return $responseFamily;
    }
}
