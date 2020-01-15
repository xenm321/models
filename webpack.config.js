const Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .addEntry('js/app', './assets/js/app.js')
    .addStyleEntry('css/app', ['./assets/css/app.scss'])
    .enableSourceMaps(!Encore.isProduction())
    .cleanupOutputBeforeBuild()
    .enableSassLoader()
    .enableVueLoader()
    .configureBabel((config) => {
        config.presets.push('stage-2');
    })
;

module.exports = Encore.getWebpackConfig();