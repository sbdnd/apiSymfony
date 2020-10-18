<?php

namespace App\DataFixtures;

use App\Entity\Post;
use App\Entity\User;
use App\Entity\Comment;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /**
     *
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     *
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager)
    {
        $users = [];
        for($i=1; $i<=10; $i++)
        {
            $user = new User();
            $user->setPassword($this->encoder->encodePassword($user,"password"))
                ->setEmail(sprintf("email+%d@email.com", $i))
                ->setName(sprintf("name+%d", $i));
                $manager->persist($user);
            
            $users[] = $user;
        }

        foreach($users as $user){
            for($j =1; $j <= 5; $j++){
                $post = new Post();
                $post->setContent("content")
                ->setAuthor($user);

                shuffle($users);

                foreach(array_slice($users, 0, 5) as $userCanLike){
                    $post->LikeBy($userCanLike);
                    $manager->persist($post);
                }

                for($k = 1; $k <=10; $k++ ){
                    $comment = new Comment();
                    $comment->setMessage(sprintf("message %d", $k))
                        ->setAuthor($users[array_rand($users)])
                        ->SetPost($post);
                    $manager->persist($comment);
                }
            }
        }

        $manager->flush();
    }
}
