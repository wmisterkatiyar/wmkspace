about
install
console

with apache
  virtual host: request header, response with nc, first dns->IP->dir by virtual host, server name, server alias for multiple domain names, directory options, first level security: user for whole apache, 2nd Level: suPHP, user per virtual host
  
  rewrite engine: R=301, L=>last, dont process further rules. rewrite condition
  RewriteEngine On
  RewriteCond %[HTTP_HOST] !^mysite.com$ [NC]
  RewriteRule (.*) http://www.mysite.com/$1 [R=301, L]
  // flagList: http://httpd.apache.org/docs/2.4/rewrite/flags.html
  
  file permissions: chmod -R, chmod a+r, chmod etc.

Notice, Warning, Error, Exception

environment variables / settings
  max executino time, timezone, upload limit, module detection

importing, autoloading and PSR
  include, remote include, autoload, PSR standards
  
package manager
  composer with its reps and git reps

database connectivity
  pdo, doctrine
  $dbh = new PDO('sqlite:db.sq3');
  $dbh->query("");
  
filesystem interaction
  read, write, list, chmod, delete
  
session and cookies

web client inputs
  GET, POST, REQUEST, FILE, User-Agent detection, user ip
  upload max size, max input time
  
array manual
  scalar, vector, array functions, sort, compare, efficiency
  
string manual
  regex etc.

dateTime manual
  timezone etc.

basic constructs
  for, while, if, switch, terniary, spaceship operator
  
object oriented coding
  all oop in php style, class, interface, singleton, traits
  
event driven coding
  

debugging php
  manual: var_dump, print_r | debugger tools: 
  
sending email and debugging
  smtp debug
  
XML processing

JSON processing

php best practice