<?php  
	get_header();  

	wp_enqueue_script( 'search', get_template_directory_uri() . '/assets/js/pages/search.js', array(), '1.0.0', true );
	$search = mx_parse_search_results();
	if( return_if( $search , 'post_types'  )){
		usort( $search->post_types , function( $a , $b ){
			return  in_array( $a->name , ['center', 'program' ] ) ? 0 : 1 ;
		} );
	}
 ?>
 
<!--====================  intro-sec Section ====================-->
<section class=" intro-sec ">
	<div class="container">
		<div class="row mtop-20 mbottom-20">
			<div class="col">
				<h1 class="display-2">Search</h1>
			</div><!--.col-->	
		</div><!--.row-->	
		<div class="row">
			<div class="col search-box bg-blue textured-bg">
				<form role="search" action="/" method="get" class="sub-nav-search">
					<div class="form-group form-group--light row">
						<div class="col-xs-12 col-md-9 col-lg-10 mb-2">
							<input type="text" class="form-control" name="s" value="<?= esc_html( esc_attr($search->search_term) ); ?>"/>
						</div><!-- .col-xs-12 -->
						<div class="col-xs-12 col-md-3 col-lg-2">
							<?php if($search->searched_post_type && $search->searched_post_type != 'any' ){?>
								<input name="post_type" type="hidden" value="<?= esc_attr($search->searched_post_type);?>"/>
							<?php } ?>
							<button type="submit" class="btn  btn-outline-white form-control">Search</button>
						</div><!-- .col-xs-12 -->
					</div><!-- .form-group -->
		    	</form><!-- .subnav-search -->
			</div><!-- .col-sm-12 -->
		</div><!-- .row -->
	</div><!-- .container -->
</section><!-- .intro-sec -->


<!--=====================  BEGIN PAGE CONTENT  =====================-->	
<section id="section-search" class="archive ptop-40 pbottom-140">
	<div class="container">
		<?php if( $search->search_term  && $search->search_term != ''){?>
			<div class="row">
				<div class="col">
					<h1 class="results"><span><?= $search->total_results ?></span> Results For "<?= esc_html( esc_attr( $search->search_term ) ) ;?>"</h1>
				</div><!-- .col-sm-12 -->
			</div>	
			<div class="row">
				<div class="col pbottom-10">
					<ul class="nav nav-pills search-filters">
						<li class="<?= $post_type == 'any' ? ' results active ' : '';?>">
							<a href="<?= esc_html( esc_attr( $search->site_search_string ) ) ;?>">
							<!-- <?php if($post_type == 'any' ) { ?><span><?= $total_results;?></span> <?php } ?> -->
								All Content</a>
						</li>
						<?php foreach($search->post_types as $post_type){ ?>
							<?php if( $post_type->count != '' ){?>
								<li class = " <?= $post_type->selected ? ' results active ' : '';?>">
									<a href="<?= esc_html( esc_attr( $search->site_search_string ) ) ;?>&post_type=<?= $post_type->name;?>">
									<span><?= $post_type->count;?></span>  
									<?= $post_type->count != '1' ? $post_type->plural : $post_type->title;?></a>
								</li>
							<?php } ?>
						<?php } ?>
					</ul><!-- .nav-pills -->
				</div><!-- .col-sm-12 -->
			</div><!-- .row -->
			<div class="row">
					<?php if( have_posts() ) : 
						while( have_posts() ) : the_post();
							get_template_part('articles/search/search-result', $post->post_type);
						endwhile; ?>
						<div class="pagers">
							<?= paginate_links(	array(
								'prev_text' => __('Previous'),
								'next_text' => __('Next'),
							) ); ?>
						</div><!-- .pagers -->
					<?php else:?>
					<div class="col">
						<h1 class="page-title">No Posts Found</h1>
					</div><!-- .col-sm-12 -->	
					<?php endif;?>
				
			</div><!-- .row -->
		<?php }else{?>
			<div class="row">
				<div class="col">
					<h1>No Search Results</h1>
					<div class="alert alert-primary">Please Enter A Search Term</div>
				</div><!-- .col -->
			</div><!-- .row -->
		<?php } ?>			
	</div><!-- .container -->
</section><!-- section-search -->

<?php get_footer(); ?>