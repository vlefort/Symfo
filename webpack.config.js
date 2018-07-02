var Encore = require('@symfony/webpack-encore');

Encore
// the project directory where compiled assets will be stored
    .setOutputPath('public/build/')
    .setPublicPath('/build')

    // read main.js     -> output as web/build/app.js
    .addEntry('app', './assets/app.js')
    // read global.scss -> output as web/build/global.css
    .addStyleEntry('global', './assets/global.scss')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .enableSassLoader()
    // uncomment to create hashed filenames (e.g. app.abc123.css)
    // .enableVersioning(Encore.isProduction())

    // uncomment to define the assets of the project
    // .addEntry('js/app', './assets/js/app.js')
    // .addStyleEntry('css/app', './assets/css/app.scss')

    .autoProvidejQuery()

module.exports = Encore.getWebpackConfig();