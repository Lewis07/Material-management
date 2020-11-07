<?php

namespace App\Controller;

use App\Entity\Role;
use App\Form\RoleType;
use App\Repository\RoleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/role")
 */
class RoleController extends AbstractController
{
    /**
     * @Route("/", name="role_index")
     */
    public function index(RoleRepository $roleRepository,Request $request): Response
    {
        $role = new Role();
        $form = $this->createForm(RoleType::class, $role);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($role);
            $entityManager->flush();
            $this->addFlash('success','Rôle ajouté avec succès');
            return $this->redirectToRoute('role_index');
        }

        return $this->render('role/index.html.twig', [
            'roles' => $roleRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="role_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Role $role,RoleRepository $roleRepository,$id): Response
    {
        $role = $roleRepository->find($id);
        $role->setNomRole( $request->request->get('titre') );
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($role);
        $entityManager->flush();
        $this->addFlash('success','Rôle modifié avec succès');
        return $this->redirectToRoute('role_index');
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
     * @Route("/{id}/delete", name="role_delete")
     */
    public function delete(Request $request, Role $role): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($role);
        $entityManager->flush();
        $this->addFlash('success','Rôle supprimé avec succès');
        return $this->redirectToRoute('role_index');
    }
}
