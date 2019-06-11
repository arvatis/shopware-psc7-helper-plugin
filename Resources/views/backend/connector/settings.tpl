{extends file="parent:backend/_base/layout.tpl"}

{block name="content/main"}
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Einstellungen</h5>
                </div>
                <div class="card-body">
                    <form action="{url controller=PSC7HelperConnector action=saveSettings}" method="post">
                        <div class="form-row">
                            <div class="col-12">
                                <div class="form-group mb-4">
                                    <label for="phpCliPathOption">PHP CLI Path</label>
                                    <input type="text" name="phpCliPathOption" id="phpCliPathOption" class="form-control" placeholder="/usr/bin/php" value="{$currentPhpCliPathOption}">
                                    <small id="phpCliPathOption" class="form-text text-muted">Falls sie einen anderen PHP Cli Path haben wegen ihrem Hoster können sie den Path hier eintragen.</small>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-4">
                                    <label for="productDefaultNameOption">Produkt Name</label>
                                    <select class="form-control" id="productDefaultNameOption" name="productDefaultNameOption">
                                        {if $productDefaultNameOptions}
                                            {foreach $productDefaultNameOptions as $key => $productDefaultNameOption}
                                                {if $key == $currentProductDefaultNameOption}
                                                    <option value="{$key}" selected>{$productDefaultNameOption}</option>
                                                {else}
                                                    <option value="{$key}">{$productDefaultNameOption}</option>
                                                {/if}
                                            {/foreach}
                                        {/if}
                                    </select>
                                    <small id="productDefaultNameOptionHelp" class="form-text text-muted">Auswahl Welcher Produkt Name für die Übertragung genutzt werden soll.</small>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-4">
                                    <label for="productDefaultNameOptionFallback">Produkt Name Fallback</label>
                                    <select class="form-control" id="productDefaultNameOptionFallback" name="productDefaultNameOptionFallback">
                                        {if $productDefaultNameOptions}
                                            {foreach $productDefaultNameOptions as $key => $productDefaultNameOption}
                                                {if $key == $currentProductDefaultNameOptionFallback}
                                                    <option value="{$key}" selected>{$productDefaultNameOption}</option>
                                                {else}
                                                    <option value="{$key}">{$productDefaultNameOption}</option>
                                                {/if}
                                            {/foreach}
                                        {/if}
                                    </select>
                                    <small id="productDefaultNameOptionFallbackHelp" class="form-text text-muted">Auswahl Welcher Produkt Name für die Übertragung genutzt werden soll wenn das ausgewählte Feld nicht befüllt ist.</small>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-4">
                                    <input type="hidden" name="stockBufferOption" value="{$currentStockBufferOption}">
                                    <label for="stockBufferOption">Stock Buffer</label>
                                    <div class="rangeslider-wrap">
                                        <input type="range" id="stockBufferOption" class="stockBufferOptionRange" value="{$currentStockBufferOption}">
                                    </div>
                                    <br />
                                    <p class="form-text text-center stockBufferOptionText">{$currentStockBufferOption}</p>
                                    <small id="stockBufferOptionHelp" class="form-text text-muted">Auswahl Welcher Warenbestandspuffer für die Übertragung genutzt werden soll.</small>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-psc7 btn-search" type="submit">Speichern</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
{/block}