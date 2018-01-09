var path = require('path');

function attach(Exphbs) {
  Exphbs.prototype.prepareOptions = prepareOptions;
}

function prepareOptions(options) {
  var opts = {};

  // cloning view options
  var settings = {};

  for (var key in options.settings) {
    settings[key] = options.settings[key];
  }

  var viewOptions = settings['view options'];

  if (viewOptions) {
    for (var key in viewOptions) {
      opts[key] = viewOptions[key];
    }
  }

  for (var key in options) {
    if (key !== 'settings') {
      opts[key] = options[key];
    }
  }

  delete settings['view options'];
  opts['settings'] = settings;

  // setting view partials
  if (!opts.settings['view partials']) {
    opts.settings['view partials'] = path.join(opts.settings['views'], 'partials');
  }

  // setting view helpers
  if (!opts.settings['view helpers']) {
    opts.settings['view helpers'] = path.join(opts.settings['views'], 'helpers');
  }

  // adding layout tracker
  opts._layout = {};

  return opts;
}

exports.attach = attach;
