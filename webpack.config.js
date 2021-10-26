const path = require('path');

module.exports = {
	mode: 'development',
	entry: './resources/js/app.js',
	devtool: 'inline-source-map',
	resolve: {
		extensions: ['.ts', '.js'],
	},
	output: {
		filename: 'main.js',
		path: path.resolve(__dirname, 'public/js'),
		clean: true,
	},
	watch: true,
};
