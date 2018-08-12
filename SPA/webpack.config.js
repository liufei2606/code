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

    performance: {
        hints: dev ? false : 'warning'
    },

    entry: {
        main: ['./src/index.js']
    },
    output: {
        publicPath: '/assets/',
        path: resolve(__dirname, 'dist'),
        filename: dev ? '[name].js' : '[chunkhash].js',
        chunkFilename: '[chunkhash].js'
    },

    module: {
        rules: [{
                test: /\.js$/,
                exclude: /node_modules/,
                use: ['babel-loader', 'eslint-loader']
            },
            {
                test: /\.html$/,
                use: [{
                    loader: 'html-loader',
                    options: {
                        attr: ['img:src', 'link:herf']
                    }
                }]
            },
            {
                /*
                匹配 favicon.png
                上面的 html-loader 会把入口 index.html 引用的 favicon.png 图标文件解析出来进行打包
                打包规则就按照这里指定的 loader 执行
                */
                test: /favicon\.png$/,

                use: [{
                    // 使用 file-loader
                    loader: 'file-loader',
                    options: {
                        /*
                        name：指定文件输出名
                        [hash] 为源文件的hash值，[ext] 为后缀。
                        */
                        name: '[hash].[ext]'
                    }
                }]
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
                        limit: 10000
                    }
                }]
            }
        ]
    },

    plugins: [
        new HtmlWebpackPlugin({
            template: './src/index.html',
            chunksSortMode: 'none'
        }),
        new wepack.HashModuleIdsPlugin()
    ],

    optimization: {
        runtimeChunk: true,
        spiltChunks: {
            chunks: 'all'
        }
    }
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