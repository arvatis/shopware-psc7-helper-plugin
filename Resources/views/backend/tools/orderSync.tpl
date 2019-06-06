{extends file="parent:backend/_base/layout.tpl"}

{block name="content/main"}
    <div class="row mb-4 command-output">
        <div class="col-12">
            <div class="card">
                <div class="card-body console-stream">
                    <pre class="console-output" data-text="Processing the command this may take a while please be patient...">Wait for command...</pre>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Bestellungen abgleichen</h5>
                </div>
                <div class="card-body">
                    {if $orders}
                        <table class="table table-striped datatable-wp">
                            <thead>
                            <tr>
                                <th class="text-left" scope="col">Bestellung</th>
                                <th class="text-left d-none d-lg-table-cell" scope="col">Datum, Uhrzeit</th>
                                <th class="text-left d-none d-md-table-cell" scope="col">Kunde</th>
                                <th class="text-left" scope="col">plenty Auftrags-ID</th>
                                <th class="text-left" scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            {foreach $orders as $order}
                                <tr>
                                    <td class="text-left align-middle">{$order->ordernumber}</td>
                                    <td class="text-left align-middle d-none d-lg-table-cell">{$order->ordertime}</td>
                                    <td class="text-left align-middle d-none d-md-table-cell">{$order->firstname} {$order->lastname}</td>
                                    {if $order->isMapped && $order->isPlentyMapped}
                                        <td class="text-left align-middle">{$order->adapterPlentyIdentifier}</td>
                                    {else}
                                        <td class="text-left align-middle">nicht gemappt</td>
                                    {/if}
                                    <td class="text-left align-middle">
                                        <form class="helper-sync-command" action="{url controller=PSC7HelperCommand action=executeCommand}" method="post" autocomplete="off">
                                            <input type="hidden" id="product" name="objectIdentifier" value="{$order->objectIdentifier}">
                                            <input type="hidden" id="type" name="type" value="Order">
                                            <button class="btn btn-psc7 btn-command-button"
                                                    type="submit"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    data-command-name="Order"
                                                    data-command-url="{url controller=PSC7HelperCommand action=executeCommand}"
                                                    title="{$order->generatedCommand}">
                                                Synchonisieren
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            {/foreach}
                            </tbody>
                        </table>
                    {else}
                        <div class="alert alert-info mb-4">
                            Leider wurden keine passende Treffer gefunden.
                        </div>
                    {/if}
                </div>
            </div>
        </div>
    </div>
{/block}