<?php

namespace PSC7Helper\Services;

class CommandsCollectionService implements CommandsCollectionServiceInterface
{
    /**
     * @var array
     */
    private $commands = [];

    public function __construct(...$commands)
    {
        foreach ($commands as $command) {
            if (substr($command, 0, 7) === 'process') {
                $this->addCommand(ucfirst(substr($command, 8)), $command, false, true, true);
            } else {
                $this->addCommand($command, $command, false, $command !== 'backlog:info', false);
            }
        }
    }

    public function getAllCommands(): array
    {
        return $this->commands;
    }

    public function addCommand(string $name, string $command, bool $all, bool $verbose, bool $backlog): void
    {
        $name = trim($name);

        if (isset($this->commands[$name])) {
            throw new \RuntimeException(
                sprintf('Can not add duplicate command: %s', $name)
            );
        }

        $this->commands[$name] = [
            'name' => $name,
            'command' => $command,
            'options' => [
                'all' => $all,
                'verbose' => $verbose,
                'backlog' => $backlog
            ]
        ];
    }

    public function getCommand(string $name): array
    {
        $name = trim($name);

        if (!isset($this->commands[$name])) {
            throw new \RuntimeException(
                sprintf('Command not found: %s', $name)
            );
        }

        return $this->commands[$name];
    }
}