#World countries in JSON, CSV and XML.
## Countries data
This repository contains lists of world countries in JSON, CSV and XML. Each line contains the country:

 - `name` - name object
 	 - `common` - common name
 	 - `official` - official name
 	 - `native`
 	 	 - `common` - native common name
 	 	 - `official` - native official name
 - country code top-level domain (`tld`)
 - code ISO 3166-1 alpha-2 (`cca2`)
 - code ISO 3166-1 numeric (`ccn3`)
 - code ISO 3166-1 alpha-3 (`cca3`)
 - ISO 4217 currency code(s) (`currency`)
 - calling code(s) (`callingCode`)
 - capital city (`capital`)
 - alternative spellings (`altSpellings`)
 - relevance
 - region
 - subregion
 - official languages `languages`
 	- `language`
 		- `alpha-2` - alpha-2 code(ISO 639-1)
 		- `alpha-3` - alpha-3 code(ISO 639-2/639-3/639-5)
 		- `native` 	- (optional)presented only in native languages
 - name translations (`translations`)
 - latitude and longitude (`latlng`)
 - name of residents (`demonym`)
 - land borders (`borders`)
 - land area in km² (`area`)

#### Additional data
The [data](https://github.com/mledoze/countries/tree/master/data) folder contains additional data such as the countries
GeoJSON outlines and flags in SVG format.

##Examples
#####JSON
```json
{
	"name": {
		"common": "Austria",
		"official": "Republic of Austria",
		"native": {
			"common": "\u00d6sterreich",
			"official": "Republik \u00d6sterreich"
		}
	},
	"tld": [".at"],
	"cca2": "AT",
	"ccn3": "040",
	"cca3": "AUT",
	"currency": ["EUR"],
	"callingCode": ["43"],
	"capital": "Vienna",
	"altSpellings": ["AT", "\u00d6sterreich", "Osterreich", "Oesterreich"],
	"relevance": "0",
	"region": "Europe",
	"subregion": "Western Europe",
	"languages": {
		"German": {
			"alpha3": "deu",
			"alpha2": "de",
			"native": true
		}
	},
	"translations": {
		"cy": "Awstria",
		"de": "\u00d6sterreich",
		"es": "Austria",
		"fr": "Autriche",
		"hr": "Austrija",
		"it": "Austria",
		"ja": "\u30aa\u30fc\u30b9\u30c8\u30ea\u30a2",
		"nl": "Oostenrijk",
		"ru": "\u0410\u0432\u0441\u0442\u0440\u0438\u044f"
	},
	"latlng": [47.33333333, 13.33333333],
	"demonym": "Austrian",
	"borders": ["CZE", "DEU", "HUN", "ITA", "LIE", "SVK", "SVN", "CHE"],
	"area": 83871
},
{
	"name": {
		"common": "Nigeria",
		"official": "Federal Republic of Nigeria",
		"native": {
			"common": "Nigeria",
			"official": "Federal Republic of Nigeria"
		}
	},
	"tld": [".ng"],
	"cca2": "NG",
	"ccn3": "566",
	"cca3": "NGA",
	"currency": ["NGN"],
	"callingCode": ["234"],
	"capital": "Abuja",
	"altSpellings": ["NG", "Nijeriya", "Na\u00edj\u00edr\u00ed\u00e0", "Federal Republic of Nigeria"],
	"relevance": "1.5",
	"region": "Africa",
	"subregion": "Western Africa",
	"languages": {
		"English": {
			"alpha3": "eng",
			"alpha2": "en",
			"native": true
		}
	},
	"translations": {
		"de": "Nigeria",
		"es": "Nigeria",
		"fr": "Nig\u00e9ria",
		"hr": "Nigerija",
		"it": "Nigeria",
		"ja": "\u30ca\u30a4\u30b8\u30a7\u30ea\u30a2",
		"nl": "Nigeria",
		"ru": "\u041d\u0438\u0433\u0435\u0440\u0438\u044f"
	},
	"latlng": [10, 8],
	"demonym": "Nigerian",
	"borders": ["BEN", "CMR", "TCD", "NER"],
	"area": 923768
}
```

#####GeoJSON outline
See an example for [Germany](https://github.com/mledoze/countries/blob/bb61a1cddfefd09ad5c92ad0a1effbfceba39930/data/deu.geo.json).

#####CSV
```csv
"name";"tld";"cca2";"ccn3";"cca3";"currency";"callingCode";"capital";"altSpellings";"relevance";"region";"subregion";"languages";"translations";"latlng";"demonym";"borders";"area"
⋮
"Afghanistan,Islamic Republic of Afghanistan,افغانستان,د افغانستان اسلامي جمهوریت";".af";"AF";"004";"AFG";"AFN";"93";"Kabul";"AF,Afġānistān";"0";"Asia";"Southern Asia";"prs,pus,ps,1,tuk,tk,1";"Affganistan,Afghanistan,Afganistán,Afghanistan,Afganistan,Afghanistan,アフガニスタン,Afghanistan,Афганистан";"33,65";"Afghan";"IRN,PAK,TKM,UZB,TJK,CHN";"652230"
"Åland Islands,Åland Islands,Åland,Landskapet Åland";".ax";"AX";"248";"ALA";"EUR";"358";"Mariehamn";"AX,Aaland,Aland,Ahvenanmaa";"0";"Europe";"Northern Europe";"swe,sv,1";"Åland,Alandia,Åland,Ålandski otoci,Isole Aland,オーランド諸島,Ålandeilanden,Аландские острова";"60.116667,19.9";"Ålandish";"";"-1"
"Albania,Republic of Albania,Shqipëria,Republika e Shqipërisë";".al";"AL";"008";"ALB";"ALL";"355";"Tirana";"AL,Shqipëri,Shqipëria,Shqipnia";"0";"Europe";"Southern Europe";"sqi,sq,1";"Albania,Albanien,Albania,Albanie,Albanija,Albania,アルバニア,Albanië,Албания";"41,20";"Albanian";"MNE,GRC,MKD,KOS";"28748"
"Algeria,People's Democratic Republic of Algeria,الجزائر,الجمهورية الديمقراطية الشعبية الجزائرية";".dz,الجزائر.";"DZ";"012";"DZA";"DZD";"213";"Algiers";"DZ,Dzayer,Algérie";"0";"Africa";"Northern Africa";"ara,ar,1";"Algeria,Algerien,Argelia,Algérie,Alžir,Algeria,アルジェリア,Algerije,Алжир";"28,3";"Algerian";"TUN,LBY,NER,ESH,MRT,MLI,MAR";"2381741"
⋮
```

#####XML
```xml
<?xml version="1.0" encoding="UTF-8"?>
<countries>
  <country name="Afghanistan,Islamic Republic of Afghanistan,افغانستان,د افغانستان اسلامي جمهوریت" tld=".af" cca2="AF" ccn3="004" cca3="AFG" currency="AFN" callingCode="93" capital="Kabul" altSpellings="AF,Afġānistān" relevance="0" region="Asia" subregion="Southern Asia" languages="prs,pus,ps,1,tuk,tk,1" translations="Affganistan,Afghanistan,Afganistán,Afghanistan,Afganistan,Afghanistan,アフガニスタン,Afghanistan,Афганистан" latlng="33,65" demonym="Afghan" borders="IRN,PAK,TKM,UZB,TJK,CHN" area="652230"/>
  <country name="Åland Islands,Åland Islands,Åland,Landskapet Åland" tld=".ax" cca2="AX" ccn3="248" cca3="ALA" currency="EUR" callingCode="358" capital="Mariehamn" altSpellings="AX,Aaland,Aland,Ahvenanmaa" relevance="0" region="Europe" subregion="Northern Europe" languages="swe,sv,1" translations="Åland,Alandia,Åland,Ålandski otoci,Isole Aland,オーランド諸島,Ålandeilanden,Аландские острова" latlng="60.116667,19.9" demonym="Ålandish" borders="" area="-1"/>
  <country name="Albania,Republic of Albania,Shqipëria,Republika e Shqipërisë" tld=".al" cca2="AL" ccn3="008" cca3="ALB" currency="ALL" callingCode="355" capital="Tirana" altSpellings="AL,Shqipëri,Shqipëria,Shqipnia" relevance="0" region="Europe" subregion="Southern Europe" languages="sqi,sq,1" translations="Albania,Albanien,Albania,Albanie,Albanija,Albania,アルバニア,Albanië,Албания" latlng="41,20" demonym="Albanian" borders="MNE,GRC,MKD,KOS" area="28748"/>
  <country name="Algeria,People's Democratic Republic of Algeria,الجزائر,الجمهورية الديمقراطية الشعبية الجزائرية" tld=".dz,الجزائر." cca2="DZ" ccn3="012" cca3="DZA" currency="DZD" callingCode="213" capital="Algiers" altSpellings="DZ,Dzayer,Algérie" relevance="0" region="Africa" subregion="Northern Africa" languages="ara,ar,1" translations="Algeria,Algerien,Argelia,Algérie,Alžir,Algeria,アルジェリア,Algerije,Алжир" latlng="28,3" demonym="Algerian" borders="TUN,LBY,NER,ESH,MRT,MLI,MAR" area="2381741"/>
⋮
<countries>
```

#### About the relevance factor
To understand the usefulness of the relevance parameter, please read this:
- http://uxdesign.smashingmagazine.com/2011/11/10/redesigning-the-country-selector/
- http://baymard.com/labs/country-selector

## Showcase
Projects using this dataset:

- [REST Countries](http://restcountries.eu/)
- [International Telephone Input](http://jackocnr.com/intl-tel-input.html)
- [Country Prefix Codes For Go](https://github.com/relops/prefixes)
- [Ask the NSA](http://askthensa.com/)

## How to contribute?
Please refer to [CONTRIBUTING](https://github.com/mledoze/countries/blob/master/CONTRIBUTING.md).

## To do
 - add the official name of the country in english and in its native language
 - add the type of the country (country, sovereign state, public body, territory, etc.)
 - add missing translations

## Sources
http://www.currency-iso.org/ for currency codes.

Relevance are inspired by https://github.com/JamieAppleseed/selectToAutocomplete.

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
 - all the contributors: https://github.com/mledoze/countries/graphs/contributors

## License
See [LICENSE](https://github.com/mledoze/countries/blob/master/LICENSE).