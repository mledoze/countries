var assert = require('chai').assert;
var request = require('request');
var app = require('./app');

var server;

describe('engine (express)', function() {

  before(function(done) {
    server = app.listen(3000, function() {
      done();
    });
  });

  it('can register view engine with exphbs.__express', function(done) {
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
