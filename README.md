#World countries in JSON, CSV and XML.
## Countries data
This repository contains lists of world countries in JSON, CSV and XML. Each line contains the country:

 - name
 - top-level domain (`tld`)
 - code ISO 3166-1 alpha-2 (`cca2`)
 - code ISO 3166-1 numeric (`ccn3`)
 - code ISO 3166-1 alpha-3 (`cca3`)
 - currency code(s) (`currency`)
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

## To do
 - add the country native/official language(s)
 - add the country native name (written in its native language)
 - add more alternative spellings/names
 - rename `alt-spellings` to `alt-names`

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

## License
This dataset is made available under the Open Database License:
http://opendatacommons.org/licenses/odbl/1.0/

Any rights in individual contents of the database are licensed under the Database Contents License:
http://opendatacommons.org/licenses/dbcl/1.0/
