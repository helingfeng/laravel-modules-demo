const path = require('path');

// const HtmlWebpackPlugin = require('html-webpack-plugin');
const CleanWebpackPlugin = require('clean-webpack-plugin');

const config = {
    mode: 'development',
    entry: './src/main.js',
    output: {
        path: path.resolve(__dirname, 'assets'),
        filename: 'main.js'
    },
    resolve: {
        alias: {
            'vue$': 'vue/dist/vue.esm.js'
        }
    },
    devServer: {
        contentBase: './assets'
    },
    plugins: [
        new CleanWebpackPlugin(['assets']),
        // new HtmlWebpackPlugin({
        //     template: './welcome.blade.php',
        //     filename: 'welcome.blade.php'
        // }),
    ]
};

module.exports = config;