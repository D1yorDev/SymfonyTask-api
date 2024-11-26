<?php

declare(strict_types=1);

namespace App\Controller\Blog;

use App\Controller\Base\AbstractController;
use App\Entity\Blog;
use App\Repository\BlogRepository;
use Doctrine\ORM\EntityManagerInterface;
class BlogChangeAction extends AbstractController
{
    public function __construct(
        private BlogRepository $blogRepository,
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function __invoke(Blog $blog): Blog
    {
        $oldBlog     = $this->blogRepository->findOneBy(array('id' => $blog->getId()));
        $oldBlog->setTitle($blog->getTitle());
        $oldBlog->setText($blog->getText());
        $oldBlog->setAuthor($blog->getAuthor());
        $blog = $oldBlog;
        $this->entityManager->persist($blog);
        $this->entityManager->flush();
        return $blog;
    }
}
