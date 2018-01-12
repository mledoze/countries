var assert = require('chai').assert;
var request = require('request');
var app = require('./app');

describe('layouts (nested)', function() {

  before(function(done) {
    server = app.listen(3000, function() {
      done();
    });
  });

  it('should support nested layouts specified as a render option', function(done) {
    request('http://localhost:3000/', function(err, res, body) {
      assert.include(body, 'Default');
      assert.include(body, 'Page');
      assert.include(body, 'Home');
      done();
    });
  });

  it('should work with another page with same render options', function(done) {
    request('http://localhost:3000/another', function(err, res, body) {
      assert.include(body, 'Default');
      assert.include(body, 'Page');
      assert.include(body, 'Home');
      done();
    });
  });

  it('should support nested layouts specified as inline comment', function(done) {
    request('http://localhost:3000/inline', function(err, res, body) {
      assert.include(body, 'Default');
      assert.include(body, 'Page');
      assert.include(body, 'Home');
      done();
    });
  });

  it('should support deep nested layouts', function(done) {
    request('http://localhost:3000/deep', function(err, res, body) {
      assert.include(body, 'Default');
      assert.include(body, 'Page');
      assert.include(body, 'Post');
      assert.include(body, 'Home');
      done();
    });
  });

  it('should detect circular references', function(done) {
    process.stderr.write = function() {};

    request('http://localhost:3000/circular', function(err, res, body) {
      assert.include(body, 'Layouts are circular referenced');
      assert.notInclude(body, 'Home');
      done();
    });
  });

  after(function(done) {
    server.close(function() {
      done();
    });
  });

});
