var path = require('path');
var express = require('express');
var exphbs = require('../../../..');
var app = express();

app.engine('hbs', exphbs.create());
app.set('view engine', 'hbs');
app.set('views', path.join(__dirname, 'views'));

app.set('env', 'production');

app.get('/', function(req, res) {
  res.render('index');
});

module.exports = app;
