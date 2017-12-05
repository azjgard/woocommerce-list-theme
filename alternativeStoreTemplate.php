<?php

/*
 * Template Name: Filter Products via Query String
 */

// This allows us to catch any notices or warnings by throwing them
// as errors. Otherwise, error handling becomes incredibly hard.
set_error_handler(function($errno, $errstr, $errfile, $errline) {
    throw new RuntimeException($errstr . " on line " . $errline . " in file " . $errfile);
});

get_header(); ?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

    <ul class="products">
      <?php
        // This will be either 'true' or will not be set at
        // all. If true, then the query performed should be an "OR"
        // query instead of an "AND" query.
        $filter_inclusive = get_query_var("inclusive", false);

        // This will be a list of comma-separated category slugs
        // to filter by.
        $filter_category = get_query_var("category", null);

        // This will be a list of key-value attributes to filter
        // by. The format will be like this:
        // attr-name:attr-value;attr-name:attr-value
        $filter_attribute = get_query_var("attribute", null);

        $args = array(
          'post_type' => 'product',
          'posts_per_page' => 100
        );

        // Filtering by CATEGORY
        if ($filter_category) {
          $tax_query      = array();
          $category_array = explode(',', $filter_category);

          $tax_query['relation'] =
            ($filter_inclusive == "true") ? 'OR' : 'AND';

          foreach ($category_array as $category) {
            array_push($tax_query, array(
              'taxonomy' => 'product_cat',
              'field' => 'slug',
              'terms' => $category
            ));
          }
          $args['tax_query'] = $tax_query;
        }

        // Filtering by ATTRIBUTE
        if ($filter_attribute) {
          $meta_query     = array();
          $key_value_pair = explode(';', $filter_attribute);

          $tax_query['relation'] =
            ($filter_inclusive == "true") ? 'OR' : 'AND';

          foreach ($key_value_pair as $pair) {
            try {
              $key   = explode(':', $pair)[0];
              $value = explode(':', $pair)[1];

              // Unfortunately, since we're importing local attributes
              // in our spreadsheets, WooCommerce stores them in a pseudo
              // JSON string inside of the meta_key '_product_attributes'.
              // Local attributes are literally stored NOWHERE else. Luckily,
              // we're allowed to do regex in our query, which works pretty
              // well. If something breaks in the future, try adjusting the
              // {2,7} ranges; that part is probably a little hacky.
              //
              // preg_quote escapes the values for use in regular expressions
              array_push($meta_query, array(
                'key' => '_product_attributes',
                'value' => '\"'.preg_quote($key).'\".{2,7}\"value\".{2,7}\"'.preg_quote($value).'\"',
                'compare' => 'REGEXP'
              ));
            }
            // This catch will be triggered if anything goes wrong
            // when trying to explode each $pair in the loop, i.e. if
            // there isn't a colon separating two strings.
            catch(Exception $e) {
              echo '<h1>Your query is in an incorrect format.</h1>';
              return;
            }
          }

          $args['meta_query'] = $meta_query;
        }

        $loop = new WP_Query( $args );

        if ( $loop->have_posts() ) {
          while ( $loop->have_posts() ) : $loop->the_post();
            wc_get_template_part( 'content', 'product' );
          endwhile;
        } 
        else {
          echo __( 'No products found' );
        }

        wp_reset_postdata();
      ?>
    </ul>
  </main>
</div>

<?php get_footer(); ?>
  
<!-- Set the error handling back to normal -->
<?php restore_error_handler(); ?>
