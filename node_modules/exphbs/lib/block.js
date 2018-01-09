function blocks(context) {
  return context.__blocks || (context.__blocks = {});
}

function register(handlebars) {
  var helpers = {
    block: function(name, options) {
      var context = this;
      var rendered = options.fn(context);

      rendered = rendered.trim();

      return blocks(context)[name] || rendered;
    },

    extend: function(name, options) {
      var context = this;
      var rendered = options.fn(context);

      rendered = rendered.trim();

      blocks(context)[name] = rendered;
    }
  };

  handlebars.registerHelper(helpers);
}

exports.register = register;
