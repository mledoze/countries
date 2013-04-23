# Countries data
This repository contains lists of world countries in JSON, CSV and XML. Each line contains the country:

 - name
 - top-level domain (tld)
 - code ISO 3166-1 alpha-2 (cca2)
 - code ISO 3166-1 numeric (ccn3)
 - code ISO 3166-1 alpha-3 (cca3)
 - currency code(s)
 - calling code(s)
 - alternative spellings
 - relevance
 - region
 - subregion

Multiple values are separated by a comma. I use [Mr. Data Converter] [1] to generate the JSON and XML; the CSV is done by hand.

I will add the following data:
 - the country capital city
 - the country official language(s)

# Sources
 - Wikipedia for country name, TLD, ISO codes and alternative spellings
 - http://www.currency-iso.org/ for currency codes
 - Alternative spellings and relevance are inspired by https://github.com/JamieAppleseed/selectToAutocomplete
 - Region and subregion are taken from https://github.com/hexorx/countries

# Credits
Thanks to @Glazz for his help with country calling codes.

Thanks to @hexorx for his work.

[1]: http://www.shancarter.com/data_converter/index.html "Mr. Data Converter"
