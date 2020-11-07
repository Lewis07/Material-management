<?php

namespace App\Controller;

use App\Entity\Mobilier;
use App\Form\MobilierType;
use App\Repository\MobilierRepository;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
* @Route("/mobilier", name="mobilier_")
*/
class MobilierController extends AbstractController
{
    private $em;
    private $repoMobilier;

    /**
     * Constructeur
     *
     * @param EntityManagerInterface $em
     * @param MobilierRepository $repoMobilier
     */
    public function __construct(EntityManagerInterface $em,MobilierRepository $repoMobilier)
    {
        $this->em = $em;
        $this->repoMobilier = $repoMobilier;
    }

    /**
     * Enregistrement et affichage des mobiliers
     *
     * @param Request $request
     * @Route("/", name="index")
     * @IsGranted("ROLE_ORDONNATEUR")
     * @return Response
     */
    public function index(Request $request)
    {
        $mobilier = new Mobilier();
        $affichMobilier = $this->repoMobilier->findAll();      

        $form = $this->createForm(MobilierType::class,$mobilier);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($mobilier);
            $this->em->flush();
            $this->addFlash('success','Mobilier ajouté avec succès');
            return $this->redirectToRoute('mobilier_index');
        }
        else if( $form->isSubmitted() && !( $form->isValid() ) ){
            $this->addFlash('error',"Ce mobilier existe déjà");
            return $this->redirectToRoute('mobilier_index');
        }

        return $this->render('mobilier/affichMobilier.html.twig', [
            'formMobilier' => $form->createView(),
            'affichMobilier' => $affichMobilier,
        ]);
    }

    /**
     * Modification de mobilier
     *
     * @param Request $request
     * @param Mobilier $mobilier
     *  @Route("/editer/{id}", name="update")
     * @IsGranted("ROLE_ORDONNATEUR")
     * @return Response
     */
    public function modif(Request $request,Mobilier $mobilier)
    {
        $form = $this->createForm(MobilierType::class,$mobilier);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($mobilier);
            $this->em->flush();
            $this->addFlash('success','Mobilier modifié avec succès');
            return $this->redirectToRoute('mobilier_index');
        }

        return $this->render('mobilier/editerMobilier.html.twig', [
            'formMobilier' => $form->createView(),
        ]);
    }

    /**
     * Suppression de mobilier
     *
     * @param Mobilier $mobilier
     * @Route("/delete/{id}", name="delete")
     * @IsGranted("ROLE_ORDONNATEUR")
     * @return Response
     */
    public function suppression(Mobilier $mobilier){
        $this->em->remove($mobilier);
        $this->em->flush();
        $this->addFlash('success','Mobilier supprimé avec succès');
        return $this->redirectToRoute('mobilier_index');
    }

    /**
     * Permet de suivre l'état des mobiliers
     * @Route("/suivi-mobilier", name="suivi")
     * @IsGranted("ROLE_DEPOSITAIRE")
     * @return Response
     */
     public function suiviMobilier()
     {
         $suiviMobilier = $this->repoMobilier->findBy([
             'service' => true
         ]);
         return $this->render('mobilier/suiviMobilier.html.twig', [
             'suiviMobilier' => $suiviMobilier
         ]);
     }
}
