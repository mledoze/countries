module.exports = require('./countries.json');

// const { execSync } = require('child_process');
// const fs = require('fs')
// const uab = require('unique-array-objects');
// const jsonToMarkdown = require('json-to-markdown-table')
// const jsonToTable = require('json-to-table')
// const mdTable = require('markdown-table')

// const baseDirectory = '/Users/reecedaniels/dev/kwiff/_counting'

// const parsedCountries = JSON.parse(fs.readFileSync(`./countries.json`).toString())

// console.log(parsedCountries)

// parsedCountries.forEach(country => {
//   fs.writeFileSync(`./country-data/${country.name.common.replace(' ', '-').toLowerCase()}.json`, JSON.stringify(country, null, 4), { encoding: 'utf8' })
// })