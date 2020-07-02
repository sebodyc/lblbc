<?php

namespace App\Controller;

use App\Form\ProductType;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CreateProductWithImageController extends AbstractController
{

    /**
     * @var FormFactoryInterface
     */
    private FormFactoryInterface $factory;
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;

    public function __construct(FormFactoryInterface $factory, EntityManagerInterface $em )
    {
        $this->factory = $factory;
        $this->em = $em;
    }

    public function __invoke(Request $request)
    {
        $form = $this->factory->createNamed('',ProductType::class);
        $form->handleRequest($request);
        $product = $form->getData();
        $this->em->persist($product);
        $this->em->flush();
        $product->setProductImageFile(null);

        return $product;

    }


}
