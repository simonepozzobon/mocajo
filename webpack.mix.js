const mix = require('laravel-mix')
mix
    .js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .webpackConfig(webpack => {
        return {
            resolve: {
                alias: {
                    'styles': path.resolve(__dirname, 'resources/sass'),
                }
            }
        }
    })
    .browserSync({
        proxy: 'http://mocajo.test:89',
        browser: 'google chrome',
        port: 3011,
        files: [
            'public/**/*',
            'resources/**/*',
            'app/**/*',
            'config/**/*'
        ]
    })
