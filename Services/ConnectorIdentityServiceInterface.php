<?php

namespace PSC7Helper\Services;

interface ConnectorIdentityServiceInterface
{
    /**
     * @return int
     */
    public function getAllIdentitiesCount(): int;

    /**
     * @param string $adapterIdentifier
     * @param string $adapterName
     * @param string $objectType
     *
     * @return object
     */
    public function getIdentityByAdapterIdentifierAndAdapterNameAndObjectType(string $adapterIdentifier, string $adapterName, string $objectType);

    /**
     * @param string $objectType
     *
     * @return int
     */
    public function getIdentitiesCountByObjectType(string $objectType): int;

    /**
     * @param string $objectIdentifier
     *
     * @return array
     */
    public function getAllObjectsByObjectIdentifier(string $objectIdentifier);

    /**
     * @param string $objectType
     *
     * @return array
     */
    public function getAllObjectsByObjectType(string $objectType);

    /**
     * @param string $adapterIdentifier
     *
     * @return array
     */
    public function getAllObjectsByAdapterIdentifier(string $adapterIdentifier);

    /**
     * @param string $adapterName
     *
     * @return array
     */
    public function getAllObjectsByAdapterName(string $adapterName);
}