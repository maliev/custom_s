const path = require('path');
const WebpackNotifierPlugin = require('webpack-notifier')

module.exports = {
    entry: [
        __dirname + '/src/js/main.js',
        __dirname + '/src/scss/main.scss'
    ],
    output: {
        path: path.resolve(__dirname, 'assets'),
        filename: 'js/main.min.js',
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
