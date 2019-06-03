<?php

namespace PSC7Helper\Services;

interface CommandExecuterServiceInterface
{
    /**
     * @param string $commandName
     * @param string|null $objectIdentifier
     *
     * @return array
     */
    public function executeCommand(string $commandName, ?string $objectIdentifier = null): array;
}