<?php


namespace App\Controller\front;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LegalController extends AbstractController
{

    /**
     *@Route("/legal", name="legal")
     */
    public function legal() {

        return $this->render('front/legal/legal.html.twig');
    }
}