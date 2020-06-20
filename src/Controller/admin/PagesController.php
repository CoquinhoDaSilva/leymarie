<?php


namespace App\Controller\admin;



use App\Entity\Protocol;
use App\Form\ArticleType;
use App\Form\ProtocolType;
use App\Repository\ProtocolRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class PagesController extends AbstractController
{

    /**
     * @Route("/admin/protocol", name="admin_protocol")
     * @param ProtocolRepository $protocolRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function adminProtocol(ProtocolRepository $protocolRepository) {

        $protocol = $protocolRepository->findAll();

        return $this->render('admin/pages/protocol.html.twig', [
            'protocol'=>$protocol
        ]);
    }

    /**
     * @Route("/admin/protocol/insert", name="admin_insert_protocol")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param SluggerInterface $slugger
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function insertProtocol(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger ) {

        $protocol = new Protocol;

        $formProtocol = $this->createForm(ProtocolType::class, $protocol);

        $formProtocol->handleRequest(($request));

        if ($formProtocol->isSubmitted() && $formProtocol->isValid()) {

            $picture = $formProtocol->get('picture')->getData();

            if ($picture) {

                $originalFilename = pathinfo($picture->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename. '-'.uniqid().'.'.$picture->guessExtension();

                $picture->move(
                    $this->getParameter('pictures_directory'),
                    $newFilename
                );

                $protocol->setPicture($newFilename);
            }

            $entityManager->persist($protocol);
            $entityManager->flush();

            $this->addFlash('success', 'L\'article a bien été modifié !');
        }

        return $this->render('admin/pages/protocol.html.twig', [
            'formProtocol'=>$formProtocol->createView()
        ]);

    }


    /**
     * @Route("/admin/protocol/update/{id}", name="admin_update_protocol")
     * @param $id
     * @param ProtocolRepository $protocolRepository
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateProtocol($id,ProtocolRepository $protocolRepository, EntityManagerInterface $entityManager, Request $request) {

        $protocol = $protocolRepository->find($id);

        $formProtocol = $this->createForm(ProtocolType::class, $protocol);
        $formProtocol->handleRequest($request);

        if ($formProtocol->isSubmitted() && $formProtocol->isValid()) {

            $entityManager->persist($protocol);
            $entityManager->flush();

            $this->addFlash('success', 'Le Protocol à bien été modifié !');

            return $this->redirectToRoute('admin_protocol');
        }


        return $this->render('admin/pages/update_protocol.html.twig', [
            'formProtocol'=>$formProtocol->createView(),
            'protocol'>$protocol
        ]);



    }
}