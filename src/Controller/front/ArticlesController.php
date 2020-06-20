<?php


namespace App\Controller\front;


use App\Entity\Commentary;
use App\Form\CommentaryType;
use App\Repository\ArticleRepository;
use App\Repository\CommentaryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class ArticlesController extends AbstractController
{
    /**
     * @Route("/articles", name="articles")
     */
    public function articles(ArticleRepository $articleRepository) {

        $articles = $articleRepository->findBy([], ['date'=>'DESC']);

        return $this->render('front/articles/articles.html.twig', [
            'articles'=>$articles
        ]);
    }

    /**
     * @Route("/article/show/{id}", name="article")
     * @param ArticleRepository $articleRepository
     * @param CommentaryRepository $commentaryRepository
     * @param $id
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param Security $security
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function article(ArticleRepository $articleRepository, CommentaryRepository $commentaryRepository , $id, Request $request, EntityManagerInterface $entityManager, Security $security) {

        $article = $articleRepository->find($id);
        $user = $security->getUser();
        $commentaries= $commentaryRepository->findBy(['article'=>$article], ['date'=>'DESC']);

        $commentary = new Commentary;

        $formCommentary = $this->createForm(CommentaryType::class, $commentary);
        $formCommentary->handleRequest($request);

        if ($formCommentary->isSubmitted() && $formCommentary->isValid()) {

            $commentary->setDate(new \DateTime('now'));
            $commentary->setUser($user);
            $commentary->setArticle($article);
            $entityManager->persist($commentary);
            $entityManager->flush();

            $this->addFlash('success', 'Le commentaire à bien été ajouté !');

            return $this->redirectToRoute('article', ['id'=>$article->getId()]);
        }

        return $this->render('front/articles/article.html.twig', [
            'article'=>$article,
            'formCommentary'=>$formCommentary->createView(),
            'commentaries'=>$commentaries
        ]);
    }

    /**
     * @Route("/actuality/search", name="search_actuality")
     * @param ArticleRepository $articleRepository
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchArticle(ArticleRepository $articleRepository, CommentaryRepository $commentaryRepository, Request $request, EntityManagerInterface $entityManager, Security $security) {

        $search = $request->query->get('search');

        $articles = $articleRepository->getByWordInTitle($search);
        $user = $security->getUser();
        $commentaries= $commentaryRepository->findBy(['article'=>$articles]);

        $commentary = new Commentary;

        $formCommentary = $this->createForm(CommentaryType::class, $commentary);
        $formCommentary->handleRequest($request);

        if ($formCommentary->isSubmitted() && $formCommentary->isValid()) {

            $commentary->setDate(new \DateTime('now'));
            $commentary->setUser($user);
            $commentary->setArticle($articles);
            $entityManager->persist($commentary);
            $entityManager->flush();

        }

        return $this->render('front/articles/search_article.html.twig', [
            'search'=>$search,
            'articles'=>$articles,
            'formCommentary'=>$formCommentary->createView(),
            'commentaries'=>$commentaries
        ]);
    }

}