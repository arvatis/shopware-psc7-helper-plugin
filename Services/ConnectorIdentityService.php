<?php

namespace PSC7Helper\Services;

use Doctrine\DBAL\Connection;

class ConnectorIdentityService implements ConnectorIdentityServiceInterface
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * {@inheritDoc}
     */
    public function getAllIdentitiesCount(): int
    {
        $identities = $this->connection->createQueryBuilder()
            ->select('COUNT(*) AS totalIdentities')
            ->from('plenty_identity', 'i')
            ->execute();

        return (int)$identities->fetch()['totalIdentities'];
    }

    /**
     * {@inheritDoc}
     */
    public function getIdentityByAdapterIdentifierAndAdapterNameAndObjectType(string $adapterIdentifier, string $adapterName, string $objectType)
    {
        $identity = $this->connection->createQueryBuilder()
            ->select('id')
            ->addSelect('objectIdentifier')
            ->addSelect('objectType')
            ->addSelect('adapterIdentifier')
            ->addSelect('adapterName')
            ->from('plenty_identity', 'i')
            ->where('i.adapterIdentifier = :adapterIdentifier')
            ->andWhere('i.adapterName = :adapterName')
            ->andWhere('i.objectType = :objectType')
            ->setParameter('adapterIdentifier', $adapterIdentifier)
            ->setParameter('adapterName', $adapterName)
            ->setParameter('objectType', $objectType)
            ->execute();

        return $identity->fetch(\PDO::FETCH_OBJ);
    }

    /**
     * {@inheritDoc}
     */
    public function getIdentitiesCountByObjectType(string $objectType): int
    {
        $identities = $this->connection->createQueryBuilder()
            ->select('COUNT(*) AS totalIdentities')
            ->from('plenty_identity', 'i')
            ->where('i.objectType = :objectType')
            ->setParameter('objectType', $objectType)
            ->execute();

        return (int)$identities->fetch()['totalIdentities'];
    }

    /**
     * {@inheritDoc}
     */
    public function getAllObjectsByObjectIdentifier(string $objectIdentifier)
    {
        $identities = $this->connection->createQueryBuilder()
            ->select('id')
            ->addSelect('objectIdentifier')
            ->addSelect('objectType')
            ->addSelect('adapterIdentifier')
            ->addSelect('adapterName')
            ->from('plenty_identity', 'i')
            ->where('i.objectIdentifier = :objectIdentifier')
            ->setParameter('objectIdentifier', $objectIdentifier)
            ->execute();

        return $identities->fetchAll(\PDO::FETCH_OBJ);
    }

    /**
     * {@inheritDoc}
     */
    public function getAllObjectsByObjectType(string $objectType)
    {
        $identities = $this->connection->createQueryBuilder()
            ->select('id')
            ->addSelect('objectIdentifier')
            ->addSelect('objectType')
            ->addSelect('adapterIdentifier')
            ->addSelect('adapterName')
            ->from('plenty_identity', 'i')
            ->where('i.objectType = :objectType')
            ->setParameter('objectType', $objectType)
            ->execute();

        return $identities->fetchAll(\PDO::FETCH_OBJ);
    }

    /**
     * {@inheritDoc}
     */
    public function getAllObjectsByAdapterIdentifier(string $adapterIdentifier)
    {
        $identities = $this->connection->createQueryBuilder()
            ->select('id')
            ->addSelect('objectIdentifier')
            ->addSelect('objectType')
            ->addSelect('adapterIdentifier')
            ->addSelect('adapterName')
            ->from('plenty_identity', 'i')
            ->where('i.adapterIdentifier = :adapterIdentifier')
            ->setParameter('adapterIdentifier', $adapterIdentifier)
            ->execute();

        return $identities->fetchAll(\PDO::FETCH_OBJ);
    }

    public function getAllObjectsByAdapterName(string $adapterName)
    {
        $identities = $this->connection->createQueryBuilder()
            ->select('id')
            ->addSelect('objectIdentifier')
            ->addSelect('objectType')
            ->addSelect('adapterIdentifier')
            ->addSelect('adapterName')
            ->from('plenty_identity', 'i')
            ->where('i.adapterName = :adapterName')
            ->setParameter('adapterName', $adapterName)
            ->execute();

        return $identities->fetchAll(\PDO::FETCH_OBJ);
    }
}