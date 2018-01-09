module.exports = function(handlebars) {
  return function(object) {
    var url = handlebars.escapeExpression(object.url);
    var text = handlebars.escapeExpression(object.text);

    return new handlebars.SafeString(
      '<a href="' + url + '">' + text + '</a>'
    );
  };
}
