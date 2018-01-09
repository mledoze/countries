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

  it('should autoload partials in `views/partials` directory', function(done) {
    request('http://localhost:3000/', function(err, res, body) {
      assert.include(body, 'Header');
      assert.include(body, 'Footer');
      done();
    });
  });

  after(function(done) {
    server.close(function() {
      done();
    });
  });

});
