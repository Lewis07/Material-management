<?php

namespace App\Controller;

use App\Entity\Materiel;
use App\Form\MaterielType;
use App\Repository\MaterielRepository;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
* @Route("/materiel", name="materiel_")
*/
class MaterielController extends AbstractController
{
    private $em;
    private $repoMateriel;

    /**
     * Constructeur
     *
     * @param EntityManagerInterface $em
     * @param MaterielRepository $repoMateriel
     */
    public function __construct(EntityManagerInterface $em,MaterielRepository $repoMateriel)
    {
        $this->em = $em;
        $this->repoMateriel = $repoMateriel;
    }

    /**
     * Enregistrement et affichage de matériel
     *
     * @param Request $request
     * @Route("/", name="index")
     * @IsGranted("ROLE_ORDONNATEUR")
     * @return Response
     */
    public function index(Request $request)
    {
        $materiel = new Materiel();
        $affichMateriel = $this->repoMateriel->findAll();

        $form = $this->createForm(MaterielType::class,$materiel);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($materiel);
            $this->em->flush();
            $this->addFlash('success','Materiel ajouté avec succès');
            return $this->redirectToRoute('materiel_index');
        }
        else if( $form->isSubmitted() && !( $form->isValid() ) ){
            $this->addFlash('error',"Ce materiel existe déjà");
            return $this->redirectToRoute('materiel_index');
        }

        return $this->render('materiel/affichMateriel.html.twig', [
            'formMateriel' => $form->createView(),
            'affichMateriel' => $affichMateriel,
        ]);
    }

    /**
     * Modification de matériel
     *
     * @param Materiel $materiel
     * @param Request $request
     * @Route("/edit/{id}", name="updates")
     * @IsGranted("ROLE_ORDONNATEUR")
     * @return Response
     */
    public function modif(Materiel  $materiel,Request $request)
    {
        $form = $this->createForm(MaterielType::class,$materiel);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($materiel);
            $this->em->flush();
            $this->addFlash('success','Materiel modifié avec succès');
            return $this->redirectToRoute('materiel_index');
        }

        return $this->render('materiel/editMateriel.html.twig', [
            'formMateriel' => $form->createView(),
        ]);
    }

    // ----------------MODIFICATION DE Materiel avec modale ----------------------------------------------
    /**
     * @Route("/materiel/editer/{id}", name="Materiel.update")
     * @IsGranted("ROLE_ORDONNATEUR")
     */
    public function modification(Request $request,$id){

        $entityManager = $this->getDoctrine()->getManager();
        $materiel = $entityManager->getRepository(Materiel::class)->find($id);

        $materiel->setDesignation( $request->request->get('designation') );
        $materiel->setQteInitiale( $request->request->get('qteInitiale') );
        $materiel->setStock( $request->request->get('stock') );
        $materiel->setStockAlerte( $request->request->get('stockAlerte') );
        // $materiel->setCategorieMateriel( $request->request->get('categorie') );

              
        $entityManager->flush();

        $this->addFlash('success','Materiel modifié avec succès');
        return $this->redirectToRoute('materiel');
    }

    /**
     * Suppression de matériel
     *
     * @param Materiel $materiel
     * @Route("/delete/{id}", name="delete")
     * @IsGranted("ROLE_ORDONNATEUR")
     * @return Response
     */
    public function suppression(Materiel $materiel){
        $this->em->remove($materiel);
        $this->em->flush();
        $this->addFlash('success','Materiel supprimé avec succès');
        return $this->redirectToRoute('materiel_index');
    }

    /**
     * Suivi des matériels
     * @Route("/suivi-materiel", name="suivi")
     * @IsGranted("ROLE_DEPOSITAIRE")
     * @return Response
     */
    public function suiviMateriel()
    {
        $suiviMat = $this->repoMateriel->findBy([
            'service' => true
        ]);
        // dd($suiviMat);
        return $this->render('materiel/suiviMateriel.html.twig', [
            'suiviMat' => $suiviMat
        ]);
    }

    /**
     * Inventaire de l'état de matériel en service
     * @Route("/inventaire-etat", name="etat_materiel")
     * @return Response
     */
    public function etatMateriel()
    {
        $etatMat = $this->repoMateriel->etatMateriel();
        return $this->render('materiel/inventaireEtatMateriel.html.twig', [
            'etatMat' => $etatMat
        ]);
    }
}
