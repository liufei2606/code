const {
    resolve
} = require('path')
const HtmlWebpackPlugin = require('html-webpack-plugin')
const history = require('connect-history-api-fallback')
const convert = require('koa-connect')

const dev = Boolean(process.env.WEBAPCK_SERVE)

module.exports = {
    mode: dev ? 'development' : 'production',
    devtool: dev ? 'cheap-module-eval-source-map' : 'hidden-source-map',

    entry: './src/index.js',
    output: {
        publicPath: '/assets/',
        path: resolve(__dirname, 'dist'),
        filename: 'index.js'
    },

    module: {
        rules: [{
                test: /\.js$/,
                exclude: /node_modules/,
                use: ['babel-loader', 'eslint-loader']
            },
            {
                test: /\.html$/,
                use: 'html-loader'
            },
            {
                test: /\.css$/,
                use: ['style-loader', 'css-loader']
            },
            {
                test: /\.(png|jpg|jpeg|gif|eot|ttf|woff|woff2|svg|svgz)(\?.+)?$/,
                use: [{
                    loader: 'url-loader',
                    options: {
                        limit: 1000
                    }
                }]
            }
        ]
    },

    plugins: [
        new HtmlWebpackPlugin({
            template: './src/index.html',
            chunksSortMode: 'none'
        })
    ],
}

if (dev) {
    module.exports.serve = {
        port: 8090,
        host: '0.0.0.0',
        dev: {
            /*
            指定 webpack-dev-middleware 的 publicpath
            一般情况下与 output.publicPath 保持一致（除非 output.publicPath 使用的是相对路径）
            https://github.com/webpack/webpack-dev-middleware#publicpath
            */
            publicPath: '/assets/'
        },
        add: app => {
            app.use(convert(history({
                index: '/assets'
            })))
        }
    }
}