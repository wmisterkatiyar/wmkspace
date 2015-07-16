install nodejs
install npm
mkdir easyrtc
cd easyrtc
curl -O http://easyrtc.com/files/easyrtc_server_example.zip
unzip easyrtc_server_example.zip
npm install
iptables -I INPUT -p tcp --dport 8080 -j ACCEPT
edit server.js to assure: 
> http.createServer(httpApp).listen(8080, '0.0.0.0');
npm install forever
forever start server.js
forever list