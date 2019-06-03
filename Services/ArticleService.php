<?php

namespace PSC7Helper\Services;

use Doctrine\DBAL\Connection;
use ShopwareAdapter\ShopwareAdapter;
use SystemConnector\TransferObject\Product\Product;

class ArticleService implements ArticleServiceInterface
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * @var ConnectorIdentityServiceInterface
     */
    private $connectorIdentityService;

    /**
     * @var CommandGeneratorServiceInterface
     */
    private $commandGeneratorService;

    /**
     * @param Connection $connection
     * @param ConnectorIdentityServiceInterface $connectorIdentityService
     * @param CommandGeneratorServiceInterface $commandGeneratorService
     */
    public function __construct(
        Connection $connection,
        ConnectorIdentityServiceInterface $connectorIdentityService,
        CommandGeneratorServiceInterface $commandGeneratorService
    )
    {
        $this->connection = $connection;
        $this->connectorIdentityService = $connectorIdentityService;
        $this->commandGeneratorService = $commandGeneratorService;
    }

    /**
     * {@inheritDoc}
     */
    public function getAllAvailableArticles(): array
    {
        $articlesQuery = $this->connection->createQueryBuilder()
            ->select('a.id')
            ->addSelect('a.name')
            ->addSelect('a.active')
            ->addSelect('ad.ordernumber')
            ->from('s_articles', 'a')
            ->leftJoin('a', 's_articles_details', 'ad', 'ad.articleID = a.id')
            ->execute();

        $articles = [];
        foreach ($articlesQuery->fetchAll(\PDO::FETCH_OBJ) as $key => $article) {
            $articles[$key] = $article;
            $articles[$key]->active = (bool)$article->active;

            $articleIdentifier = $this->connectorIdentityService->getIdentityByAdapterIdentifierAndAdapterNameAndObjectType(
                $article->id,
                ShopwareAdapter::NAME,
                Product::TYPE
            );
            $articles[$key]->isMapped = $articleIdentifier->objectIdentifier !== null;
            $articles[$key]->objectIdentifier = $articleIdentifier->objectIdentifier;

            $generatedCommand = $this->commandGeneratorService->generateCommand(Product::TYPE, $articleIdentifier->objectIdentifier);
            $articles[$key]->generatedCommand = $generatedCommand;
        }

        return $articles;
    }
}