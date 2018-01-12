var path = require('path');
var express = require('express');
var app = express();

app.engine('hbs', require('../..'));
app.set('view engine', 'hbs');
app.set('views', path.join(__dirname, 'views'));

app.get('/', function(req, res) {
  res.render('index');
});

app.get('/default', function(req, res) {
  res.render('default');
});

app.get('/override', function(req, res) {
  res.render('override');
});

module.exports = app;
