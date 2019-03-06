// webpack v4
const path = require( 'path' );
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );
const BrowserSyncPlugin = require( 'browser-sync-webpack-plugin' );
const OptimizeCssAssetsPlugin = require( 'optimize-css-assets-webpack-plugin' );


module.exports = function( env ) {
	console.log( env );

	return {
		entry: {
			main: './index.js'
		},
		output: {
			path: path.resolve( __dirname, 'assets/js' ),
			filename: '[name].js'
		},
		module: {
			rules: [
				{
					test: /\.js$/,
					exclude: /node_modules/,
					use: {
						loader: 'babel-loader'
					}
				},
				{
					test: /\.s[c|a]ss$/,
					use: [ 'style-loader', MiniCssExtractPlugin.loader, 'css-loader', 'postcss-loader', 'sass-loader' ]
				}
			]
		},
		plugins: [
			new MiniCssExtractPlugin({
				filename: '../../style.css' // up two directories from /assets/js/ to base folder
			}),
			new OptimizeCssAssetsPlugin({
				assetNameRegExp: env.production ? /style\.css$/g : '',
				cssProcessor: require( 'cssnano' ),
				cssProcessorPluginOptions: {
					preset: [ 'default', { discardComments: { removeAll: false } } ]
				},
				canPrint: true
			}),
			new BrowserSyncPlugin({
					host: 'localhost',
					port: 3000,
					proxy: 'http://localhost/unicorns-take-photos-too/',
					files: [ '**/*.php' ],
					ghostMode: {
						clicks: false,
						forms: false
					},
					snippetOptions: {
						ignorePaths: 'wp-admin/**'
					}
				})
		]
	};
};
