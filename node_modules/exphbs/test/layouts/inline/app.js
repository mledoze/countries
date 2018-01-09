var path = require('path');
var express = require('express');
var app = express();

app.engine('hbs', require('../../..'));
app.set('view engine', 'hbs');
app.set('views', path.join(__dirname, 'views'));

app.get('/', function(req, res) {
  res.render('index');
});

app.get('/directory', function(req, res) {
  res.render('directory');
});

app.get('/override', function(req, res) {
  res.render('override', {
    layout: 'default'
  });
});

module.exports = app;
