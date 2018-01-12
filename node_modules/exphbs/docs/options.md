# Render options

From the highest precedence to the lowest, render options can be specified in the following ways:

  * Local options
  * Global options
  * View options

In the following sections, we give examples for defining the variable `name` in different ways. In all cases, the variable can be accessed with `{{name}}` in the templates.

## Local options

Variable `name` is available only when rendering the current view:

```javascript
app.get('/', function(req, res) {
  res.render('index', {
    name: 'value';
  });
});
```

Local options have the highest precedence, which will override the same options specified otherwise.

## Global options

Variable `name` is applied each time when rendering a view. In this case, we can use `{{name}}` to get the value in both `index.hbs` and `another.hbs` templates:

```javascript
app.locals.name = 'value';

app.get('/', function(req, res) {
  res.render('index');
});

app.get('/another', function(req, res) {
  res.render('another');
});
```

Global options have lower precedence than the local ones. If the same variable is defined in multiple ways, the one with higher precedence will override the lower one.

## View options

Like a global option, variable `name` defined as a view option is available when redering any view (both `index.hbs` or `another.hbs` in this case), but with a lower precedence:

```javascript
app.set('view options', {
  name: 'value';
});

app.get('/', function(req, res) {
  res.render('index');
});

app.get('/another', function(req, res) {
  res.render('another');
});
```

Global options and view options are useful for setting default values. For a special case, we can then use a local option to override the default value.
