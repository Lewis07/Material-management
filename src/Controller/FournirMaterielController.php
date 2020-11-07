<?php

namespace App\Controller;

use App\Entity\FournirMateriel;
use App\Form\FournirMaterielType;
use App\Repository\SourceRepository;
use App\Repository\MaterielRepository;

use App\Repository\FournirMaterielRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FournirMaterielController extends AbstractController
{

    // ----------------AJOUT ET AFFICHAGE DE FournirMateriel ----------------------------------------------
    /**
     * @Route("/fournir/materiel", name="fournir_materiel")
     * @IsGranted("ROLE_COMPTABLE")
     */
    public function index(Request $request,FournirMaterielRepository $repoFournirMateriel,SourceRepository $repoSource,MaterielRepository $repoMateriel)
    {
        $fournirMateriel = new FournirMateriel();
        $affichFournirMateriel = $repoFournirMateriel->findAll();
        $affichSource = $repoSource->findAll();
        $affichMateriel = $repoMateriel->findAll();

        $form = $this->createForm(FournirMaterielType::class,$fournirMateriel);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $manager = $this->getDoctrine()->getManager();

            // dd($fournirMateriel);

            $manager->persist($fournirMateriel);
            $manager->flush();

            $this->addFlash('success','Approvisionnement de matériel ajouté avec succès');
            return $this->redirectToRoute('fournir_materiel');
        }

        else if( $form->isSubmitted() && !( $form->isValid() ) ){
            $this->addFlash('error',"Cet approvisionnement de matériel existe déjà");
            return $this->redirectToRoute('fournir_materiel');
        }

        return $this->render('fournir_materiel/affichFournirMateriel.html.twig', [
            'formFournirMateriel' => $form->createView(),
            'affichFournirMateriel' => $affichFournirMateriel,
            'affichSource' => $affichSource,
            'affichMateriel' => $affichMateriel
        ]);
    }

    // ----------------MODIFICATION DE FournirMateriel ----------------------------------------------
    /**
     * @Route("/fournir/materiel/editer/{id}", name="fournir_materiel.update")
     * @IsGranted("ROLE_COMPTABLE")
     */
    public function modif(Request $request,FournirMateriel $fournirMateriel)
    {
        $form = $this->createForm(FournirMaterielType::class,$fournirMateriel);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $manager = $this->getDoctrine()->getManager();

            $manager->persist($fournirMateriel);
            $manager->flush();

            $this->addFlash('success','Approvisionnement de matériel modifié avec succès');
            return $this->redirectToRoute('fournir_materiel');
        }

        return $this->render('fournir_materiel/editerFournirMateriel.html.twig', [
            'formFournirMateriel' => $form->createView(),
        ]);
    }

     // ----------------SUPPRESSION DE FournirMateriel ----------------------------------------------
    /**
     * @Route("/fournir/materiel/{id}", name="fournir_materiel.delete")
     * @IsGranted("ROLE_COMPTABLE")
     */
    public function suppression(FournirMateriel $fournirMateriel){
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($fournirMateriel);
        $entityManager->flush();

        $this->addFlash('success','Approvisionnement de matériel supprimé avec succès');
        return $this->redirectToRoute('fournir_materiel');
    }
    
}
