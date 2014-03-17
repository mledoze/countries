var _ = require('lodash'),
	Knex = require('knex'),
	countries = require('./../db/countries.json'),
	counter = 0,
	MAX_COUNTER = countries.length,
	knex = Knex.initialize({
  client: 'mysql',
  connection: {
    host     : '127.0.0.1',
    user     : 'root',
    database : 'cityowls',
    charset  : 'utf8'
  }
});

console.log('Starting...');

function getCountryData(){
	console.log('getCountryData');
	if (counter < MAX_COUNTER ){
		insertDataToMysql(countries[counter], function(err, result){
			if (err)
				process.exit();

			if (result){
				console.log('calling again got result');
				console.log(result);
				counter++
				getCountryData();
			}
		});
	}
	else{
		console.log('Script is done.');
		process.exit('Done.');
	}
}

function insertDataToMysql(data, cb){
	console.log('insertDataToMysql');
	console.log(data);
	knex('countries').insert({
		id: null,
		callingCode: '"[' + data.callingCode + ']"',
		name: data.name,
		nativeName: data.nativeName,
		cca2: data.cca2,
		ccn3: data.ccn3,
		cca3: data.cca3,
		currency: '"[' + data.currency + ']"',
		capital: data.capital,
		altSpellings: '"[' + data.altSpellings + ']"',
		region: data.region,
		subregion: data.subregion,
		language: '"[' + data.language + ']"',
		languageCodes: '"[' + data.languageCodes + ']"',
		demonym: '"[' + data.demonym + ']"',
		borders: '"[' + data.borders + ']"'
	}).then(function(results){
		console.log('then response...');
		cb(null, { data: "Done", country: data.name });
	});
}

getCountryData();