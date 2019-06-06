<?php

namespace PSC7Helper\Services;

class CommandGeneratorService implements CommandGeneratorServiceInterface
{
    /**
     * @var CommandsCollectionServiceInterface
     */
    private $commandsCollectionService;

    public function __construct(CommandsCollectionServiceInterface $commandsCollectionService)
    {
        $this->commandsCollectionService = $commandsCollectionService;
    }

    /**
     * {@inheritDoc}
     */
    public function generateCommand(string $name, ?string $objectIdentifier = null, array $options = []): string
    {
        $command = $this->commandsCollectionService->getCommand($name);
        $command['options'] = array_merge($command['options'], $options);

        $options = '';
        $prefix = 'plentyconnector:';

        if (substr($command['name'], 0, 3) === 'sw:') {
            $prefix = '';
        }

        if (substr($command['command'], 0, 7) === 'process') {
            $command['command'] = 'process ' . $command['name'];

            if ($objectIdentifier !== null) {
                $command['command'] .= ' '. $objectIdentifier;
            }

            if ($command['options']['all']) {
                $options .= ' --all';
            }

            if (!$command['options']['backlog']) {
                $options .= ' --disableBacklog';
            }
        }

        if ($command['options']['verbose']) {
            $options .= ' -vvv';
        }

        return trim(sprintf('%s bin/console %s%s %s', $this->getPhpPath(), $prefix, $command['command'], trim($options)));
    }

    private function getPhpPath(): ?string
    {
        exec(sprintf('which php%d.%d', PHP_MAJOR_VERSION, PHP_MINOR_VERSION), $phpPathOutput);

        return array_shift($phpPathOutput) ?? null;
    }
}