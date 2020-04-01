<?php


namespace App\Controller\admin;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HealthcareController extends AbstractController
{
    /**
     * @Route("/admin/healthcare", name="admin_healthcare")
     */
    public function healthcare() {

        return $this->render('admin/healthcare/healthcare.html.twig');
    }

    /**
     * @Route("/admin/healthcare/insert", name="admin_insert_healthcare")
     */
    public function insertHealthcare() {

        return $this->render('admin/healthcare/insert_healthcare.html.twig');
    }

    /**
     * @Route("/admin/healthcare/search", name="admin_search_healthcare")
     */
    public function searchHealthcare() {

        return $this->render('admin/healthcare/search_healthcare.html.twig');
    }

    /**
     * @Route("admin/healthcare/update", name="admin_update_healthcare")
     */
    public function updateHealthcare() {

        return $this->render('admin/healthcare/update_healthcare.html.twig');
    }

    /**
     * @Route("admin/healthcare/delete", name="admin_delete_healthcare")
     */
    public function deleteHealthcare() {

        return $this->render('admin/healthcare/delete_healthcare.html.twig');
    }

}