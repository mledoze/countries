module.exports = function(handlebars) {
  return function() {
    var year = new Date().getFullYear();

    return new handlebars.SafeString(
      'Copyright &copy; ' + year
    );
  };
};
