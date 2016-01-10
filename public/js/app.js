$(function(){
    $('#share_url').on('click', function() {
        $(this).select();
    });

    /**
     * Display the items
     */
    function displayJavascriptData()
    {
        $('#js-display').html(function () {
            return window.javascriptData.display.width + 'px x ' + window.javascriptData.display.height + 'px (' + window.javascriptData.display.colorDepth + 'bit)';
        });
        $('#js-browser-window').html(function () {
            return window.javascriptData.browserWindow.width + 'px x ' + window.javascriptData.browserWindow.height + 'px';
        });
        $('#js-cookies').html(function () {
            return window.javascriptData.cookies ? 'Enabled' : 'Disabled';
        });
        $('#js-do-not-track').html(function () {
            return window.javascriptData.doNotTrack ? 'Privacy Requested' : 'Public or Not Available';
        });
        $('#js-language').html(function () {
            return window.javascriptData.language;
        });
        $('#js-platform').html(function () {
            return window.javascriptData.platform;
        });

        var $template = $('#js-template');
        var $table = $template.parent();
        $template = $template.detach();
        $template.css('display', 'table-row');

        $.each(window.javascriptData.plugins, function(index, plugin) {
            var $row = $template.clone();
            $('td:first-child', $row).html(plugin.name);
            var description = plugin.description;
            if (!description) {
                description = 'Present';
            }
            $('td:last-child', $row).html(description);
            $table.append($row);
        });
    }

    if (window.javascriptData) {
        window.javascriptData = $.parseJSON(window.javascriptData);
        displayJavascriptData();
    }
    else {
        var properties = {};
        properties.display = {
            width: window.screen.availWidth,
            height: window.screen.availHeight,
            colorDepth: window.screen.colorDepth
        };
        properties.browserWindow = {width: $(window).width(), height: $(window).height()};
        properties.cookies = navigator.cookieEnabled;
        properties.doNotTrack = navigator.doNotTrack;
        properties.language = navigator.language;
        properties.platform = navigator.platform;
        properties.plugins = [];

        $.each(navigator.plugins, function (idx, plugin) {
            var p = {
                name: plugin.name,
                description: $('<div>' + plugin.description + '</div>').text()
            };
            properties.plugins.push(p);
        });

        window.javascriptData = properties;

        $.ajax({
            type: "POST",
            url: window.location.href + '/js',
            data: properties,
            success: displayJavascriptData
        });
    }
});