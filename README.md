#World countries in JSON, CSV and XML.
## Countries data
This repository contains lists of world countries in JSON, CSV and XML. Each line contains the country:

 - name
 - native name in its native language (`native-name`)
 - top-level domain (`tld`)
 - code ISO 3166-1 alpha-2 (`cca2`)
 - code ISO 3166-1 numeric (`ccn3`)
 - code ISO 3166-1 alpha-3 (`cca3`)
 - ISO 4217 currency code(s) (`currency`)
 - calling code(s) (`calling-code`)
 - capital city (`capital`)
 - alternative spellings (`alt-spellings`)
 - relevance
 - region
 - subregion
 - language in English
 - population
 - latitude and longitude (`latlng`)
 - name of residents (`demonym`)

##Examples
#####JSON
```json
{
	"name": "Austria",
	"nativeName": "Österreich",
	"tld": ".at",
	"cca2": "AT",
	"ccn3": "040",
	"cca3": "AUT",
	"currency": "EUR",
	"callingCode": "43",
	"capital": "Vienna",
	"altSpellings": [
		"AT",
		"Österreich",
		"Osterreich",
		"Oesterreich"
	],
	"relevance": "0",
	"region": "Europe",
	"subregion": "Western Europe",
	"language": "German",
	"population": 8501502,
	"latlng": [
		47.33333333,
		13.33333333
	],
	"demonym": "Austrian"
}

{
	"name": "Nigeria",
	"nativeName": "Nigeria",
	"tld": ".ng",
	"cca2": "NG",
	"ccn3": "566",
	"cca3": "NGA",
	"currency": "NGN",
	"callingCode": "234",
	"capital": "Abuja",
	"altSpellings": [
		"NG",
		"Nijeriya",
		"Naíjíríà",
		"Federal Republic of Nigeria"
	],
	"relevance": "1.5",
	"region": "Africa",
	"subregion": "Western Africa",
	"language": "English",
	"population": 173615000,
	"latlng": [
		10,
		8
	],
	"demonym": "Nigerian"
}
```
#####CSV
```csv
name;native-name;tld;cca2;ccn3;cca3;currency;calling-code;capital;alt-spellings;relevance;region;subregion;language
⋮
United Arab Emirates;Dawlat al-ʾImārāt al-ʿArabiyyah al-Muttaḥidah;.ae;AE;784;ARE;AED;971;Abu Dhabi;AE,UAE;0;Asia;Western Asia;Arabic
United Kingdom;United Kingdom;.uk;GB;826;GBR;GBP;44;London;GB,UK,Great Britain;2.5;Europe;Northern Europe;English
United States;United States;.us;US;840;USA;USD,USN,USS;1;Washington D.C.;US,USA,United States of America;3.5;Americas;Northern America;English
United States Minor Outlying Islands;United States Minor Outlying Islands;.us;UM;581;UMI;USD;;;UM;0;Americas;Northern America;English
United States Virgin Islands;United States Virgin Islands;.vi;VI;850;VIR;USD;1340;Charlotte Amalie;VI;0.5;Americas;Caribbean;English
⋮
```
#####XML
```xml
<?xml version="1.0" encoding="UTF-8"?>
<countries>
  <country name="Afghanistan" native-name="Afġānistān" tld=".af" cca2="AF" ccn3="004" cca3="AFG" currency="AFN" calling-code="93" capital="Kabul" alt-spellings="AF,Afġānistān" relevance="0" region="Asia" subregion="Southern Asia" language="Pashto,Dari"/>
  <country name="Åland Islands" native-name="Åland" tld=".ax" cca2="AX" ccn3="248" cca3="ALA" currency="EUR" calling-code="358" capital="Mariehamn" alt-spellings="AX,Aaland,Aland,Ahvenanmaa" relevance="0" region="Europe" subregion="Northern Europe" language="Swedish"/>
  <country name="Albania" native-name="Shqipëria" tld=".al" cca2="AL" ccn3="008" cca3="ALB" currency="ALL" calling-code="355" capital="Tirana" alt-spellings="AL,Shqipëri,Shqipëria,Shqipnia" relevance="0" region="Europe" subregion="Southern Europe" language="Albanian"/>
  <country name="Algeria" native-name="al-Jazāʼir" tld=".dz" cca2="DZ" ccn3="012" cca3="DZA" currency="DZD" calling-code="213" capital="Algiers" alt-spellings="DZ,Dzayer,Algérie" relevance="0" region="Africa" subregion="Northern Africa" language="Arabic"/>
⋮
<countries>
```

#### About the relevance factor
To understand the usefulness of the relevance parameter, please read this:
- http://uxdesign.smashingmagazine.com/2011/11/10/redesigning-the-country-selector/
- http://baymard.com/labs/country-selector

## To do
 - add the official name of the country in english and in its native language
 - rename `alt-spellings` to `alt-names`
 - have only one data source (master file) from which we can generate other formats (see #12)
 - add the type of the country (country, sovereign state, public body, territory, etc.)
 - add the land borders
 - add regions, provinces and cities

## Sources
http://www.currency-iso.org/ for currency codes.

Relevance are inspired by https://github.com/JamieAppleseed/selectToAutocomplete.

Region and subregion are taken from https://github.com/hexorx/countries.

The rest comes from Wikipedia.

## Credits
Thanks to:
 - @Glazz for his help with country calling codes.
 - @hexorx for his work (https://github.com/hexorx/countries)
 - @frederik-jacques for the capital cities
 - @fayer for the population, geolocation and demonym data
 - all the contributors: https://github.com/mledoze/countries/graphs/contributors

## License
This dataset is made available under the Open Database License:
http://opendatacommons.org/licenses/odbl/1.0/

Any rights in individual contents of the database are licensed under the Database Contents License:
http://opendatacommons.org/licenses/dbcl/1.0/
