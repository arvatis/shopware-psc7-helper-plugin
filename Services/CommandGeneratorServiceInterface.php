<?php

namespace PSC7Helper\Services;

interface CommandGeneratorServiceInterface
{
    /**
     * Generates the command by the name with given options for command.
     *
     * @param string $name
     * @param string|null $objectIdentifier
     * @param array $options
     *
     * @return string
     */
    public function generateCommand(string $name, ?string $objectIdentifier = null, array $options = []): string;
}