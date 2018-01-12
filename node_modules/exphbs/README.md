# exphbs [![Build Status](https://travis-ci.org/gnowoel/exphbs.svg?branch=master)](https://travis-ci.org/gnowoel/exphbs)

A [Handlebars](https://github.com/wycats/handlebars.js) view engine for [Express](https://github.com/strongloop/express).

<table>
  <tr>
    <td></td>
    <td>Node.js 5.7</td>
    <td>Node.js 4.3</td>
    <td>Node.js 0.12</td>
    <td>Node.js 0.10</td>
  </tr>
  <tr>
    <td>Express 4</td>
    <td>✓</td>
    <td>✓</td>
    <td>✓</td>
    <td>✓</td>
  </tr>
  <tr>
    <td>Express 3</td>
    <td>✓</td>
    <td>✓</td>
    <td>✓</td>
    <td>✓</td>
  </tr>
</table>

## Features

Layouts:

  * Declaring layout with a render option or template comment (`{{!< layout}}`)
  * Nested layouts with arbitrary depth

Partials:

  * Autoloading from defined directory (defaults to `views/partials`)
  * Namespaced partial names (based on relative paths)
  * Dynamically applying changes during development

Helpers:

  * Autoloading from defined directory (defaults to `views/helpers`)

Block inheritance:

  * Defining named blocks in layouts then extend them in templates

Variables:

  * Defining `@variables` that can be accessed from any context in a template

Precompiling:

  * Templates and partials are precompiled and cached in production

Instances:

  * Creating a new instance of separate cache
  * Instantiating with user-provided Handlebars object

## Getting started

Installation:

```bash
$ npm install exphbs
```

Registering view engine:

```javascript
app.engine('hbs', require('exphbs'));
app.set('view engine', 'hbs');
```

Default directory structure:

```
.
├── app.js
└─┬ views/
  ├── index.hbs
  ├── helpers/
  ├── layouts/
  └── partials/
```

## Example

Check out [example](example) directory for a complete example. You can play around with it on [Runnable](http://code.runnable.com/VZi1SrKlnf0d4_ps/expresss-handlebars-example-for-node-js).

## Docs

  * [View engine](docs/engine.md)
  * [Render options](docs/options.md)
  * [Variables](docs/variables.md)
  * [Layouts](docs/layouts.md)
  * [Partials](docs/partials.md)
  * [Helpers](docs/helpers.md)
  * [Block inheritance](docs/blocks.md)

## Tests

```bash
$ npm install
$ npm test
```

## License

MIT
