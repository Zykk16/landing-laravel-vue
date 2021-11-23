const mix = require('laravel-mix');

require('laravel-mix-polyfill');

const TargetsPlugin = require('targets-webpack-plugin')

mix.js('resources/js/app.js', 'public/js').vue()
    .sass('resources/scss/app.scss', 'public/css')
    .polyfill({
        enabled: true,
        useBuiltIns: "usage",
        targets: {"ie": 11},
        debug: true,
        corejs: 3,
    })
    .options({
        postCss: [
            require('autoprefixer')({
                overrideBrowserslist: ['last 5 versions'],
                grid: true
            })
        ]
    })
    .browserSync({
        open: 'external',
        host: process.env.HOSTNAME,
        proxy: process.env.HOSTNAME
    });

mix.webpackConfig(webpack => {
    return {
        plugins: [
            new TargetsPlugin({
                browsers: ['last 2 versions', 'chrome >= 41', 'IE 11'],
            }),
        ],
        module: {
            rules: [{
                test: /(\.(png|jpe?g|gif|webp)$|^((?!font).)*\.svg$)/,
                use: [{
                    loader: require.resolve('file-loader'),
                    options: {
                        esModule: false
                    }
                }]
            }]
        }
    };
});
