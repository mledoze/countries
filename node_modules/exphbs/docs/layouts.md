# Layouts

exphbs supports flexible layouts. You can set a layout as a render option or a special comment in the templates. Layouts can also be nested, no matter how deep they are.

## Content interpolation

A layout file is just a normal Handlebars template. But we put a ```{{{body}}}``` tag in the file as a placeholder where the rendered content will be inserted.

Suppose we can have a layout like this:

```html
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
  </head>
  <body>

    {{{body}}}

  </body>
</html>
```

And a page template as below:

```html
<h1>Hello world!</h1>
```

The resulting HTML of the rendered page would be:

```html
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
  </head>
  <body>

    <h1>Hello, world!</h1>

  </body>
</html>
```

## Layout names

A layout is specified with its name. A layout name is the path relative to the directory where we put layout files. By default, the layouts should be save under `views/layouts`.

Suppose we have a layout file `views/layouts/default.hbs`, the name will be `default`. File extension can be included, so `default.hbs` will also work.

The subdirectory of the path is respected. A layout file named `default.hbs` in `views/layouts/page ` would have name `page/default`.

The layouts directory can be customized with the `view layouts` application setting. For example:

```javascript
var path = require('path');

app.set('view layouts', path.join(__dirname, `views`, `custom`));
```

In this case, all layout names would be relative paths to the `views/custom` directory.

## Layout option

A layout can be specified as a [render option](#render-options). As an example, suppose we have a `default` layout and an `admin` layout, with the file structure as below:

```
.
├── app.js
└─┬ view/
  ├── admin.hbs
  ├── index.hbs
  └─┬ layouts/
    ├── admin.hbs
    └── default.hbs
```

We can set the `default` layout as default and use the `admin` layout as a special case:

```javascript
app.set('views', __dirname + '/views'));

app.locals.layout = 'default';

app.get('/', function(req, res) {
  res.render('index');
});

app.get('/admin', function(req, res) {
  res.render('admin', {
    layout: 'admin'
  });
});
```

In this example, the `/` page would use the `default` layout, and the `admin` page would use `admin`.

A layout name like `default` or `admin` is just the relative path of the template file. By default, the path is relative to `views/layouts`, but we can customize the layouts path with `view layouts` application setting:

```javascript
var path = require('path');

app.set('view layouts', path.join(__dirname, 'views', 'custom');
```

When specifying a layout, the file extension is optional. Both `default.hbs` and `default` would work.

## Layout comment

Alternative to a render option, a layout can be specified in the template with a special comment. Take the example from the previous section, instead of using a local option, we can declare a layout for the `admin` template by adding a line in the file `view/admin.hbs`:

```
{{!< admin}}
```

This comment line can be put anywhere in the template file, but it's conventional to put it on top to make it stand out.

The layout specified with a comment has higher precedence. If we also set a layout with a render option, the one in the comment will be used.

## Nested layouts

Sometimes it's convenient to have a layout belong to another layout. For example, if we are building a blogging software, we would like to have a `post` layout and a `page` layout. Since these two layouts share a large chunk of code, we could add a `default` layout as the parent of both.

*views/default.hbs*

```html
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
  </head>
  <body>

    {{{body}}}

  </body>
</html>
```

*views/post.hbs*

```html
{{!< default}}

<main id="post">

  {{{body}}}

</main>
```

*views/page.hbs*

```html
{{!< default}}

<main id="page">

  {{{body}}}

</main>
```

There are no limit on the depth of the nesting, as long as the layouts are not circular referenced. But exphbs would be smart enough to detect this kind of error.

The layout options and layout comments can be mixed. It's allowed to use a layout comment for a template and a render option for its parent, or the other way around.
