const sass = require('@stencil/sass');

exports.config = {
  namespace: 'techomaha',
  generateDistribution: true,
  bundles: [
    { components: ['techomaha-theme'] }
  ],
  globalStyle: 'src/global/variables.scss',
  plugins: [
    sass()
  ]
};

exports.devServer = {
  root: 'www',
  watchGlob: '**/**'
}
