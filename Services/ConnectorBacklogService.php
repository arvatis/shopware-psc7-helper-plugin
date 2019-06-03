<?php

namespace PSC7Helper\Services;

use SystemConnector\BacklogService\BacklogServiceInterface;

class ConnectorBacklogService implements ConnectorBacklogServiceInterface
{
    /**
     * @var BacklogServiceInterface
     */
    private $backlogService;

    public function __construct(BacklogServiceInterface $backlogService)
    {
        $this->backlogService = $backlogService;
    }

    /**
     * {@inheritDoc}
     */
    public function countAllBacklogObjects(): int
    {
        return (int)$this->backlogService->getInfo()['amount_enqueued'] ?? 0;
    }
}