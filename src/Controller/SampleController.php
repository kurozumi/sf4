<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SampleController extends AbstractController
{
    /**
     * @Route("/sample", name="sample")
     */
    public function index()
    {
        return $this->render('sample/index.html.twig', [
            'controller_name' => 'SampleController',
        ]);
    }

    /**
     * @Route("/jump", name="jump")
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function jump()
    {
        return $this->redirectToRoute("sample");
    }
}
