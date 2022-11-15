const path = require('path');
const webpack = require('webpack');

module.exports = {
	mode: 'production',
	watch : true,
	watchOptions: {
		ignored: /node_modules/
	},
	entry: {
		index: './assets/index.js'
	},
	output: {
		path: path.resolve(__dirname, 'assets/build'),
		filename: '[name].bundle.js'
	},
  	module: {
		rules: [
			{
				test: /\.js$/,
				exclude: /(node_modules)/,
				use: {
					loader: 'babel-loader',
					options: {
						presets: ['env']
					}
				}
			},

			{
				test: /\.(png|svg|jpg|gif)$/,
				use: [
					'file-loader'
				]
			}
		],
	},
	resolve: {
		modules: ['node_modules'],
		alias: {
			'TweenLite': 'gsap/src/minified/TweenLite.min.js',
			'TweenMax': 'gsap/src/minified/TweenMax.min.js',
			'TimelineLite': 'gsap/src/minified/TimelineLite.min.js',
			'TimelineMax': 'gsap/src/minified/TimelineMax.min.js',
			'ScrollMagic': 'scrollmagic/scrollmagic/minified/ScrollMagic.min.js',
			'animation.gsap': 'scrollmagic/scrollmagic/minified/plugins/animation.gsap.min.js',
			'debug.addIndicators': 'scrollmagic/scrollmagic/minified/plugins/debug.addIndicators.min.js',
			'Swiper': 'swiper/dist/js/swiper.min.js'
		}
	},
	optimization: {
		splitChunks : {
			chunks : 'all'
		}
	},
	plugins: [
		// new ExtractTextPlugin("style.css")
		new webpack.ProvidePlugin({
			$: 'jquery',
			jQuery: 'jquery',
			'window.jQuery': 'jquery',
			Popper: ['popper.js', 'default']
		})

	]

};


// module.exports = {
	
// 	entry:"./assets/main.js",
// 	output : {
// 		path: path.resolve( __dirname, 'dist' ),
// 		filename: "assets/bundle.js"
// 	},
// 	rules: [
// 	  {
// 		test: /\.js$/,
// 		exclude: /(node_modules)/,
// 		use: {
// 		  loader: 'babel-loader',
// 		  options: {
// 		   presets: ['env']
// 		  }
// 		}
// 	  }
// 	]
//   }


// module.exports = {
// 	entry:"./assets/main.js",
// 	output : {
// 		path: path.resolve( __dirname, 'dist' ),
// 		filename: "assets/bundle.js"

// 	},
// 	rules: [
// 		{
// 			test: /\.js$/,
// 			exclude: /(node_modules)/,
// 			use: {
// 			  loader: 'babel-loader',
// 			  options: {
// 			   presets: ['env']
// 			  }
// 			}
// 		},
// 		{
// 			test: /\.css$/,
// 			use: ExtractTextPlugin.extract({
// 				fallback : 'style-loader',
// 				use : {
// 					loader: "css-loader",
// 					importLoaders : 1,
// 					sourceMap : true
// 				}
// 			})
// 		},
// 		{
// 			test: "/\.(png|svg|jpg|gif)$/",
// 			use : ['file-loader']
// 		},
// 		{
// 			test: /\.(png|svg|jpg|gif)$/,
// 			use: [
// 			  'file-loader'
// 			]
// 		}
// 	],
// 	plugins : [
// 		new ExtractTextPlugin("style.css")
// 	]
// }
