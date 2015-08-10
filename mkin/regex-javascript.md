# http://krasimirtsonev.com/blog/article/Javascript-template-engine-in-just-20-line

# http://www.rexegg.com/regex-quickstart.html


var template = 'My name is __name__ and my language is __language__.';

template.match(/__([^__]+)__/g);

regex = new Regexp("__([^__]+)__", "g")

regex.exec(template);



template = "Hello, my name is __name__. I\'m __age__ years old.";

var re = /<%([^%>]+)?%>/g;

