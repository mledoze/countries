var assert = require('chai').assert;
var request = require('request');
var app = require('./app');

describe('layouts (inline)', function() {

  before(function(done) {
    server = app.listen(3000, function() {
      done();
    });
  });

  it('should support layout specified as inline comment', function(done) {
    request('http://localhost:3000/', function(err, res, body) {
      assert.include(body, 'Default');
      assert.include(body, 'Home');
      done();
    });
  });

  it('should support layout specified as inline comment with a directory', function(done) {
    request('http://localhost:3000/directory', function(err, res, body) {
      assert.include(body, 'Page');
      assert.include(body, 'Home');
      done();
    });
  });

  it('layout specified as inline comment should override the one in options', function(done) {
    request('http://localhost:3000/override', function(err, res, body) {
      assert.notInclude(body, 'Default');
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
