var path = require('path');

var distPath = path.join(__dirname, 'public/admin');
var srcPath = path.join(__dirname, 'resources/admin');

var webpack = require('webpack');
var ExtractTextPlugin = require("extract-text-webpack-plugin");

module.exports = {
    entry: {
        app: path.join(srcPath, 'app.js'),
        all: [path.join(srcPath, 'assets/js/adminLTE.min.js')]
    },
    output: {
        path: distPath,
        publicPath: '/admin/',
        filename: "js/[name].js"
    },
    module: {
        loaders: [
            {
                test: /\.js$/,
                loader: 'babel',
                include: srcPath,
                exclude: /node_modules/,
                query: {
                    presets: ['es2015']
                }
            },
            {
                test: /\.vue$/,
                loader: 'vue'
            },
            {
                test: /\.css$/,
                loader: ExtractTextPlugin.extract("style-loader", "css-loader")
            },
            {
                test: /\.(woff2?|eot|ttf)(\?.*)?$/,
                loader: 'url',
                query: {
                    limit: 10000,
                    name: 'fonts/[name].[ext]'
                }
            },
            {
                test: /\.(png|jpg|gif|svg)(\?.*)?$/,
                loader: 'url',
                query: {
                    limit: 10000,
                    name: 'images/[name].[ext]'
                }
            }
        ]
    },
    plugins: [
        new ExtractTextPlugin("css/style.css"),
        new webpack.optimize.UglifyJsPlugin({
            output: {
                comments: false,
            },
            compress: {
                warnings: false
            }
        }),
        new webpack.DefinePlugin({
            "require.specified": "require.resolve"
        })
    ]
};