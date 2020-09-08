<?php


namespace App\Controller\admin;


use App\Repository\BlocOneRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlocController extends AbstractController
{
    /**
     * @Route ("/admin/blocone/update/{id}", name="admin_update_bloc_one")
     * @param $id
     * @param BlocOneRepository $blocOneRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateOne($id, BlocOneRepository $blocOneRepository, EntityManagerInterface  $entityManager) {

        $blocOneView = $blocOneRepository->find($id);

        $blocOne = $blocOneRepository->find($id);


        $entityManager->persist($blocOne);
        $entityManager->flush();



        return $this->render('admin/blocs/update_bloc_one.html.twig', [
            'blocOne'=>$blocOneView
        ]);
    }


}