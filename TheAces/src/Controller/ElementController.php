<?php

namespace App\Controller;

use App\Entity\Element;
use App\Entity\Promotion;
use App\Form\ElementFormType;
use App\Form\PromotionFormType;
use App\Services\FileUploader;
use Endroid\QrCodeBundle\Response\QrCodeResponse;
use Gedmo\Sluggable\Util\Urlizer;
use Repository\ElementRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;
class ElementController extends AbstractController
{
    /**
     * @Route("/element", name="element")
     */
    public function index(): Response
    {
        //$Element=$this->getDoctrine()->getRepository(Element::class)->findAll();
        return $this->render('element/index.html.twig', [
            'controller_name' => 'ElementController',
        ]);
       /* public function index()
    {$Element=$this->getDoctrine()->getRepository(Element::class)->findAll();
        return $this->render('element/index.html.twig', [
            'controller_name' => 'ElementController',
        ]);*/
    }

    /**
     * @Route("/ajouterElement", name="ajouterElement",methods={"GET","POST"}))
     * @param Request $req
     * @param FileUploader $fileUploader
     * @return Response
     *
     */

    public function Ajouter(Request $req): Response
    {
        $Element = new Element();

       // $response = new QrCodeResponse($result);
        $formClassroom = $this->createForm(ElementFormType::class, $Element);
        $formClassroom->handleRequest($req);
        if (($formClassroom->isSubmitted()) && ($formClassroom->isValid()))
        {

            $uploadedFile = $formClassroom['image']->getData();
            $pathupload = $this->getParameter('kernel.project_dir').'/public/uploads/images';
            $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
            $newFilename = urlizer::urlize($originalFilename).'-'.uniqid().'.'.$uploadedFile->guessExtension();
            $uploadedFile->move(
                $pathupload,
                $newFilename
            );
            $Element->setImage($newFilename);



            $entityManager=$this->getDoctrine()->getManager();
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($Element);
            $manager->flush();
            return $this->redirectToRoute('afficherElement');
        }
        return $this->render('element/AjouterElement.twig', ['Element' => $formClassroom->createView()]);


        }



    /**
     * @Route("/afficherElement", name="afficherElement")
     */
    public function AfficherElement()
    {
        $repo = $this->getDoctrine()->getRepository(Element::class);
        $element = $repo->findAll();
        return $this->render('element/AfficherElement.twig', ["element" => $element]);



        }

    /**
     * @Route("/supprimerElement/{id}", name="supprimer")
     */
    public function supprimer($id)
    {
        $Element=$this->getDoctrine()->getRepository(Element::class)->find($id);
        $a=$this->getDoctrine()->getManager();
        $a->remove($Element);
        $a->flush();
        return $this->redirectToRoute('afficher');
    }
    /**
     * @Route ("/modifierElement/{id}", name="modifier")
     */
    public function modifier($id,Request $req)
    {
        $Element=$this->getDoctrine()->getRepository(Element::class)->find($id);
        $form=$this->createForm(ElementFormType::class,$Element);
        $form->handleRequest($req);

        if($form->isSubmitted() && $form->isValid())
        {

            $a=$this->getDoctrine()->getManager();
            $a->flush();
            return $this->redirectToRoute('afficher');
        }
        return $this->render('element/AjouterElement.twig', [
            'Element'=>$form->createView()

        ]);
    }

    /**
     * @Route("/afficherElementFront", name="afficherElementFront")
     */
    public function AfficherElementFront()
    {
        $repo = $this->getDoctrine()->getRepository(Element::class);
        $element = $repo->findAll();
        return $this->render('element/AfficherElementFront.twig', ["element" => $element]);



    }

}
