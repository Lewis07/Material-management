<?php

namespace App\Controller;

use App\Repository\MaterielRepository;
use App\Repository\MobilierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EtatDetentionController extends AbstractController
{
    private $em;
    private $repoMateriel;
    private $repoMobilier;

    /**
     * Constructeur
     *
     * @param EntityManagerInterface $em
     * @param MaterielRepository $repoMateriel
     */
    public function __construct(EntityManagerInterface $em,MaterielRepository $repoMateriel,MobilierRepository $repoMobilier)
    {
        $this->em = $em;
        $this->repoMateriel = $repoMateriel;
        $this->repoMobilier = $repoMobilier;
    }

    /**
     * Etat de matériel après la détention
     *
     * @param Request $request
     * @param int $id
     * @Route("/etat-materiel/{id}", name="etat_detention_materiel")
     * @return Response
     */
    public function index(Request $request,$id)
    {
        $etatMateriel = $this->repoMateriel->find($id);
        $etatMateriel->setEtatRetourMateriel( $request->request->get('etat') );
        $this->em->flush();
        $this->addFlash('success','Etat modifié avec succès');
        return $this->redirectToRoute('detenir_materiel_index');
    }

    /**
     * Etat de mobilier après la détention
     *
     * @param Request $request
     * @param int $id
     * @Route("/etat-mobiliers/{id}", name="etat_detention_mobilier")
     * @return Response
     */
    public function etat(Request $request,$id)
    {
        $etatMobilier = $this->repoMobilier->find($id);
        $etatMobilier->setEtat( $request->request->get('etat') );
        $this->em->flush();
        $this->addFlash('success','Etat modifié avec succès');
        return $this->redirectToRoute('detenir_mobilier_index');
    }
}
