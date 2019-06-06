$(document).ready(function(){  
    $('#id_grupo').keyup(function(){
         var query = $(this).val();  
         if(query != '')  
         {  
              $.ajax({  
                   url:"../../core/fetch_results/fetch_grupo.php",
                   method:"POST",  
                   data:{query:query},  
                   success:function(data)  
                   {  
                        $('#lista_grupos').fadeIn();  
                        $('#lista_grupos').html(data);  
                   }  
              });  
         }  
    });  
    $(document).on('click', 'li', function(){  
         $('#id_grupo').val($(this).text());  
         $('#lista_grupos').fadeOut();  
    });  
    
});  