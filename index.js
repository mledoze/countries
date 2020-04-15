module.exports = require('./countries.json');

// const { execSync } = require('child_process');
const fs = require('fs')
// const uab = require('unique-array-objects');
// const jsonToMarkdown = require('json-to-markdown-table')
// const jsonToTable = require('json-to-table')
// const mdTable = require('markdown-table')

// const baseDirectory = '/Users/reecedaniels/dev/kwiff/_counting'

const parsedCountries = JSON.parse(fs.readFileSync(`./countries.json`).toString())

console.log(parsedCountries)

parsedCountries.forEach(country => {
  if (!fs.existsSync('./data2')) {
    fs.mkdirSync('./data2')
  }
  const lowerCaseCode = country.cca3.toLowerCase()
  const source = `./data/${lowerCaseCode}`
  fs.mkdirSync(`./data2/${lowerCaseCode}`)

  const target = `./data2/${lowerCaseCode}/${lowerCaseCode}`
  fs.copyFileSync(`${source}.geo.json`, `${target}.geo.json`)
  fs.copyFileSync(`${source}.svg`, `${target}.svg`)
  fs.copyFileSync(`${source}.topo.json`, `${target}.topo.json`)
  fs.writeFileSync(`${target}.country.json`, JSON.stringify(country, null, 4), { encoding: 'utf8' })
})