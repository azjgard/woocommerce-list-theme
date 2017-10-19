var DEBUG = true;

if (DEBUG) {
    console.log('DEBUG IS ENABLED.');
}

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

    var filter = { visible: false };
    var nav    = { visible: false };

    // TODO: change the name of the class being added to #primary to be filter agnostic
    // TODO: make a transition mixin and add it to the primary nav menu

    function toggleElement(selector, flag) {
        flag.visible = !flag.visible;

        if (flag.visible) {
            debug('Element is now visible');

            $('.site-branding').addClass('grayed-out');
            $('#primary')      .addClass('grayed-out');

            $(selector).addClass('visible');

            // hide the element when the window is resized
            // with it open.
            $(window).resize(function() { toggleElement(selector, flag); });
        }
        else {
            debug('Element is now hidden.');

            $('.site-branding').removeClass('grayed-out');
            $('#primary')      .removeClass('grayed-out');

            $(selector).removeClass('visible');

            // remove the resize listener when
            // the element is closed.
            $(window).off('resize');
        }
    }

    // Mobile product filter
    $('#lcgc-toggle-filter').on('click', function() {
        toggleElement('#secondary', filter)
    });

    // Mobile navigation menu
    $('#lcgc-toggle-mobile-nav').on('click', function() {
        toggleElement('.storefront-primary-navigation', nav)
    });

})(jQuery);
