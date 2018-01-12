var path = require('path');
var express = require('express');
var app = express();

app.engine('hbs', require('../../..'));
app.set('view engine', 'hbs');
app.set('views', path.join(__dirname, 'views'));

app.locals.layout = 'default';

app.get('/', function(req, res) {
  res.render('index');
});

app.get('/override', function(req, res) {
  res.render('index', {
    layout: 'page.hbs'
  });
});

module.exports = app;
