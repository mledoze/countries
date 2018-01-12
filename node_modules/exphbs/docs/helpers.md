# Helpers

By default, modules located in `views/helpers` will be autoloaded as view helpers. The directory can be customized with the `view helpers` application setting. Note subdirectories are not supported. A module in a subdirectory will be simply ignored.

exphbs also exposes the vanilla `handlebars` object, which can be used to manually register helpers.

## Autoloading

A helper module should expose a single function with signature `function(handlebars)`. When registering, the filename (without extension) of the module will be used as the helper name.

Suppose we create a file `views/helpers/hello.js` with the following content:

```javascript
module.exports = function(handlebars) {
  return function() {
    return new handlebars.SafeString('Hello!');
  };
}
```

The `hello` helper will be automatically registered. We can use the helper in a template as below:

```html
{{hello}}
```

The resulting HTML will be:

```html
Hello!
```

## Custom directory

The default directory for helpers is `views/helpers`. We can customize it by changing the `view helpers` application setting. For example:

```javascript
app.set('view helpers', __dirname + '/custom');
```

Now, the helpers in `views/custom` directory will be autoloaded.

## Manually registering

The exposed `handlebars` object can be used to manually register a helper. Here's an example:

```javascript
var exphbs = require('exphbs');
var handlebars = exphbs.handlebars;

handlebars.registerHelper('hello', function() {
  return new handlebars.SafeString('Hello!');
});
```

Suppose it's saved in `helper.js`. We just require it to run the code:

```javascript
require('./helper');
```

If we use `exphbs.create()` to create a new instance of Handlebars, the instance must be passed around. The updated code would look like:

```javascript

module.exports = function(handlebars) {
  handlebars.registerHelper('hello', function() {
    return new handlebars.SafeString('Hello!');
  });  
};
```

When requiring, we pass in the Handlebars object:

```javascript
var exphbs = require('exphbs').create();
var handlebars = exphbs.handlebars;

require('./helper')(handlebars);
```
