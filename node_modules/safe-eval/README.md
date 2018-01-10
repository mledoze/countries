# safe-eval [![npm version](https://badge.fury.io/js/safe-eval.svg)](https://badge.fury.io/js/safe-eval)

## What is this?

`safe-eval` lets you execute JavaScript code without having to use the much discouraged and feared upon `eval()`. `safe-eval` has access to all the standard APIs of the [V8 JavaScript Engine](https://code.google.com/p/v8/). By default, it does not have access to the Node.js API, but can be given access using a conext object. It is implemented using [node's vm module](https://nodejs.org/api/vm.html).

Currently, it works only with Node.js, and the JavaScript code must be an expression (something which evaluates to a value).

## Installation

```sh
npm install safe-eval --save
```

## Usage

```js
var safeEval = require('safe-eval')
```

**safeEval(code, [context], options)**

`code` is the JavaScript code you want to execute.

`context` is an object of methods and properties, these methods and properties are interpreted as global objects in `code`. Be careful about the objects you are passing to the context API, because they can completely defeat the purpose of `safe-eval`.

`options` is the [options object](https://nodejs.org/api/vm.html) for the vm executing the code.

### Examples

```js
// string concatenation
var code = '"app" + "le"'
var evaluated = safeEval(code) // "apple"
```

```js
// math
var code = 'Math.floor(22/7)'
var evaluated = safeEval(code) // 3.142857142857143
```

```js
// JSON
var code = '{name: "Borat", hobbies: ["disco dance", "sunbathing"]}'
var evaluated = safeEval(code) // {name: "Borat", hobbies: ["disco dance", "sunbathing"]}
```

```js
// function expression
var code = '(function square(b) { return b * b; })(5)'
var evaluated = safeEval(code) // 25
```

```js
// no access to Node.js objects
var code = 'process'
safeEval(code) // THROWS!
```

```js
// your own context API - access to Node's process object and a custom function
var code = '{pid: process.pid, apple: a()}'
var context = {
  process: process,
  a: function () { return 'APPLE' }
}
var evaluated = safeEval(code, context) // { pid: 16987, apple: 'APPLE' }
```

```js
// pass an options object to the vm
var code = 'process'
safeEval(code, {}, { filename: 'myfile.js'}) // myfile.js can be seen in the stacktrace
```

## License (MIT)

Copyright (c) 2016 Hage Yaapa

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

