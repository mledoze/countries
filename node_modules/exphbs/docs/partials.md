# Partials

By default, files in the `views/partials` directory will be automatically registered as partials. The directory can be customized with the `view partials` application setting. The partial names are based on the relative path from the defined directory.

Partials can also be manually registered with the exposed `handlebars` object.

## Autoloading

Suppose we have two partials under `views/partials`, one for header and one for footer:

*views/partials/header.hbs*

```html
<header>
  This is a header
</header>
```

*views/partials/footer.hbs*

```html
<footer>
  This is a footer
</footer>
```

These partials will be automatically registered. The names are the paths relative to the `views/partials` directory. In this case, we have `header` and `footer`.

To include a partial in the template, use the `{{> partial}}` syntax:

```html
{{> header}}

<main>
  This is the main part.
</main>

{{> footer}}
```

The template would result to the following HTML:

```html
<header>
  This is a footer
</header>

<main>
  This is the main part.
</main>

<footer>
  This is a footer
</footer>
```

Changes in a partial will be applied dynamically during development. No need to restart the server just because of an updated partial.

In production, the partials are precompiled and cached. They are always available even if the underlying files are changed or deleted.


## Namespace

The names of the automatically registered partials are namespaced. Take the above example, if we instead save the header and footer partials under `views/partials/shared`, the partial names would become `shared/header` and `shared/footer`.

To include them in the template:

```html
{{> shared/header}}

<main>
  This is the main part.
</main>

{{> shared/footer}}
```

## Custom directory

You can customize the partials directory by changing the `views partials` application setting, for example:

```javascript
app.set('view partials', path.join(__dirname, 'views', 'custom'));
```

Now, the partials in `views/custom` directory will be autoloaded.

## Manually registering

The exposed `handlebars` object can be used to manually register a partial. Here's an example:

```javascript
var exphbs = require('exphbs');
var handlebars = exphbs.handlebars;

handlebars.registerPartial('sidebar', '<contents of sidebar>');
});
```

Suppose it's saved in `partial.js`. We just require it to run the code:

```javascript
require('./partial');
```

If we use `exphbs.create()` to create a new instance of Handlebars, the instance must be passed around. The updated code would look like:

```javascript

module.exports = function(handlebars) {
  handlebars.registerPartial('sidebar', '<contents of sidebar>');
};
```

When requiring, we pass in the Handlebars object:

```javascript
var exphbs = require('exphbs').create();
var handlebars = exphbs.handlebars;

require('./partial')(handlebars);
```
