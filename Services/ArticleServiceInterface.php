<?php

namespace PSC7Helper\Services;

interface ArticleServiceInterface
{
    /**
     * @return array
     */
    public function getAllAvailableArticles(): array;
}