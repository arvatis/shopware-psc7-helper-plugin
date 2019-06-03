{extends file="parent:backend/_base/layout.tpl"}

{block name="content/main"}
    <div class="alert alert-info mb-4">
        Cronjob Synchronize: Letzte plentyMarkets synchonisierung lief {$lastSyncDate->format('d.m.Y H:i:s')}
    </div>
    <div class="row">
        <div class="col-12 col-xl-6">
            <div class="card h-100">
                <div class="card-header">
                    <div class="float-right font-size-min pt-2">
                    </div>
                    <h5>
                        Connector
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-4">
                            {if $backlogCount}
                                <span class="badge badge-success badge-psc7big w-100 total-backlog-count">{$backlogCount} Objekte im Backlog</span>
                            {else}
                                <span class="badge badge-success badge-psc7big w-100 total-backlog-count">Der Backlog ist leer</span>
                            {/if}
                        </div>
                        <div class="col-12 mb-4">
                            {if $identityCount}
                                <span class="badge badge-dark badge-psc7big w-100 total-identity-count">{$identityCount} Objekte im Identity</span>
                            {else}
                                <span class="badge badge-dark badge-psc7big w-100 total-identity-count">Die Identity sind leer</span>
                            {/if}
                        </div>
                        <div class="col-12 col-sm-6 mb-4">
                            <span class="badge badge-info badge-psc7big w-100">{$identityOrderCount} Bestellungen gemappt</span>
                        </div>
                        <div class="col-12 col-sm-6 mb-4">
                            <span class="badge badge-info badge-psc7big w-100">{$identityProductCount} Produkte gemappt</span>
                        </div>
                        <div class="col-12 col-sm-6 mb-4">
                            <span class="badge badge-info badge-psc7big w-100">{$identityVariationCount} Varianten gemappt</span>
                        </div>
                        <div class="col-12 col-sm-6 mb-4">
                            <span class="badge badge-info badge-psc7big w-100">{$identityMediaCount} Bilder gemappt</span>
                        </div>
                        <div class="col-12 col-sm-6">
                            <span class="badge badge-info badge-psc7big w-100">{$identityCategoryCount} Kategorien gemappt</span>
                        </div>
                        <div class="col-12 col-sm-6 mt-4 mt-sm-0">
                            <span class="badge badge-info badge-psc7big w-100">{$identityManufacturerCount} Hersteller gemappt</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-6 mt-4 mt-xl-0">
            <div class="card h-100">
                <div class="card-header">
                    <h5>
                        Cronjobs
                    </h5>
                </div>
                <div class="card-body table-responsive-md">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Cronjob</th>
                            <th class="d-none d-sm-table-cell" scope="col">Letzte Ausführung</th>
                            <th scope="col">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        {if $cronjobs}
                            {foreach $cronjobs as $cronjob}
                                <tr>
                                    <td>{$cronjob.name}</td>
                                    <td class="d-none d-sm-table-cell">{$cronjob.end->format('d.m.Y H:i:s')}</td>
                                    {if $cronjob['isRecentlyRun']}
                                        <td><span class="badge badge-success badge-psc7">aktiv</span></td>
                                    {else}
                                        <td><span class="badge badge-danger badge-psc7">überfällig</span></td>
                                    {/if}
                                </tr>
                            {/foreach}
                        {/if}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
{/block}