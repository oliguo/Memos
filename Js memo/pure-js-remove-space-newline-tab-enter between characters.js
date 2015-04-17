1.remove newline/tab/enter characters
string.toString().replace(/[\n\r\t]/g, "")
reference:
http://princepthomas.blogspot.hk/2010/04/javascript-to-remove-newline.html
2.remove space between words
<<<<<<< HEAD
string = string.replace(/^\s+|\s+$/g, "");
reference:
http://stackoverflow.com/questions/7635952/javascript-how-to-remove-all-extra-spacing-between-words
=======
referencd:
http://kpdirection.com/technology/javascript-replace-is-not-a-function/
>>>>>>> FETCH_HEAD
