$(document).ready(function(){
    // Testing Jquery
  console.log('jquery is working!');

  let correo = $('#usmail').html();
  // document.getElementById('usmail').innerHTML;

     const postData = {correo: $('#usmail').html()};
      
    $.post('backend.php', postData, (response) => {
      console.log(response);
     
      fetchTasks();
    });


      function fetchTasks() {
    $.ajax({
      url: 'backend.php',
      type: 'GET',
      success: function(response) {
        const tasks = JSON.parse(response);
        let template = '';
        tasks.forEach(task => {
          template += `
                  <tr>
                  <td>${task.Nombre}</td>
                  <td>
                  <a href="#" class="task-item">
                    ${task.Correo} 
                  </a>
                  </td>
                 
                  </tr>
                `
        });
        $('#contactos').html(template);
      }
    });
  }


        let p = document.getElementById("add"); // Encuentra el elemento "p" en el sitio
      p.onclick = ()=>{
        let Mailamigo= prompt("Ingresa el correo de tu amigo:");
        const Datos = {correo1: $('#usmail').html(),correo2:Mailamigo}   
            $.post('addFriend.php', Datos, (response) => {
      console.log(response);
     fetchTasks();
      
    });

      } 



});