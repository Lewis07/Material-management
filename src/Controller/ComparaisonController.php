<?php

namespace App\Controller;

use App\Repository\MobilierRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ComparaisonController extends AbstractController
{
    /**
     * @Route("/comparaison", name="comparaison")
     */
    public function index(MobilierRepository $repo)
    {
        $comp = $repo->comparaisonPrix();
        return $this->render('comparaison/index.html.twig', [
            'comp' => $comp
        ]);
    }
}
