$(document).ready(function(){  
    $('#id_utilizador').keyup(function(){
         var query = $(this).val();  
         if(query != '')  
         {  
              $.ajax({  
                   url:"../../../core/fetch_results/fetch_user.php",
                   method:"POST",  
                   data:{query:query},  
                   success:function(data)  
                   {  
                        $('#lista_utilizadores').fadeIn();  
                        $('#lista_utilizadores').html(data);  
                   }  
              });  
         }  
    });  
    $(document).on('click', 'li', function(){  
         $('#id_utilizador').val($(this).text());  
         $('#lista_utilizadores').fadeOut();  
    });  
    
});  