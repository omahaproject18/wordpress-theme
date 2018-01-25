exports.config = {
  namespace: 'techomaha',
  generateDistribution: true,
  bundles: [
    { components: ['techomaha-theme'] }
  ]
};

exports.devServer = {
  root: 'www',
  watchGlob: '**/**'
}
