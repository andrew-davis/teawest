<?php
// load up ATW	
require_once( WP_CONTENT_DIR . '/themes/mx-theme/atw/init.php');

/**
	 * Sets the 'publicly_queryable' value of the page post type to true
	 * so that search results can be filtered by page.
 *
 * @author Brent Shepherd
 */

function eg_make_pages_queryable() {
    global $wp_post_types;  
 
    $wp_post_types['page']->publicly_queryable = true;
}
add_action( 'init', 'eg_make_pages_queryable', 20 );

function my_password_form() {
    global $post;
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    $o = '<form action="' . esc_url( site_url( '/?mx-postpass', 'login_post' ) ) . '" method="post">';
    $o.= "<h3>Please Login to view this Protected Page:</h3>";
    $o.="<div class = 'form-group'>";
	    $o.='<label class="sr-only" for="' . $label . '">' . __( "Password:" ) . ' </label>';
	    $o.='<input class="form-control" name="post_password" id="' . $label . '" type="password" size="20" maxlength="20" clas="form-control" placeholder="Enter Your Password" />';
	  $o.="</div>";
    $o.="<div class = 'form-group'>";
	    $o.='<button class="btn btn-default" type="submit" name="Submit" value="' . esc_attr__( "Submit" ) . '" >Submit</button>';
	  $o.="</div>";
    $o.='</form>';
    return $o;
}






if( trying_to( 'mx-postpass', 'request' )){
		if ( ! array_key_exists( 'post_password', $_POST ) ) {
			wp_safe_redirect( wp_get_referer() );
			exit();
		}
		require_once ABSPATH . WPINC . '/class-phpass.php';
		
		$hasher = new PasswordHash( 8, true );
		$expire = apply_filters( 'post_password_expires', time() + 10 * DAY_IN_SECONDS );
		
		$referer = wp_get_referer();
		if ( $referer ) {
			$secure = ( 'https' === parse_url( $referer, PHP_URL_SCHEME ) );
		} else {
			$secure = false;
		}
		setcookie( 'wp-postpass_' . COOKIEHASH, $hasher->HashPassword( wp_unslash( $_POST['post_password'] ) ), $expire, COOKIEPATH, COOKIE_DOMAIN, $secure );
		wp_safe_redirect( wp_get_referer() );
		exit();
}


register_block_pattern(
    'my-plugin/my-awesome-pattern',
    array(
        'title'       => __( 'Custom buttons', 'my-plugin' ),
        'description' => _x( 'Two horizontal buttons, the left button is filled in, and the right button is outlined.', 'Block pattern description', 'my-plugin' ),
        'content'     => "<!-- wp:buttons {\"align\":\"center\"} -->\n<div class=\"wp-block-buttons aligncenter\"><!-- wp:button {\"backgroundColor\":\"very-dark-gray\",\"borderRadius\":0} -->\n<div class=\"wp-block-button\"><a class=\"wp-block-button__link has-background has-very-dark-gray-background-color no-border-radius\">" . esc_html__( 'Button One', 'my-plugin' ) . "</a></div>\n<!-- /wp:button -->\n\n<!-- wp:button {\"textColor\":\"very-dark-gray\",\"borderRadius\":0,\"className\":\"is-style-outline\"} -->\n<div class=\"wp-block-button is-style-outline\"><a class=\"wp-block-button__link has-text-color has-very-dark-gray-color no-border-radius\">" . esc_html__( 'Button Two', 'my-plugin' ) . "</a></div>\n<!-- /wp:button --></div>\n<!-- /wp:buttons -->",
    )
);