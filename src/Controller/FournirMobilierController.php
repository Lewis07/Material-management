<?php

namespace App\Controller;

use App\Entity\FournirMobilier;
use App\Form\FournirMobilierType;
use App\Repository\FournirMobilierRepository;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FournirMobilierController extends AbstractController
{
    // ----------------AJOUT ET AFFICHAGE DE FournirMobilier ----------------------------------------------

    /**
     * @Route("/fournir/mobilier", name="fournir_mobilier")
     * @IsGranted("ROLE_COMPTABLE")
     * 
     */
    public function index(Request $request,FournirMobilierRepository $repoFournirMobilier)
    {
        $fournirMobilier = new FournirMobilier();
        $affichFournirMobilier = $repoFournirMobilier->findAll();

        $form = $this->createForm(FournirMobilierType::class,$fournirMobilier);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $manager = $this->getDoctrine()->getManager();

            $manager->persist($fournirMobilier);
            $manager->flush();

            $this->addFlash('success','Approvisionnement de mobilier ajouté avec succès');
            return $this->redirectToRoute('fournir_mobilier');
        }

        else if( $form->isSubmitted() && !( $form->isValid() ) ){
            $this->addFlash('error',"Cet approvisionnement de mobilier existe déjà");
            return $this->redirectToRoute('fournir_mobilier');
        }

        return $this->render('fournir_mobilier/affichFournirMobilier.html.twig', [
            'formFournirMobilier' => $form->createView(),
            'affichFournirMobilier' => $affichFournirMobilier
        ]);
    }

    // ----------------MODIFICATION DE FournirMobilier ----------------------------------------------
    /**
     * @Route("/fournir/mobilier/editer/{id}", name="fournir_mobilier.update")
     * @IsGranted("ROLE_COMPTABLE")
     */
    public function modif(Request $request,FournirMobilier $fournirMobilier)
    {
        $form = $this->createForm(FournirMobilierType::class,$fournirMobilier);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $manager = $this->getDoctrine()->getManager();

            $manager->persist($fournirMobilier);
            $manager->flush();

            $this->addFlash('success','Approvisionnement de mobilier modifié avec succès');
            return $this->redirectToRoute('fournir_mobilier');
        }

        return $this->render('fournir_mobilier/editerFournirMobilier.html.twig', [
            'formFournirMobilier' => $form->createView(),
        ]);
    }

    // ----------------SUPPRESSION DE fournirMobilier ----------------------------------------------
    /**
     * @Route("/fournir/mobilier/{id}", name="fournir_mobilier.delete")
     * @IsGranted("ROLE_COMPTABLE")
     */
    public function suppression(FournirMobilier $fournirMobilier){
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($fournirMobilier);
        $entityManager->flush();

        $this->addFlash('success','Approvisionnement de mobilier supprimé avec succès');
        return $this->redirectToRoute('fournir_mobilier');
    }
}
