<?php

namespace App\Tests;

use App\Entity\Comment;
use PHPUnit\Framework\TestCase;
use App\Service\VerificationComment;

class VerificationCommentTest extends TestCase
{
    protected $comment;
    protected $service;

    protected function setUp(): void
    {
        $this->comment = new Comment();
        $this->service = new VerificationComment();        
    }
    
    public function testContientMotInterdit(){

        $this->comment->setContenu("test commentaire avec mauvais");
        $result = $this->service->commentaireNonAutorise($this->comment);

        $this->assertTrue($result);
    }

    public function testContientPasMotInterdit(){
        
        $this->comment->setContenu("test commentaire avec ");
        $result = $this->service->commentaireNonAutorise($this->comment);

        $this->assertFalse($result);
    }
}
