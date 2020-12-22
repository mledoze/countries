# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]
### Added
- add Swedish translation (#398)
- add a changelog (#383)
- add Hungarian translation (#385)
- add UN membership boolean flag to each country (#401)
- add geojson and topojson for South Sudan (#406)
- add geojson and topojson for Sint Maarten (SX) (#407)
- add geojson and topojson for the Caribbean Netherlands (BQ) (#407)
### Changed
- sort `translations` alphabetically (#384)
- remove South Sudan from Sudan's geojson and topojson (#406)
- change subregion to `Eastern Europe` for Slovakia (#413)
### Fixed
- rename capital city of Kazakhstan from Astana to Nur-Sultan (#391)
- change capital city of Burundi from Bujumbura to Gitega (#391)
- change demonym of United States Minor Outlying Islands to American Islander (#391)
- add South African rand as a currency to Eswatini (#391)
- remove St Barthelemy from Guadaloupe geojson and topojson (#407)
- set St Barthelemy's geojson and topojson to correct region (#407)
- remove duplicate viewBox for Cuba's flag (#411)
### Build
- add `files` in `package.json` to reduce package size (#388)
- generate calling codes (`callingCodes`) from international direct dialing info (`idd`) (#389)

## [v4.0.0] - 2020-04-04
### Breaking changes
- merge demonym into demonyms (#369)
- remove property demonym (#369)

**Before**

    "demonym": "Irish",
    ...
    "demonyms": {
        "fra": {
            "f": "Irlandaise",
            "m": "Irlandais"
        }
    }

**After**

    "demonyms": {
        "eng": {
            "f": "Irish",
            "m": "Irish"
        },
        "fra": {
            "f": "Irlandaise",
            "m": "Irlandais"
        }
    }

### Added
- add translated demonyms in French (#343)
- add DPRK as an alternative spelling to North Korea (#371)
- add altSpelling to Macedonia (#377)
### Changed
- update TypeScript types to v3 (#376)
### Fixed
- fix Curaçao calling code (#370)
- fix wrong Iran language code, update the language label (#374)
- fix Spanish spelling for Haiti (#380)

## [v3.0.0] - 2019-12-18
### Breaking changes
- rename property currency to currencies
- change format of currencies property: it is now an object with currency code as keys. The value is an object with name
 and symbol properties.

**Before**

     "currency": ["SHP", "GBP"]

**After**

    "currencies": {
        "GBP": {
            "name": "Pound sterling",
            "symbol": "\u00a3"
        },
        "SHP": {
            "name": "Saint Helena pound",
            "symbol": "\u00a3"
        }
    }

### Added
- add International Direct Dialing codes (idd property); example:


    "idd": {
        "root": "+2",
        "suffixes": [
            "90",
            "47"
        ]
    }

- add Persian translations
- add Korean translations
- add Urdu translations
- add missing currency codes
- add missing Korean common translation for Wallis and Futuna
- add types for TypeScript
- add Symfony 5 support
### Changed
- change name of Macedonia to North Macedonia
- update translations of North Macedonia
- update flag of Bolivia and Peru
- reorder currencies codes alphabetically
- change demonym of Myanmar to Burmese
- update entry for Curaçao
### Fixed
- rename 'Dollar' to 'dollar'
- replace sovereing with sovereign
- fix names of Saint Kitts and Nevis
- remove [G] in currency codes
- fix official German name for Nepal
- fix Kazakhstan calling code
- replaces (none) with empty strings
### Build
- migrate CI from Travis to GitHub Actions
### Miscellaneous
- add the full ODbL license
- update build status badge with

## [v2.1.0] - 2018-11-09
### Added
- add Czech translations
- add Polish translations
- add missing Croatian translation for Sint Maarten
### Fixed
- replace "Northern America" by "North America"
- remove fund codes from currencies
- rename Swaziland to Eswatini
- revise some German translations
- fix Vatican City demonym
- fix Macau demonym
- fix some Unicode typos
- fix type of 'name.native' when property is empty
- fix official and common country name of Korea
- fix official and native name of the Netherlands (#277)
### Build
- fix output message when converting with specific format(s) (#281)
- format code to comply with PSR2 coding standard
- remove Hungarian notation in PHP Code
- move dependency `roave/security-advisories` to require-dev section
### Miscellaneous
- add badge for PHP minimum version
- add scrutinizer badge

## [v2.0.0] - 2018-02-08
This project now requires the latest version of PHP 5, which is 5.6.33. This will be the last release to support PHP 5.
The next major release (v3.0.0) will require PHP 7.2.
### Breaking changes
- change type of property capitals from string to array to support countries with multiple capitals
- change semicolon to comma for CSV format
(see https://github.com/mledoze/countries/blob/e2de3c46402c2b7a90d30fa1d6d1151e97420992/dist/countries.csv)
- move SHN and BES divisions back into the main `countries.json` as two separate entries; also removed files
`data/shn.divisions.json` and `data/bes.divisions.json`
- remove region specific languages (see #181)
- remove South Sudan from Chad's neighbours
### Added
- add ISO 3166-1 independence status (property independent)
- add ISO 3166-1 assignment status (property status)
- add TopoJSON formatted files for each country
- add Estonian translations
- add Guiana demonym for French French Guiana
- add "The Netherlands" as alternate spelling of Netherlands
- add CKD as currency of Cook Islands
- add "Antarctic" region for multiple countries
- add latitude and longitude data for United States Minor Outlying Islands
### Build
- add three new options: `--include-field`, `--format` and `--output-dir` (thank you @emilv)
- add Travis CI to automatically validate new pull requests
- update dependencies:
    - php (>=5.5.9 => >=5.6.33)
    - symfony/console (v3.1.3 => v4.0.4)
    - symfony/yaml (v3.1.3 => v4.0.4)
### Changed
- update alternative spellings of Cocos (Keeling) Islands
- update official languages of Armenia
### Removed
- remove province of China and use Traditional Chinese instead of Simplified Chinese
### Fixed
- fix capital of Ukraine
- fix non-existing slk language
- fix land borders for China, Cyprus, Chad, Egypt, India, Jordan and Israel
- fix Russian translation of Mexico
- fix existing official names in Welsh
- fix Russia native official name according to en.wikipedia.org/wiki/Russia
- fix Czech Republic short names
- fix Slovakian translation ISO code
- fix subregion field for Mexico
- fix altSpellings field for Belarus
- fix country name and currency code for Belarus
### Miscalleanous
- change licence label to "ODC Open Database License v1.0" to comply with SPDX names

## [v1.8.0] - 2016-09-01
### Added
- add Slovak translations
- add Chinese translations
- add Dutch translation for Kosovo
- add German translations for Kosovo and Curaçao
### Build
- add composer.lock file to prevent dependencies issues
- allow setting a custom command name
### Fixed
- fix native name for Nepal (from apilayer/restcountries#23)
- change demonym for Argentina to Argentine
- fix demonym for Christmas Island
- fix subregion in Slovak Republic
- replace all "cmn" with "zho"
- replace Kosovo's International Olympic Committee code by ISO 3166-1 alpha-3 code in land borders array

## [v1.7.7] - 2016-01-28
### Added
- add missing French translations for Kosovo and Curaçao.

## [v1.7.6] - 2016-01-21
### Fixed
- fix languages key not being excluded with JSON converter (#162)

## [v1.7.5] - 2016-01-20
### Build
- Allow both 2.7 and 3.0 for Symfony

## [v1.7.4] - 2015-06-20
### Build
- update Symfony to version 2.7

## [v1.7.3] - 2015-04-05
### Breaking changes
- remove Bonaire and Saint Helena, Ascension and Tristan da Cunha from countries.json and moved them respectively in
`data/bes.divisions.json` and `data/shn.divisions.json` (see #93)
### Added
- add new property: International Olympic Committee country code (cioc)
- add Ascension and Tristan da Cunha to data/shn.divisions.json
- add Sint Eustatius and Saba to data/bes.divisions.json
- add Tamil to the list of Indian languages
- add missing ISO 3166-1 names to altSpellings
- add sardinian language to Italy
- add sardinian translation of the Italian name
- add finish translations
- add basque language name to Spain
### Build
- update composer dependencies
### Fixed
- made Kuwait border Iraq
- remove Iran from Kuwait borders

**Thank you to all the contributors who helped for this release!**

## [v1.7.2] - 2015-03-07
### Removed
remove src from the ignore list in bower.json
### Fixed
fix bugs entry in package.json

## [v1.7.1] - 2015-03-07
### Breaking changes
- remove relevance data, see #41
### Added
- add `bower.json` to make this project available as a Bower package
- add note about editing languages in CONTRIBUTING.md
### Build
- rename `CountryData` to `Converter`
- rename `Converter` interface to `ConverterInterface`
### Fixed
- fix data for South Soudan, Bonaire and Curazao
- fix spelling in german translation for Egypt
- remove `cca3` code from Kosovo

## [v1.7.0] - 2015-02-06
### Breaking changes
- New format for country names.

The country names (property `name.native`) now contains every native languages. Thus the `nativeLanguage` property,
 which used to identify the language code used for the native country names, has been removed.

**Before**

    {
        "name": {
            "common": "Peru",
            "official": "Republic of Peru",
            "native": {
                "common": "Per\u00fa",
                "official": "Rep\u00fablica del Per\u00fa"
            }
        },
        "...": "...",
        "nativeLanguage": "spa",
        "languages": {
            "aym": "Aymara",
            "que": "Quechua",
            "spa": "Spanish"
        }
    }

**After**

    {
        "name": {
            "common": "Peru",
            "official": "Republic of Peru",
            "native": {
                "aym": {
                    "official": "Piruw Suyu",
                    "common": "Piruw"
                },
                "que": {
                    "official": "Piruw Ripuwlika",
                    "common": "Piruw"
                },
                "spa": {
                    "official": "Rep\u00fablica del Per\u00fa",
                    "common": "Per\u00fa"
                }
            }
        },
        "...": "...",
        "languages": {
            "aym": "Aymara",
            "que": "Quechua",
            "spa": "Spanish"
        }
    }

- New format for translations

As proposed by @herrniemand, the format for translations has been updated to include official country names. Hereafter
 an example for Peru:

**Before**

    {
          "translations": {
            "deu": "Peru",
            "fra": "P\u00e9rou",
            "hrv": "Peru",
            "ita": "Per\u00f9",
            "jpn": "\u30da\u30eb\u30fc",
            "nld": "Peru",
            "por": "Per\u00fa",
            "rus": "\u041f\u0435\u0440\u0443",
            "spa": "Per\u00fa"
        }
    }

**After**

    {
        "translations": {
            "deu": {"official": "Republik Peru", "common": "Peru"},
            "fra": {"official": "R\u00e9publique du P\u00e9rou", "common": "P\u00e9rou"},
            "hrv": {"official": "Republika Peru", "common": "Peru"},
            "ita": {"official": "Repubblica del Per\u00f9", "common": "Per\u00f9"},
            "jpn": {"official": "\u30da\u30eb\u30fc\u5171\u548c\u56fd", "common": "\u30da\u30eb\u30fc"},
            "nld": {"official": "Republiek Peru", "common": "Peru"},
            "por": {"official": "Rep\u00fablica do Peru", "common": "Per\u00fa"},
            "rus": {"official": "\u0420\u0435\u0441\u043f\u0443\u0431\u043b\u0438\u043a\u0430 \u041f\u0435\u0440\u0443", "common": "\u041f\u0435\u0440\u0443"},
            "spa": {"official": "Rep\u00fablica de Per\u00fa", "common": "Per\u00fa"}
        }
    }

### Added
- add alternative name and spellings for East Timor
### Build
A new build system has been introduced by @petert82. The single script is split up into individual files in src/ and
the symfony Console component as a dependency, to make it nice and easy to extend the conversion options in future.

To build the dist files, the command is now `php countries.php convert`.
### Changed
- change Lithuania currency to EUR
- change zambian currency to ZMW
### Fixed
- fix Kosovo calling code
- fix demonym of Myanmar
- fix official Swahili name of Kenya

**Again, a huge thank you goes to @herrniemand and @petert82 for their ideas and help on this.**

## [v1.6.2] - 2015-01-21
### Added
- add landlocked data (as proposed by @romsson)
- add commands in CONTRIBUTING.md to generate dist files
### Fixed
- fix Saint-Martin and Saint-Pierre-and-Miquelon mixed up names
- fix flags ratio
 -fix Western Sahara names

## [v1.6.1] - 2015-01-12
### Added
- this project is now available on Packagist: https://packagist.org/packages/mledoze/countries
- add demonym for Antarctica
- add Countries of the World in showcase list
- add portuguese country name translations
- add missing area data
- add russian language to Azerbaijan
### Build
- add a yaml converter
- add processEmptyArrays method for JSON converters
- refactor loop for fields to keep
- change PHP_EOL to \n
### Fixed
- fix DR Congo common name
- fix afghanistan portuguese translation
- fix denonym for Mayotte and South Georgia
- fix names for Kosovo bump version
- fix Georgia's area
- remove Armenian language to Azerbaijan

## [v1.6] - 2014-09-12
### Breaking changes
New format for country names.
The name property is now an object containing the common and official names of the country both in english and in the
official native language of the country (the language used for this is identified by the new nativeLanguage property;
 see below).

**Before**

    {
          "name": "Switzerland",
          "nativeName": "Schweiz",
          "..."
    }

**After**

    {
        "name": {
            "common": "Switzerland",
            "official": "Swiss Confederation",
            "native": {
                "common": "Schweiz",
                "official": "Schweizerische Eidgenossenschaft"
            }
        },
        "..."
    }

- New format for country languages:
    - The language property is now an object where keys are ISO 639-3 codes (alpha 3) and values are the name of the
    language in english.
    - The nativeLanguage property contains the ISO 639-3 code of the language used for the native country names.

**Before**

    {
        "...",
        "language": ["Finnish", "Swedish"],
        "languageCodes": ["fi", "sv"]
        "..."
    }

**After**

    {
        "...",
        "nativeLanguage": "fin",
        "languages": {
            "fin": "Finnish",
            "swe": "Swedish"
        },
        "..."
    }

- The keys in the translations property are ISO 639-3 languages codes as well.

_Credits to @herrniemand and @petert82 for the original idea and help on this._
### Added
- add official names in english and in the country native language
- add TLD's for Tailand, Taiwan, Syria, Sri Lanka, South Korea, Singapore, Algeria, Jordan, Morocco, Palestine and Qatar
### Build
- update the convertArrays function to handle multi dimensionnal arrays
### Fixed
- fix data for Saint Kitts and Nevis
- fix demonym for Niger
- fix broken link in README update examples
- fix Thailand borders
- fix Senegal borders

## [v1.5.1] - 2014-07-31
### Fixed
- fix data for Israel
- fix data for Sint Maarten
- fix data for Saint Martin
- fix Bolivia borders (PER instead of PRU)

## [v1.5] - 2014-07-30
### Breaking changes
- remove Ascension Island (merged with Saint Helena, see #57)
### Added
- add countries GeoJSON outline
(example https://github.com/mledoze/countries/blob/4251a5f95d5255a913a397d831dd75080e370f33/data/deu.geo.json)
- add russian translations for all countries (thanks @eugene-lazarev)
- add unescaped JSON version
- add "How to contribute" section in README
- This project is now available as a NPM package: https://www.npmjs.org/package/world-countries
### Fixed
- fix Libya CCA3 in Algeria's borders
- fix russian translations, replace \x20 and \x2d with a space and a hyphen
- fix calling code for Vatican City
- fix data for Hong Kong
- fix language and language codes for Norway (fix #56)
- remove BRA-FRA, SUR-FRA, MAF-NED borders for Brazil, Suriname and France

## [v1.4] - 2014-05-07
## Breaking changes
- remove population data (see #6)
- rename Côte d'Ivoire to Ivory Coast
### Added
- add area data in km²
- add countries flag in SVG format (see data folder, source: https://github.com/tinata/tinatapi)
- add welsh translations
- add Ascension Island
- add showcase section in README
- add CONTRIBUTING
### Fixed
- fix missing borders, latitude/longitude and language codes
- fix encoding of accented characters in translations
- fix native names for countries with right-to-left language
- fix/reorder language codes for some countries
- fix spanish translation of Chad
- fix language for Egypt
- fix denonym for United Arab Emirates
- fix region and subregion for Cyprus

## [v1.3] - 2014-02-22
### Breaking changes
- remove english translations since they are redundant with the name parameter
- rename languagesCodes to languageCodes
### Build
- move generated files to the dist folder
- prettify JSON source to ease the contributions
- add script to generate other formats (the source is the JSON file)
### Added
- add geolocation, population, borders and demonym data
- add language codes and translations for multiple countries
- add Republic of Kosovo (#27)
- add missing population field for some countries (-1 is used if there is no data)
### Fixed
- fix many type inconsistencies
- fix/add translations, mainly french
- fix NL translation of Macedonia
- fix currency for Colombia and Mexico
- fix denonym for Åland Islands
- fix null values for latitude/longitude
- rename Macao to Macau
- convert multiple values to real JSON arrays

## [v1.2] - 2013-11-18
### Added
- add license (Open Database License)
- add country native name in its native language
- add country official language(s) in english
- add alt spellings: official country name in english and in its official language(s)
- add region and subregion for Bonaire, Sint Maarten and South Sudan
- add capital for British Indian Ocean Territory, Micronesia, Réunion, South Georgia, Virgin Islands (British) and
Virgin Islands (U.S.)
- add currency for Palestinian Territory
- add examples in README
### Changed
- change TLD for the UK from .gb to .uk
- use camelCase in countries.json
- rename Brunei Darussalam to Brunei
- rename Falkland Islands (Malvinas) to Falkland Islands
- rename French Southern Territories to French Southern and Antarctic Lands
- rename Myanmar (Burma) to Myanmar (added Burma in alt-spellings)
- rename Palestinian Territory to Palestine
- rename Pitcairn to Pitcairn Islands
- rename Russian Federation to Russia
- rename Syrian Arab Republic to Syria
- rename Virgin Islands (British) to British Virgin Islands
- rename Virgin Islands (U.S.) to United States Virgin Islands
### Fixed
- fix alt spellings for Czech Republic
- fix typo in Canada's and Russia's capital
- fix currency and alt-spelling for Slovakia
- fix currency code for Solomon Islands, Somalia and South Africa
- fix South Georgia currency
- fix relevance for Åland Islands and Finland
- fix ccn3 padding
- fix subregion for Brunei Darussalam, Cambodia, Indonesia, Laos, Malaysia, Myanmar, Philippines, Singapore, Thailand,
Timor-Leste and Vietnam
- fix TLD for Bonaire, Heard and McDonald Islands, Kazakhstan and Saint Martin
- fix capital for Moldova
- fix alt-spellings for United Kingdom

## [v1.1] - 2013-10-05
### Added
- add capital cities
### Fixed
- fix accented characters encoding in JSON file

## [v1.0] - 2013-07-26
### Added
- initial release
