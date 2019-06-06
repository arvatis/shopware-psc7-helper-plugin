<?php

namespace PSC7Helper\Services;

use Doctrine\DBAL\Connection;
use PlentymarketsAdapter\PlentymarketsAdapter;
use ShopwareAdapter\ShopwareAdapter;
use SystemConnector\TransferObject\Order\Order;

class OrderService implements OrderServiceInterface
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
    public function getAllAvailableOrders(): array
    {
        $ordersQuery = $this->connection->createQueryBuilder()
            ->select('o.id')
            ->addSelect('o.ordertime')
            ->addSelect('o.ordernumber')
            ->addSelect('u.firstname')
            ->addSelect('u.lastname')
            ->from('s_order', 'o')
            ->join('o', 's_user', 'u', 'u.id = o.userID')
            ->execute();

        $orders = [];
        foreach ($ordersQuery->fetchAll(\PDO::FETCH_OBJ) as $key => $order) {
            $orders[$key] = $order;

            $orderIdentifier = $this->connectorIdentityService->getIdentityByAdapterIdentifierAndAdapterNameAndObjectType(
                $order->id,
                ShopwareAdapter::NAME,
                Order::TYPE
            );
            $orders[$key]->isMapped = $orderIdentifier->objectIdentifier !== null;
            $orders[$key]->objectIdentifier = $orderIdentifier->objectIdentifier;

            $orderPlentyIdentifier = $this->connectorIdentityService->getIdentityByObjectIdentifierAndAdapterNameAndObjectType(
                $orderIdentifier->objectIdentifier,
                PlentymarketsAdapter::NAME,
                Order::TYPE
            );

            $orders[$key]->isPlentyMapped = $orderPlentyIdentifier->objectIdentifier !== null;
            $orders[$key]->adapterPlentyIdentifier = $orderPlentyIdentifier->adapterIdentifier;

            $generatedCommand = $this->commandGeneratorService->generateCommand(
                Order::TYPE,
                $orderIdentifier->objectIdentifier,
                [
                    'backlog' => false
                ]
            );
            $orders[$key]->generatedCommand = $generatedCommand;
        }

        return $orders;
    }
}