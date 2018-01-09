var fs = require('fs');
var extname = require('path').extname;
var sep = require('path').sep;
var glob = require('glob');

function attach(Exphbs) {
  Exphbs.prototype.registerPartials = registerPartials;
  Exphbs.prototype.registerPartial = registerPartial;
}

function registerPartials(partialsPath, env, callback) {
  var self = this;

  if (env === 'production') {
    if (self.cache.partialsRegistered) {
      return callback();
    }
  }

  glob(partialsPath + '/**/*.{hbs,html}', function(err, matches) {
    if (err) return callback(err);

    var wait = matches.length;

    Object.keys(self.handlebars.partials).forEach(function(name) {
      var path = self.handlebars.partials[name]['__path'];

      if (matches.indexOf(path) < 0) {
        self.handlebars.unregisterPartial(name);
      }
    });

    if (!wait) return done();

    matches.forEach(function(match) {
      var name, offset;

      offset = partialsPath.slice(-1) === sep ? 0 : 1;
      name = match .slice(partialsPath.length + offset, -extname(match).length);

      self.registerPartial(name, match, env, function(err) {
        if (err) return callback(err);

        wait--;
        done();
      });
    });

    function done() {
      if (!wait) {
        if (env === 'production') {
          self.cache.partialsRegistered = true;
        }

        return callback();
      }
    }
  });
}

function registerPartial(name, path, env, callback) {
  var self = this;

  fs.readFile(path, 'utf8', function(err, content) {
    if (err) return callback(err);

    try {
      var compiled = self.handlebars.compile(content);

      self.handlebars.registerPartial(name, compiled);
    } catch(err) {
      return callback(err);
    }

    if (env === 'production') {
      self.handlebars.partials[name]['__path'] = path;
    }

    callback();
  });
}

exports.attach = attach;
