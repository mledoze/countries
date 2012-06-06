This repository contains lists of world countries in JSON, CSV and XML. Each line contains:

 - the country name

 - the country top-level domain

 - the country code ISO 3166-1 alpha-2 (cca2)

 - the country code ISO 3166-1 numeric (ccn3)

 - the country code ISO 3166-1 alpha-3 (cca3)
 
 - alternative spellings of the country name (separated by spaces)
 
 - the country relevance

 - the country currency code(s) (comma separated if necessary)
 
# 
Alternative spellings and relevance are inspired by https://github.com/JamieAppleseed/selectToAutocomplete. 

I used http://www.shancarter.com/data_converter/index.html to generate the JSON and XML; the CSV was done by hand.

NB: I removed a few alternative spellings because of some unicode issues. If someone has a fix, please send a pull request.

# Sources
Wikipedia and http://www.currency-iso.org/ for currency codes