<?php

namespace App\Controller;

use App\Entity\Sample;
use App\Form\SampleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/contact", name="contact")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function contact(Request $request)
    {
        $sample = new Sample();

        $form = $this->createForm(SampleType::class, $sample);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {

            return $this->redirectToRoute("contact");
        }

        return $this->render("sample/contact.html.twig", [
            "form" => $form->createView()
        ]);
    }
}
