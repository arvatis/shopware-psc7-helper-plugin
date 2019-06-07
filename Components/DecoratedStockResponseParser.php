<?php

namespace PSC7Helper\Components;

use PlentymarketsAdapter\ResponseParser\Product\Stock\StockResponseParserInterface;
use SystemConnector\ConfigService\ConfigServiceInterface;
use SystemConnector\TransferObject\Product\Stock\Stock;

class DecoratedStockResponseParser implements StockResponseParserInterface
{
    /**
     * @var StockResponseParserInterface
     */
    private $parentStockResponseParser;

    /**
     * @var ConfigServiceInterface
     */
    private $configService;

    /**
     * @param StockResponseParserInterface $parentStockResponseParser
     * @param ConfigServiceInterface $configService
     */
    public function __construct(
        StockResponseParserInterface $parentStockResponseParser,
        ConfigServiceInterface $configService
    ) {
        $this->parentStockResponseParser = $parentStockResponseParser;
        $this->configService = $configService;
    }

    /**
     * {@inheritDoc}
     */
    public function parse(array $variation)
    {
        /** @var Stock $stock */
        $stock = $this->parentStockResponseParser->parse($variation);
        if ($stock === null) {
            return null;
        }

        $stockBufferOption = (int)$this->configService->get('helper.stock.stock_buffer_option', 0);
        $stock->setStock($stock->getStock() - $stockBufferOption);

        return $stock;
    }
}