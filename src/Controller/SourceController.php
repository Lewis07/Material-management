<?php

namespace App\Controller;

use App\Entity\Source;
use App\Form\SourceType;
use App\Repository\SourceRepository;
use Doctrine\ORM\EntityManagerInterface;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
* @Route("/source", name="source_")
* @IsGranted("ROLE_ORDONNATEUR")
*/
class SourceController extends AbstractController
{
    private $em;
    private $repoSource;

    /**
     * Constructeur
     *
     * @param EntityManagerInterface $em
     * @param SourceRepository $repoSource
     */
    public function __construct(EntityManagerInterface $em,SourceRepository $repoSource)
    {
        $this->em = $em;
        $this->repoSource = $repoSource;
    }

    /**
     * Enregistrement et affichage de source
     *
     * @param Request $request
     * @Route("/", name="index")
     * @return Response
     */
    public function index(Request $request)
    {
        $source = new Source();
        $affichSource = $this->repoSource->findAll();

        $form = $this->createForm(SourceType::class,$source);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($source);
            $this->em->flush();
            $this->addFlash('success','Source ajouté avec succès');
            return $this->redirectToRoute('source_index');
        }
        else if( $form->isSubmitted() && !( $form->isValid() ) ){
            $this->addFlash('error',"Ce source existe déjà ");
            return $this->redirectToRoute('source_index');
        }

        return $this->render('source/affichSource.html.twig', [
            'formSource' => $form->createView(),
            'affichSource' => $affichSource
        ]);
    }

    /**
     * Modification de source
     *
     * @param Request $request
     * @param int $id
     * @Route("/editer/{id}", name="update")
     * @return Response
     */
    public function modification(Request $request,$id){
        $source = $this->repoSource->find($id);
        $source->setNomSource( $request->request->get('nom') );
        $this->em->flush();
        $this->addFlash('success','Source modifié avec succès');
        return $this->redirectToRoute('source_index');
    }

    /**
     * Suppression de source
     *
     * @param Source $source
     * @Route("/delete/{id}", name="delete")
     * @return Response
     */
    public function suppression(Source $source){
        $this->em->remove($source);
        $this->em->flush();
        $this->addFlash('success','Source supprimé avec succès');
        return $this->redirectToRoute('source_index');
    }
}
