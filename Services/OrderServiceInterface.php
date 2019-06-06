<?php

namespace PSC7Helper\Services;

interface OrderServiceInterface
{
    /**
     * @return array
     */
    public function getAllAvailableOrders(): array;
}