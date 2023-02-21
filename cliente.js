$(document).ready(function(){
	  // Testing Jquery
  console.log('jquery is working!');

  let correo = $('#usmail').html();
  // document.getElementById('usmail').innerHTML;

     const postData = {
      correo: $('#usmail').html()};
    	
    $.post('serv.php', postData, (response) => {
      console.log(response);
     
      fetchTasks();
    });


      function fetchTasks() {
    $.ajax({
      url: 'serv.php',
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

});