<?php


namespace App\Controller\admin;



use App\Entity\AlertMessage;
use App\Entity\Protocol;
use App\Form\AlertMessageType;
use App\Form\ProtocolType;
use App\Repository\AlertMessageRepository;
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
            'protocol'=>$protocol,
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

        return $this->render('admin/pages/insert_protocol.html.twig', [
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
            'protocol'=>$protocol
        ]);



    }


    /**
     * @Route ("/admin/alertmessage", name="admin_alert_message")
     * @param AlertMessageRepository $alertMessageRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function alertMessage(AlertMessageRepository $alertMessageRepository) {

        $alertMessage = $alertMessageRepository->findAll();

        return $this->render('admin/pages/alertMessage.html.twig', [
            'alertMessage'=>$alertMessage
        ]);
    }

    /**
     * @Route ("/admin/alertmessage/insert", name="admin_insert_alert_message")
     */
    public function insertAlertMessage(AlertMessageRepository $alertMessageRepository, Request $request, SluggerInterface $slugger, EntityManagerInterface $entityManager) {

        $alertMessageView = $alertMessageRepository->findAll();
        $alertMessage = new AlertMessage;

        $formAlert = $this->createForm(AlertMessageType::class, $alertMessage);
        $formAlert->handleRequest($request);

        if ($formAlert->isSubmitted() && $formAlert->isValid()) {

            $picture = $formAlert->get('picture')->getData();

            if ($picture) {

                $originalFilename = pathinfo($picture->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename. '-'.uniqid().'.'.$picture->guessExtension();

                $picture->move(
                    $this->getParameter('pictures_directory'),
                    $newFilename
                );

                $alertMessage->setPicture($newFilename);
            }

            $entityManager->persist($alertMessage);
            $entityManager->flush();

            $this->addFlash('success', 'L\'article a bien été ajouté !');

            return $this->redirectToRoute('admin_insert_alert_message');
        }

        return $this->render('admin/pages/insert_alertMessage.html.twig', [
            'alertMessageView'=>$alertMessageView,
            'formAlert'=>$formAlert->createView()
        ]);
    }

    /**
     * @Route ("/admin/alertmessage/show/{id}", name="admin_alert_message_one")
     * @param $id
     * @param AlertMessageRepository $alertMessageRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function adminMessage($id, AlertMessageRepository  $alertMessageRepository) {

        $alertMessage = $alertMessageRepository->find($id);

        return $this->render('admin/pages/message.html.twig', [
            'alertMessage'=>$alertMessage
        ]);
    }


    /**
     * @Route("/admin/alertmessage/update/{id}", name="admin_update_alert_message")
     * @param AlertMessageRepository $alertMessageRepository
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param $id
     * @param SluggerInterface $slugger
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateAlert(
        AlertMessageRepository $alertMessageRepository,
        Request $request,
        EntityManagerInterface $entityManager,
        $id,
        SluggerInterface $slugger) {

        $alertMessage = $alertMessageRepository->find($id);

        $formAlert = $this->createForm(AlertMessageType::class, $alertMessage);
        $formAlert->handleRequest($request);

        if ($formAlert->isSubmitted() && $formAlert->isValid()) {

            $picture = $formAlert->get('picture')->getData();

            if ($picture) {

                $originalFilename = pathinfo($picture->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename. '-'.uniqid().'.'.$picture->guessExtension();

                $picture->move(
                    $this->getParameter('pictures_directory'),
                    $newFilename
                );

                $alertMessage->setPicture($newFilename);
            }

            $entityManager->persist($alertMessage);
            $entityManager->flush();

            $this->addFlash('success', 'L\'article a bien été modifié !');

        }

        return $this->render('admin/pages/update_alertMessage.html.twig', [
            'formAlert'=>$formAlert->createView(),
            'alertMessage'=>$alertMessage
        ]);
    }

}