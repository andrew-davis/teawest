// v 2
const gulp = require('gulp');
const browserSync = require( 'browser-sync');
const settings = require( './atw_app/config/settings.json');

const mx_log = require( './atw/build-scripts/mx_log');
const get_default_style = require( './atw/build-scripts/get_default_style');
const { clean_scripts , scripts } = require( './atw/build-scripts/theme-scripts');
const { styles_less , styles_scss , styles , glob_scss } = require('./atw/build-scripts/theme-styles');
const shopify_styles  =  require( './atw/build-scripts/shopify-styles' ) ;
const { styles_changed , styles_changed_dir }  = require( './atw/build-scripts/styles_changed');
const plugins = require( './atw/build-scripts/plugins');
const plugins_webpack = require( './atw/build-scripts/plugins-webpack');
const extensions = require( './atw/build-scripts/extensions');
const lintCss = require( './atw/build-scripts/lint');
const update_version = require( './atw/build-scripts/update-version');

let 	syncing = false;


//############################//
// Theme Scripts 
//############################//
gulp.task( 'clean_scripts' , clean_scripts)

gulp.task ( 'scripts', gulp.series( clean_scripts , scripts , update_version) );

gulp.task( 'watch_scripts', function(){
	gulp.watch( ['assets/**/*.js' , '!assets/**/*-compiled.js'] , gulp.series( scripts  )  )
	.on('change', function( $file ){
	  if( syncing ) browserSync.reload();
	});
})


//############################//
// Theme Styles
//############################//
gulp.task( 'watch_styles', () => {
	var type = get_default_style(  );
	gulp.watch( [
		'./assets/'+ type+'/*.' + type , 
		'./assets/'+ type+'/**/*.' + type , 
		'./mx-sections/**/*.' + type,
		'!./assets/'+ type+'/**/*_auto-imports.' + type,
		'./partials/page/sections/**/*.' + type
	] ,  gulp.series( 'styles_' + type ) );
})

// check with method to use and compile with  that.
gulp.task( 'styles', gulp.series( styles , update_version ) );

gulp.task ( 'styles_less', () => { return styles_less(); });

gulp.task( 'sccs_import', () => glob_scss( 'sections' ) )

gulp.task ( 'styles_scss', () => { return styles_scss(); });

gulp.task ( 'shopify_styles', gulp.series( shopify_styles ) );

gulp.task( 'watch_shopify_styles', () => {
	gulp.watch( ['./assets/scss/**/*.scss' , '!./assets/scss/**/*_auto-imports.scss'] ,  gulp.series( shopify_styles ) );
})
	


//############################//
// Atw App Styles
//############################//
gulp.task ( 'atw_app_styles', gulp.series( () => { 
	return styles_changed_dir( './atw_app/assets/less/', './atw_app/assets/css' ) } )  );

gulp.task( 'watch_atw_app_styles', function(){
	gulp.watch( ['./atw_app/assets/less/*.less'])
	.on('change', function( $file ){ styles_changed( $file  , './atw_app/assets/css/'); });
})

//############################//
// Atw Styles
//############################//
gulp.task ( 'atw_styles', gulp.series( () => { 
	return styles_changed_dir( './atw/assets/less/', './atw/assets/css' ) } )  );

gulp.task( 'watch_atw_styles', function(){
	gulp.watch( ['./atw/assets/less/*.less'])
	.on('change', function( $file ){ styles_changed( $file  , './atw/assets/css/'); });
})


//############################//
// StyleLint
//############################//

gulp.task('lint_css', gulp.series ( lintCss ));

//############################//
// MX
//############################//
gulp.task( 'mx', gulp.series( gulp.parallel( 'watch_styles', 'watch_scripts' )  , function(){
	mx_log( ['Running MX Site']);
} ) );

gulp.task( 'default', gulp.series( 'mx', function(){
	mx_log( ['Running MX Site', settings.compiler, settings.site]);
} ) );

gulp.task ( 'package', gulp.series( 'clean_scripts', gulp.parallel( 'scripts', 'styles' )  ) );

//############################//
// serve
//############################//
gulp.task( 'serve', gulp.series( 'mx' , function(){
	browserSync.init({ proxy: settings.site.proxy });
	syncing = true;
	mx_log( ['Running MX Site with Live Reload Server']);
} ) );




//############################//
// Atw Plugins
//############################//
gulp.task( 'plugins', gulp.series( plugins )  )


//############################//
// Atw Plugins
//############################//
gulp.task( 'plugins_webpack', gulp.series( plugins_webpack )  )


//############################//
// Atw Plugin / Extensions
//############################//
gulp.task( 'extensions',  extensions)
