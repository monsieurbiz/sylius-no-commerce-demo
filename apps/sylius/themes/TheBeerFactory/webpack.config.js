const Encore = require('@symfony/webpack-encore');

Encore
  // Directory where compiled assets will be stored
  .setOutputPath('public/build/themes/thebeerfactory')
  // Public path used by the web server to access the output path
  .setPublicPath('/build/themes/thebeerfactory')

  // Entry
  .addEntry('thebeerfactory-theme-entry', './themes/TheBeerFactory/assets/entry.js')

  // Configuration
  .disableSingleRuntimeChunk()
  .cleanupOutputBeforeBuild()
  .enableSassLoader()
  .enableSourceMaps(!Encore.isProduction())
  .enableVersioning(Encore.isProduction());

const config = Encore.getWebpackConfig();
config.name = 'TheBeerFactory';

Encore.reset();

module.exports = config;
