		<?php wp_footer(); // js scripts are inserted using this function ?>

		<!-- // laod up our global and page level scripts --> 
		<script>
			$(document).ready(function(){
				// accept options from other parts of the app
				var global_options = (typeof(global_init) != 'undefined') ? global_init : {}; 
		
				// set default options that are global accross the application
				var default_global_options =  {} 
				<?php if( $globals_js = aw_config('global_js_options') ){?>
					default_global_options  = <?= json_encode($globals_js);?>;
				<?php } ?>
				// iniitialize the application javascript
				if(typeof(mx_global) == 'function'){	
					
					var app = global( global_options, default_global_options );
					if(typeof(page) == 'function'){
						var options = (typeof(page_init) != 'undefined') ? page_init : undefined; 
						var activePage = page(app, options)
					}	
				}
			});//-docuemnt ready 
		</script>
		
		<?= WildTheme::do_footer_scripts(); ?>
		
		<script>
			jQuery( document ).on('ready', function() {
				console.log( "ready!" );
			});
		</script>

	</body>

</html>