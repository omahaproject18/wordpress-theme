exports.config = {
  namespace: 'techomaha',
  generateDistribution: true,
  bundles: [
    { components: ['techomaha-theme'] }
  ],
  globalStyle: 'src/index.scss'
};

exports.devServer = {
  root: 'www',
  watchGlob: '**/**'
}
