var fs = require('fs');
var app = require('express')();
var exphbs  = require('express-handlebars');
var translate = require('google-translate-api');


/* rendering engine, with change extension to .hbs */
//app.engine('handlebars',exphbs({defaultLayout: 'main.hbs'}));
app.engine('.hbs', exphbs({
        defaultLayout: 'main',
        extname: '.hbs'
}));

var bodyParser = require('body-parser');
app.use( bodyParser.json() );       // to support JSON-encoded bodies
app.use(bodyParser.urlencoded({     // to support URL-encoded bodies
  extended: true
}));

/* set view engine */
app.set('view engine', 'hbs');
/* views directory to search */
app.set('views', 'views');
var currentIndex = 0;
var json = JSON.parse(fs.readFileSync('rawJSON.json', 'utf8'));

/* home path */
app.get("/", function (req, res) {
  var translatedArabic='';
  var translatedFarsi='';
  var translatedFarsi2='';
    for (var i = 0; i < json.length; i++) {
      if(json[i].translations.per == undefined){
        currentIndex = i;
        translate(json[i].name.common, {to: 'ar'})
          .then(res => {
            translatedArabic = res.text;
          }).catch(err => {
            translatedArabic = err;
          });
          translate(json[i].name.common, {to: 'fa'})
            .then(res => {
              translatedFarsi = res.text;
            }).catch(err => {
              translatedFarsi = err;
            });
          translate(json[i].name.official, {to: 'fa'})
            .then(res => {
              translatedFarsi2 = res.text;
            }).catch(err => {
              translatedFarsi2 = err;
            });

        setTimeout(function () {
          res.render('home', {common: json[i].name.common + ' ('+ (currentIndex+1) + '/248)',
                              official: json[i].name.official,
                              arabicCommon:json[i].translations.ara.common,
                              arabicOfficial:json[i].translations.ara.official,
                              translateArabic: translatedArabic,
                              translateFarsi: translatedFarsi,
                              translateFarsi1: translatedFarsi2});
        }, 800);

        break;
      }
      if(i == 248) res.render('end');
    }

});


app.post("/pp", function (req, res) {
  var arC = req.body.arCommon;
  var arO = req.body.arOfficial;
  var prC = req.body.prCommon;
  var prO = req.body.prOfficial;

  var inputC = escape(prC).replace(/%/g, '\\');
  var inputO = escape(prO).replace(/%/g, '\\');
  json[currentIndex].translations.per={
    official:inputO,
    common:inputC
  };


  fs.unlinkSync('rawJSON.json');
  fs.writeFileSync('rawJSON.json', JSON.stringify(json,null,4));
  res.render('home');


});

app.listen(3000, () => console.log('app listening on port 3000!'));
