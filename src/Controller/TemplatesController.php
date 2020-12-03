<?php

namespace App\Controller;

use App\Entity\Skill;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TemplatesController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('templates/index.html.twig', [
            'controller_name' => 'TemplatesController',
        ]);
    }

    /**
     * @Route("/profile", name="profile")
     */
    public function profile(): Response
    {
        $skills = $this->getDoctrine()->getRepository(Skill::class)->findAll();

        return $this->render('templates/profile.html.twig', [
            'skills' => $skills,
        ]);
    }

    /**
     * @Route("/gallery", name="gallery")
     */
    public function gallery(): Response
    {
        return $this->render('templates/gallery.html.twig', [
            'controller_name' => 'TemplatesController',
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(): Response
    {
        return $this->render('templates/contact.html.twig', [
            'controller_name' => 'TemplatesController',
        ]);
    }
}
