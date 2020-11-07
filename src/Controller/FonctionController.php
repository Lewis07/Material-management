<?php

namespace App\Controller;

use App\Entity\Fonction;
use App\Form\FonctionType;
use App\Repository\FonctionRepository;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @Route("/fonction",name="fonction_")
 * @IsGranted("ROLE_ADMIN")
 */
class FonctionController extends AbstractController
{
    private $em;
    private $fonctionRepository;

    /**
     * Constructeur
     *
     * @param EntityManagerInterface $em
     * @param FonctionRepository $fonctionRepository
     */
    public function __construct(EntityManagerInterface $em,FonctionRepository $fonctionRepository)
    {
        $this->em = $em;
        $this->fonctionRepository = $fonctionRepository;
    }
    
    /**
     * Enregistrement et affichage de fonction
     *
     * @param Request $request
     * @Route("/", name="index")
     * @return Response
     */
    public function index(Request $request)
    {
        $fonction = new Fonction();
        $affichFonction = $this->fonctionRepository->findAll();

        $form = $this->createForm(FonctionType::class, $fonction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->em->persist($fonction);
            $this->em->flush();

            $this->addFlash('success','Fonction ajouté avec succès');
            return $this->redirectToRoute('fonction_index');
        }

        else if( $form->isSubmitted() && !( $form->isValid() ) ){
            $this->addFlash('error',"Ce fonction existe déjà ");
            return $this->redirectToRoute('fonction_index');
        }

        return $this->render('fonction/affichFonction.html.twig', [
            'formFonction' => $form->createView(),
            'affichFonction' => $affichFonction,
        ]);
    }

    /**
     * Modification de fonction
     *
     * @param Request $request
     * @param int $id
     * @param FonctionRepository $fonctionRepository
     * @Route("/editer/{id}", name="update")
     * @return Response
     */
    public function modification(Request $request,$id){

        $fonction = $this->fonctionRepository->find($id);
        $fonction->setLibelle( $request->request->get('libelle') );
        $this->em->persist($fonction);
        $this->em->flush();
        $this->addFlash('success','Fonction modifié avec succès');
        return $this->redirectToRoute('fonction_index');
    }

    /**
     * Suppression de fonction
     *
     * @param Fonction $fonction
     * @Route("/{id}", name="delete")
     * @return Response
     */
    public function suppression(Fonction $fonction){
        $this->em->remove($fonction);
        $this->em->flush();
        $response = [
            'success' => true,
            'notif_suppr' => 'Fonction supprimé avec succès'
        ];
        echo json_encode($response);exit;
        // $this->addFlash('success','Fonction supprimé avec succès');
        // return $this->redirectToRoute('fonction_index');
    }
}
