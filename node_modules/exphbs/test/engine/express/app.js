var path = require('path');
var express = require('express');
var app = express();

app.engine('exphbs', require('../../..').__express);
app.set('view engine', 'exphbs');
app.set('views', path.join(__dirname, 'views'));

app.get('/', function(req, res) {
  res.render('index');
});

module.exports = app;
