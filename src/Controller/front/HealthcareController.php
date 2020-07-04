<?php


namespace App\Controller\front;


use App\Repository\HealthcareRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HealthcareController extends AbstractController
{
    /**
     * @Route("/healthcare", name="healthcare")
     * @param HealthcareRepository $healthcareRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function healthcare(HealthcareRepository $healthcareRepository) {

        $healthcare = $healthcareRepository->findAll();

        return $this->render('front/healthcare/healthcare.html.twig', [
            'healthcare'=>$healthcare
        ]);
    }

}