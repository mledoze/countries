# google-translate-token [![Build Status](https://travis-ci.org/matheuss/google-translate-token.svg?branch=master)](https://travis-ci.org/matheuss/google-translate-token) [![XO code style](https://img.shields.io/badge/code_style-XO-5ed9c7.svg)](https://github.com/sindresorhus/xo)
A package that generates the necessary token to use the [**Google Translate API for free** :dollar::no_entry_sign:](https://github.com/matheuss/google-translate-api)

## Why

[translate.google.com](https://translate.google.com) uses a token to authorize the requests. If you are not Google, you do not have this token and will have to [pay $20 per 1 million characters of text](https://cloud.google.com/translate/v2/pricing).

This package is the [result](https://github.com/matheuss/google-translate-token/blob/master/index.js#L12-110) of reverse engineering on the [obfuscated and minified code](https://translate.google.com/translate/releases/twsfe_w_20160620_RC00/r/js/desktop_module_main.js) used by Google to generate such token.

## How it works

The token is based on a seed which is updated once per hour and on the text that will be translated. Both are combined – by some strange math – in order to generate a final token (e.g. `820594.703830`) which is used by the API to validade the request. 


## Install

```
npm install --save google-translate-token
```

## Usage

``` js
const token = require('google-translate-token');

token.get('Hello').then(console.log);
//=> { name: 'tk', value: '159402.284291' }
```

## Related

- [`google-translate-api`](https://github.com/matheuss/google-translate-api) – A **free** and **unlimited** API for Google Translate :dollar::no_entry_sign: