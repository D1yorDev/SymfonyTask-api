<?php

declare(strict_types=1);

namespace App\Controller\Blog;

use App\Component\Blog\BlogFactory;
use App\Component\Blog\BlogManager;
use App\Controller\Base\AbstractController;
use App\Entity\Blog;

class BlogCreateAction extends AbstractController
{
    public function __invoke(Blog $data, BlogFactory $blogFactory, BlogManager $blogManager):Blog
    {
        $this->validate($data);
        $blog = $blogFactory->create($data->getTitle(),$data->getText(), $data->getAuthor());
        $blogManager->save($blog,true);

        return $blog;
    }
}
