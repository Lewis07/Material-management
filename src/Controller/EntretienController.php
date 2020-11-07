<?php

namespace App\Controller;

use App\Entity\Entretien;
use App\Form\EntretienType;

use App\Repository\EntretienRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EntretienController extends AbstractController
{
    // ------------AFFICHAGE et AJOUT----------------------------------------------------------


    /**
     * @Route("/entretien", name="entretien")
     * @IsGranted("ROLE_COMPTABLE")
     */
   
    public function index(Request $request,EntretienRepository $repoEntretien)
    {
        $entretien = new Entretien();
        $affichEntretien = $repoEntretien->findAll();
        $manager = $this->getDoctrine()->getManager();

        $form = $this->createForm(EntretienType::class,$entretien);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($entretien);
            $manager->flush();
    
            $this->addFlash('success','Entretien ajouté avec succès');
            return $this->redirectToRoute('entretien');
        }

        return $this->render('entretien/affichEntretien.html.twig', [
            'formEntretien' => $form->createView(),
            'affichEntretien' => $affichEntretien
        ]);
    }

    // ------------MISE A JOUR----------------------------------------------------------

    /**
     * @Route("/entretien/editer/{id}", name="entretien.update")
     * @IsGranted("ROLE_COMPTABLE")
     */
    public function updates(Entretien $entretien,Request $request)
    {

        $form = $this->createForm(EntretienType::class,$entretien);
        $manager = $this->getDoctrine()->getManager();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($entretien);
            $manager->flush();
    
            $this->addFlash('success','Entretien mofifié avec succès');
            return $this->redirectToRoute('entretien');
        }

        return $this->render('entretien/editEntretien.html.twig', [
            'formEntretien' => $form->createView()
        ]);
    }

     // ------------SUPPRESSION----------------------------------------------------------

    /**
    * @Route("/entretien/{id}", name="entretien.delete")
    * @IsGranted("ROLE_COMPTABLE")
    */
    public function suppression(Entretien $entretien,Request $request){

        $manager = $this->getDoctrine()->getManager();

        $manager->remove($entretien);
        $manager->flush();

        $this->addFlash('success','Entretien supprimé avec succès');
        return $this->redirectToRoute('entretien');
    }
}
