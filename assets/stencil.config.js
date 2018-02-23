const sass = require('@stencil/sass');

exports.config = {
  namespace: 'techomaha',
  generateDistribution: true,
  globalStyle: 'src/global/variables.scss',
  plugins: [
    sass()
  ]
};

exports.devServer = {
  root: 'www',
  watchGlob: '**/**'
}
