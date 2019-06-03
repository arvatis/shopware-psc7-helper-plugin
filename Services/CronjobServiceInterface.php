<?php

namespace PSC7Helper\Services;

interface CronjobServiceInterface
{
    /**
     * @return array
     */
    public function getConnectorCronjobs(): array;

    /**
     * @return \DateTimeImmutable
     * @throws \Doctrine\DBAL\DBALException
     */
    public function getLastSyncDate(): \DateTimeImmutable;
}