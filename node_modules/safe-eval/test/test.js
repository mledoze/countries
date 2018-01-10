/* global describe, it */

var assert = require('assert')
var safeEval = require(__dirname + '/..')

describe('safe-eval', function () {
  it('should perform string concatenation', function () {
    var code = '"app" + "le"'
    var evaluated = safeEval(code)
    assert(evaluated === 'apple')
  })

  it('should perform simple math', function () {
    var code = '9 + 1'
    var evaluated = safeEval(code)
    assert(evaluated === 10)
  })

  it('should have access to standard JavaScript library', function () {
    var code = 'Math.floor(22/7)'
    var evaluated = safeEval(code)
    assert(evaluated === Math.floor(22 / 7))
  })

  it('should parse JSON', function () {
    var code = '{name: "Borat", hobbies: ["disco dance", "sunbathing"]}'
    var evaluated = safeEval(code)
    assert(evaluated.name === 'Borat')
    assert(evaluated.hobbies[0] === 'disco dance')
    assert(evaluated.hobbies[1] === 'sunbathing')
  })

  it('should parse a function expression', function () {
    var code = '(function square(b) { return b * b; })(5)'
    var evaluated = safeEval(code)
    assert(evaluated === 25)
  })

  it('should not have access to Node.js objects', function () {
    var code = 'process'
    assert.throws(function () {
      safeEval(code)
    })
  })

  it('should support context API', function () {
    var code = '{pid: process.pid, apple: a()}'
    var context = {
      process: process,
      a: function () { return 'APPLE' }
    }
    var evaluated = safeEval(code, context)
    assert(evaluated.pid > 0)
    assert(evaluated.apple === 'APPLE')
  })

  it('should include vm options', function () {
    var code = 'foo'
    try {
      safeEval(code, {}, { filename: 'bar.js', timeout: 1 })
    } catch (e) {
      assert(e.stack.indexOf('bar.js') > 0)
    }
  })
})
