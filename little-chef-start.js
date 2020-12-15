var http = require('http');
var port = process.env.PORT || 3000;
var fs = require('fs');

http.createServer(function (req,res){
	res.writeHead(200, {'Content-Type': 'text/html'});
	fs.readFile('./login.html', null, function (err, data){
		if (err) throw err;
		res.write(data);
	});
	res.end(); 
}).listen(port);