var fs = require('fs');
var path = require('path');
var assert = require('chai').assert;
var request = require('request');
var app = require('./app');

describe('partials (production (render))', function() {

  before(function(done) {
    app.set('env', 'production');
    server = app.listen(3000, function() {
      done();
    });
  });

  beforeEach(function(done) {
    fs.readFile(path.resolve(__dirname, 'views/partials/header.hbs'), function(err, data) {
      if (err) return done(err);

      content = data;
      done();
    });
  });

  it('should work with original partials', function(done) {
    request('http://localhost:3000/', function(err, res, body) {
      assert.include(body, 'Header');
      assert.include(body, 'Footer');
      done();
    });
  });

  it('should still use original partials on changes', function(done) {
    request('http://localhost:3000/', function(err, res, body) {
      fs.writeFile(path.resolve(__dirname, 'views/partials/header.hbs'), 'Changed', function(err) {
        if (err) return done(err);

        request('http://localhost:3000/', function(err, res, body) {
          assert.include(body, 'Header');
          assert.include(body, 'Footer');
          done();
        });
      })
    });
  });

  it('should still work after restoring partials', function(done) {
    request('http://localhost:3000/', function(err, res, body) {
      assert.include(body, 'Header');
      assert.include(body, 'Footer');
      done();
    });
  });

  afterEach(function(done) {
    fs.writeFile(path.resolve(__dirname, 'views/partials/header.hbs'), content, function(err) {
      if (err) return done(err);

      done();
    });
  });

  after(function(done) {
    server.close(function() {
      done();
    });
  });

});
