<?php


namespace App\Doctrine\Listener;


use App\Entity\Conversation;
use App\Entity\Message;
use App\Repository\ProductsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class MessageListener
{
    /**
     * @var Security
     */
    private Security $security;
    /**
     * @var ProductsRepository
     */
    private ProductsRepository $productsRepository;
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;

    public function  __construct(Security $security,ProductsRepository $productsRepository, EntityManagerInterface $em)
    {
        $this->security = $security;
        $this->productsRepository = $productsRepository;
        $this->em = $em;
    }

    public  function  prePersist( Message $message){
        if(!$message->getCreatedAt()){
            $message->setCreatedAt(new \DateTime());
        }

        if (! $message->getSender()){
            $message->setSender($this->security->getUser());
        }

        if(! $message->getConversation() ){
            if(! $message->annonceId){
             throw new \Exception("erreur pas de message pas conv pas d'annonce");
            }
            $product= $this->productsRepository->find($message->annonceId);
            $conversation = new Conversation();
            $conversation->setProduct($product)
                ->setCreatedAt(new \DateTime())
                ->setUpdatedAt(new \DateTime())
                ->setBuyer($this->security->getUser());

            $this->em->persist($conversation);
            $message->setConversation($conversation);

        }
        else {
            $message->getConversation()
                ->setUpdatedAt(new \DateTime());
        }

    }

}
