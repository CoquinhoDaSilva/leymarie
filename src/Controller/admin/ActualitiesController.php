<?php


namespace App\Controller\admin;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ActualitiesController extends AbstractController
{
    /**
     * @Route("/admin/actualities", name="admin_actualities")
     */
    public function actualities() {

       return $this->render('admin/actualities/actualities.html.twig');
    }

    /**
     * @Route("/admin/actuality/{id]", name="admin_actuality")
     */
    public function actuality() {

        return $this->render('admin/actualities/actuality.html.twig');
    }

    /**
     * @Route("/admin/actuality/insert", name="admin_insert_actuality")
     */
    public function insertActuality() {

        return $this->render('admin/actualities/insert_actuality.html.twig');
    }

    /**
     * @Route("/admin/actuality/search", name="admin_search_actuality")
     */
    public function searchActuality() {

        return $this->render('admin/actualities/search_actuality.html.twig');
    }

    /**
     * @Route("/admin/actuality/update", name="admin_update_actuality")
     */
    public function updateActuality() {

        return $this->render('admin/actualities/update_actuality.html.twig');
    }

    /**
     * @Route("/admin/actuality/delete", name="admin_delete_actuality")
     */
    public function deleteActuality() {

        return $this->render('admin/actualities/delete_actuality.html.twig');
    }

}