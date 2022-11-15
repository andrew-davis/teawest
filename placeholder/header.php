<!DOCTYPE html >
<?php if( return_if( aw_config( 'theme_options' ), 'as_angular_app' ) == 1){?>
	<html <?php language_attributes(); ?> data-ng-app = 'WebsiteApp'>
<?php }else{?>
	<html <?php language_attributes(); ?> >
<?php } ?>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?= Loader::partial('partials/page/favicon');?>
	<?php wp_head(); ?>
	<title><?php wp_title(); ?></title>
</head>
<body >
<?php 
	/** Allow our theme to add something right here ... like alerts **/
	do_action('mx_after_body');?>
