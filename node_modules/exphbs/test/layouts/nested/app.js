var path = require('path');
var express = require('express');
var app = express();

app.engine('hbs', require('../../..'));
app.set('view engine', 'hbs');
app.set('views', path.join(__dirname, 'views'));

app.get('/', function(req, res) {
  res.render('index', {
    layout: 'page'
  });
});

app.get('/another', function(req, res) {
  res.render('another', {
    layout: 'page'
  });
});

app.get('/inline', function(req, res) {
  res.render('inline');
});

app.get('/deep', function(req, res) {
  res.render('deep');
});

app.get('/circular', function(req, res) {
  res.render('circular');
});

module.exports = app;
