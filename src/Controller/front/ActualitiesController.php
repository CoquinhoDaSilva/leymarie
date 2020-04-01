<?php


namespace App\Controller\front;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ActualitiesController extends AbstractController
{
    /**
     * @Route("/actualities", name="actualities")
     */
    public function actualities() {

        return $this->render('front/actualities/actualities.html.twig');
    }

    /**
     * @Route("/actuality/{id]", name="actuality")
     */
    public function actuality() {

        return $this->render('front/actualities/actuality.html.twig');
    }

    /**
     * @Route("/actuality/search", name="search_actuality")
     */
    public function searchActuality() {

        return $this->render('front/actualities/search_actuality.html.twig');
    }

}