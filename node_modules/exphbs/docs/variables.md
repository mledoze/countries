# Variables

A variable can be defined as a [render option](#render-options). In the above section, we have seen examples for defining a variable in three different ways (a local option, a global option and a view option).

We can also define a variable in Handlebars data channel. These variables can either be global ones, which applies whenever `render()` is executed, or local ones, which applies to the current `render()` method. In both cases, they can be accessed in the templates with syntax `{{@variable}}`.

Here is an example of defining a global @variable::

```javascript
app.locals.data = {
  name: 'value';
};

app.get('/', function(req, res) {
  res.render('index');
});
```

Alternatively, we can define it locally:

```javascript
app.get('/', function(req, res) {
  res.render('index', {
    data: {
      name: 'another value'
    }
  });
});
```

In the templates, we use `{{@name}}` to access the variable, as shown below:

```html
<p>The value is {{@name}}.</p>
```

Local `@variables` have higher precedence than the global ones. If we define the same `@variable` in both ways, the local one will be used.

`@variables` are different from render options in that they can be accessed from any context in a template. So, it's handy to use them for commonly used variables like `@siteName` or `@currentUser`.

In the following example, we will define `@production` to check if it's running in production:

```
app.locals.data = {
  production: app.get('env') === 'production'
};
```

After that, we can use it to check the environment anywhere in the templates:

```html
{{#if @production}}
  <!-- do something -->
{{/if}}

{{#anotherContext}}

  {{#if @production}}
    <!-- do something -->
  {{/if}}

{{/anotherContext}}
```
