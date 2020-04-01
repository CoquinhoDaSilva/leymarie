<?php


namespace App\Controller\admin;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     */
    public function insertPrice() {

        return $this->render('admin/prices/insert_price.html.twig');
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