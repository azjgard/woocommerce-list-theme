var DEBUG = true;

function debug() {
    if (DEBUG) {
        for (var i = 0; i < arguments.length; i++) {
            console.log(arguments[i]);
        }
    }
}
// ---------------------------------------------------------------------------------

/**
 * Product select box handler.
 *
 * Only run on the shop page.
 */

if (window.location.href.match(/shop/)) {
    (function($) {
        debug('Forms initialized.');

        // change the action of the add-to-cart form every time
        // the value of the select box is changed.
        $(document).on('change', '.wcgp-select', function(e) {

            // info about the option changed to
            var options = this.options;
            var index   = e.target.selectedIndex;
            var action  = options[index].value;

            // the form that contains the select box
            var form = $(this).parent();

            // change the action of the form that is taken
            // upon submission
            form.attr('action', action ? action : form.data('default'));

            debug('Select box changed.. NEW ACTION: ', action);
        });
    })(jQuery);
}

// ---------------------------------------------------------------------------------

/**
 * Add a click listener to the button on the sidebar so that it can toggle
 * the filter box on mobile.
 */

(function($) {
    debug('Adding filter listener.');

    var filterVisible = false;

    function toggleFilter() {
        filterVisible = !filterVisible;

        if (filterVisible) {
            debug('Filter is now visible');

            $('#primary').addClass('lcgc-filter-visible');
            $('#secondary').addClass('visible');

            // hide the filter when the window is resized
            // with it open.
            $(window).resize(toggleFilter);
        }
        else {
            debug('Filter is now hidden.');

            $('#primary').removeClass('lcgc-filter-visible');
            $('#secondary').removeClass('visible');

            // remove the resize listener when
            // the filter is closed.
            $(window).off('resize');
        }
    }

    $('#lcgc-toggle-filter').on('click', toggleFilter);

})(jQuery);
