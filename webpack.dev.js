const path = require('path');
const dev = process.env.NODE_ENV !== 'production'
const {merge} = require('webpack-merge');
const common = require('./webpack.common.js');

module.exports = merge(common, {
    mode: 'development',
});
