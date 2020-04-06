<?php


namespace App\Controller\front;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PagesController extends AbstractController
{
    /**
     * @Route("/appointment", name="appointment")
     */
    public function appointment() {

        return $this->render('front/pages/appointment.html.twig');
    }

    /**
     *@Route("/legal", name="legal")
     */
    public function legal() {

        return $this->render('front/pages/legal.html.twig');
    }

    /**
     *@Route("/location", name="location")
     */
    public function location() {

        return $this->render('front/pages/location.html.twig');
    }

    /**
     *@Route("/practitioner", name="practitioner")
     */
    public function practitioner() {

        return $this->render('front/pages/practitioner.html.twig');
    }

    /**
     * @Route("/profile", name="profile")
     */
    public function profile() {

        return $this->render('front/pages/user.html.twig');
    }

    /**
     *@Route("/protocol", name="protocol")
     */
    public function protocol() {

        return $this->render('front/pages/protocol.html.twig');
    }

    /**
     *@Route("/technique", name="technique")
     */
    public function technique() {

        return $this->render('front/pages/technique.html.twig');
    }



}