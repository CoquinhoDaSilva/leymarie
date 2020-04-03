<?php


namespace App\Controller\admin;


use App\Entity\Price;
use App\Form\PriceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PriceController extends AbstractController
{
    /**
     * @Route("/admin/prices", name="admin_prices")
     */
    public function prices() {

        return $this->render('admin/prices/prices.html.twig');
    }

    /**
     * @Route("/admin/price/insert", name="admin_insert_price")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function insertPrice(Request $request, EntityManagerInterface $entityManager) {

        $price = new Price;

        $formPrice = $this->createForm(PriceType::class, $price);
        $formPrice->handleRequest($request);

        if($formPrice->isSubmitted() && $formPrice->isValid()) {

            $entityManager->persist($price);
            $entityManager->flush();
        }

        return $this->render('admin/prices/insert_price.html.twig', [
            'formPrice'=>$formPrice->createView()
        ]);
    }

    /**
     * @Route("/admin/price/update", name="admin_update_price")
     */
    public function updatePrice() {

        return $this->render('admin/prices/update_price.html.twig');
    }

    /**
     * @Route("/admin/price/delete", name="admin_delete_price")
     */
    public function deletePrice() {

        return $this->render('admin/prices/delete_price.html.twig');
    }

}