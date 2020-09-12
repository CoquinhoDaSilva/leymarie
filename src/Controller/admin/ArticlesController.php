<?php


namespace App\Controller\admin;


use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use App\Repository\CommentaryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\String\Slugger\SluggerInterface;

class ArticlesController extends AbstractController
{
    /**
     * @Route("/admin/articles", name="admin_articles")
     * @param ArticleRepository $articleRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function articles(ArticleRepository $articleRepository) {

        $actualities = $articleRepository->findBy([], ['date'=>'DESC']);

       return $this->render('admin/articles/articles.html.twig', [
           'articles'=>$actualities
       ]);
    }

    /**
     * @Route("/admin/article/show/{id}", name="admin_article")
     * @param ArticleRepository $articleRepository
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function article(ArticleRepository $articleRepository, $id, CommentaryRepository $commentaryRepository) {

        $article = $articleRepository->find($id);

        $commentary = $commentaryRepository->findBy(['article'=>$article], ['id'=>'DESC']);

        return $this->render('admin/articles/article.html.twig', [
            'article'=>$article,
            'commentaries'=>$commentary
        ]);
    }

    /**
     * @Route("/admin/article/insert", name="admin_insert_article")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param SluggerInterface $slugger
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function insertArticle(Request $request,
                                  EntityManagerInterface $entityManager,
                                  SluggerInterface $slugger,
                                  Security $security) {

        $user = $security->getUser();
        $article = new Article;

        $formArticle = $this->createForm(ArticleType::class, $article);

        $formArticle->handleRequest(($request));

        if ($formArticle->isSubmitted() && $formArticle->isValid()) {

            $article->setDate(new \DateTime('now'));
            $article->setUser($user);
            $picture = $formArticle->get('picture')->getData();

            if ($picture) {

                $originalFilename = pathinfo($picture->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename. '-'.uniqid().'.'.$picture->guessExtension();

                $picture->move(
                    $this->getParameter('pictures_directory'),
                    $newFilename
                );

                $article->setPicture($newFilename);
            }

            $entityManager->persist($article);
            $entityManager->flush();

            $this->addFlash('success', 'L\'article a bien été ajouté !');

            return $this->redirectToRoute('article', ['id'=>$article->getId()]);

        }

        return $this->render('admin/articles/insert_article.html.twig', [
            'formArticle'=>$formArticle->createView()
        ]);
    }

    /**
     * @Route("/admin/article/search", name="admin_search_article")
     * @param ArticleRepository $articleRepository
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchArticle(ArticleRepository $articleRepository, Request $request) {

        $search = $request->query->get('search');
        $articles = $articleRepository->getByWordInTitle($search);

        return $this->render('admin/articles/search_article.html.twig', [
            'search'=>$search,
            'articles'=>$articles
        ]);
    }

    /**
     * @Route("/admin/article/update/{id}", name="admin_update_article")
     * @param ArticleRepository $articleRepository
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateArticle(
        ArticleRepository $articleRepository,
        Request $request,
        EntityManagerInterface $entityManager,
        $id,
        SluggerInterface $slugger) {

        $article = $articleRepository->find($id);

        $formArticle = $this->createForm(ArticleType::class, $article);
        $formArticle->handleRequest($request);

        if ($formArticle->isSubmitted() && $formArticle->isValid()) {

            $picture = $formArticle->get('picture')->getData();

            if ($picture) {

                $originalFilename = pathinfo($picture->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename. '-'.uniqid().'.'.$picture->guessExtension();

                $picture->move(
                    $this->getParameter('pictures_directory'),
                    $newFilename
                );

                $article->setPicture($newFilename);
            }


            $entityManager->persist($article);
            $entityManager->flush();

            $this->addFlash('success', 'L\'article a bien été modifié !');

            return $this->redirectToRoute('admin_article', ['id'=>$article->getId()]);
        }

        return $this->render('admin/articles/update_article.html.twig', [
            'formArticle'=>$formArticle->createView()
        ]);
    }

    /**
     * @Route("/admin/article/delete/{id}", name="admin_delete_article")
     * @param ArticleRepository $articleRepository
     * @param $id
     * @param EntityManagerInterface $entityManager
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteArticle(ArticleRepository $articleRepository,
                                  $id,
                                  EntityManagerInterface $entityManager) {

        $article = $articleRepository->find($id);

        $entityManager->remove($article);
        $entityManager->flush();

        $this->addFlash('success', 'L\'article a bien été supprimé !');

        return $this->redirectToRoute('admin_articles');
    }

}