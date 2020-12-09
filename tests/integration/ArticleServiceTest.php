<?php
namespace App\Tests\Unit;


use App\Project\Domain\Article\Entity\Article;
use App\Project\Domain\User\Entity\User;
use App\Tests\UnitTest;
use Symfony\Component\HttpFoundation\Request;

class ArticleServiceTest extends UnitTest
{

    public function test_add_article_from_service()
    {
        $articleService = self::$kernel->getContainer()->get('project.article.service');

        $articleTitle = 'Test Title';

        $user = $this->em->getRepository(User::class)->findOneBy(['username' => 'Project']);
        //create a request
        $request = new Request([],[
            'user' => $user->getId(),
            'title' => $articleTitle,
            'body' => 'this is html body'
        ]);

        $articleService->addArticle($request);

        //see in db
        /** @var Article $article */
        $article = $this->em->getRepository(Article::class)->findOneBy(['title' => $articleTitle]);

        $this->assertEquals($article->getTitle(), $articleTitle);
    }
}
