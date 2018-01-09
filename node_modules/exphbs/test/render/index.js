var assert = require('chai').assert;
var request = require('request');
var app = require('./app');

describe('render', function() {

  before(function(done) {
    server = app.listen(3000, function() {
      done();
    });
  });

  it('should render a Handlebars template', function(done) {
    request('http://localhost:3000/', function(err, res, body) {
      assert.include(body, 'Home');
      done();
    });
  });

  after(function(done) {
    server.close(function() {
      done();
    });
  });

});
