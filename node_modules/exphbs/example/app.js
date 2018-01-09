var express = require('express');
var app = express();

app.engine('hbs', require('exphbs'));
app.set('view engine', 'hbs');

app.locals.data = {
  site: 'Example'
};

app.get('/', function(req, res) {
  res.render('index', {
    title: 'Home',
    name: 'world'
  });
});

app.listen(3000);
console.log('Listening on port 3000');
