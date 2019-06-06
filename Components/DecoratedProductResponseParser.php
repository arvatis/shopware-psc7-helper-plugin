<?php

namespace PSC7Helper\Components;

use PlentymarketsAdapter\ResponseParser\Product\ProductResponseParserInterface;
use SystemConnector\ConfigService\ConfigServiceInterface;

class DecoratedProductResponseParser implements ProductResponseParserInterface
{
    /**
     * @var ProductResponseParserInterface
     */
    private $parentProductResponseParser;

    /**
     * @var ConfigServiceInterface
     */
    private $configService;

    /**
     * @param ProductResponseParserInterface $parentProductResponseParser
     * @param ConfigServiceInterface $configService
     */
    public function __construct(
        ProductResponseParserInterface $parentProductResponseParser,
        ConfigServiceInterface $configService
    ) {
        $this->parentProductResponseParser = $parentProductResponseParser;
        $this->configService = $configService;
    }

    /**
     * {@inheritdoc}
     */
    public function parse(array $product): array
    {
        $productDefaultNameOption = (int)$this->configService->get('helper.product_default_name_option');
        $productDefaultNameOptionFallback = (int)$this->configService->get('helper.product_default_name_option_fallback');

        foreach ($product['texts'] as $key => $text) {
            // 1 is default so not needed here.

            if ($productDefaultNameOption === 2) {
                $productName = !empty($text['name2']) ? $text['name2'] : $text['name'. $productDefaultNameOptionFallback] ?? '';
                $product['texts'][$key]['name1'] = $productName;
            } elseif ($productDefaultNameOption === 3) {
                $productName = !empty($text['name3']) ? $text['name3'] : $text['name'. $productDefaultNameOptionFallback] ?? '';
                $product['texts'][$key]['name1'] = $productName;
            }
        }

        return $this->parentProductResponseParser->parse($product);
    }
}