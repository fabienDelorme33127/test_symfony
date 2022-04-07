<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\Category;
use App\Form\ArticleType;
use App\Form\CommentType;
use Psr\Log\LoggerInterface;
use Doctrine\DBAL\Types\TextType;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="liste_articles", methods={"GET"})
     */
    public function listeArticles(ArticleRepository $articleRepository): Response{

        //$articleByTitle = $articleRepository->findByTitle('Article n°4');
        //dump($articleByTitle);die;

        //$article = $articleRepository->findByDateCreation(new \DateTime('17-10-2021'));
        //dump($article);die;
        $articles =  $articleRepository->findAll();

        return $this->render('default/index.html.twig', [
            'articles' => $articles
        ]);
    }

     /**
      * @Route("/{id}", name="vue_article", requirements={"id"="\d+"}, methods={"GET", "POST"})
      */
    public function vueArticle(Article $article, Request $request, EntityManagerInterface $manager){

        $comment = new Comment();
        $comment->setArticle($article);
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $manager->persist($comment);
            $manager->flush();
            
            return $this->redirectToRoute('vue_article', [
                'id' => $article->getId()
            ]);
        }
        
        return $this->render('default/vue.html.twig', [
            'article' => $article,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/article/ajouter", name="ajout_article")
     */
    public function ajouter(Request $request, Entitymanagerinterface $manager, LoggerInterface $logger){

        $logger->info("nous sommes dans le logger");

        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $manager->persist($article);
            $manager->flush();
            return $this->redirectToRoute('liste_articles');
        }

        return $this->render('default/ajout.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
