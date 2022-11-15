<?php 
	global $wp_query;
	$search_term = return_if($wp_query->query_vars,'name') ? : return_if($wp_query->query,'name');
	$options = mx_options();
	$mx_page = get_post(return_if($options, '404_page') );
	$mx_page = $mx_page ? : (object) array( 
		'post_title'=> '404',
		'post_excerpt'=> 'Page Not Found',
		'post_type'=> 'archive',
		'dont_link' => true,
		'post_parent' => 0,
		'ID' => 0
	);
	get_header();
?>

<!--=====================  BEGIN PAGE CONTENT  =====================-->	
<section class="fourofour">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 text-center">
				<h1><?= $mx_page->post_title ?></h1>
				<h2><?= $mx_page->post_excerpt ?></h2>
				
				<hr />
				
				<?= apply_filters('the_content', return_if( $mx_page,'post_content') ); ?>

				<span class="h3">Would you like to <a href="/?s=<?= urlencode($search_term) ?>" class="">search for <em><?= $search_term ?></em></a>&nbsp;? </span>
				
				<div class="clearfix"></div>
				
				<a href="/" class="btn btn-default btn-reverse mtop-40">Return to Homepage</a>
				
				<?php //pr( $wp_query ); ?>
			</div><!-- .col-sm-12 -->
		</div><!-- .row -->
	</div><!-- .container -->
</section><!-- .fourofour -->
<!--=====================  END PAGE CONTENT  =====================-->

<?php get_footer(); ?>

