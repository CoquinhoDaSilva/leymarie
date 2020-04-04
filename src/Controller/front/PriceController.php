<?php


namespace App\Controller\front;


use App\Repository\PriceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PriceController extends AbstractController
{
    /**
     * @Route("/prices", name="prices")
     * @param PriceRepository $priceRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function prices(PriceRepository $priceRepository) {

        $prices = $priceRepository->findAll();

        return $this->render('front/prices/prices.html.twig', [
            'prices'=>$prices
        ]);
    }

}