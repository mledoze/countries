var assert = require('chai').assert;
var request = require('request');
var app = require('./app');

describe('layouts (custom)', function() {

  before(function(done) {
    server = app.listen(3000, function() {
      done();
    });
  });

  it('can use layout file in custom directory passed as a render option', function(done) {
    request('http://localhost:3000/', function(err, res, body) {
      assert.include(body, 'Default');
      assert.include(body, 'Home');
      done();
    });
  });

  it('can use layout file in custom directory with extension', function(done) {
    request('http://localhost:3000/extension', function(err, res, body) {
      assert.include(body, 'Default');
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
