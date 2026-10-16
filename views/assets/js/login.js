$("#signup").click(function() {
$("#first").fadeOut("fast", function() {
$("#second").fadeIn("fast");
});
});

$("#signin").click(function() {
$("#second").fadeOut("fast", function() {
$("#first").fadeIn("fast");
});
});


  
         $(function() {
           $("form[name='login']").validate({
             rules: {
               user: "required",
               
               pass: {
                 required: true,
                 
               }
             },
              messages: {
               user: "Por favor introduce usuario",
              
               pass: {
                 required: "Por favor introduce contraseña",
                
               }
               
             },
             submitHandler: function(form) {
               form.submit();
             }
           });
         });
         


$(function() {
  
  $("form[name='registration']").validate({
    rules: {
      usuario: "required",
      nombre: "required",
      apellidos: "required",
      password: {
        required: true,
        minlength: 5
      },
      password2: {
        required: true,
        minlength: 5
      }
    },
    
    messages: {
      usuario: "Por favor introduce tu usuario",
      nombre: "Por favor introduce tu nombre",
      apellidos: "Por favor introduce tu apellido",
      password: {
        required: "Por favor introduce tu contraseña",
        minlength: "Tu contraseña tiene que tener más de 5 letras"
      },
      password2: {
        required: "Por favor introduce la segunda contraseña",
        minlength: "Tu contraseña tiene que tener más de 5 letras"
      }
    },
  
    submitHandler: function(form) {
      form.submit();
    }
  });
});