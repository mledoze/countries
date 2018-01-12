var assert = require('chai').assert;
var request = require('request');
var app = require('./app');

describe('helpers (custom)', function() {

  before(function(done) {
    server = app.listen(3000, function() {
      done();
    });
  });

  it('should autoload Handlebars helpers from custom directory', function(done) {
    request('http://localhost:3000/', function(err, res, body) {
      assert.include(body, '<a href="http://www.google.com/">Google</a>');
      done();
    });
  });

  after(function(done) {
    server.close(function() {
      done();
    });
  });

});
