<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PassController extends AbstractController
{
    /**
     * @Route("/pass", name="pass")
     */
    public function index()
    {
        return $this->render('pass/index.html.twig', [
            'pass' => password_hash('password',PASSWORD_DEFAULT)
        ]);
    }
}
