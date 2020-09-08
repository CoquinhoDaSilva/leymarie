<?php


namespace App\Controller\front;


use App\Entity\Protocol;
use App\Form\ProtocolType;
use App\Repository\CategoryRepository;
use App\Repository\ProtocolRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class PagesController extends AbstractController
{
    /**
     *@Route("/legal", name="legal")
     */
    public function legal() {

        return $this->render('front/pages/legal.html.twig');
    }

    /**
     * @Route("/protocol", name="protocol")
     * @param ProtocolRepository $protocolRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function protocol(ProtocolRepository $protocolRepository) {

        $protocol = $protocolRepository->findAll();

        return $this->render('front/pages/protocol.html.twig', [
            'protocol'=>$protocol
        ]);
    }

    /**
     * @Route ("/podology", name="podology")
     */
    public function podology(CategoryRepository $categoryRepository) {

        $category = $categoryRepository->find(5);

        return $this->render('front/pages/podology.html.twig', [
            'category'=>$category
        ]);
    }

    /**
     * @Route ("/pedicury", name="pedicury")
     */
    public function pedicury(CategoryRepository $categoryRepository) {

        $category = $categoryRepository->find(6);

        return $this->render('front/pages/pedicury.html.twig', [
            'category'=>$category
        ]);
    }

    /**
     * @Route ("/sportpodology", name="sport_podology")
     */
    public function sportPodology(CategoryRepository $categoryRepository) {

        $category = $categoryRepository->find(7);

        return $this->render('front/pages/sport_podology.html.twig', [
            'category'=>$category
        ]);
    }

}