import test from 'ava';
import {get as getToken} from './index';

const browser = require('webdriverio').remote({
    user: process.env.SAUCE_USERNAME,
    key: process.env.SAUCE_ACCESS_KEY,
    host: 'localhost',
    port: 4445,
    desiredCapabilities: {
        'browserName': 'chrome',
        'tunnel-identifier': process.env.TRAVIS_JOB_NUMBER
    }
});

test('check if what we generate equals to what translate.google.com generates', async t => {
    try {
        const token = await getToken('hello');
        const returned = await browser
            .init()
            .url('http://translate.google.com')
            .timeoutsAsyncScript(10000)
            .executeAsync((tokenName, callback) => {
                setTimeout(function () {
                    injectAjaxInterceptor(tokenName, callback);
                    document.getElementById('source').value = 'hello'; // eslint-disable-line no-undef
                }, 0);

                function injectAjaxInterceptor(tokenName, callback) {
                    /* eslint-disable no-undef */
                    XMLHttpRequest.prototype.reallySend = XMLHttpRequest.prototype.send;
                    XMLHttpRequest.prototype.send = function (data) {
                    /* eslint-enable no-undef */
                        var _this = this;
                        setTimeout(function () {
                            if (_this.responseURL.indexOf('single') !== -1) {
                                var regex = new RegExp('[?&]' + tokenName + '(=([^&#]*)|&|#|$)');
                                var results = regex.exec(_this.responseURL);
                                callback(results[2]);
                            }
                        }, 5000);
                        this.reallySend(data);
                    };
                }
            }, token.name);

        t.is(token.value, returned.value);
    } catch (err) {
        t.fail(err);
    } finally {
        browser.end();
    }
});
