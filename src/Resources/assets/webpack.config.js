let Encore = require('@symfony/webpack-encore');
// process.env.NODE_ENV = Encore.isProduction() ? 'production' : 'development';
const path = require('path');
// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'production');
}

Encore.setOutputPath(Encore.isProduction() ? './../public/build' : './../../../tests/app/public/bundles/choosy/build')

Encore
    .setPublicPath('/')
    .setManifestKeyPrefix('bundles/choosy')
    .addStyleEntry('bundle', './node_modules/@michael-brauner/choosy/dist/choosy.min.css')
    .disableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = 3;
    });

module.exports = Encore.getWebpackConfig();