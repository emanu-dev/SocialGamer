const path = require('path');

const config = {
	mode: process.env.NODE_ENV || 'development',
	entry: path.resolve(__dirname, 'php', 'style', 'indexStyle.scss'),
	output: {
		path: path.resolve(__dirname, 'php', 'style'),
		filename: 'bundle.js'
	},
	devtool: 'source-map',
	module: {
		rules: [
			{
				test: /.(sass|scss)$/,
				use: [
					'style-loader',
					'css-loader',
					'sass-loader',
				],
			},
			{
				test: /.(ttf|otf|woff|woff2)$/,
				use: 'file-loader',
			},
			{
				test: /.(jpg|jpeg|png|gif|svg)$/,
				use: 'file-loader'
			}
		],
	}
}; 

module.exports = config;