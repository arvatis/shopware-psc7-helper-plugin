<?php

namespace PSC7Helper\Services;

interface CommandGeneratorServiceInterface
{
    /**
     * Generates the command by the command with given options for command.
     *
     * @param string $command
     * @param string|null $objectIdentifier
     *
     * @return string
     */
    public function generateCommand(string $command, ?string $objectIdentifier = null): string;
}