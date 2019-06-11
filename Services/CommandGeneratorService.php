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
                $command['command'] .= ' ' . $objectIdentifier;
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

    private function getPhpPath(): string
    {
        exec($phpExecCommand = 'which php', $phpPathOutput);
        if (!$phpCliPath = array_shift($phpPathOutput)) {
            throw new \RuntimeException(
                sprintf(
                    'Unable to locate PHP CLI path tried to run command: %s please contact your hosting provider.',
                    $phpExecCommand
                )
            );
        }

        exec($phpVersionExecCommand = sprintf('%s -r "echo PHP_VERSION_ID;"', $phpCliPath), $phpVersionOutput);

        $phpVersion = (int)array_shift($phpVersionOutput);
        if ($phpVersion < 70200) {
            throw new \RuntimeException(
                sprintf(
                    'PHP CLI needs to run with at least php 7.2 path tried to run command: %s please contact your hosting provider.',
                    $phpVersionExecCommand
                )
            );
        }

        return $phpCliPath;
    }
}