#World countries in JSON, CSV and XML.
## Countries data
This repository contains lists of world countries in JSON, CSV and XML. Each line contains the country:

 - name
 - native name in its native language (`nativeName`)
 - top-level domain (`tld`)
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
 - language(s) in English
 - ISO 639-1 language code(s) (`languageCodes`)
 - name translations
 - population
 - latitude and longitude (`latlng`)
 - name of residents (`demonym`)
 - land borders (`borders`)

##Examples
#####JSON
```json
{
	"name": "Austria",
	"nativeName": "Österreich",
	"tld": [".at"],
	"cca2": "AT",
	"ccn3": "040",
	"cca3": "AUT",
	"currency": ["EUR"],
	"callingCode": ["43"],
	"capital": "Vienna",
	"altSpellings": ["AT", "Österreich", "Osterreich", "Oesterreich"],
	"relevance": "0",
	"region": "Europe",
	"subregion": "Western Europe",
	"language": ["German"],
	"languageCodes": ["de"],
	"translations": {
		"de": "Österreich",
		"es": "Austria",
		"fr": "Autriche",
		"it": "Austria",
		"ja": "オーストリア",
		"nl": "Oostenrijk",
		"hr": "Austrija"
	},
	"population": 8501502,
	"latlng": [47.33333333, 13.33333333],
	"demonym": "Austrian",
	"borders": ["CZE", "DEU", "HUN", "ITA", "LIE", "SVK", "SVN", "CHE"]
}

{
	"name": "Nigeria",
	"nativeName": "Nigeria",
	"tld": [".ng"],
	"cca2": "NG",
	"ccn3": "566",
	"cca3": "NGA",
	"currency": ["NGN"],
	"callingCode": ["234"],
	"capital": "Abuja",
	"altSpellings": ["NG", "Nijeriya", "Naíjíríà", "Federal Republic of Nigeria"],
	"relevance": "1.5",
	"region": "Africa",
	"subregion": "Western Africa",
	"language": ["English"],
	"languageCodes": ["en"],
	"translations": {
		"de": "Nigeria",
		"es": "Nigeria",
		"fr": "Nigéria",
		"it": "Nigeria",
		"ja": "ナイジェリア",
		"nl": "Nigeria",
		"hr": "Nigerija"
	},
	"population": 173615000,
	"latlng": [10, 8],
	"demonym": "Nigerian",
	"borders": ["BEN", "CMR", "TCD", "NER"]
}
```

#####CSV
```csv
"name";"nativeName";"tld";"cca2";"ccn3";"cca3";"currency";"callingCode";"capital";"altSpellings";"relevance";"region";"subregion";"language";"languageCodes";"translations";"population";"latlng";"demonym";"borders"
⋮
"United Arab Emirates";"دولة الإمارات العربية المتحدة";".ae";"AE";"784";"ARE";"AED";"971";"Abu Dhabi";"AE,UAE";"0";"Asia";"Western Asia";"Arabic";"ar";"Vereinigte Arabische Emirate,Emiratos Árabes Unidos,Émirats arabes unis,Emirati Arabi Uniti,アラブ首長国連邦,Verenigde Arabische Emiraten,Ujedinjeni Arapski Emirati";"5473972";"24,54";"Emirati";"OMN,SAU"
"United Kingdom";"United Kingdom";".uk";"GB";"826";"GBR";"GBP";"44";"London";"GB,UK,Great Britain";"2.5";"Europe";"Northern Europe";"English";"en";"Vereinigtes Königreich,Reino Unido,Royaume-Uni,Regno Unito,イギリス,Verenigd Koninkrijk,Ujedinjeno Kraljevstvo";"63705000";"54,-2";"British";"IRL"
"United States";"United States";".us";"US";"840";"USA";"USD,USN,USS";"1";"Washington D.C.";"US,USA,United States of America";"3.5";"Americas";"Northern America";"English";"en";"Vereinigte Staaten von Amerika,Estados Unidos,États-Unis,Stati Uniti D'America,アメリカ合衆国,Verenigde Staten,Sjedinjene Američke Države";"317101000";"38,-97";"American";"CAN,MEX"
"United States Minor Outlying Islands";"United States Minor Outlying Islands";".us";"UM";"581";"UMI";"USD";"";"";"UM";"0";"Americas";"Northern America";"English";"en";"Kleinere Inselbesitzungen der Vereinigten Staaten,Islas Ultramarinas Menores de Estados Unidos,Îles mineures éloignées des États-Unis,Isole minori esterne degli Stati Uniti d'America,合衆国領有小離島,Kleine afgelegen eilanden van de Verenigde Staten,Mali udaljeni otoci SAD-a";"300";"";"American";""
"United States Virgin Islands";"United States Virgin Islands";".vi";"VI";"850";"VIR";"USD";"1340";"Charlotte Amalie";"VI";"0.5";"Americas";"Caribbean";"English";"en";"Amerikanische Jungferninseln,Islas Vírgenes de los Estados Unidos,Îles Vierges des États-Unis,Isole Vergini americane,アメリカ領ヴァージン諸島,Amerikaanse Maagdeneilanden,Američki Djevičanski Otoci";"106405";"18.35,-64.933333";"Virgin Islander";""
⋮
```

#####XML
```xml
<?xml version="1.0" encoding="UTF-8"?>
<countries>
  <country name="Afghanistan" nativeName="افغانستان" tld=".af" cca2="AF" ccn3="004" cca3="AFG" currency="AFN" callingCode="93" capital="Kabul" altSpellings="AF,Afġānistān" relevance="0" region="Asia" subregion="Southern Asia" language="Pashto,Dari" languageCodes="ps,uz,tk" translations="Affganistan,Afghanistan,Afganistán,Afghanistan,Afghanistan,アフガニスタン,Afghanistan,Afganistan" population="25500100" latlng="33,65" demonym="Afghan" borders="IRN,PAK,TKM,UZB,TJK,CHN"/>
  <country name="Åland Islands" nativeName="Åland" tld=".ax" cca2="AX" ccn3="248" cca3="ALA" currency="EUR" callingCode="358" capital="Mariehamn" altSpellings="AX,Aaland,Aland,Ahvenanmaa" relevance="0" region="Europe" subregion="Northern Europe" language="Swedish" languageCodes="sv" translations="Åland,Alandia,Åland,Isole Aland,オーランド諸島,Ålandeilanden,Ålandski otoci" population="28502" latlng="60.116667,19.9" demonym="Ålandish" borders=""/>
  <country name="Albania" nativeName="Shqipëria" tld=".al" cca2="AL" ccn3="008" cca3="ALB" currency="ALL" callingCode="355" capital="Tirana" altSpellings="AL,Shqipëri,Shqipëria,Shqipnia" relevance="0" region="Europe" subregion="Southern Europe" language="Albanian" languageCodes="sq" translations="Albania,Albanien,Albania,Albanie,Albania,アルバニア,Albanië,Albanija" population="2821977" latlng="41,20" demonym="Albanian" borders="MNE,GRC,MKD,KOS"/>
  <country name="Algeria" nativeName="الجزائر" tld=".dz" cca2="DZ" ccn3="012" cca3="DZA" currency="DZD" callingCode="213" capital="Algiers" altSpellings="DZ,Dzayer,Algérie" relevance="0" region="Africa" subregion="Northern Africa" language="Arabic" languageCodes="ar" translations="Algeria,Algerien,Argelia,Algérie,Algeria,アルジェリア,Algerije,Alžir" population="37900000" latlng="28,3" demonym="Algerian" borders="TUN,LDY,NER,ESH,MRT,MLI,MAR"/>
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

## To do
 - add the official name of the country in english and in its native language
 - add the type of the country (country, sovereign state, public body, territory, etc.)
 - add geoJSON outlines of the countries (https://github.com/mledoze/countries/issues/6#issuecomment-38167077)
 - add missing translations

## Sources
http://www.currency-iso.org/ for currency codes.

Relevance are inspired by https://github.com/JamieAppleseed/selectToAutocomplete.

Region and subregion are taken from https://github.com/hexorx/countries.

The rest comes from Wikipedia.

## Credits
Thanks to:
 - @Glazz for his help with country calling codes
 - @hexorx for his work (https://github.com/hexorx/countries)
 - @frederik-jacques for the capital cities
 - @fayer for the population, geolocation and demonym data
 - @ancosen for his help with the borders data
 - all the contributors: https://github.com/mledoze/countries/graphs/contributors

## License
See [LICENSE](LICENSE).