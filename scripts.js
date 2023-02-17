//Archivo para configurar la parte del cliente

//Configuracion de la conexion por parte del cliente
const socketIO = io("http://localhost:3000",{ //asignar el dominio
    secure:true,
    transports:['websocket','polling'] 
});




let AddFriend = document.getElementById('add');
 let bar = document.getElementById('bar');
 let mjs = "";

AddFriend.addEventListener('click',()=>{
	let Friend = prompt('Ingresa el correo de tu amigo para agregarlo');

socketIO.emit('add',Friend);
	//$(jq).post( "Sala.php",Friend );

});
