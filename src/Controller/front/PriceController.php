<?php


namespace App\Controller\front;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PriceController extends AbstractController
{
    /**
     * @Route("/prices", name="prices")
     */
    public function prices() {

        return $this->render('front/prices/prices.html.twig');
    }

}