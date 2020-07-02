<?php


namespace App\Doctrine\Listener;


use App\Entity\Products;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Security;

class ProductListener
{
    /**
     * @var Security
     */
    protected $security;

    public  function  __construct(Security $security)
    {
        $this->security = $security;
    }

    public function prePersist(Products $products)
    {
        if ($products->getUser()) {
            return;
        }
        $user=$this->security->getUser();
            $products->setUser($user);

    }






}
