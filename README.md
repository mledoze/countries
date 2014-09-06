#World countries in JSON, CSV and XML.
## Countries data
This repository contains lists of world countries in JSON, CSV and XML. Each line contains the country:

 - name
 - native name in its native language (`nativeName`)
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
 - language(s) in English (`language`)
 - ISO 639-1 language code(s) (`languageCodes`)
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
        "native": {
            "common": "\u00d6sterreich",
            "official": ""
        },
        "official": ""
    },
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
		"cy": "Awstria",
		"de": "Österreich",
		"es": "Austria",
		"fr": "Autriche",
		"it": "Austria",
		"ja": "オーストリア",
		"nl": "Oostenrijk",
		"hr": "Austrija",
		"ru": "Австрия"
	},
	"latlng": [47.33333333, 13.33333333],
	"demonym": "Austrian",
	"borders": ["CZE", "DEU", "HUN", "ITA", "LIE", "SVK", "SVN", "CHE"],
	"area": 83871
}

{
	"name": {
            "common": "Nigeria",
            "native": {
                "common": "Nigeria",
                "official": ""
            },
            "official": ""
    },
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
		"hr": "Nigerija",
		"ru": "Нигерия"
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
"name";"nativeName";"tld";"cca2";"ccn3";"cca3";"currency";"callingCode";"capital";"altSpellings";"relevance";"region";"subregion";"language";"languageCodes";"translations";"latlng";"demonym";"borders"
⋮
"AE,UAE,Emirates";"83600";"OMN,SAU";"971";"Abu Dhabi";"AE";"ARE";"784";"AED";"Emirati";"Arabic";"ar";"24,54";"United Arab Emirates,دولة الإمارات العربية المتحدة";"Asia";"0";"Western Asia";".ae,امارات.";"Vereinigte Arabische Emirate,Emiratos Árabes Unidos,Émirats arabes unis,Ujedinjeni Arapski Emirati,Emirati Arabi Uniti,アラブ首長国連邦,Verenigde Arabische Emiraten,Объединённые Арабские Эмираты"
"GB,UK,Great Britain";"242900";"IRL";"44";"London";"GB";"GBR";"826";"GBP";"British";"English";"en";"54,-2";"United Kingdom,United Kingdom";"Europe";"2.5";"Northern Europe";".uk";"Vereinigtes Königreich,Reino Unido,Royaume-Uni,Ujedinjeno Kraljevstvo,Regno Unito,イギリス,Verenigd Koninkrijk,Великобритания"
"US,USA,United States of America";"9372610";"CAN,MEX";"1";"Washington D.C.";"US";"USA";"840";"USD,USN,USS";"American";"English";"en";"38,-97";"United States,United States";"Americas";"3.5";"Northern America";".us";"Vereinigte Staaten von Amerika,Estados Unidos,États-Unis,Sjedinjene Američke Države,Stati Uniti D'America,アメリカ合衆国,Verenigde Staten,Соединённые Штаты Америки"
"UM";"-1";"";"";"";"UM";"UMI";"581";"USD";"American";"English";"en";"";"United States Minor Outlying Islands,United States Minor Outlying Islands";"Americas";"0";"Northern America";".us";"Kleinere Inselbesitzungen der Vereinigten Staaten,Islas Ultramarinas Menores de Estados Unidos,Îles mineures éloignées des États-Unis,Mali udaljeni otoci SAD-a,Isole minori esterne degli Stati Uniti d'America,合衆国領有小離島,Kleine afgelegen eilanden van de Verenigde Staten,Внешние малые острова США"
"VI";"347";"";"1340";"Charlotte Amalie";"VI";"VIR";"850";"USD";"Virgin Islander";"English";"en";"18.35,-64.933333";"United States Virgin Islands,United States Virgin Islands";"Americas";"0.5";"Caribbean";".vi";"Amerikanische Jungferninseln,Islas Vírgenes de los Estados Unidos,Îles Vierges des États-Unis,Američki Djevičanski Otoci,Isole Vergini americane,アメリカ領ヴァージン諸島,Amerikaanse Maagdeneilanden,Виргинские Острова"
⋮
```

#####XML
```xml
<?xml version="1.0" encoding="UTF-8"?>
<countries>
   <country altSpellings="AF,Afġānistān" area="652230" borders="IRN,PAK,TKM,UZB,TJK,CHN" callingCode="93" capital="Kabul" cca2="AF" cca3="AFG" ccn3="004" currency="AFN" demonym="Afghan" language="Pashto,Dari" languageCodes="ps,uz,tk" latlng="33,65" name="Afghanistan,افغانستان" region="Asia" relevance="0" subregion="Southern Asia" tld=".af" translations="Affganistan,Afghanistan,Afganistán,Afghanistan,Afganistan,Afghanistan,アフガニスタン,Afghanistan,Афганистан"/>
  <country altSpellings="AX,Aaland,Aland,Ahvenanmaa" area="-1" borders="" callingCode="358" capital="Mariehamn" cca2="AX" cca3="ALA" ccn3="248" currency="EUR" demonym="Ålandish" language="Swedish" languageCodes="sv" latlng="60.116667,19.9" name="Åland Islands,Åland" region="Europe" relevance="0" subregion="Northern Europe" tld=".ax" translations="Åland,Alandia,Åland,Ålandski otoci,Isole Aland,オーランド諸島,Ålandeilanden,Аландские острова"/>
  <country altSpellings="AL,Shqipëri,Shqipëria,Shqipnia" area="28748" borders="MNE,GRC,MKD,KOS" callingCode="355" capital="Tirana" cca2="AL" cca3="ALB" ccn3="008" currency="ALL" demonym="Albanian" language="Albanian" languageCodes="sq" latlng="41,20" name="Albania,Shqipëria" region="Europe" relevance="0" subregion="Southern Europe" tld=".al" translations="Albania,Albanien,Albania,Albanie,Albanija,Albania,アルバニア,Albanië,Албания"/>
  <country altSpellings="DZ,Dzayer,Algérie" area="2381741" borders="TUN,LBY,NER,ESH,MRT,MLI,MAR" callingCode="213" capital="Algiers" cca2="DZ" cca3="DZA" ccn3="012" currency="DZD" demonym="Algerian" language="Arabic" languageCodes="ar" latlng="28,3" name="Algeria,الجزائر" region="Africa" relevance="0" subregion="Northern Africa" tld=".dz,الجزائر." translations="Algeria,Algerien,Argelia,Algérie,Alžir,Algeria,アルジェリア,Algerije,Алжир"/>
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