<?php

namespace App\Controller;

use App\Entity\Role;
use App\Entity\User;
use App\Form\UserType;

use App\Form\DesignRoleType;
use App\Repository\RoleRepository;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    private $em;
    private $repoUser;
    private $roleRepository;

    /**
     * Constructeur
     *
     * @param EntityManagerInterface $em
     * @param UserRepository $repoUser
     * @param RoleRepository $roleRepository
     */
    public function __construct(EntityManagerInterface $em,UserRepository $repoUser,RoleRepository $roleRepository)
    {
        $this->em = $em;
        $this->repoUser = $repoUser;
        $this->roleRepository = $roleRepository;
    }
    
    /**
     * Enregistrement et affichage des utilisateurs 
     *
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @Route("/admin", name="security.register")
     * @IsGranted("ROLE_ADMIN")
     * @return Response
     */
    public function index(Request $request,UserPasswordEncoderInterface $encoder)
    {
        $user = new User();
        $affichUser = $this->repoUser->findAll();

        // Liste de tous les rôles dans la base de donnée
        $listRole = $this->roleRepository->findAll();

        $form = $this->createForm(UserType::class,$user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $mdp = $user->getPassword();
            $mdpCrypt = $encoder->encodePassword($user, $mdp);
            $user->setPassword($mdpCrypt);

            $role = new Role();
            $nomRole = $form->get('roleUser')->getData()->getNomRole();
            $user->setRole($nomRole);

            $this->em->persist($user);
            $this->em->flush();

            $this->addFlash('success','Utilisateur ajouté avec succès');
            return $this->redirectToRoute('security.register');
        }

        else if( $form->isSubmitted() && !( $form->isValid() ) ){
            $this->addFlash('error',"Ce nom d'utilisateur existe déjà ");
            return $this->redirectToRoute('security.register');
        }
        
        return $this->render('user/register.html.twig', [
            'formRegister' => $form->createView(),
            'affichUser' => $affichUser,
            'listRole' => $listRole
        ]);
    }

    /**
     * Modification d'un utilisateur
     *
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @param int $id
     * @Route("/admin/editer/{id}", name="security.update")
     * @IsGranted("ROLE_ADMIN")
     * @return Response
     */
    public function update(Request $request,UserPasswordEncoderInterface $encoder,$id)
    {
        $user = $this->repoUser->find($id);

        // get('name @champs input ')
        $user->setUsername($request->request->get('nom'));
        $user->setEmail($request->request->get('email'));
        $user->setRole($request->request->get('role'));

        $mdpass = $request->request->get('password');
        $mdpCrypt = $encoder->encodePassword($user, $mdpass);
        $user->setPassword($mdpCrypt);

        // dd($user);

        $this->em->persist($user);
        $this->em->flush();

        $this->addFlash('success','Utilisateur modifié avec succès');
        return $this->redirectToRoute('security.register');
    }

    /**
     * Suppression d'un utilisateur
     *
     * @param User $user
     * @param Request $request
     * @Route("/admin/{id}", name="security.delete")
     * @IsGranted("ROLE_ADMIN")
     * @return Response
     */
    public function suppression(User $user,Request $request){
        $this->em->remove($user);
        $this->em->flush();
        $this->addFlash('success','Utilisateur supprimé avec succès');
        return $this->redirectToRoute('security.register');
    }

    /**
     * Déconnexion
     *
     * @Route("/deconnexion", name="logout")
     * @return void
     */
    public function logout(){}

    /**
     * Permet de se connecter
     *
     * @param AuthenticationUtils $authenticationUtils
     * @Route("/", name="security.login")
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils){

        // obtenir l'erreur d'authentification
        $error = $authenticationUtils->getLastAuthenticationError();
        
        // Récupérer dernier pseudo
        $lastUsername = $authenticationUtils->getLastUsername();
        $user = new User();
        return $this->render('user/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'message_erreur' => 'Votre login ou mot de passe est incorrecte',
            'user' => $user
        ]);
    }

    /**
     * Enregistrement et affichage de désignation de rôle
     *
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @param UserRepository $repoUser
     * @Route("/ordonnateur", name="user.membre")
     * @IsGranted("ROLE_ORDONNATEUR")
     * @return Response
     */
    public function affichageOrdonnateur(Request $request,UserPasswordEncoderInterface $encoder)
    {
        $user = new User();
        $affichUser = $this->repoUser->roleInOrdonnateur();

        $form = $this->createForm(DesignRoleType::class,$user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $mdp = $user->getPassword();
            $mdpCrypt = $encoder->encodePassword($user, $mdp);
            $user->setPassword($mdpCrypt);

            $this->em->persist($user);
            $this->em->flush();
            $this->addFlash('success','Utilisateur ajouté avec succès');
            return $this->redirectToRoute('user.membre');
        }

        else if( $form->isSubmitted() && !( $form->isValid() ) ){
            $this->addFlash('error',"Ce nom d'utilisateur existe déjà ");
            return $this->redirectToRoute('user.membre');
        }
        
        return $this->render('user/designationRole.html.twig', [
            'formRegister' => $form->createView(),
            'affichUser' => $affichUser
        ]);
    }

    /**
     * Modification de désignation de rôle
     *
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @param UserRepository $repoUser
     * @param int $id
     * @Route("/ordonnateur/editer/{id}", name="ordonnateur.update")
     * @IsGranted("ROLE_ORDONNATEUR")
     * @return Response
     */
    public function updateOrdonnateur(Request $request,UserPasswordEncoderInterface $encoder,$id)
    {
        $user = $this->repoUser->find($id);
        // get('name @champs input ')
        $user->setUsername($request->request->get('nom'));
        $user->setEmail($request->request->get('email'));
        $user->setRole($request->request->get('role'));

        $mdpass = $request->request->get('password');
        $mdpCrypt = $encoder->encodePassword($user, $mdpass);
        $user->setPassword($mdpCrypt);

        $this->em->persist($user);
        $this->em->flush();

        $this->addFlash('success','Utilisateur modifié avec succès');
        return $this->redirectToRoute('user.membre');
    }

    /**
     * Suppression de désignation de rôle
     *
     * @param User $user
     * @param Request $request
     * @Route("/ordonnateur/{id}", name="ordonnateur.delete")
     * @IsGranted("ROLE_ORDONNATEUR")
     * @return Response
     */
    public function suppressionOrdonnateur(User $user,Request $request){
        $this->em->remove($user);
        $this->em->flush();
        $this->addFlash('success','Utilisateur supprimé avec succès');
        return $this->redirectToRoute('user.membre');
    }
}
