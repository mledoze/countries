var engine = require('./engine');
var option = require('./option');
var partial = require('./partial');
var helper = require('./helper');
var render = require('./render');
var block = require('./block');

function Exphbs(handlebars) {
  this.cache = {};
  this.handlebars = handlebars ||
    require('handlebars').create();

  block.register(this.handlebars);

  engine.attach(Exphbs);
  option.attach(Exphbs);
  partial.attach(Exphbs);
  helper.attach(Exphbs);
  render.attach(Exphbs);
}

function create() {
  var exphbs = new Exphbs();
  var engine = exphbs.engine.bind(exphbs);

  engine.handlebars = exphbs.handlebars;
  engine.__express = engine;
  engine.create = create;

  return engine;
}

module.exports = create();
