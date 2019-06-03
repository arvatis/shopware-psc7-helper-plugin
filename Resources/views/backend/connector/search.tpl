{if $identities}
    <table class="table datatable-wp">
        <thead>
        <tr>
            <th>id</th>
            <th>objectIdentifier</th>
            <th>objectType</th>
            <th>adapterIdentifier</th>
            <th>adapterName</th>
        </tr>
        </thead>
        <tbody>
        {foreach $identities as $identity}
            <tr>
                <td>{$identity->id}</td>
                <td>{$identity->objectIdentifier}</td>
                <td>{$identity->objectType}</td>
                <td>{$identity->adapterIdentifier}</td>
                <td>{$identity->adapterName}</td>
            </tr>
        {/foreach}
        </tbody>
    </table>
{else}
    <div class="alert alert-info mb-4">
        Leider wurden keine passende Treffer gefunden.
    </div>
{/if}