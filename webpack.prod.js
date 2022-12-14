const {merge} = require('webpack-merge');
const common = require('./webpack.common.js');
const path = require('path');
const TerserPlugin = require("terser-webpack-plugin");

module.exports = merge(common, {
    mode: 'production',
    optimization: {
        minimize: true,
        minimizer: [new TerserPlugin({
            terserOptions: {
                format: {
                    comments: false,
                },
            },
            extractComments: false,
        })],
    }
});
