<?php


namespace App\Controller\front;


use App\Repository\HealthcareRepository;
use App\Repository\PriceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PriceController extends AbstractController
{
    /**
     * @Route("/prices", name="prices")
     * @param PriceRepository $priceRepository
     * @param HealthcareRepository $healthcareRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function prices(PriceRepository $priceRepository, HealthcareRepository $healthcareRepository) {

        $prices = $priceRepository->findAll();
        $healthcare= $healthcareRepository->findAll();

        return $this->render('front/prices/prices.html.twig', [
            'prices'=>$prices,
            'healthcare'=>$healthcare
        ]);
    }

}