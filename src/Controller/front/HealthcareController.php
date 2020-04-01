<?php


namespace App\Controller\front;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HealthcareController extends AbstractController
{
    /**
     * @Route("/healthcare", name="healthcare")
     */
    public function healthcare() {

        return $this->render('front/healthcare/healthcare.html.twig');
    }

    /**
     * @Route("/healthcare/search", name="search_healthcare")
     */
    public function searchHealthcare() {

        return $this->render('front/healthcare/search_healthcare.html.twig');
    }

}