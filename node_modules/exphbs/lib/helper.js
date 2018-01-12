var path = require('path');
var glob = require('glob');

function attach(Exphbs) {
  Exphbs.prototype.registerHelpers = registerHelpers;
}

function registerHelpers(helpersPath, callback) {
  var self = this;

  if (self.cache.helpersRegistered) {
    return callback();
  }

  glob(helpersPath + '/*.js', function(err, matches) {
    if (err) return callback(err);

    matches.forEach(function(match) {
      var relative = path.relative(__dirname, match);
      var modulePath = relative.slice(0, -path.extname(match).length);
      var helperName = path.basename(relative, path.extname(relative));

      try {
        var helper = require(modulePath);

        self.handlebars.registerHelper(helperName, helper(self.handlebars));
      } catch(err) {
        return callback(err);
      }
    });

    self.cache.helpersRegistered = true;

    callback();
  });
}

exports.attach = attach;
