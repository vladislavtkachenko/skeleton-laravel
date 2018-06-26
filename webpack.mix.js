let mix = require('laravel-mix');
let autoprefixer = require('autoprefixer');
let ExtractTextPlugin = require('extract-text-webpack-plugin');
let path = require('path')

const extractSass = new ExtractTextPlugin({
  filename: 'css/app.css'
});

const sassExtractor = () => {
  return ['css-hot-loader'].concat(extractSass.extract({
    use: [{
      loader: "css-loader",
      options: {
        sourceMap: true
      }
    }, {
      loader: 'postcss-loader',
      options: {
        plugins: [
          autoprefixer({
            browsers: ['ie >= 9', 'iOS >= 8', 'Safari >= 8', 'last 3 version']
          })
        ],
        sourceMap: true
      }
    }, {
      loader: 'resolve-url-loader',
      options: {
        sourceMap: true,
        //root: Mix.paths.root('node_modules')
      }
    }, {
      loader: "sass-loader",
      options: {
        sourceMap: true
      }
    }],
    fallback: "style-loader"
  }));
};



// Костыль, так как внутри mix.webpackConfig работает merge-webpack и он не корректно мержит
Mix.listen('configReady', function(webpackConfig){

  if(Mix.isUsing('hmr')){
    webpackConfig.output.path = "/"
  }

  webpackConfig.module.rules.forEach((rule, index, list) => {
    if(String(rule.test) == String(/\.css$/)){
      list[index] = {
        test: /\.css$/,
        loaders: sassExtractor()
      }
    }
    if(String(rule.test) == String(/\.s[ac]ss$/)){
      list[index] = {
        test: /\.s[ac]ss$/,
        loaders: sassExtractor()
      }
    }
  })
})

mix.webpackConfig({
  output: {
    publicPath: Mix.isUsing('hmr') ? '//localhost:3030/' : '/',
    chunkFilename: 'js/chunks/[name].[hash].js',
  },
  module: {
    rules: [
      {
        // only include svg that doesn't have font in the path or file name by using negative lookahead
        test: /(\.(png|jpe?g|gif)$|^((?!font).)*\.svg$)/,
        loaders: [
          {
            loader: 'file-loader',
            options: {
              name: path => {
                if (!/node_modules|bower_components/.test(path)) {
                  return (
                    Config.fileLoaderDirs.images +
                    '/[name].[hash:8].[ext]'
                  )
                }

                return (
                  Config.fileLoaderDirs.images +
                  '/vendor/' +
                  path
                    .replace(/\\/g, '/')
                    .replace(
                      /((.*(node_modules|bower_components))|images|image|img|assets|webpack)\//g,
                      ''
                    )
                    .replace(
                      /(\.(png|jpe?g|gif|svg)$)/g,
                      '.[hash:8]$1'
                    )
                )
              },
              publicPath: Config.resourceRoot
            }
          },

          {
            loader: 'img-loader',
            options: Config.imgLoaderOptions
          },
        ]
      },

      {
        test: /\.pug/,
        use: [
          {
            loader: 'babel-loader'
          },
          {
            loader: 'pug-loader'
          }
        ]
      },

      {
        test: /\.(js|es6)$/,
        use: [
          {
            loader: 'babel-loader'
          }
        ],
        exclude: [path.resolve(__dirname, 'node_modules')]
      }
    ]
  },
  resolve: {
    modules: [
      path.resolve(__dirname, 'resources', 'webpack'),
      path.resolve(__dirname, 'node_modules')
    ],
    extensions: ['.js', '.es6', '.css', '.sass', '.scss']
  },
  plugins: [
    extractSass
  ]
})

mix.options({
  imgLoaderOptions: {
    enabled: false,
    gifsicle: {},
    mozjpeg: {},
    optipng: {},
    svgo: {},
  },
  hmrOptions: {
    host: 'localhost',
    port: '3030'
  }
})

mix
  .extract(['jquery', 'vue'])
  .autoload({
    jquery: ['$', 'jQuery', 'window.jQuery']
  })
  .js('resources/webpack/app.js', 'public/js')

if(Mix.isUsing('hmr')) {
  mix.setResourceRoot('//localhost:3030/')
} else {
  mix.version()
}

if (!Mix.inProduction()) {
  mix.sourceMaps(true, 'inline-source-map')
} else {
  mix.sourceMaps()
}
