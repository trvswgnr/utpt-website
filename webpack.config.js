// webpack v4
const path = require( 'path' );
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );
const BrowserSyncPlugin = require( 'browser-sync-webpack-plugin' );

module.exports = {
	entry: {
		main: './index.js'
	},
	output: {
		path: path.resolve( __dirname, '' ),
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
			filename: 'style.css'
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
