<?php

namespace App\DataFixtures;

use App\Entity\InBox;
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
                     ->setDescription($this->faker->paragraph())
                     ->setZipCode(13100)
                     ->setPrice($this->faker->randomNumber(2))
                     ->setUser($this->getRandomReference(User::class));
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
