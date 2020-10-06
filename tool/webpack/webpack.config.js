module.exports = {
	mode: 'development',
	entry: {
		bundle1: './src/main1.js',
		bundle2: './src/main2.js',
		// main: './src/main.jsx'
	},
	output: {
		filename: './js/[name].js'
	},
	// module: {
	// 	rules: [{
	// 		test: /\.jsx?$/,
	// 		exclude: /node_modules/,
	// 		use: {
	// 			loader: 'babel-loader',
	// 			options: {
	// 				presets: ['es2015', 'react']
	// 			}
	// 		}
	// 	}]
	// }
};
