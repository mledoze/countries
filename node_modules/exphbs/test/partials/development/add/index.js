var fs = require('fs');
var path = require('path');
var assert = require('chai').assert;
var request = require('request');
var app = require('./app');

describe('partials (development (add))', function() {

  before(function(done) {
    server = app.listen(3000, function() {
      done();
    });
  });

  it('should generate an error when including nonexistent partials', function(done) {
    request('http://localhost:3000/', function(err, res, body) {
      process.stderr.write = function() {};
      assert.include(body, 'The partial footer could not be found');
      done();
    });
  });


  it('should work with newly added partials', function(done) {
    fs.writeFile(path.resolve(__dirname, 'views/partials/footer.hbs'), 'Footer', function(err) {
      if (err) return done(err);

      request('http://localhost:3000/', function(err, res, body) {
        assert.include(body, 'Header');
        assert.include(body, 'Footer');

        fs.unlink(path.resolve(__dirname, 'views/partials/footer.hbs'), function(err) {
          if (err) return done(err);

          done();
        });
      });
    });
  });

  it('should have deleted the added partials', function(done) {
    request('http://localhost:3000/', function(err, res, body) {
      process.stderr.write = function() {};
      assert.include(body, 'The partial footer could not be found');
      done();
    });
  });

  after(function(done) {
    server.close(function() {
      done();
    });
  });

});
