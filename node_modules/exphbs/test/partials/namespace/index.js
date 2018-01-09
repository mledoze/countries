var fs = require('fs');
var path = require('path');
var assert = require('chai').assert;
var request = require('request');
var app = require('./app');

describe('partials (autoload)', function() {

  before(function(done) {
    server = app.listen(3000, function() {
      done();
    });
  });

  it('partial names should be namespaced', function(done) {
    request('http://localhost:3000/', function(err, res, body) {
      assert.include(body, 'Namespaced header');
      assert.include(body, 'Namespaced footer');
      done();
    });
  });

  after(function(done) {
    server.close(function() {
      done();
    });
  });

});
