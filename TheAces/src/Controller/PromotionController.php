<?php

namespace App\Controller;


use App\Entity\Element;
use App\Entity\Promotion;
use App\Form\PromotionFormType;
use App\Services\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PromotionController extends AbstractController
{
    /**
     * @Route("/promotion", name="promotion")
     */
    public function index(): Response
    {
        return $this->render('promotion/index.html.twig', [
            'controller_name' => 'PromotionController',
        ]);
    }
    /**
     * @Route("/ajouter", name="ajouter",methods={"GET","POST"}))
     */

    public function Ajouter(Request $req): Response
    {
        $Promotion = new Promotion();
        $Element = new Element();
        $Element=$this->getDoctrine()->getManager()->getRepository(Element::class)->find(3);


        $formClassroom = $this->createForm(PromotionFormType::class, $Promotion);
        $formClassroom->handleRequest($req);
        if (($formClassroom->isSubmitted()) && ($formClassroom->isValid()))
        {
            $Promotion->setIdprod($Element);

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($Promotion);
            $manager->flush();
            return $this->redirectToRoute('afficherPromotion');
        }
        return $this->render('promotion/AjouterPromotion.twig', ['Promotion' => $formClassroom->createView()]);

    }





    /**
     * @Route("/afficher", name="afficherPromotion")
     */
    public function AfficherPromotion()
    {
        $repo = $this->getDoctrine()->getRepository(Promotion::class);
        $Promotion = $repo->findAll();
        return $this->render('promotion/AfficherPromotion.twig', ["Promotion" => $Promotion]);



    }

    /**
     * @Route("/supprimerPromotion/{id}", name="supprimer")
     */
    public function supprimer($id)
    {
        $Promotion=$this->getDoctrine()->getRepository(Promotion::class)->find($id);
        $a=$this->getDoctrine()->getManager();
        $a->remove($Promotion);
        $a->flush();
        return $this->redirectToRoute('afficher');
    }
    /**
     * @Route ("/modifierPromotion/{id}", name="modifier")
     */
    public function modifier($id,Request $req)
    {
        $Promotion=$this->getDoctrine()->getRepository(Promotion::class)->find($id);
        $form=$this->createForm(PromotionFormType::class,$Promotion);
        $form->handleRequest($req);

        if($form->isSubmitted() && $form->isValid())
        {
            $a=$this->getDoctrine()->getManager();
            $a->flush();
            return $this->redirectToRoute('afficher');
        }
        return $this->render('promotion/AjouterPromotion.twig', [
            'Promotion'=>$form->createView()

        ]);
    }



}
