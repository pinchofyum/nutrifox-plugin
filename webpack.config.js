module.exports = {
	entry: './assets/block-editor/index.js',
	output: {
		path: __dirname,
		filename: './assets/dist/block-editor.build.js',
	},
	module: {
		rules: [
			{
				test: /.js$/,
				use: 'babel-loader',
				exclude: /node_modules/,
			},
			{
				test: /\.css$/,
				use: [
					'style-loader',
					'css-loader'
				]
			},
		],
	},
	resolve: {
		extensions: ['.js', '.jsx', '.css']
	}
};
