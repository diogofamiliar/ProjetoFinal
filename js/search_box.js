$(document).ready(function(){  
    $('#id_condominio').keyup(function(){
         var query = $(this).val();  
         if(query != '')  
         {  
              $.ajax({  
                   url:"fetch.php",
                   method:"POST",  
                   data:{query:query},  
                   success:function(data)  
                   {  
                        $('#lista_condominios').fadeIn();  
                        $('#lista_condominios').html(data);  
                   }  
              });  
         }  
    });  
    $(document).on('click', 'li', function(){  
         $('#id_condominio').val($(this).text());  
         $('#lista_condominios').fadeOut();  
    });  
});  