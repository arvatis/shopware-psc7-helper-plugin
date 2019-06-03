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
                    <h5>Artikelstatus prüfen</h5>
                </div>
                <div class="card-body">
                    {if $articles}
                        <table class="table table-striped datatable-wp">
                            <thead>
                            <tr>
                                <th class="text-left" scope="col">Artikelid</th>
                                <th class="text-left " scope="col">Artikelnummer</th>
                                <th class="text-left d-none d-lg-table-cell" scope="col">Artikelname</th>
                                <th class="text-left" scope="col">Aktiv</th>
                                <th class="text-left" scope="col">Gemappt</th>
                                <th class="text-left" scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            {foreach $articles as $article}
                                <tr>
                                    <td class="text-left align-middle">{$article->id}</td>
                                    <td class="text-left align-middle">{$article->ordernumber}</td>
                                    <td class="text-left align-middle d-none d-lg-table-cell">{$article->name}</td>
                                    {if $article->active}
                                        <td class="text-left align-middle">Ja</td>
                                    {else}
                                        <td class="text-left align-middle">Nein</td>
                                    {/if}
                                    {if $article->isMapped}
                                        <td class="text-left align-middle">Ja</td>
                                    {else}
                                        <td class="text-left align-middle">Nein</td>
                                    {/if}
                                    <td class="text-left align-middle">
                                        <form class="helper-sync-command" action="{url controller=PSC7HelperCommand action=executeCommand}" method="post" autocomplete="off">
                                            <input type="hidden" id="product" name="objectIdentifier" value="{$article->objectIdentifier}">
                                            <input type="hidden" id="type" name="type" value="Product">
                                            <button class="btn btn-psc7 btn-command-button"
                                                    type="submit"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    data-command-name="Product"
                                                    data-command-url="{url controller=PSC7HelperCommand action=executeCommand}"
                                                    title="{$article->generatedCommand}">
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