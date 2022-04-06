<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
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
    public function ajouter(Request $request, CategoryRepository $categoryRepository, Entitymanagerinterface $manager){

        $form = $this->createFormBuilder()
        ->add('titre', TypeTextType::class, [
            'label' => "Titre de l'article"
        ])
        ->add('contenu', TextareaType::class)
        ->add('dateCreation', DateType::class, [
            'widget' => 'single_text'
        ])->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $article = new Article();
            $article->setTitre($form->get('titre')->getdata());
            $article->setContenu($form->get('contenu')->getdata());
            $article->setDateCreation($form->get('dateCreation')->getdata());

            $category = $categoryRepository->findOneBy([
                'name' => 'sport'
            ]);
            $article->addCategory($category);
            
            $manager->persist($article);
            $manager->flush();

            return $this->redirectToRoute('liste_articles');
        }


        return $this->render('default/ajout.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
