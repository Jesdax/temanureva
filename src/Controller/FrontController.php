<?php
namespace App\Controller;
use App\Entity\Article;
use App\Entity\User;
use App\Entity\Observation;
use App\Form\ContactType;
use App\Form\ExploSearchType;
use App\Repository\ObservationRepository;
use App\Service\BreadcrumbManager;
use App\Service\MailManager;
use App\Utility\Contact;
use App\Entity\Bird;
use PhpParser\Node\Expr\Array_;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
class FrontController extends Controller
{
    /**
     * @return Response
     * @Route("/", name="homepage")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $observations = $em->getRepository(Observation::class)->findLastThreeObservations(3);

        return $this->render('front/index.html.twig', [
            'observations' => $observations,
        ]);
    }


    /**
     * @return JsonResponse|Response
     * @Route("/observer-carte-oiseaux", name="explorer")
     */
    public function exploration()
    {
        $breadcrumb = new BreadcrumbManager();
        $breadcrumb->add('exploration', 'Exploration');
        return $this->render('front/exploration.html.twig', [
            'breadcrumb' => $breadcrumb->getBreadcrumb()]);
    }

    /**
     * @return JsonResponse
     * @Route("/observer-carte-oiseaux/rechercher", name="exploration_json_bird", methods={"GET", "POST"})
     */
    public function explorationSearchBirdAction()
    {
        $birdId = intval($_GET['dataBird']); // intval pour transformer en integer et GET pour prendre le param dataBird qui était en string
        //dump($birdId); die();
        $result = [];
        $observations = $this->getDoctrine()->getManager()
            ->getRepository(Observation::class)
            ->findByBirdId($birdId);


        /*if (null !== $observations) {
            $this->addFlash('error', 'Erreur');
        }*/


        foreach ($observations as $observation) {
            $result[] = [
                'id' => $observation->getId(),
                'vernacularName' => $observation->getBird()->getVernacularName(),
                'observationDate' => $observation->getObservationDate()->format('d/m/Y'),
                'latitude' => $observation->getLatitude(),
                'longitude' => $observation->getLongitude(),
            ];
        }
        //dump($result);die();
        return new JsonResponse($result);
    }

    /**
     * @return Response
     * @Route("/presentation-association-protection-amis-oiseaux", name="presentation")
     */
    public function presentationAssociation(){
        $breadcrumb = new BreadcrumbManager();
        $breadcrumb
            ->add('presentation', 'Notre association');
        return $this->render('front/presentation.html.twig',['breadcrumb' => $breadcrumb->getBreadcrumb()]);
    }

    /**
     * @param Request $request
     * @param MailManager $mail
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     * @Route("/contact-association-amis-oiseaux", name="contact")
     */
    public function contact(Request $request, MailManager $mail)
    {
        //Breadcrumb
        $breadcrumb = new BreadcrumbManager();
        $breadcrumb
            ->add('contact', 'Nous contacter');
        //Form
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $mail->sendContact($contact);
            $this->addFlash('success', 'Votre message a été envoyé');
        }
        return $this->render('front/contact.html.twig',[
            'breadcrumb' => $breadcrumb->getBreadcrumb(),
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/don-association-reduction-impots-amis-oiseaux", name="donation")
     */
    public function donation() {
        $breadcrumb = new BreadcrumbManager();
        $breadcrumb->add('donation', 'Faire un don');
        return $this->render('front/donation.html.twig', [
            'breadcrumb' => $breadcrumb->getBreadcrumb()
        ]);
    }

    /**
     * @Route("/mentions-legales", name="mentions")
     */
    public function legalMentions() {
        $breadcrumb = new BreadcrumbManager();
        $breadcrumb
            ->add('mentions', 'Mentions légales');
        return $this->render('front/legalMentions.html.twig', [
            'breadcrumb' => $breadcrumb->getBreadcrumb()
        ]);
    }

    /**
     * @Route("/FAQ", name="faq")
     */
    public function faq() {
        $breadcrumb = new BreadcrumbManager();
        $breadcrumb
            ->add('faq', 'FAQ');
        return $this->render('front/faq.html.twig', [
            'breadcrumb' => $breadcrumb->getBreadcrumb()
        ]);
    }
}
