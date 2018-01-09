var fs = require('fs');
var app = require('express')();
var exphbs  = require('express-handlebars');

/* rendering engine, with change extension to .hbs */
//app.engine('handlebars',exphbs({defaultLayout: 'main.hbs'}));
app.engine('.hbs', exphbs({
        defaultLayout: 'main',
        extname: '.hbs'
}));

var bodyParser = require('body-parser')
app.use( bodyParser.json() );       // to support JSON-encoded bodies
app.use(bodyParser.urlencoded({     // to support URL-encoded bodies
  extended: true
}));

/* set view engine */
app.set('view engine', 'hbs');
/* views directory to search */
app.set('views', 'views');
var i = 0;

/* home path */
app.get("/", function (req, res) {
    var json = JSON.parse(fs.readFileSync('../countries.json', 'utf8'));
    for (var i in json) {
      res.render('home', {country: json[i].name.common});
      break;
    }
});
app.post("/", function (req, res) {
  var arC = req.body.arCommon;
  var arO = req.body.arOfficial;
  var prC = req.body.prCommon;
  var prO = req.body.prOfficial;
  //mystring.replace(/,/g , "newchar");
  console.log(arC);
  console.log(escape(arC).replace(/%/g, "/"));
  //res.render('home');
  res.end();

});

app.listen(3000, () => console.log('app listening on port 3000!'));
