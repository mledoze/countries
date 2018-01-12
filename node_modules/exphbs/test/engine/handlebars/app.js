var path = require('path');
var express = require('express');
var handlebars = require('handlebars');
var exphbs = require('../../..');
var app = express();

app.engine('exphbs', exphbs.create(handlebars));
app.set('view engine', 'exphbs');
app.set('views', path.join(__dirname, 'views'));

app.get('/', function(req, res) {
  res.render('index');
});

module.exports = app;
