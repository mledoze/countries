var fs = require('fs');
var path = require('path');
var assert = require('chai').assert;
var request = require('request');
var app = require('./app');

describe('partials (custom)', function() {

  before(function(done) {
    server = app.listen(3000, function() {
      done();
    });
  });

  it('can load partials in custom directory', function(done) {
    request('http://localhost:3000/', function(err, res, body) {
      assert.include(body, 'Custom header');
      assert.include(body, 'Custom footer');
      done();
    });
  });

  after(function(done) {
    server.close(function() {
      done();
    });
  });

});
