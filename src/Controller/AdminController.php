<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use Psr\Log\LoggerInterface;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/article/ajouter", name="ajout_article")
     * @Route("/article/{id}/edition", name="edition_article", requirements={"id"="\d+"}, methods={"GET", "POST"})
     */
    public function ajouter(Article $article = null, Request $request, Entitymanagerinterface $manager, LoggerInterface $logger){

        if($article === null){
            $article = new Article();
        }

        $logger->info("nous sommes dans le logger");

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            if($form->get('brouillon')->isClicked()){
                $article->setState('brouillon');
            }else{
                $article->setState('a publier');
            }

            if($article->getId() === null){
                $manager->persist($article);
            }            
            $manager->flush();
            return $this->redirectToRoute('liste_articles');
        }

        return $this->render('default/ajout.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/article/brouillon", name="brouillon_article")
     */
    public function brouillon(ArticleRepository $articleRepository){
        $articles = $articleRepository->findBy([
            'state' => 'brouillon'
        ]);

        return $this->render('default/index.html.twig', [
            'articles' => $articles,
            'brouillon' => true
        ]);
    }
}
