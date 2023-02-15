
const express = require('express'); //utilizando el modulo de node js "express"
const app = express();
const http = require('http').createServer(app); //utilizando el modulo de node js "http"
const io = require('socket.io')(http); //utilizando socket io
const port = process.env.PORT || 3000; // variable para configurar el puerto

app.get('/',(req,res,next)=>{ 
    res.send('Hola mundo');
});

//Funciones para la conexion del websocket
io.on('connection',(socketIO)=>{
    console.log("New conection");
// //Receptor del mensaje
//     socketIO.on('SendMessage',(data)=>{
//       console.log(data);
// //Emision del mensaje
//     io.emit('SendMessage',data);
//     });


});


var mysql = require("mysql");
var connection = mysql.createConnection({
    host: "localhost",
    port: 3306,
    user: "root",
    password: "root",
    database: "ChatPersonal"
});

connection.connect(function (error) {
    console.log("Database connected: " + error);
});

//Asignacion del pueto al servidor
http.listen(port,()=>{
console.log('Puerto: '+port);
});
