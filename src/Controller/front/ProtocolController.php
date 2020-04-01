<?php


namespace App\Controller\front;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProtocolController extends AbstractController
{

    /**
     *@Route("/protocol", name="protocol")
     */
    public function protocol() {

        return $this->render('front/protocol/protocol.html.twig');
    }
}