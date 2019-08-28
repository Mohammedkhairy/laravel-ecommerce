var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var redis = require('redis');

http.listen(6000, function(){
    console.log('Listening on Port 3000');
});