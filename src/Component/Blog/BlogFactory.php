<?php

declare(strict_types=1);

namespace App\Component\Blog;

use App\Entity\Blog;
use App\Entity\User;

class BlogFactory
{
    public function create(string $title, string $text , User $author): Blog
    {
        return (new Blog())
            ->setTitle($title)
            ->setText($text)
            ->setAuthor($author);
    }
}
