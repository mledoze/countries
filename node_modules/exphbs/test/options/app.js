var path = require('path');
var express = require('express');
var app = express();

app.engine('hbs', require('../..'));
app.set('view engine', 'hbs');
app.set('views', path.join(__dirname, 'views'));

app.set('view options', {
  view: 'view',
  override: 'view',
});

app.locals.global = 'global';
app.locals.override = 'global';

app.get('/local', function(req, res) {
  res.render('local', {
    local: 'local'
  });
});

app.get('/global', function(req, res) {
  res.render('global');
});

app.get('/view', function(req, res) {
  res.render('view');
});

app.get('/override1', function(req, res) {
  res.render('override');
});

app.get('/override2', function(req, res) {
  res.render('override', {
    override: 'local'
  });
});

module.exports = app;
