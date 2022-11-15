<?php  
	/**
	 * Template Name: Articles Listing
	 * Description: Template for displaying articles in a list format. Also used for category and tag archives (ie. press and media, news, blog etc.).
	 * Order: 49
	 * Meta: {"link" : "/blog", "icon" : "fa fa-rss"}
	 * 
	**/
	$mx_page = Atw_app::get_page(Atw_app::get_posts_page($post));
	get_header(); 
?>


<!--==================== Intro Section ====================-->
<section class="intro-sec page-intro">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<!-- ==================  PAGE BANNER  ================== -->
				<?= Loader::partial('partials/page/banner', compact('mx_page'));?>
				
				<!-- ==================  PAGE TITLE  ================== --> 
				<?= Loader::partial('partials/page/page-title', compact('mx_page'));?>
			</div><!-- .col-sm-12 -->
		</div><!-- .row -->
	</div><!-- .container -->
</section><!-- .intro-sec sub-page -->

<!--==================== Content Section ====================-->
<section class="content-sec">
	<div class="container">
		<div class="row">

	<!-- ==================  CONTENT LOOP  ================== --> 
		<?php if( have_posts() ) { 
			while( have_posts() ) { the_post();
				get_template_part('articles/search/search-result', $post->post_type);
			};?>
			<div class="pagers">
				<?php echo paginate_links(	array(
					'prev_text' => __('Previous'),
					'next_text' => __('Next'),
				) ); ?>
			</div><!-- .pagers -->
		<?php }else{ ?>
			<h4 class = 'page-title'>No Posts Found</h4>
		<?php };?>
		</div><!-- .row -->
	</div><!-- .container -->
</section><!-- .content-sec -->	

<?php get_footer(); ?>

