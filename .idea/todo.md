## TODOs - Check 3

# STOPPED IN ALTERNATIVESTORETEMPLATE.PHP

** WAIT ON DETAILS FROM STEVEN **
--------------------------------------

    For people ordering in USA:
      - Shipping system conditional on price, no conditions at all on location
      - Create option to allow for 2-day shipping

    - Abilty to ship with a shipping company account

    For people ordering out of USA:
      - Only options are to ship with account or ship with GCFerrule's FedEx
      account

--------------------------------------
** WAIT ON DETAILS FROM STEVEN **

- Get hosting information and send to steven to set up

- Generate invoice for last check

- Ensure promo code system is set up

- Use commas to separate Similar to field instead of |

- For the quantity packs, only look for SKUs that end in:
  - 5
  - 25
  - 50
  - 100
(nothing else will come afterwards)

- Absolute positioning and no max-height on the sidebar when on desktops.
Leave fixed positioning with max-height on mobile.

- Implement sidebar front-end to request the filterable product page
via AJAX.

- BUG: make the tables wider so that the values of the product attributes
are never wrapped (screwing up the rest of the product div)

- BUG: the dumb search only searches for product names, and doesn't work for
SKU numbers, attributes, etc.

- Figure out what to do for caching and versioning file names before
uploading to the server.

- Add products to cart via AJAX (NOTE: there is a snippet for this
saved in Chrome Snippets)

- Add JavaScript to prevent adding to cart if the customer has not yet
selected a quantity.

- Add quantity box to product archive page

~~- Instead of showing the price as regular text, in addition to a select
box that drops down, the price should be hidden and the default select box
option should simply be an option of ONE.~~

~~- BUG: The dropdown boxes on the product page currently truncate the price. For
example, if the actual price is $104.63, the dropdown box will show
$104.00.~~
(I was parsing to int instead of to double, so it was truncating the decimal)

~~- BUG: The product page shouldn't display products whose SKUs end with a - and
a two digit number, since that's what the dropdown boxes rely upon to work.~~
(Edited template file content-product.php and return if SKU matches pattern)

~~- BUG: The individual product pages shouldn't display the first image that is
listed for the product~~

~~- Bullet proof the product import system and add images to the store~~

//////

- Optimize speed and load times

- Pay for hosting, change DNS servers to point
to hosting

- Put site up in production

- Link up actual payment gateway

- Run production tests

## MAYBEs

- Add a form to the Contact Us page

$('.add-to-cart.button').on('click', function(e) {
	// don't submit the form
	e.preventDefault();

	var action           = $(this).parent().attr('action')
	var productContainer = $(this).parent().parent()
	
	// response from that page
	$.get(action, function(res) {

		// TODO: update the cart HTML with the cart HTML
		// from the page.

		// TODO: fade in and fade out a notification saying
		// that the item has been added to the cart.

		// TODO: change logic for product page vs product-archive
		// page.

		let html  = jQuery.parseHTML(res);
		let notif = $(html).find('.woocommerce-message');


		$(productContainer).append(notif);
    });
});
