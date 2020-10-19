<?php

namespace App\Entity;

use App\Entity\Post;
use App\Entity\User;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Comment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @var int|null
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    private $message;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @var \DateTimeInterface
     */
    private $publishedAt;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @var User
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="Post")
     * @ORM\JoinColumn(onDelete="CASCADE")
     * @var Post
     */
    private $post;

    public function __construct()
    {
        $this->publishedAt = new DateTimeImmutable();
    }

    /**
     * Get the value of id
     *
     * @return  int|null
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of message
     *
     * @return  string
     */ 
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @param  string  $message
     *
     * @return  self
     */ 
    public function setMessage(string $message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get the value of publishedAt
     *
     * @return  \DateTimeInterface
     */ 
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * Set the value of publishedAt
     *
     * @param  \DateTimeInterface  $publishedAt
     *
     * @return  self
     */ 
    public function setPublishedAt(\DateTimeInterface $publishedAt)
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    /**
     * Get the value of author
     *
     * @return  User
     */ 
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set the value of author
     *
     * @param  User  $author
     *
     * @return  self
     */ 
    public function setAuthor(User $author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  Post
     */ 
    public function getPost()
    {
        return $this->post;
    }

    /**
     *
     * @param  Post  $post 
     *
     * @return  self
     */ 
    public function setPost(Post $post)
    {
        $this->post = $post;

        return $this;
    }
}