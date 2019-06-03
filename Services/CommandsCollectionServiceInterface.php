<?php

namespace PSC7Helper\Services;

interface CommandsCollectionServiceInterface
{
    public function addCommand(string $name, string $command, bool $all, bool $verbose, bool $backlog): void;

    public function getCommand(string $name): array;

    public function getAllCommands(): array;
}