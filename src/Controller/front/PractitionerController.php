<?php


namespace App\Controller\front;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PractitionerController extends AbstractController
{

    /**
     *@Route("/practitioner", name="practitioner")
     */
    public function practitioner() {

        return $this->render('front/practitioner/practitioner.html.twig');
    }
}