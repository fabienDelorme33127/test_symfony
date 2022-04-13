<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CommentFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        
        for($a = 1; $a <= 5; $a++){
            for($i = 1; $i <= 10; $i++){
                $comment = new Comment();
                $comment->setContenu("Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, 
                from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 
                1.10.32 and 1.10.33 of 'de Finibus Bonorum et Malorum' (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, 
                very popular during the Renaissance. The first line of Lorem Ipsum, 'Lorem ipsum dolor sit amet..', comes from a line in section 1.10.32.");
                $comment->setAuthor("fabien");
                $comment->setDateComment(new \Datetime());
                $comment->setArticle($this->getReference('article-'.$i));
    
                $manager->persist($comment);
            }
        }        
        
        $manager->flush();
    }

    public function getDependencies(){
        return [
            ArticleFixtures::class
        ];
    }
}