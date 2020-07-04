<?php


namespace App\Controller\admin;


use App\Entity\Healthcare;
use App\Form\HealthcareType;
use App\Repository\HealthcareRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class HealthcareController extends AbstractController
{
    /**
     * @Route("/admin/healthcare", name="admin_healthcare")
     * @param HealthcareRepository $healthcareRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function healthcare(HealthcareRepository $healthcareRepository) {

        $healthcare = $healthcareRepository->findBy([], ['id'=>'DESC']);

        return $this->render('admin/healthcare/healthcare.html.twig', [
            'healthcare'=>$healthcare
        ]);
    }

    /**
     * @Route("/admin/healthcare/insert", name="admin_insert_healthcare")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param SluggerInterface $slugger
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function insertHealthcare(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger) {

        $healthcare = new Healthcare;

        $formHealthcare = $this->createForm(HealthcareType::class, $healthcare);
        $formHealthcare->handleRequest($request);

        if ($formHealthcare->isSubmitted() && $formHealthcare->isValid()) {

            $picture = $formHealthcare->get('picture')->getData();

            if ($picture) {

                $originalFilename = pathinfo($picture->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename. '-'.uniqid().'.'.$picture->guessExtension();

                $picture->move(
                    $this->getParameter('healthcare_directory'),
                    $newFilename
                );

                $healthcare->setPicture($newFilename);

            }

            $entityManager->persist($healthcare);
            $entityManager->flush();

            $this->addFlash('success', 'Le soin a bien été rajouté !');

            return $this->redirectToRoute('admin_healthcare');

        }

        return $this->render('admin/healthcare/insert_healthcare.html.twig', [
            'formHealthcare'=>$formHealthcare->createView()
        ]);
    }

    /**
     * @Route("admin/healthcare/update/{id}", name="admin_update_healthcare")
     * @param Request $request
     * @param HealthcareRepository $healthcareRepository
     * @param EntityManagerInterface $entityManager
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateHealthcare(
        Request $request,
        HealthcareRepository $healthcareRepository,
        EntityManagerInterface $entityManager,
        $id)
    {

        $healthcare = $healthcareRepository->find($id);

        $formHealthcare = $this->createForm(HealthcareType::class, $healthcare);
        $formHealthcare->handleRequest($request);

        if ($formHealthcare->isSubmitted() && $formHealthcare->isValid()) {

            $entityManager->persist($healthcare);
            $entityManager->flush();

            $this->addFlash('success', 'Le soin a bien été modifié !');

            return $this->redirectToRoute('admin_healthcare');

        }

        return $this->render('admin/healthcare/update_healthcare.html.twig', [
            'formHealthcare'=>$formHealthcare->createView(),
            'healthcare'=>$healthcare
        ]);
    }

    /**
     * @Route("admin/healthcare/delete/{id}", name="admin_delete_healthcare")
     * @param HealthcareRepository $healthcareRepository
     * @param EntityManagerInterface $entityManager
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteHealthcare(
        HealthcareRepository $healthcareRepository,
        EntityManagerInterface $entityManager,
        $id)
    {

        $healthcare = $healthcareRepository->find($id);

        $entityManager->remove($healthcare);
        $entityManager->flush();

        $this->addFlash('success', 'Le soin a bien été supprimé !');

        return $this->redirectToRoute('admin_healthcare');
    }

}