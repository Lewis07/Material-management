<?php

namespace App\Controller;

use App\Entity\Declaration;
use App\Form\DeclarationType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\DeclarationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/declaration", name="declaration_")
 * @IsGranted("ROLE_RESPONSABLE")
 */
class DeclarationController extends AbstractController
{
    private $em;
    private $declarationRepository;

    /**
     * Constructeur
     *
     * @param EntityManagerInterface $em
     * @param DeclarationRepository $declarationRepository
     */
    public function __construct(EntityManagerInterface $em,DeclarationRepository $declarationRepository)
    {
        $this->em = $em;
        $this->declarationRepository = $declarationRepository;
    }

    /**
     * Enregistrement et affichage de déclaration
     *
     * @param Request $request
     * @param DeclarationRepository $declarationRepository
     * @Route("/", name="index")
     * @return Response
     */
    public function index(Request $request)
    {
        $declaration = new Declaration();
        $form = $this->createForm(DeclarationType::class, $declaration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($declaration);
            $this->em->flush();
            $this->addFlash('success','Declaration ajouté avec succès');
            return $this->redirectToRoute('declaration_index');
        }

        return $this->render('declaration/affichDeclaration.html.twig', [
            'declarations' => $this->declarationRepository->findAll(),
            'formDeclaration' => $form->createView()
        ]);
    }

    /**
     * Modification de déclaration
     *
     * @param Request $request
     * @param Declaration $declaration
     * @Route("/editer/{id}", name="edit")
     * @return Response
     */
    public function edit(Request $request, Declaration $declaration): Response
    {
        $form = $this->createForm(DeclarationType::class, $declaration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($declaration);
            $this->em->flush();
            $this->addFlash('success','Declaration modifié avec succès');
            return $this->redirectToRoute('declaration_index');
        }

        return $this->render('declaration/editDeclaration.html.twig', [
            'declaration' => $declaration,
            'formDeclaration' => $form->createView(),
        ]);
    }

    /**
     * Suppression de déclaration
     *
     * @param Request $request
     * @param Declaration $declaration
     * @Route("/delete/{id}", name="delete")
     * @return Response
     */
    public function delete(Request $request, Declaration $declaration)
    {
        // if ($this->isCsrfTokenValid('delete'.$declaration->getId(), $request->request->get('_token'))) {
            $this->em->remove($declaration);
            $this->em->flush();
        // }
        $this->addFlash('success','Declaration supprimé avec succès');
        return $this->redirectToRoute('declaration_index');
    }
}
