<?php
namespace App\Entity;

use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
Class Post
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
    private $content;

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
     * @ORM\ManyToMany(targetEntity="User")
     * @ORM\JoinTable(name="post_likes")
     * @var User[]|Collection
     */
    private $likedBy;

    /**
     * Post Constructor
     */
    public function __construct()
    {
        $this->publishedAt = new \DateTimeImmutable();
        $this->likedBy = new ArrayCollection();
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
     * Get the value of content
     *
     * @return  string
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @param  string  $content
     *
     * @return  self
     */ 
    public function setContent(string $content)
    {
        $this->content = $content;

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
     * Get the value of likedBy
     *
     * @return  User[]|Collection
     */ 
    public function getLikedBy()
    {
        return $this->likedBy;
    }

    /**
     * Set the value of likedBy
     *
     * @param  User[] $likedBy
     *
     * @return  self
     */ 
    public function LikeBy(User $user)
    {
        if(!$this->likedBy->contains($user))
        {
            $this->likedBy[] = $user;
        }

        return $this;
    }

    public function dislikeBy(User $user)
    {
        if($this->likedBy->contains($user))
        {
            $this->likedBy->removeElements($user);
        }
        return $this;
    }
}