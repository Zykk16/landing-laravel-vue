const mix = require('laravel-mix')

mix.webpackConfig(webpack => {
    return {
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
    }
})

mix.js('resources/js/app.js', 'public/js').vue()
    .sass('resources/scss/app.scss', 'public/css')
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
