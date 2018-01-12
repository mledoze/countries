var path = require('path');
var express = require('express');
var app = express();

app.engine('hbs', require('../../..'));
app.set('view engine', 'hbs');
app.set('views', path.join(__dirname, 'views'));

app.get('/', function(req, res) {
  res.render('index', {
    layout: 'default'
  });
});

app.get('/extension', function(req, res) {
  res.render('index', {
    layout: 'default.hbs'
  });
});

app.get('/directory', function(req, res) {
  res.render('index', {
    layout: 'shared/page'
  });
});

app.get('/directory-extention', function(req, res) {
  res.render('index', {
    layout: 'shared/page.hbs'
  });
});

module.exports = app;
