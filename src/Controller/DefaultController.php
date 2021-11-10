<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="liste_articles", methods={"GET"})
     */
    public function listeArticles(ArticleRepository $articleRepository): Response{

        //$article = $articleRepository->findByDateCreation(new \DateTime('17-10-2021'));
        //dump($article);die;
        $articles =  $articleRepository->findAll();

        return $this->render('default/index.html.twig', [
            'articles' => $articles
        ]);
    }

     /**
      * @Route("/{id}", name="vue_article", requirements={"id"="\d+"}, methods={"GET"})
      */
    public function vueArticle(ArticleRepository $articleRepository, $id){

        $article =  $articleRepository->find($id);

        return $this->render('default/vue.html.twig', [
            'article' => $article,
        ]);
    }

    /**
      * @Route("/article/ajouter", name="ajout_article")
      */
    public function ajouter(EntityManagerInterface $manager){

        $article = new Article();
        $article->setTitre("Titre de l'article");
        $article->setContenu("Ceci est le contenue de l'article");
        $article->setDateCreation(new \DateTime());
        
        $manager->persist($article);

        $manager->flush();

        die;
    }
}
