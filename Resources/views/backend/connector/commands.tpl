{extends file="parent:backend/_base/layout.tpl"}

{block name="content/main"}
    <div class="alert alert-info mb-4">
        Cronjob Synchronize: Letzte plentyMarkets synchonisierung lief {$lastSyncDate->format('d.m.Y H:i:s')}
    </div>
    <div class="row mb-4">
        <div class="col-12 col-lg-8">
            <div class="card h-100">
                <div class="card-header">
                    <h5>
                        Kurzwahl-Befehle
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        {if $availableCommands}
                            {foreach $availableCommands as $command}
                                <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-4 helper-command">
                                    <button class="btn btn-psc7 btn-command-button w-100"
                                            type="submit"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            data-command-name="{$command.name}"
                                            data-command-url="{url controller=PSC7HelperCommand action=executeCommand}"
                                            title="{$command.generatedCommand}">
                                        {$command.command}
                                    </button>
                                </div>
                            {/foreach}
                        {/if}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 mt-4 mt-lg-0">
            <div class="card mb-4">
                <div class="card-header"><h5>Artikel / Bestellung Sync</h5></div>
                <div class="card-body">
                    <form class="helper-sync-command" action="{url controller=PSC7HelperCommand action=executeCommand}" method="post" autocomplete="off">
                        <div class="form-row">
                            <div class="col-sm-12 mb-1">
                                <div class="form-group">
                                    <label for="product">Identifiernummer</label>
                                    <input id="product" class="form-control" type="text" name="objectIdentifier" placeholder="z.B 753c7d5d-09be-4dd3-bd3f-3d5cc2e92dab" required>
                                </div>
                            </div>
                            <div class="col-sm-12 mb-1">
                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <select class="form-control" id="type" name="type">
                                        <option value="Product">Artikel</option>
                                        <option value="Order">Bestellung</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-psc7 btn-command-button" type="submit">Synchonisieren</button>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    {if $backlogCount|count}
                        <span class="badge badge-success badge-psc7big w-100 total-backlog-count">{$backlogCount} Objekte im Backlog</span>
                    {else}
                        <span class="badge badge-danger badge-psc7big w-100 total-backlog-count">Der Backlog ist leer</span>
                    {/if}
                </div>
            </div>
        </div>
    </div>
    <div class="row command-output">
        <div class="col-12">
            <div class="card">
                <div class="card-body console-stream">
                    <pre class="console-output" data-text="Processing the command this may take a while please be patient...">Wait for command...</pre>
                </div>
            </div>
        </div>
    </div>
{/block}
