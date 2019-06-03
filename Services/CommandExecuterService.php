<?php

namespace PSC7Helper\Services;

class CommandExecuterService implements CommandExecuterServiceInterface
{
    /**
     * @var CommandGeneratorServiceInterface
     */
    private $commandGeneratorService;

    public function __construct(CommandGeneratorServiceInterface $commandGeneratorService)
    {
        $this->commandGeneratorService = $commandGeneratorService;
    }

    /**
     * {@inheritDoc}
     */
    public function executeCommand(string $commandName, ?string $objectIdentifier = null): array
    {
        $command = $this->commandGeneratorService->generateCommand($commandName, $objectIdentifier);
        exec($command, $commandOutput);

        return $commandOutput;
    }
}