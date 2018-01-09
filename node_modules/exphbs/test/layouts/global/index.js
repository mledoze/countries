var assert = require('chai').assert;
var request = require('request');
var app = require('./app');

describe('layouts (global)', function() {

  before(function(done) {
    server = app.listen(3000, function() {
      done();
    });
  });

  it('can use layout file specified as a global option', function(done) {
    request('http://localhost:3000/', function(err, res, body) {
      assert.include(body, 'Default');
      assert.include(body, 'Home');
      done();
    });
  });

  it('should be override by a local layout', function(done) {
    request('http://localhost:3000/override', function(err, res, body) {
      assert.include(body, 'Page');
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
