<?php

namespace PSC7Helper\Services;

use SystemConnector\ConfigService\ConfigServiceInterface;

class CommandGeneratorService implements CommandGeneratorServiceInterface
{
    /**
     * @var CommandsCollectionServiceInterface
     */
    private $commandsCollectionService;

    /**
     * @var ConfigServiceInterface
     */
    private $configService;

    /**
     * @param CommandsCollectionServiceInterface $commandsCollectionService
     * @param ConfigServiceInterface $configService
     */
    public function __construct(
        CommandsCollectionServiceInterface $commandsCollectionService,
        ConfigServiceInterface $configService
    )
    {
        $this->commandsCollectionService = $commandsCollectionService;
        $this->configService = $configService;
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
        return $this->configService->get('helper.php_cli_path_option', '');
    }
}