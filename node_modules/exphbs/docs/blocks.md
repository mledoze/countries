## Block inheritance

exphbs supports block inheritance as seen in other template engines. Start by defining a named block with default content in the layout, as the following example shows:

*views/layouts/default.hbs*

```html
<html>
  <body>

    {{#block "header"}}
      <h1>The default title</h1>
    {{/block}}

    {{{body}}}

  </body>
</html>
```

Then extend the block in a template that uses the layout:

*views/index.hbs*

```html
{{!< default}}

{{#extend "header"}}
  <h1>Home page</h1>
{{/extend}}

<p>
  Hello world!
</p>
```

When rendering, the content of the `extend` helper will override the default content of the block. In this example, the resulting HTML would be:

```html
<html>
  <body>

    <h1>Home page</h1>

    <p>
      Hello world!
    </p>

  </body>
</html>
```

If we don't extend the block in the template, the default content of the block will be used.
