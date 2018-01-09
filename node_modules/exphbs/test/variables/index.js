var assert = require('chai').assert;
var request = require('request');
var app = require('./app');

describe('variables', function() {

  before(function(done) {
    server = app.listen(3000, function() {
      done();
    });
  });

  it('should honor local @variables', function(done) {
    request('http://localhost:3000/local', function(err, res, body) {
      assert.include(body, 'local');
      done();
    });
  });


  it('should honor global @variables', function(done) {
    request('http://localhost:3000/global', function(err, res, body) {
      assert.include(body, 'global');
      done();
    });
  });

  it('local @variables should override global @variables', function(done) {
    request('http://localhost:3000/override', function(err, res, body) {
      assert.include(body, 'local');
      done();
    });
  });

  after(function(done) {
    server.close(function() {
      done();
    });
  });

});
