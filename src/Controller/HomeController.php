<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/accueil", name="home")
     */
    public function index()
    {
        // $authChecker = $this->container->get('security.authorization_checker');

        // if($authChecker->isGranted('ROLE_ADMIN')){
        //     return $this->render('user/register.html.twig');
        // }
        // elseif($authChecker->isGranted('ROLE_COMPTABLE')){
        //     return redirectToRoute('fournir_materiel');
        // }
        // elseif($authChecker->isGranted('ROLE_ORDONNATEUR')){
        //     return redirectToRoute('categorie');
        // }
        // elseif($authChecker->isGranted('ROLE_HAFA')){
        //     return redirectToRoute('fonction');
        // }

        return $this->render('home/index.html.twig', [
            // 'controller_name' => 'HomeController',
        ]);
    }
}
