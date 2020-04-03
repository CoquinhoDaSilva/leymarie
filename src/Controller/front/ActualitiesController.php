<?php


namespace App\Controller\front;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ActualitiesController extends AbstractController
{
    /**
     * @Route("/articles", name="articles")
     */
    public function actualities() {

        return $this->render('front/articles/articles.html.twig');
    }

    /**
     * @Route("/actuality/{id]", name="actuality")
     */
    public function actuality() {

        return $this->render('front/articles/article.html.twig');
    }

    /**
     * @Route("/actuality/search", name="search_actuality")
     */
    public function searchActuality() {

        return $this->render('front/articles/search_article.html.twig');
    }

}