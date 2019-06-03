<?php

namespace PSC7Helper\Services;

interface ConnectorBacklogServiceInterface
{
    /**
     * @return int
     */
    public function countAllBacklogObjects(): int;
}