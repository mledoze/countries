#World countries in JSON, CSV and XML.
## Countries data
This repository contains lists of world countries in JSON, CSV and XML. Each line contains the country:

 - name
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

Multiple values are separated by a comma.

#### About the relevance factor
To understand the usefulness of the relevance parameter, please read this: 
- http://uxdesign.smashingmagazine.com/2011/11/10/redesigning-the-country-selector/
- http://baymard.com/labs/country-selector

##Examples
#####JSON
```json
{
    "name":"Austria",
    "tld":".at",
    "cca2":"AT",
    "ccn3":40,
    "cca3":"AUT",
    "currency":"EUR",
    "calling-code":"43",
    "capital":"Vienna",
    "alt-spellings":"AT,Österreich,Osterreich,Oesterreich",
    "relevance":0,
    "region":"Europe",
    "subregion":"Western Europe"
}

{
    "name":"Nigeria",
    "tld":".ng",
    "cca2":"NG",
    "ccn3":566,
    "cca3":"NGA",
    "currency":"NGN",
    "calling-code":"234",
    "capital":"Abuja",
    "alt-spellings":"NG,Nijeriya,Naíjíríà",
    "relevance":1.5,
    "region":"Africa",
    "subregion":"Western Africa"
}
```
#####CSV
```csv
name;tld;cca2;ccn3;cca3;currency;calling-code;capital;alt-spellings;relevance;region;subregion
⋮
United Arab Emirates;.ae;AE;784;ARE;AED;971;Abu Dhabi;AE,UAE;0;Asia;Western Asia
United Kingdom;.uk;GB;826;GBR;GBP;44;London;GB,Great Britain,England,UK,Wales,Scotland,Northern Ireland;2.5;Europe;Northern Europe
United States;.us;US;840;USA;USD,USN,USS;1;Washington D.C.;US,USA,United States of America;3.5;Americas;Northern America
United States Minor Outlying Islands;.us;UM;581;UMI;USD;;;UM;0;Americas;Northern America
⋮
```
#####XML
```xml
<?xml version="1.0" encoding="UTF-8"?>
<countries>
  <country name="Afghanistan" tld=".af" cca2="AF" ccn3="4" cca3="AFG" currency="AFN" calling-code="93" capital="Kabul" alt-spellings="AF,Afġānistān" relevance="0" region="Asia" subregion="Southern Asia"/>
  <country name="Åland Islands" tld=".ax" cca2="AX" ccn3="248" cca3="ALA" currency="EUR" calling-code="358" capital="Mariehamn" alt-spellings="AX,Aaland,Aland" relevance="0.5" region="Europe" subregion="Northern Europe"/>
  <country name="Albania" tld=".al" cca2="AL" ccn3="8" cca3="ALB" currency="ALL" calling-code="355" capital="Tirana" alt-spellings="AL,Shqipëri,Shqipëria,Shqipnia" relevance="0" region="Europe" subregion="Southern Europe"/>
  <country name="Algeria" tld=".dz" cca2="DZ" ccn3="12" cca3="DZA" currency="DZD" calling-code="213" capital="Algiers" alt-spellings="DZ,al-Jazā'ir" relevance="0" region="Africa" subregion="Northern Africa"/>
⋮
<countries>
```

## To do
 - add the country official language(s)
 - add the country native name (written in its native language)
 - add the official name of the country in english and in its native language
 - add more alternative spellings/names
 - rename `alt-spellings` to `alt-names`
 - have only one data source (master file) from which we can generate other formats (see #12)
 - add the type of the country (country, sovereign state, public body, territory, etc.)
 - add the land borders
 - add regions, provinces and cities


## Sources
Wikipedia for country name, TLD, ISO codes and alternative spellings

http://www.currency-iso.org/ for currency codes

Alternative spellings and relevance are inspired by https://github.com/JamieAppleseed/selectToAutocomplete

Region and subregion are taken from https://github.com/hexorx/countries

## Credits
Thanks to:
 - @Glazz for his help with country calling codes.
 - @hexorx for his work (https://github.com/hexorx/countries)
 - @frederik-jacques for the capital cities
 - all the contributors: https://github.com/mledoze/countries/graphs/contributors

## License
This dataset is made available under the Open Database License:
http://opendatacommons.org/licenses/odbl/1.0/

Any rights in individual contents of the database are licensed under the Database Contents License:
http://opendatacommons.org/licenses/dbcl/1.0/
