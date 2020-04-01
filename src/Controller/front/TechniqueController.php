<?php


namespace App\Controller\front;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TechniqueController extends AbstractController
{

    /**
     *@Route("/technique", name="technique")
     */
    public function technique() {

        return $this->render('front/technique/technique.html.twig');
    }
}