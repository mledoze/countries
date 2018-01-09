var path = require('path');
var express = require('express');
var app = express();

app.engine('hbs', require('../..'));
app.set('view engine', 'hbs');
app.set('views', path.join(__dirname, 'views'));

app.locals.data = {
  global: 'global',
  override: 'global'
}

app.get('/local', function(req, res) {
  res.render('local', {
    data: {
      local: 'local'
    }
  });
});

app.get('/global', function(req, res) {
  res.render('global');
});

app.get('/override', function(req, res) {
  res.render('override', {
    data: {
      override: 'local'
    }
  });
});

module.exports = app;
