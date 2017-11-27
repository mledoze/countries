# World countries in JSON, CSV, XML and YAML.

[![Build Status](https://travis-ci.org/mledoze/countries.svg?branch=master)](https://travis-ci.org/mledoze/countries)
[![Downloads](https://img.shields.io/npm/dm/world-countries.svg?style=flat)](https://www.npmjs.com/package/world-countries)
[![Latest Stable Version](https://img.shields.io/npm/v/world-countries.svg?style=flat)](https://www.npmjs.com/package/world-countries)
[![Latest Stable Version](https://img.shields.io/packagist/v/mledoze/countries.svg?style=flat)](https://packagist.org/packages/mledoze/countries)
[![License](https://img.shields.io/packagist/l/mledoze/countries.svg?style=flat)](http://opendatacommons.org/licenses/odbl/1.0/)

## Countries data
This repository contains lists of world countries in JSON, CSV and XML. Each line contains the country:

 - `name`
 	 - `common` - common name in english
 	 - `official` - official name in english
 	 - `native` - list of all native names
 	 	- key: three-letter ISO 639-3 language code
	 	- value: name object
	 		+ key: official - official name translation
	 		+ key: common - common name translation
 - country code top-level domain (`tld`)
 - code ISO 3166-1 alpha-2 (`cca2`)
 - code ISO 3166-1 numeric (`ccn3`)
 - code ISO 3166-1 alpha-3 (`cca3`)
 - code International Olympic Committee (`cioc`)
 - ISO 4217 currency code(s) (`currency`)
 - calling code(s) (`callingCode`)
 - capital city (`capital`)
 - alternative spellings (`altSpellings`)
 - region
 - subregion
 - list of official languages (`languages`)
 	- key: three-letter ISO 639-3 language code
 	- value: name of the language in english
 - list of name translations (`translations`)
 	- key: three-letter ISO 639-3 language code
 	- value: name object
 		+ key: official - official name translation
 		+ key: common - common name translation
 - latitude and longitude (`latlng`)
 - name of residents (`demonym`)
 - landlocked status (`landlocked`)
 - land borders (`borders`)
 - land area in km² (`area`)

#### Additional data
The [data](https://github.com/mledoze/countries/tree/master/data) folder contains additional data such as the countries
GeoJSON outlines and flags in SVG format.

## Examples
##### JSON
```json
{
	"name": {
		"common": "Austria",
		"official": "Republic of Austria",
		"native": {
			"bar": {
				"official": "Republik Österreich",
				"common": "Österreich"
			}
		}
	},
	"tld": [".at"],
	"cca2": "AT",
	"ccn3": "040",
	"cca3": "AUT",
	"cioc": "AUT",
	"currency": ["EUR"],
	"callingCode": ["43"],
	"capital": "Vienna",
	"altSpellings": ["AT", "Osterreich", "Oesterreich"],
	"region": "Europe",
	"subregion": "Western Europe",
	"languages": {
		"bar": "Austro-Bavarian German"
	},
	"translations": {
		"cym": {"official": "Republic of Austria", "common": "Awstria"},
		"deu": {"official": "Republik Österreich", "common": "Österreich"},
		"fra": {"official": "République d'Autriche", "common": "Autriche"},
		"hrv": {"official": "Republika Austrija", "common": "Austrija"},
		"ita": {"official": "Repubblica d'Austria", "common": "Austria"},
		"jpn": {"official": "オーストリア共和国", "common": "オーストリア"},
		"nld": {"official": "Republiek Oostenrijk", "common": "Oostenrijk"},
		"por": {"official": "República da Áustria", "common": "Áustria"},
		"rus": {"official": "Австрийская Республика", "common": "Австрия"},
		"spa": {"official": "República de Austria", "common": "Austria"}
	},
	"latlng": [47.33333333, 13.33333333],
	"demonym": "Austrian",
	"landlocked": true,
	"borders": ["CZE", "DEU", "HUN", "ITA", "LIE", "SVK", "SVN", "CHE"],
	"area": 83871
}
```

##### GeoJSON and TopoJSON outlines
See an example for Germany: [GeoJSON](https://github.com/mledoze/countries/blob/bb61a1cddfefd09ad5c92ad0a1effbfceba39930/data/deu.geo.json) or [TopoJSON](https://github.com/mledoze/countries/blob/442472de98e80f4a44f1028960dbb0dfb1d942fe/data/deu.topo.json).

##### CSV
```csv
"name";"tld";"cca2";"ccn3";"cca3";"currency";"callingCode";"capital";"altSpellings";"region";"subregion";"languages";"translations";"latlng";"demonym";"landlocked";"borders";"area"
⋮
"Aruba,Aruba,Aruba,Aruba,Aruba,Aruba";".aw";"AW";"533";"ABW";"ARU";"AWG";"297";"Oranjestad";"AW";"Americas";"Caribbean";"Dutch,Papiamento";"Aruba,Aruba,Aruba,Aruba,Aruba,Aruba,Aruba,Aruba,アルバ,アルバ,Aruba,Aruba,Aruba,Aruba,Аруба,Аруба,Aruba,Aruba";"12.5,-69.96666666";"Aruban";"";"";"180"
"Afghanistan,Islamic Republic of Afghanistan,جمهوری اسلامی افغانستان,افغانستان,د افغانستان اسلامي جمهوریت,افغانستان,Owganystan Yslam Respublikasy,Owganystan";".af";"AF";"004";"AFG";"AFG";"AFN";"93";"Kabul";"AF,Afġānistān";"Asia";"Southern Asia";"Dari,Pashto,Turkmen";"Islamic Republic of Afghanistan,Affganistan,Islamischen Republik Afghanistan,Afghanistan,République islamique d'Afghanistan,Afghanistan,Islamska Republika Afganistan,Afganistan,Repubblica islamica dell'Afghanistan,Afghanistan,アフガニスタン·イスラム共和国,アフガニスタン,Islamitische Republiek Afghanistan,Afghanistan,República Islâmica do Afeganistão,Afeganistão,Исламская Республика Афганистан,Афганистан,República Islámica de Afganistán,Afganistán";"33,65";"Afghan";"1";"IRN,PAK,TKM,UZB,TJK,CHN";"652230"
"Angola,Republic of Angola,República de Angola,Angola";".ao";"AO";"024";"AGO";"ANG";"AOA";"244";"Luanda";"AO,República de Angola,ʁɛpublika de an'ɡɔla";"Africa";"Middle Africa";"Portuguese";"Republic of Angola,Angola,Republik Angola,Angola,République d'Angola,Angola,Republika Angola,Angola,Repubblica dell'Angola,Angola,アンゴラ共和国,アンゴラ,Republiek Angola,Angola,República de Angola,Angola,Республика Ангола,Ангола,República de Angola,Angola";"-12.5,18.5";"Angolan";"";"COG,COD,ZMB,NAM";"1246700"
⋮
```

##### XML
```xml
<?xml version="1.0" encoding="UTF-8"?>
<countries>
  <country name="Aruba,Aruba,Aruba,Aruba,Aruba,Aruba" tld=".aw" cca2="AW" ccn3="533" cca3="ABW" cioc="ARU" currency="AWG" callingCode="297" capital="Oranjestad" altSpellings="AW" region="Americas" subregion="Caribbean" languages="Dutch,Papiamento" translations="Aruba,Aruba,Aruba,Aruba,Aruba,Aruba,Aruba,Aruba,アルバ,アルバ,Aruba,Aruba,Aruba,Aruba,Аруба,Аруба,Aruba,Aruba" latlng="12.5,-69.96666666" demonym="Aruban" landlocked="" borders="" area="180"/>
  <country name="Afghanistan,Islamic Republic of Afghanistan,جمهوری اسلامی افغانستان,افغانستان,د افغانستان اسلامي جمهوریت,افغانستان,Owganystan Yslam Respublikasy,Owganystan" tld=".af" cca2="AF" ccn3="004" cca3="AFG" cioc="AFG" currency="AFN" callingCode="93" capital="Kabul" altSpellings="AF,Afġānistān" region="Asia" subregion="Southern Asia" languages="Dari,Pashto,Turkmen" translations="Islamic Republic of Afghanistan,Affganistan,Islamischen Republik Afghanistan,Afghanistan,République islamique d'Afghanistan,Afghanistan,Islamska Republika Afganistan,Afganistan,Repubblica islamica dell'Afghanistan,Afghanistan,アフガニスタン·イスラム共和国,アフガニスタン,Islamitische Republiek Afghanistan,Afghanistan,República Islâmica do Afeganistão,Afeganistão,Исламская Республика Афганистан,Афганистан,República Islámica de Afganistán,Afganistán" latlng="33,65" demonym="Afghan" landlocked="1" borders="IRN,PAK,TKM,UZB,TJK,CHN" area="652230"/>
  <country name="Angola,Republic of Angola,República de Angola,Angola" tld=".ao" cca2="AO" ccn3="024" cca3="AGO" cioc="ANG" currency="AOA" callingCode="244" capital="Luanda" altSpellings="AO,República de Angola,ʁɛpublika de an'ɡɔla" region="Africa" subregion="Middle Africa" languages="Portuguese" translations="Republic of Angola,Angola,Republik Angola,Angola,République d'Angola,Angola,Republika Angola,Angola,Repubblica dell'Angola,Angola,アンゴラ共和国,アンゴラ,Republiek Angola,Angola,República de Angola,Angola,Республика Ангола,Ангола,República de Angola,Angola" latlng="-12.5,18.5" demonym="Angolan" landlocked="" borders="COG,COD,ZMB,NAM" area="1246700"/>  
⋮
<countries>
```

##### YAML
```yaml
- { name: { common: Aruba, official: Aruba, native: { nld: { official: Aruba, common: Aruba }, pap: { official: Aruba, common: Aruba } } }, tld: [.aw], cca2: AW, ccn3: '533', cca3: ABW, cioc: ARU, currency: [AWG], callingCode: ['297'], capital: Oranjestad, altSpellings: [AW], region: Americas, subregion: Caribbean, languages: { nld: Dutch, pap: Papiamento }, translations: { deu: { official: Aruba, common: Aruba }, fra: { official: Aruba, common: Aruba }, hrv: { official: Aruba, common: Aruba }, ita: { official: Aruba, common: Aruba }, jpn: { official: アルバ, common: アルバ }, nld: { official: Aruba, common: Aruba }, por: { official: Aruba, common: Aruba }, rus: { official: Аруба, common: Аруба }, spa: { official: Aruba, common: Aruba } }, latlng: [12.5, -69.96666666], demonym: Aruban, landlocked: false, borders: {  }, area: 180 }
- { name: { common: Afghanistan, official: 'Islamic Republic of Afghanistan', native: { prs: { official: 'جمهوری اسلامی افغانستان', common: افغانستان }, pus: { official: 'د افغانستان اسلامي جمهوریت', common: افغانستان }, tuk: { official: 'Owganystan Yslam Respublikasy', common: Owganystan } } }, tld: [.af], cca2: AF, ccn3: '004', cca3: AFG, cioc: AFG, currency: [AFN], callingCode: ['93'], capital: Kabul, altSpellings: [AF, Afġānistān], region: Asia, subregion: 'Southern Asia', languages: { prs: Dari, pus: Pashto, tuk: Turkmen }, translations: { cym: { official: 'Islamic Republic of Afghanistan', common: Affganistan }, deu: { official: 'Islamischen Republik Afghanistan', common: Afghanistan }, fra: { official: 'République islamique d''Afghanistan', common: Afghanistan }, hrv: { official: 'Islamska Republika Afganistan', common: Afganistan }, ita: { official: 'Repubblica islamica dell''Afghanistan', common: Afghanistan }, jpn: { official: アフガニスタン·イスラム共和国, common: アフガニスタン }, nld: { official: 'Islamitische Republiek Afghanistan', common: Afghanistan }, por: { official: 'República Islâmica do Afeganistão', common: Afeganistão }, rus: { official: 'Исламская Республика Афганистан', common: Афганистан }, spa: { official: 'República Islámica de Afganistán', common: Afganistán } }, latlng: [33, 65], demonym: Afghan, landlocked: true, borders: [IRN, PAK, TKM, UZB, TJK, CHN], area: 652230 }
- { name: { common: Angola, official: 'Republic of Angola', native: { por: { official: 'República de Angola', common: Angola } } }, tld: [.ao], cca2: AO, ccn3: '024', cca3: AGO, cioc: ANG, currency: [AOA], callingCode: ['244'], capital: Luanda, altSpellings: [AO, 'República de Angola', 'ʁɛpublika de an''ɡɔla'], region: Africa, subregion: 'Middle Africa', languages: { por: Portuguese }, translations: { cym: { official: 'Republic of Angola', common: Angola }, deu: { official: 'Republik Angola', common: Angola }, fra: { official: 'République d''Angola', common: Angola }, hrv: { official: 'Republika Angola', common: Angola }, ita: { official: 'Repubblica dell''Angola', common: Angola }, jpn: { official: アンゴラ共和国, common: アンゴラ }, nld: { official: 'Republiek Angola', common: Angola }, por: { official: 'República de Angola', common: Angola }, rus: { official: 'Республика Ангола', common: Ангола }, spa: { official: 'República de Angola', common: Angola } }, latlng: [-12.5, 18.5], demonym: Angolan, landlocked: false, borders: [COG, COD, ZMB, NAM], area: 1246700 }
```

## Customising the output
The data files provided in the `dist` directory include all available fields, but is also possible to build a custom version of the data with certain fields excluded.

To do this, you will first need a working PHP installation, [composer](https://getcomposer.org) and a local copy of this repository. Once you have these, open a terminal in your local version of this project's root directory and run this command to install the necessary dependencies:

```sh
composer install
```

After this finishes, run the following command (here we will exclude the `tld` field from the output, but you can exclude any field you want):

```sh
php countries.php convert --exclude-field=tld
```

You can also exclude multiple fields:

```sh
php countries.php convert --exclude-field=tld --exclude-field=cca2

# Or using the shorter `-x` syntax:
php countries.php convert -x tld -x cca2
```

If you prefer to include only some fields (this can not be combined with `--exclude-field`):

```sh
php countries.php convert --include-field=name --include-field=area

# or using the shorter `-i` syntax:
php countries.php convert -i=name -i=area
```

The generated files are put into the `dist` directory, but you can change this to another existing directory:

```sh
mkdir foobar
php countries.php convert --output-dir=foobar
```

You can also choose to only generate some of the output formats:

```sh
mkdir foobar
php countries.php convert --format=json_unescaped --format=csv

# or using the shorter `-f` syntax:
php countries.php convert -f json_unescaped -f csv
```


## Showcase
Projects using this dataset:

- [REST Countries](https://restcountries.eu/)
- [International Telephone Input](https://intl-tel-input.com/)
- [Telephone JS](https://github.com/lukaswhite/telephones-js)
- [Countries of the World](http://countries.petethompson.net/)
- [Country Prefix Codes For Go](https://github.com/relops/prefixes)
- [Country Info Mapper in Go](https://github.com/pirsquare/country-mapper)
- [Visa requirements in JSON](https://github.com/StrudelInc/visas2)
- [Country picker modal for React Native](https://github.com/xcarpentier/react-native-country-picker-modal)
- [Agnostic Virtual Assistant](https://github.com/ava-ia/core)

## How to contribute?
Please refer to [CONTRIBUTING](https://github.com/mledoze/countries/blob/master/CONTRIBUTING.md).

## To do
 - add the type of the country (country, sovereign state, public body, territory, etc.)
 - add missing translations
 - pull in data automatically from CLDR at build time (idea from @Munter, see #108) 

## Sources
http://www.currency-iso.org/ for currency codes.

Region and subregion are taken from https://github.com/hexorx/countries.

GeoJSON outlines come from http://thematicmapping.org/downloads/world_borders.php.

The rest comes from Wikipedia.

## Credits
Thanks to:
 - @Glazz for his help with country calling codes
 - @hexorx for his work (https://github.com/hexorx/countries)
 - @frederik-jacques for the capital cities
 - @fayer for the population, geolocation, demonym and area data
 - @ancosen for his help with the borders data
 - @herrjemand for country names and various fixes
 - all the contributors: https://github.com/mledoze/countries/graphs/contributors

## License
See [LICENSE](https://github.com/mledoze/countries/blob/master/LICENSE).
