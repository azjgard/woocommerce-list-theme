## TODOs

- ~~On mobile, change the product filter dropdown
to use percentage-based widths instead of fixed
pixel~~
    
- ~~On mobile, change the navigation to be a dropdown
similar to the product filter (with fixed positioning)~~

- ~~Add the product quantity select box to individual
product pages~~

- ~~Style individual product pages to fit
look and feel of the rest of the site~~

- ~~Style the product filter sidebar to be consistent
and not load styling via JavaScript after
the page has loaded~~

- Style product filter sidebar to be consistent with
parent/child styling as shown on
GCFerrules.com

- ~~Fix the FAQs page so that the dropdowns actually
work (and maybe completely remove the dropdowns?)~~

- Implement color scheme determined by graphic
designer that RS uses for their logos

- Optimize speed and load times

- Pay for hosting, change DNS servers to point
to hosting

- Put site up in production

- Link up actual payment gateway

- Run production tests

## MAYBEs

- ~~Filter products via AJAX~~
- ~~Add fixed positioning for sidebar on products page~~
- Add products to cart via AJAX
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
