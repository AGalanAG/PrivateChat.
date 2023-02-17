
const express = require('express'); //utilizando el modulo de node js "express"
const app = express();
const http = require('http').createServer(app); //utilizando el modulo de node js "http"
const io = require('socket.io')(http); //utilizando socket io
const port = process.env.PORT || 3000; // variable para configurar el puerto
let Correo='';

app.get('/',(req,res,next)=>{ 
    res.send('Hola mundo');
});

//Funciones para la conexion del websocket
io.on('connection',(socketIO)=>{
    console.log("New conection");
      socketIO.on('add',(correo)=>{
    EmailFriend=console.log(correo);
    consulta(correo);

});
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

connection.connect(function(err) {
  if (err) throw err;
  console.log("Connected!");
});
function  consulta(EmailFriend){
    sql = "CALL ExisUser(?);";
//sql = "select FullName as nombre from user where email = 'Alberto@gmail.com'";
connection.query(sql,EmailFriend,(error,result)=>{ 
    // Si utilizamos una consulta directa podemos iterar sobre el obreto "result"
    //Pero utilizando un SP nos devuelve un arreglo de objetos, tenemos que iterar
    //Sobre el result[0] para poder acceder a los datos
   result[0].forEach( (result) => {
  console.log(result.nombre);
  Correo=result.nombre;
  //console.log("guardado:"+Correo);
});

});

}




//Asignacion del pueto al servidor
http.listen(port,()=>{
console.log('Puerto: '+port);
});
