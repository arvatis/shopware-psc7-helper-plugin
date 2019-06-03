{extends file="parent:backend/_base/layout.tpl"}

{block name="content/main"}
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>
                        Identitys
                    </h5>
                </div>
                <div class="card-body">
                    <form class="searchIdentities" action="{url controller=PSC7HelperConnector action=search}" method="post">
                        <div class="form-row">
                            <div class="col-12 col-md-6">
                                <div class="form-group mb-4">
                                    <label for="search">Suchbegriff</label>
                                    <input class="form-control" type="text" name="term" placeholder="Suchbegriff">
                                    <small id="search_help" class="form-text text-muted">Beispiel adapterIdentifier: Artikelnummer, plenty-ID, Artikel-ID, oder andere ID´s.<br>Beispiel objectIdentifier: fedcba09-abcd-1234-5678-01234567890a</small>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group mb-4">
                                    <label for="column">Datenbank-Spalte</label>
                                    <select class="form-control" id="column" name="type">
                                        {if $identitySearchColumns}
                                            {foreach $identitySearchColumns as $key => $identitySearchColumn}
                                                <option value="{$key + 1}">{$identitySearchColumn}</option>
                                            {/foreach}
                                        {/if}
                                    </select>
                                    <small id="column_help" class="form-text text-muted">Auswahl der Datenbank-Spalte in der gesucht werden soll. Der im Log angegebene payload befindet sich in der Spalte objectIdentifier.</small>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-psc7 btn-search" type="submit">Suchen</button>
                    </form>
                </div>
            </div>
            <div class="card search-results">
                <div class="card-body search-content">
                    <pre>Wait for command...</pre>
                </div>
            </div>
        </div>
    </div>
{/block}