<?php


namespace App\Controller\admin;


use App\Repository\ArticleRepository;
use App\Repository\CommentaryRepository;
use App\Repository\HealthcareRepository;
use App\Repository\PriceRepository;
use App\Repository\ProtocolRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{

    /**
     * @Route("/admin", name="admin_dashboard")
     * @param ArticleRepository $articleRepository
     * @param CommentaryRepository $commentaryRepository
     * @param HealthcareRepository $healthcareRepository
     * @param ProtocolRepository $protocolRepository
     * @param UserRepository $userRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function adminDashboard(ArticleRepository $articleRepository, CommentaryRepository $commentaryRepository, HealthcareRepository $healthcareRepository, ProtocolRepository $protocolRepository, UserRepository $userRepository) {

        $articles = $articleRepository->findAll();
        $commentaries = $commentaryRepository->findAll();
        $healthcare = $healthcareRepository->findAll();
        $protocol = $protocolRepository->findAll();
        $users = $userRepository->findAll();

        return $this->render('admin/home/dashboard.html.twig', [
            'articles'=>$articles,
            'commentaries'=>$commentaries,
            'healthcare'=>$healthcare,
            'protocol'=>$protocol,
            'users'=>$users
        ]);

    }
}