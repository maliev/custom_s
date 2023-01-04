const path = require('path');
const WebpackNotifierPlugin = require('webpack-notifier')

module.exports = {
    entry: {
        main: ['./src/js/main.js', './src/scss/main.scss'],
        'hero-video': ['./src/js/hero-video.js'],
        gallery: './src/js/gallery.js',
        accordion: './src/js/accordion.js',
        posts: './src/js/posts.js'
    },
    output: {
        path: path.resolve(__dirname, 'assets'),
        filename: 'js/[name].min.js',
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: ['babel-loader']
            }, {
                test: /\.scss$/,
                exclude: /node_modules/,
                use: [
                    {
                        loader: 'file-loader',
                        options: {outputPath: 'css/', name: '[name].min.css'}
                    },
                    'sass-loader'
                ]
            }
        ]
    },
    plugins: [
        new WebpackNotifierPlugin({
            contentImage: path.join(__dirname, '/assets/icons/logo.svg'),
            emoji: true,
        }),
    ]
};
