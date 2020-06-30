<?php


namespace App\Doctrine\Extension;


use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryItemExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use App\Entity\Conversation;
use App\Entity\Message;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Security\Core\Security;

class CurentUserExtension implements QueryCollectionExtensionInterface , QueryItemExtensionInterface
{
    /**
     * @var Security
     */
    private Security $security;

    public  function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function applyToCollection(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = null)
    {
        if ($resourceClass === Message::class){
            $rootAlias = $queryBuilder->getRootAlias()[0];
            $queryBuilder->andWhere($rootAlias . '.sender = :sender')
                ->setParameter('sender', $this->security->getUser());
        }

        if ($resourceClass === Conversation::class){
            $rootAlias = $queryBuilder->getRootAlias()[0];
            $queryBuilder->andWhere($rootAlias . '.buyer = :buyer')
                ->setParameter('buyer', $this->security->getUser());
        }
    }

    public function applyToItem(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, array $identifiers, string $operationName = null, array $context = [])
    {
        if ($resourceClass === Message::class){
            $rootAlias = $queryBuilder->getRootAlias()[0];
            $queryBuilder->andWhere($rootAlias . '.sender = :sender')
                ->setParameter('sender', $this->security->getUser());
        }
        if ($resourceClass === Conversation::class){
            $rootAlias = $queryBuilder->getRootAlias()[0];
            $queryBuilder->andWhere($rootAlias . '.buyer = :buyer')
                ->setParameter('buyer', $this->security->getUser());
        }
    }
}
