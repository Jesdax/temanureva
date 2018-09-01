<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ExploSearchType;
use App\Service\BreadcrumbManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FrontController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="homepage")
     */
    public function index()
    {
        return $this->render('front/index.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/profil/{id}", name="profil", requirements={"id"="\d+$"})
     */
    public function connectedInterface($id = -1)
    {
        //J'ai doullé de ouf
        if($id === -1){
            return $this->redirectToRoute('profil',['id' => $this->getUser()->getId()]);
        }

        $user = $this->getDoctrine()->getRepository(User::class)->findById($id);

        return $this->render('back/index.html.twig', ['user' => $user]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/exploration", name="exploration")
     */
    public function exploration()
    {
        $form = $this->createForm(ExploSearchType::class);

        return $this->render('front/exploration.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/presentation-association-protection-amis-oiseaux", name="presentation")
     */
    public function presentationAssociation(){
        $breadcrumb = new BreadcrumbManager();
        $breadcrumb
            ->add('presentation', 'Notre assotion');

        return $this->render('front/presentation.html.twig',['breadcrumb' => $breadcrumb->getBreadcrumb()]);
    }
}
