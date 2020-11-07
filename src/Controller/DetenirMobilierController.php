<?php

namespace App\Controller;

use App\Entity\Mobilier;
use App\Entity\DetenirMobilier;
use App\Form\DetenirMobilierType;
use App\Repository\MobilierRepository;

use Doctrine\ORM\EntityManagerInterface;
use App\Repository\DetenirMobilierRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/detention-de-mobilier", name="detenir_mobilier_")
 * @IsGranted("ROLE_RESPONSABLE")
 */
class DetenirMobilierController extends AbstractController
{
    private $em;
    private $repoDetenirMobilier;
    private $repoMobilier;

    /**
     * Constructeur
     *
     * @param EntityManagerInterface $em
     * @param DetenirMobilierRepository $repoDetenirMobilier
     */
    public function __construct(EntityManagerInterface $em,
                                DetenirMobilierRepository $repoDetenirMobilier,
                                MobilierRepository $repoMobilier)
    {
        $this->em = $em;
        $this->repoDetenirMobilier = $repoDetenirMobilier;
        $this->repoMobilier = $repoMobilier;
    }

    /**
     * Enregistrement et affichage de détention de mobilier
     *
     * @param Request $request
     * @Route("/", name="index")
     * @return Response
     */
    public function index(Request $request)
    {
        $detenirMobilier = new DetenirMobilier();
        $affichDetenirMobilier = $this->repoDetenirMobilier->findAll();

        $form = $this->createForm(DetenirMobilierType::class,$detenirMobilier);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($detenirMobilier);
            $this->em->flush();
            $this->addFlash('success','Détention de mobilier ajouté avec succès');
            return $this->redirectToRoute('detenir_mobilier_index');
        }
        else if( $form->isSubmitted() && !( $form->isValid() ) ){
            $this->addFlash('error',"Ce mobilier est déjà detenu par un detenteur");
            return $this->redirectToRoute('detenir_mobilier_index');
        }

        return $this->render('detenir_mobilier/affichDetenirMobilier.html.twig', [
            'formDetenirMobilier' => $form->createView(),
            'affichDetenirMobilier' => $affichDetenirMobilier,
        ]);
    }

    /**
     * Modification de détention de mobilier
     *
     * @param Request $request
     * @param DetenirMobilier $detenirMobilier
     * @Route("/editer/{id}", name="update")
     * @return Response
     */
    public function modif(Request $request,DetenirMobilier $detenirMobilier)
    {
        $form = $this->createForm(DetenirMobilierType::class,$detenirMobilier);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($detenirMobilier);
            $this->em->flush();
            $this->addFlash('success','Détention de mobilier modifié avec succès');
            return $this->redirectToRoute('detenir_mobilier_index');
        }

        return $this->render('detenir_mobilier/editerDetenirMobilier.html.twig', [
            'formDetenirMobilier' => $form->createView(),
        ]);
    }

    /**
     * Suppression de détention de mobilier 
     *
     * @param DetenirMobilier $detenirMobilier
     * @Route("/delete/{id}", name="delete")
     * @return Response
     */
    public function suppression(DetenirMobilier $detenirMobilier){
        $this->em->remove($detenirMobilier);
        $this->em->flush();
        $this->addFlash('success','Détention de materiel supprimé avec succès');
        return $this->redirectToRoute('detenir_mobilier_index');
    }
}
