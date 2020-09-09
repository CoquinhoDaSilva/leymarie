<?php


namespace App\Controller\admin;


use App\Form\BlocOneType;
use App\Form\BlocTwoType;
use App\Repository\BlocOneRepository;
use App\Repository\BlocTwoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class BlocController extends AbstractController
{
    /**
     * @Route ("/admin/blocone/update/{id}", name="admin_update_bloc_one")
     * @param $id
     * @param BlocOneRepository $blocOneRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateOne(SluggerInterface $slugger, Request $request, $id, BlocOneRepository $blocOneRepository, EntityManagerInterface  $entityManager) {

        $blocOneView = $blocOneRepository->find($id);

        $blocOne = $blocOneRepository->find($id);

        $formBlocOne = $this->createForm(BlocOneType::class, $blocOne);
        $formBlocOne->handleRequest($request);

        if ($formBlocOne->isSubmitted() && $formBlocOne->isValid()) {

            $picture = $formBlocOne->get('picture')->getData();

            if ($picture) {

                $originalFilename = pathinfo($picture->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $picture->guessExtension();

                $picture->move(
                    $this->getParameter('pictures_directory'),
                    $newFilename
                );

                $blocOne->setPicture($newFilename);
            }

            $entityManager->persist($blocOne);
            $entityManager->flush();

            $this->addFlash('success', 'Le bloc a bien été modifié !');

            return $this->redirectToRoute('home');
        }

        return $this->render('admin/blocs/update_bloc_one.html.twig', [
            'blocOneView'=>$blocOneView,
            'formBlocOne'=>$formBlocOne->createView()
        ]);
    }

    /**
     * @Route ("/admin/bloctwo/update/{id}", name="admin_update_bloc_two")
     */
    public function updateTwo(SluggerInterface $slugger, Request $request, $id, EntityManagerInterface  $entityManager, BlocTwoRepository $blocTwoRepository) {

        $blocTwoView = $blocTwoRepository->find($id);

        $blocTwo = $blocTwoRepository->find($id);

        $formBlocTwo = $this->createForm(BlocTwoType::class, $blocTwo);
        $formBlocTwo->handleRequest($request);

        if ($formBlocTwo->isSubmitted() && $formBlocTwo->isValid()) {

            $picture = $formBlocTwo->get('picture')->getData();

            if ($picture) {

                $originalFilename = pathinfo($picture->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $picture->guessExtension();

                $picture->move(
                    $this->getParameter('pictures_directory'),
                    $newFilename
                );

                $blocTwo->setPicture($newFilename);
            }

            $entityManager->persist($blocTwo);
            $entityManager->flush();

            $this->addFlash('success', 'Le bloc a bien été modifié !');

            return $this->redirectToRoute('home');
        }

        return $this->render('admin/blocs/update_bloc_two.html.twig', [
            'blocTwoView'=>$blocTwoView,
            'formBlocTwo'=>$formBlocTwo->createView()
        ]);
    }


}