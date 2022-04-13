const express = require('express');
const app = express();
const http = require('http');
const server = http.createServer(app);
const { Server } = require("socket.io");
const io = new Server(server);
var path = require('path');

// app.get('/', (req, res) => {
//     res.sendFile(__dirname + 'www');
//   });


app.use(express.static(path.join(__dirname, 'www'))); 

server.listen(3000, () => {
  console.log('listening on *:3000');
});

io.on('connection', (socket) => {
    console.log('a user connected');






    socket.on('disconnect', () =>{
        console.log('a user disconnected')
    })




  });