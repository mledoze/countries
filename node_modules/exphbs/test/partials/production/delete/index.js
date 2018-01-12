var fs = require('fs');
var path = require('path');
var assert = require('chai').assert;
var request = require('request');
var handlebars = require('handlebars');
var app = require('./app');

describe('partials (production (delete))', function() {

  before(function(done) {
    process.stderr.write = function() {};

    handlebars.partials = {};

    server = app.listen(3000, function() {
      done();
    });
  });

  beforeEach(function(done) {
    fs.exists(path.resolve(__dirname, 'views/partials/footer.hbs'), function(exists) {
      if (!exists) {

        fs.writeFile(path.resolve(__dirname, 'views/partials/footer.hbs'), 'Footer', function(err) {
          if (err) return done(err);

          done();
        });
      } else {
        done();
      }
    });
  });

  it('should work with original partials', function(done) {
    request('http://localhost:3000/', function(err, res, body) {
      assert.include(body, 'Header');
      assert.include(body, 'Footer');
      done();
    });
  });

  it('should still work after deleting partial files', function(done) {
    fs.unlink(path.resolve(__dirname, 'views/partials/footer.hbs'), function(err) {
      if (err) return done(err);

      request('http://localhost:3000/', function(err, res, body) {
        assert.include(body, 'Header');
        assert.include(body, 'Footer');
        done();
      });
    });
  });

  it('should still work after restoring deleted partials', function(done) {
    request('http://localhost:3000/', function(err, res, body) {
      assert.include(body, 'Header');
      assert.include(body, 'Footer');
      done();
    });
  });

  afterEach(function(done) {
    fs.exists(path.resolve(__dirname, 'views/partials/footer.hbs'), function(exists) {
      if (!exists) {

        fs.writeFile(path.resolve(__dirname, 'views/partials/footer.hbs'), 'Footer', function(err) {
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
