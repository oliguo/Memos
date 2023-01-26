var pwchars = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWYXZ@!_.*/()[]-';
var passwordlength = 16;    // do we want that to be dynamic?  no, keep it simple :)
// eslint-disable-next-line compat/compat
var randomWords = new Int32Array(passwordlength);

var value = '';

var i;

// First we're going to try to use a built-in CSPRNG
// eslint-disable-next-line compat/compat
if (window.crypto && window.crypto.getRandomValues) {
    // eslint-disable-next-line compat/compat
    window.crypto.getRandomValues(randomWords);
} else if (window.msCrypto && window.msCrypto.getRandomValues) {
    // Because of course IE calls it msCrypto instead of being standard
    window.msCrypto.getRandomValues(randomWords);
} else {
    // Fallback to Math.random
    for (i = 0; i < passwordlength; i++) {
        randomWords[i] = Math.floor(Math.random() * pwchars.length);
    }
}

for (i = 0; i < passwordlength; i++) {
    value += pwchars.charAt(Math.abs(randomWords[i]) % pwchars.length);
}

console.log(value);
