var fs = require('fs');
var path = require('path');
var assert = require('chai').assert;
var request = require('request');
var app = require('./app');

var content;

describe('cache', function() {

  before(function(done) {
    server = app.listen(3000, function() {
      done();
    });
  });

  beforeEach(function(done) {
    fs.readFile(path.resolve(__dirname, 'views/index.hbs'), function(err, data) {
      if (err) return done(err);

      content = data;
      done();
    });
  });

  it('should not cache compiled templates by default', function(done) {
    request('http://localhost:3000/', function(err, res, body) {
      fs.writeFile(path.resolve(__dirname, 'views/index.hbs'), 'Changed', function(err) {
        if (err) return done(err);

        request('http://localhost:3000/', function(err, res, body) {
          assert.include(body, 'Changed');
          done();
        });
      })
    });
  });

  it('should cache compiled templates if rendered with option `{ cache: true }`', function(done) {
    request('http://localhost:3000/cached', function(err, res, body) {
      fs.writeFile(path.resolve(__dirname, 'views/index.hbs'), 'Changed', function(err) {
        if (err) return done(err);

        request('http://localhost:3000/cached', function(err, res, body) {
          assert.include(body, 'Home');
          done();
        });
      })
    });
  });

  afterEach(function(done) {
    fs.writeFile(path.resolve(__dirname, 'views/index.hbs'), content, function(err) {
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
