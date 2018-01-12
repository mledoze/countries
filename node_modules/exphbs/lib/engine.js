function attach(Exphbs) {
  Exphbs.prototype.engine = engine;
};

function engine(filePath, options, callback) {
  var self = this;

  options = this.prepareOptions(options);

  var partialsPath = options.settings['view partials'];
  var helpersPath = options.settings['view helpers'];
  var env = options.settings['env'];

  self.registerPartials(partialsPath, env, function(err) {
    if (err) return callback(err);

    self.registerHelpers(helpersPath, function(err) {
      if (err) return callback(err);

      self.render(filePath, options, callback);
    });
  });
}

exports.attach = attach;
