<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Controller\Blog\BlogChangeAction;
use App\Controller\Blog\BlogCreateAction;
use App\Repository\BlogRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BlogRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(),
        new Get(),
        new Post(controller: BlogCreateAction::class,),
        new Put(controller: BlogChangeAction::class),
        new Delete()
    ],
    normalizationContext: ['groups' => ['blog:read']],
    denormalizationContext: ['groups' => ['blog:write']],
)]
class Blog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['blog:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['blog:read', 'blog:write'])]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['blog:read', 'blog:write'])]
    private ?string $text = null;

    #[ORM\ManyToOne(inversedBy: 'blogs')]
    #[Groups(['blog:read', 'blog:write'])]
    private ?User $author = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }
}
