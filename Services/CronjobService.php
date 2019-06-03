<?php

namespace PSC7Helper\Services;

use Doctrine\DBAL\Connection;

class CronjobService implements CronjobServiceInterface
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function getConnectorCronjobs(): array
    {
        $query = $this->connection->executeQuery(
            'SELECT REPLACE(name, \'PlentyConnector\', \'\') AS name, end FROM s_crontab WHERE name LIKE :name', [
            ':name' => 'Plentyconnector%'
        ]);

        $cronjobs = [];
        foreach ($query->fetchAll(\PDO::FETCH_OBJ) as $cronjob) {
            $cronLastRunDate = new \DateTimeImmutable($cronjob->end);

            $cronjobs[] = [
                'name' => $cronjob->name,
                'end' => new \DateTimeImmutable($cronjob->end),
                'isRecentlyRun' => (time() - $cronLastRunDate->getTimestamp() <= 5400)
            ];
        }

        return $cronjobs;
    }

    /**
     * {@inheritDoc}
     */
    public function getLastSyncDate(): \DateTimeImmutable
    {
        $query = $this->connection->executeQuery(
            'SELECT next FROM s_crontab WHERE name = :name LIMIT 1', [
            ':name' => 'PlentyConnector Synchronize'
        ]);

        return new \DateTimeImmutable($query->fetch(\PDO::FETCH_COLUMN));
    }
}