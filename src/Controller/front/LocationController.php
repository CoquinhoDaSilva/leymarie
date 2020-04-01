<?php


namespace App\Controller\front;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LocationController extends AbstractController
{

    /**
     *@Route("/location", name="location")
     */
    public function location() {

        return $this->render('front/location/location.html.twig');
    }
}