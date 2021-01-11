<?php

namespace App\Controller;

use App\Entity\Skill;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DatabaseController extends AbstractController
{
    /**
     * @Route("/database", name="database")
     */
    public function createSkill(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $skill = new Skill();
        $skill->setTitle('Ma troisième compétence');
        $skill->setStar(4);
        $skill->setContent('
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium velit atque cumque quos, 
            officia eius illo repudiandae natus commodi quo optio expedita sint molestias rerum minima 
            fugiat magnam officiis unde. Lorem ipsum dolor sit amet consectetur adipisicing elit. 
            Accusantium velit atque cumque quos, officia eius illo repudiandae natus commodi quo optio 
            expedita sint molestias rerum minima fugias illo repudiandae natus commodi quo optio expedita 
            sint molestias rerum minima fugiat magnam officiis unde.
        ');

        /* $entityManager->persist($skill);
        $entityManager->flush(); */

        return new Response('Compétence enregistrée ! Son id : ' . $skill->getId());
    }
}
