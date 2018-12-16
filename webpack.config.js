const path = require('path');
const webpack = require('webpack');

/**
 * PostCSS plugins
 */
const postCssCssNano = require('cssnano');
const postCssAutoprefixer = require('autoprefixer');
const postCssUrl = require('postcss-url');
const postCssPresetEnv = require('postcss-preset-env');
const postCssFlexBugsFixes = require('postcss-flexbugs-fixes');

/**
 * Webpack plugins
 */
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');
const ExtractCssChunks = require('extract-css-chunks-webpack-plugin');
const ManifestPlugin = require('webpack-manifest-plugin');
const VueLoaderPlugin = require('vue-loader/lib/plugin');

/**
 * Webpack server config
 */
const IS_PRODUCTION = process.env.NODE_ENV === 'production';
const SERVER_HOST = 'localhost';
const SERVER_PORT = 3000;

/**
 * Webpack config variables
 */
const PATH_ASSET = IS_PRODUCTION ? '/webpack/' : `http://${SERVER_HOST}:${SERVER_PORT}/webpack/`;
const PATH_SRC = path.resolve(__dirname, 'resources', 'webpack');
const PATH_BUILD = path.resolve(__dirname, 'public','webpack');
const PATH_PUBLIC = path.resolve(__dirname, 'public');

/**
 * Функция обработки файлов стилей
 *
 * @param {boolean} isLoadResources - флаг использования sass-resources-loader
 * @param {boolean} isSassSyntax - флаг использования синтаксиса sass
 * @returns {any[]}
 */
const styleLoader = (isLoadResources = true, isSassSyntax = true) => {
  const loaders = [
    ExtractCssChunks.loader,
    {
      loader: 'css-loader',
      options: {
        sourceMap: true,
      },
    }, {
      loader: 'postcss-loader',
      options: {
        sourceMap: true,
        plugins: ((() => {
          const plugins = [];
          plugins.push(
            postCssFlexBugsFixes(),
            postCssPresetEnv(),
            postCssUrl(),
            postCssAutoprefixer({
              browsers: ['ie >= 9', 'last 4 version', '> 1%', 'safari >= 9', 'ios >= 9'],
            }),
          );
          if (IS_PRODUCTION) {
            plugins.push(
              postCssCssNano(),
            );
          }
          return plugins;
        })()),
      },
    },
    {
      loader: 'sass-loader',
      options: {
        sourceMap: true,
        indentedSyntax: isSassSyntax,
        includePaths: [
          path.resolve(__dirname, 'node_modules'),
          path.resolve(PATH_SRC),
        ],
      },
    },
  ];

  if (isLoadResources) {
    loaders.push({
      loader: 'sass-resources-loader',
      options: {
        sourceMap: true,
        resources: path.resolve(PATH_SRC, 'common', 'index.scss'),
      },
    });
  }

  return loaders;
};

/**
 * Config of Webpack
 */
const config = {
  mode: process.env.NODE_ENV,
  context: PATH_SRC,
  entry: {
    app: [path.resolve(PATH_SRC, 'index.js')],
  },
  output: {
    filename: 'js/[name].js?[hash]',
    path: PATH_BUILD,
    publicPath: PATH_ASSET,
    chunkFilename: 'js/[name].js?[hash]',
  },
  optimization: {
    minimizer: [
      new UglifyJsPlugin({
        sourceMap: true,
        uglifyOptions: {
          sourceMap: true,
          output: {
            comments: false,
          },
        },
      }),
    ],
    splitChunks: {
      cacheGroups: {
        default: false,
        vendors: {
          test: /[\\/]node_modules[\\/]/,
          priority: 1,
          name: 'vendors',
          chunks: 'initial',
          enforce: true,
        },
      },
    },
    runtimeChunk: {
      name: "manifest",
    },
  },
  stats: {
    assets: true,
    colors: true,
    errors: true,
    errorDetails: true,
    hash: true,
  },
  module: {
    rules: [
      {
        test: /\.(js|jsx|es6)$/,
        loader: 'babel-loader',
        options: {
          cacheDirectory: true,
        },
        exclude: [
          path.resolve(__dirname, 'node_modules'),
        ],
      },
      {
        test: /\.vue$/,
        use: 'vue-loader',
      },
      {
        test: /\.(jpe?g|png|gif|svg|ico)$/i,
        use: [
          {
            loader: 'file-loader',
            options: {
              name: 'images/[name]-[hash:8].[ext]',
            },
          },
        ],
        exclude: [
          path.resolve(PATH_SRC, 'fonts'),
          path.resolve(PATH_SRC, 'images'),
          /inline/i,
        ],
      },
      {
        test: /\.svg$/,
        use: [
          {
            loader: 'svg-inline-loader?classPrefix',
          },
          {
            loader: 'svgo-loader',
            options: {
              plugins: [
                { removeViewBox: false },
              ],
            },
          },
        ],
        include: [
          /inline/i,
        ],
      },
      {
        test: /\.(woff|woff2|eot|otf|ttf|svg)(\?.*$|$)/,
        use: [
          {
            loader: 'file-loader',
            options: {
              name: 'fonts/[name]-[hash:8].[ext]',
            },
          },
        ],
        include: [
          path.resolve(__dirname, 'node_modules'),
          path.resolve(PATH_SRC, 'fonts'),
        ],
        exclude: [
          /inline/i,
        ],
      },
      {
        test: /\.sass$/,
        use: styleLoader(),
      },
      {
        test: /\.scss$/,
        use: styleLoader(true, false),
      },
      {
        test: /\.css$/,
        use: styleLoader(false, false),
      },
      {
        test: /\.pug$/,
        oneOf: [
          {
            resourceQuery: /^\?vue/,
            use: ['pug-plain-loader'],
          },
          {
            use: ['pug-loader']
          }
        ]
      },
    ],
  },

  resolve: {
    modules: [
      path.resolve(__dirname, 'node_modules'),
      path.resolve(PATH_SRC),
    ],
    extensions: ['*', '.js', '.es6', '.jsx', '*.vue', '.css', '.scss', '.sass'],
  },

  devtool: IS_PRODUCTION ? 'hidden-source-map' : 'source-map',

  devServer: {
    host: SERVER_HOST,
    port: SERVER_PORT,
    headers: { 'Access-Control-Allow-Origin': '*' },
    contentBase: path.resolve(PATH_SRC),
  },

  plugins: [
    new ExtractCssChunks({
      filename: 'css/[name].css?[hash]',
      chunkFilename: 'css/[name].css?[hash]',
      hot: IS_PRODUCTION,
    }),
    new webpack.DefinePlugin({
      'process.env': { NODE_ENV: JSON.stringify(process.env.NODE_ENV) },
    }),
    new webpack.ProvidePlugin({
      $: 'jquery',
      jQuery: 'jquery',
      'window.jQuery': 'jquery',
    }),
    new VueLoaderPlugin(),
  ],
};

config.plugins.push(
  new ManifestPlugin({
    fileName: path.resolve(PATH_PUBLIC, 'mix-manifest.json'),
    publicPath: PATH_ASSET,
    basePath: '/webpack/',
    writeToFileEmit: true,
  }),
);


module.exports = config;
