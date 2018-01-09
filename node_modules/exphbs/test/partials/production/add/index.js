var fs = require('fs');
var path = require('path');
var assert = require('chai').assert;
var request = require('request');
var handlebars = require('handlebars');
var app = require('./app');

describe('partials (production (add))', function() {

  before(function(done) {
    process.stderr.write = function() {};

    handlebars.partials = {};

    server = app.listen(3000, function() {
      done();
    });
  });

  beforeEach(function(done) {
    fs.exists(path.resolve(__dirname, 'views/partials/footer.hbs'), function(exists) {
      if (exists) {

        fs.unlink(path.resolve(__dirname, 'views/partials/footer.hbs'), function(err) {
          if (err) return done(err);

          done();
        });
      } else {
        done();
      }
    });
  });

  it('should generate an error when including nonexistent partials', function(done) {
    request('http://localhost:3000/', function(err, res, body) {
      assert.include(body, 'Error');
      done();
    });
  });


  it('should not work with newly added partials', function(done) {
    fs.writeFile(path.resolve(__dirname, 'views/partials/footer.hbs'), 'Footer', function(err) {
      if (err) return done(err);

      request('http://localhost:3000/', function(err, res, body) {
        assert.include(body, 'Error');

        done();
      });
    });
  });

  it('should have deleted the added partials', function(done) {
    fs.exists(path.resolve(__dirname, 'views/partials/footer.hbs'), function(exists) {
      assert.notOk(exists);
      done();
    });
  });

  afterEach(function(done) {
    fs.exists(path.resolve(__dirname, 'views/partials/footer.hbs'), function(exists) {
      if (exists) {

        fs.unlink(path.resolve(__dirname, 'views/partials/footer.hbs'), function(err) {
          if (err) return done(err);

          done();
        });
      } else {
        done();
      }
    });
  });

  after(function(done) {
    server.close(function() {
      done();
    });
  });

});
