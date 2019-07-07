<?php
ob_start();
?>

<div class="container">
    <div class="modal fade" id="loginModal" role="dialog">
        <div class="modal-dialog">  
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="display:table-cell; vertical-align:middle; text-align:center">
                <a class="navbar-brand"><img src="https://i.imgur.com/SzFkxr6.png" style="width:40px;"></a>
                <h2>elVecino</h2>
            </div>
            <div class="modal-body" style="padding:40px 50px;">
                <form form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"> 
                    <div class="form-group">
                        <label for="usrname">Email</label>
                        <input type="text" class="form-control" name="login_email" placeholder="Introduzir email" Required>
                    </div>
                    <div class="form-group">
                        <label for="psw">Palavra-passe</label>
                        <input type="password" class="form-control" id="login_password" name="login_password" placeholder="Introduzir palavra-passe" Required>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" value="" checked> Lembrar palavra-passe</label>
                        </div>
                    <button type="submit" class="btn btn-success btn-block">Iniciar Sessão</button>
                </form>
            </div>
            <div class="modal-footer">
                <div class="content-center" id="modal_footer_content">
                    <ul style="list-style-type: none;">
                        <li>
                            <button type="submit" class="btn btn-danger btn-default" data-dismiss="modal">Cancelar</button>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
        
        </div>
    </div>
</div> 

<?php
include __DIR__.'/../core/connect.php';


/*
IMPORTANTE para no ficheiro "verify_user_role.php" o utilizador poder ser reencaminhado corretamente para a página pretendida. 
Este isset define a proveniencia do user para este ficheiro login.php
*/
if(isset($camefrom)){ 
    if($camefrom=="registar_utilizador.php"){
        $_SESSION['camefrom']='registar_utilizador.php';
    }else $_SESSION['camefrom']='index.php';
}

//pega nos dados do MODAL FORM e pesquisa pelo id_utilizador, email e senha do utilizador com o EMAIL inserido
if($_SERVER["REQUEST_METHOD"] == "POST"){ 
     //vai verificar a pass inserida com a hash guardada na bd   
    if(isset($_POST['login_password'],$_POST['login_email'])){
        $email = $_POST['login_email'];
        $senha = $_POST['login_password'];       
        $sql="SELECT id_utilizador, email, senha FROM utilizador WHERE email='$email'"; 
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_array($result);
        $hash=$row['senha']; //hash que contem a pass do user
        $id_utilizador=$row['id_utilizador'];
        $_SESSION['id_utilizador']=$id_utilizador;  //vai ser util para mais tarde os dados das páginas serem direcionados ao user que efetuou Login
        if (password_verify($senha, $hash)) {
            include __DIR__.'/../core/verify_user_role.php';
        } else {
            setcookie("pass_errada", "1", time()+(3), "/"); // o "/" disponibiliza a cookie para toda a plataforma
            header('Location: index.php');
        }
    }
}
?>
