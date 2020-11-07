<?php

namespace App\Controller;

use App\Entity\Detenteur;
use App\Form\DetenteurType;
use App\Repository\DetenteurRepository;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
* @Route("/detenteur", name="detenteur_")
* @IsGranted("ROLE_ORDONNATEUR")
*/
class DetenteurController extends AbstractController
{
    private $em;
    private $repoDetenteur;

    /**
     * Constructeur
     * 
     * @param EntityManagerInterface $em
     * @param DetenteurRepository $repoDetenteur
     */
    public function __construct(EntityManagerInterface $em,DetenteurRepository $repoDetenteur)
    {
        $this->em = $em;
        $this->repoDetenteur = $repoDetenteur;
    }

    /**
     * Enregistrement et affichage des détenteurs
     *
     * @param Request $request
     * @Route("/", name="index")
     * @return Response
     */
    public function index(Request $request)
    {   
        $detenteur = new Detenteur();
        $affichDetenteur = $this->repoDetenteur->findAll();

        $form = $this->createForm(DetenteurType::class,$detenteur);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($detenteur);
            $this->em->flush();
            $this->addFlash('success','Detenteur ajouté avec succès');
            return $this->redirectToRoute('detenteur_index');
        }

        return $this->render('detenteur/affichDetenteur.html.twig', [
            'formDetenteur' => $form->createView(),
            'affichDetenteur' => $affichDetenteur
        ]);
    }

    /**
     * Modification d'un détenteur
     *
     * @param Request $request
     * @return Response
     * @param Detenteur $detenteur
     * @Route("/editer/{id}", name="update")
     */
    public function modif(Request $request,Detenteur $detenteur)
    {   
        $form = $this->createForm(DetenteurType::class,$detenteur);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($detenteur);
            $this->em->flush();
            $this->addFlash('success','Detenteur mofifié avec succès');
            return $this->redirectToRoute('detenteur_index');
        }

        return $this->render('detenteur/editerDetenteur.html.twig', [
            'formDetenteur' => $form->createView(),
        ]);
    }

    /**
     * Suppression de détenteur
     *
     * @param Detenteur $detenteur
     * @Route("/delete/{id}", name="delete")
     * @return Response
     */
    public function suppression(Detenteur $detenteur){
        $this->em->remove($detenteur);
        $this->em->flush();
        $this->addFlash('success','Detenteur supprimé avec succès');
        return $this->redirectToRoute('detenteur_index');
    }
}
