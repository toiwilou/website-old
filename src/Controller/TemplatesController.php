<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Skill;
use App\Entity\Image;
use App\Form\SkillFormType;
use App\Form\UserFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TemplatesController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request): Response
    {
        $contact = new Contact();
        $contactForm = $this->createForm(UserFormType::class, $contact);
        $contactForm->handleRequest($request);
        if($contactForm->isSubmitted() && $contactForm->isValid()){
            $doctrine = $this->getDoctrine()->getManager();
            $doctrine->persist($contact);
            //$doctrine->flush();
        }

        return $this->render('templates/index.html.twig', [
            'contactForm' => $contactForm->createView(),
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
     * @Route("/courses", name="courses")
     */
    public function courses(): Response
    {
        return $this->render('templates/contact.html.twig', [
            'controller_name' => 'TemplatesController',
        ]);
    }

    /**
     * @Route("/gallery", name="gallery")
     */
    public function gallery(): Response
    {
        $images = $this->getDoctrine()->getRepository(Image::class)->findAll();

        return $this->render('templates/gallery.html.twig', [
            'images' => $images,
        ]);
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function admin(Request $request): Response
    {
        

        $skills = new Skill();
        $skillsForm = $this->createForm(SkillFormType::class, $skills);
        $skillsForm->handleRequest($request);
        if($skillsForm->isSubmitted() && $skillsForm->isValid()){
            $doctrine = $this->getDoctrine()->getManager();
            $doctrine->persist($skills);
            //$doctrine->flush();
        }

        return $this->render('templates/admin.html.twig', [
            'skillsForm' => $skillsForm->createView(),
        ]);
    }
}
