<?php

namespace App\Controller;

use App\Entity\Materiel;
use App\Entity\DetenirMateriel;
use App\Form\DetenirMaterielType;
use App\Repository\MaterielRepository;

use Doctrine\ORM\EntityManagerInterface;
use App\Repository\DetenirMaterielRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

// * @IsGranted("ROLE_RESPONSABLE")
/**
 * @Route("/detention-de-materiel", name="detenir_materiel_")
 */
class DetenirMaterielController extends AbstractController
{
    private $em;
    private $repoDetenirMateriel;

    /**
     * Constructeur
     *
     * @param EntityManagerInterface $em
     * @param DetenirMaterielRepository $repoDetenirMateriel
     * @param MaterielRepository $repoMateriel
     */
    public function __construct(EntityManagerInterface $em,DetenirMaterielRepository $repoDetenirMateriel,MaterielRepository $repoMateriel)
    {
        $this->em = $em;
        $this->repoDetenirMateriel = $repoDetenirMateriel;
        $this->repoMateriel = $repoMateriel;
    }

    /**
     * Enregistrement et affichage de détention de matériel
     *
     * @param Request $request
     * @Route("/", name="index")
     * @return Response
     */
    public function index(Request $request)
    {
        $detenirMateriel = new DetenirMateriel();
        $affichDetenirMateriel = $this->repoDetenirMateriel->findAll();

        $form = $this->createForm(DetenirMaterielType::class,$detenirMateriel);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($detenirMateriel);
            $this->em->flush();
            $this->addFlash('success','Détention de materiel ajouté avec succès');
            return $this->redirectToRoute('detenir_materiel_index');
        }
        else if( $form->isSubmitted() && !( $form->isValid() ) ){
            $this->addFlash('error',"Ce materiel est déjà detenu par un detenteur");
            return $this->redirectToRoute('detenir_materiel_index');
        }

        return $this->render('detenir_materiel/affichDetenirMateriel.html.twig', [
            'formDetenirMateriel' => $form->createView(),
            'affichDetenirMateriel' => $affichDetenirMateriel
        ]);
    }

    /**
     * Modification de matériel
     *
     * @param Request $request
     * @param DetenirMateriel $detenirMateriel
     * @Route("/editer/{id}", name="update")
     * @return Response
     */
    public function modif(Request $request,DetenirMateriel $detenirMateriel)
    {
        $form = $this->createForm(DetenirMaterielType::class,$detenirMateriel);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($detenirMateriel);
            $this->em->flush();
            $this->addFlash('success','Détention de materiel modifié avec succès');
            return $this->redirectToRoute('detenir_materiel_index');
        }

        return $this->render('detenir_materiel/editerDetenirMateriel.html.twig', [
            'formDetenirMateriel' => $form->createView(),
        ]);
    }

    /**
     * Suppression de détention de matériel
     *
     * @param DetenirMateriel $detenirMateriel
     * @Route("/delete/{id}", name="delete")
     * @return Response
     */
    public function suppression(DetenirMateriel $detenirMateriel){
        $this->em->remove($detenirMateriel);
        $this->em->flush();
        $this->addFlash('success','Détention de materiel supprimé avec succès');
        return $this->redirectToRoute('detenir_materiel_index');
    }
}
