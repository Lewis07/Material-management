<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
* @Route("/categorie", name="categorie_")
* @IsGranted("ROLE_ORDONNATEUR")
*/
class CategorieController extends AbstractController
{
    private $em;
    private $repoCategorie;

    /**
     * Constructeur
     *
     * @param EntityManagerInterface $em
     * @param CategorieRepository $repoCategorie
     */
    public function __construct(EntityManagerInterface $em,CategorieRepository $repoCategorie)
    {
        $this->em = $em;
        $this->repoCategorie = $repoCategorie;
    }
    
    /**
     * Enregistrement et affichage de catégorie
     *
     * @param Request $request
     * @Route("/", name="index")
     * @return Response
     */
    public function index(Request $request)
    {   
        $categorie = new Categorie();
        $affichCategorie = $this->repoCategorie->findAll();

        $form = $this->createForm(CategorieType::class,$categorie);
        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() ) {
            $this->em->persist($categorie);
            $this->em->flush();
            $this->addFlash('success','Categorie ajouté avec succès');
            return $this->redirectToRoute('categorie_index');
        }
        
        else if( $form->isSubmitted() && !( $form->isValid() ) ){
            $this->addFlash('error',"Ce categorie existe déjà");
            return $this->redirectToRoute('categorie_index');
        }

        return $this->render('categorie/affichCategorie.html.twig', [
            'formCategorie' => $form->createView(),
            'affichCategorie' => $affichCategorie
        ]);
    }

    /**
     * Modification de catégorie
     *
     * @param int $id
     * @param Request $request
     * @Route("/editer/{id}", name="update")
     * @return Response
     */
    public function modification($id,Request $request){

        $categorie = $this->repoCategorie->find($id);
        $categorie->setLibelleCateg( $request->request->get('libelle') );
        $categorie->setDescriptionCateg( $request->request->get('description') );
        $this->em->persist($categorie);     
        $this->em->flush();
        $this->addFlash('success','Categorie modifié avec succès');
        return $this->redirectToRoute('categorie_index');
    }

    /**
     * Suppression de catégorie
     *
     * @param Categorie $categorie
     * @Route("/delete/{id}", name="delete")
     * @return Response
     */
    public function suppression(Categorie $categorie){
        $this->em->remove($categorie);
        $this->em->flush();
        $this->addFlash('success','Categorie supprimé avec succès');
        return $this->redirectToRoute('categorie_index');
    }
}
