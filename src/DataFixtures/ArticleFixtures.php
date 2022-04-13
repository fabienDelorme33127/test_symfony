<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $state = ['brouillon', 'publie'];

        for($i = 1; $i <= 10; $i++){
            $article = new Article();
            $article->setTitre("Article n°".$i);
            $article->setContenu("Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, 
            from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 
            1.10.32 and 1.10.33 of 'de Finibus Bonorum et Malorum' (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, 
            very popular during the Renaissance. The first line of Lorem Ipsum, 'Lorem ipsum dolor sit amet..', comes from a line in section 1.10.32.Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, 
            from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 
            1.10.32 and 1.10.33 of 'de Finibus Bonorum et Malorum' (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, 
            very popular during the Renaissance. The first line of Lorem Ipsum, 'Lorem ipsum dolor sit amet..', comes from a line in section 1.10.32.");
            $article->setState($state[1]);

            $date = new \DateTime();
            $date->modify('-'.$i.' days');

            $article->setDateCreation($date);

            $this->addReference('article-'.$i, $article);

            $manager->persist($article);
        }    
        for($i = 11; $i <= 16; $i++){
            $article = new Article();
            $article->setTitre("Article n°".$i);
            $article->setContenu("Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, 
            from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 
            1.10.32 and 1.10.33 of 'de Finibus Bonorum et Malorum' (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, 
            very popular during the Renaissance. The first line of Lorem Ipsum, 'Lorem ipsum dolor sit amet..', comes from a line in section 1.10.32.Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, 
            from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 
            1.10.32 and 1.10.33 of 'de Finibus Bonorum et Malorum' (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, 
            very popular during the Renaissance. The first line of Lorem Ipsum, 'Lorem ipsum dolor sit amet..', comes from a line in section 1.10.32.");
            $article->setState($state[0]);

            $date = new \DateTime();
            $date->modify('-'.$i.' days');

            $article->setDateCreation($date);

            $this->addReference('article-'.$i, $article);

            $manager->persist($article);
        }    

        $manager->flush();
    }
}
