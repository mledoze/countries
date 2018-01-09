var assert = require('chai').assert;
var request = require('request');
var app = require('./app');

describe('blocks', function() {

  before(function(done) {
    server = app.listen(3000, function() {
      done();
    });
  });

  it('extend() returns nothing', function(done) {
    request('http://localhost:3000/', function(err, res, body) {
      assert.equal(body, '\nLorem ipsum.\n');
      done();
    });
  });

  it('empty extend falls back to default', function(done) {
    request('http://localhost:3000/default', function(err, res, body) {
      assert.include(body, '<h1>Default</h1>');
      done();
    });
  });

  it('non-empty extend overrides default', function(done) {
    request('http://localhost:3000/override', function(err, res, body) {
      assert.include(body, '<h1>Home</h1>');
      done();
    });
  });

  after(function(done) {
    server.close(function() {
      done();
    });
  });

});
