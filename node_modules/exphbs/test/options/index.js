var assert = require('chai').assert;
var request = require('request');
var app = require('./app');

describe('options', function() {

  before(function(done) {
    server = app.listen(3000, function() {
      done();
    });
  });

  it('should honor local options', function(done) {
    request('http://localhost:3000/local', function(err, res, body) {
      assert.include(body, 'local');
      done();
    });
  });

  it('should honor global options', function(done) {
    request('http://localhost:3000/global', function(err, res, body) {
      assert.include(body, 'global');
      done();
    });
  });

  it('should honor view options', function(done) {
    request('http://localhost:3000/view', function(err, res, body) {
      assert.include(body, 'view');
      done();
    });
  });

  it('global options will override view options', function(done) {
    request('http://localhost:3000/override1', function(err, res, body) {
      assert.include(body, 'global');
      done();
    });
  });

  it('local options will override global options', function(done) {
    request('http://localhost:3000/override2', function(err, res, body) {
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
