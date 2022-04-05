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
                $comment->setContenu("ceci est le commentaire n°".$a);
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