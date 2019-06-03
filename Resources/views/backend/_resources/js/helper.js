;(function ($, window, document) {

    var psc7Helper = {
        init: function () {
            var self = this;

            self.registerEvents();
        },

        registerEvents: function () {
            var self = this,
                $commandButton = $('.helper-command').find('.btn-command-button'),
                $syncCommandButton = $('.helper-sync-command').find('.btn-command-button'),
                $searchButton = $('form.searchIdentities').find('.btn.btn-search');

            $commandButton.on('click', function (e) {
                e.preventDefault();

                self.handleCommandOutput($(this));
            });

            $syncCommandButton.on('click', function (e) {
                e.preventDefault();

                self.handleSyncCommandOutput($(this));
            });

            $searchButton.on('click', function (e) {
                e.preventDefault();

                self.handleSearchResults($(this));
            });

            self.handleDataTables();
            self.handleTooltips();
        },

        handleCommandOutput: function ($commandButton) {
            var $commandOutput = $('.command-output'),
                $consoleOutput = $commandOutput.find('pre.console-output');

            $consoleOutput.text($consoleOutput.attr('data-text'));

            $.ajax({
                url: $commandButton.attr('data-command-url'),
                method: 'POST',
                cache: false,
                data: {
                    command: $commandButton.attr('data-command-name')
                }
            }).done(function (response) {
                $consoleOutput.html(response.data.join("\n"));
            });
        },

        handleSyncCommandOutput: function ($commandButton) {
            var $commandForm = $commandButton.parent() || {},
                $commandOutput = $('.command-output'),
                $consoleOutput = $commandOutput.find('pre.console-output');

            $consoleOutput.text($consoleOutput.attr('data-text'));

            $.ajax({
                url: $commandForm.attr('action'),
                method: 'POST',
                cache: false,
                data: {
                    command: $commandForm.find('#type').val(),
                    objectIdentifier: $commandForm.find('#product').val()
                }
            }).done(function (response) {
                $consoleOutput.html(response.data.join("\n"));
            });
        },

        handleSearchResults: function ($searchButton) {
            var $searchForm = $searchButton.parent(),
                $searchResults = $('.search-results'),
                $searchContent = $searchResults.find('.search-content');

            $.ajax({
                url: $searchForm.attr('action'),
                method: $searchForm.attr('method'),
                cache: false,
                data: $searchForm.serialize()
            }).done(function (response) {
                $searchContent.html(response);
            });
        },

        handleTooltips: function () {
            $('[data-toggle="tooltip"]').tooltip();
        },

        handleDataTables: function () {
            $('.datatable').DataTable({
                "order": [[3, "desc"]],
                "lengthMenu": [[50, -1], [50, "All"]],
                "paging": true,
                "ordering": true,
                "info": false
            });

            $('.datatable-wp').DataTable({
                "order": [[3, "desc"]],
                "lengthMenu": [[50, -1], [50, "All"]],
                "paging": false,
                "ordering": true,
                "info": false
            });
        }
    };

    psc7Helper.init();

})(jQuery, window, document);