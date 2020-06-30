<?php


namespace App\Doctrine\Subscriber;


use App\Entity\Products;
use Symfony\Component\Security\Core\Security;

class ProductUserSubscriber
{
    protected Security $security;
    public function __construct(Security $security)
    {
        $this->security=$security;
    }
    public function prePersist(Products $products)
    {
        if (!$products->getUser()) {
            $products->setUser($this->security->getUser());
        }
    }


}
