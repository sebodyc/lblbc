<?php

namespace App\DataFixtures;

use App\Entity\Conversation;
use App\Entity\InBox;
use App\Entity\Message;
use App\Entity\Products;
use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends AbstractFixture
{

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function loadData(ObjectManager $manager)
    {
        //creation des utilsateurs
        $this->createMany(User::class, 10,function (User $user,$u){
            $user->setName($this->faker->lastName)
                 ->setFirtsName($this->faker->lastName)
                 ->setRoles(array('ROLE_USER'))
                 ->setAdress($this->faker->address)
                 ->setZipCode(13100)
                 ->setEmail("user$u@gmail.com")
                 ->setPassword("password");
        });
        //creation des product
        $this->createMany(Products::class,60 ,function(Products $products){
            $products->setTitle($this->faker->sentence($nbWords = 6, $variableNbWords = true) )
                     ->setDescription($this->faker->paragraph(6))
                     ->setZipCode(13100)
                     ->setType("vente")
                     ->setPrice($this->faker->randomNumber(2))
                     ->setUser($this->getRandomReference(User::class));
            $this->createMany(Conversation::class,mt_rand(1,2), function (Conversation $conversation) use ($products){
                $buyer= $this->getRandomReference(User::class);
                $conversation->setBuyer($buyer)
                    ->setCreatedAt($this->faker->dateTimeBetween("-6 months"))
                    ->setUpdatedAt($this->faker->dateTimeBetween("-2 months"))
                    ->setProduct($products);
                $this->createMany(Message::class,mt_rand(3,4), function (Message $message) use ($buyer,$conversation,$products){
                    $message->setContent($this->faker->sentence)
                        ->setCreatedAt($this->faker->dateTimeBetween("-6 months"))
                        ->setConversation($conversation)
                        ->setSender($this->faker->boolean ? $buyer : $products->getUser());
                });

            });

        });
        //creation des Inbox
        $this->createMany(InBox::class,20,function(InBox $inBox){
            $inBox->setTitle($this->faker->title)
                    ->setMessage($this->faker->paragraph)
                    ->setProductUserId($this->faker->randomDigit)
                    ->setCreatedAt($this->faker->dateTimeBetween('-2 months'))
                    ->setSender($this->faker->name)
                     ->setDestinataire($this->getRandomReference(User::class));

        });
    }
}
