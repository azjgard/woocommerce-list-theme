## TODOs - Check 3

- Fix the sidebar to filter by attributes as shown on GCFerrules.com

- BUG: the dumb search only searches for product names, and doesn't work for
SKU numbers, attributes, etc.

~~- BUG: The dropdown boxes on the product page currently truncate the price. For
example, if the actual price is $104.63, the dropdown box will show
$104.00.~~
(I was parsing to int instead of to double, so it was truncating the decimal)

~~- BUG: The product page shouldn't display products whose SKUs end with a - and
a two digit number, since that's what the dropdown boxes rely upon to work.~~
(Edited template file content-product.php and return if SKU matches pattern)

~~- BUG: The individual product pages shouldn't display the first image that is
listed for the product~~

//////


- Move the external plugin into the child theme to remove external
dependencies?

- Implement color scheme determined by graphic
designer that RS uses for their logos

- Optimize speed and load times

- Pay for hosting, change DNS servers to point
to hosting

- Put site up in production

- Link up actual payment gateway

- Run production tests

## MAYBEs

- Add products to cart via AJAX (NOTE: there is a snippet for this
saved in Chrome Snippets)
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
