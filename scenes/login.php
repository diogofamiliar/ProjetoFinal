<?php
ob_start();
?>
<div class="container">
    <div class="modal fade" id="loginModal" role="dialog">
        <div class="modal-dialog">  
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="display:table-cell; vertical-align:middle; text-align:center">
                <a class="navbar-brand"><img src="../assets/navbar/icon_navbar.png" style="width:40px;"></a>
                <h2>HabitaBem</h2>
            </div>
            <div class="modal-body" style="padding:40px 50px;">
                <form form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"> 
                    <div class="form-group">
                        <label for="usrname"><span class="glyphicon glyphicon-user"></span> Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Enter email" Required>
                    </div>
                    <div class="form-group">
                        <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
                        <input type="password" class="form-control" id="pw" name="password" placeholder="Enter password" Required>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" value="" checked>Remember me</label>
                        </div>
                    <button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-off"></span> Login</button>
                </form>
            </div>
            <div class="modal-footer">
                <div class="content-center" id="modal_footer_content">
                    <ul style="list-style-type: none;">
                        <li>
                            <p>Não tens uma conta? <a href="registar_cliente.php">Regista-te!</a></p>
                            <p>Esqueceste-te da <a href="#">palavra-passe?</a></p>
                        </li>
                        <li>
                            <button type="submit" class="btn btn-danger btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>Cancel</button>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
        
        </div>
    </div>
</div> 

<?php
ob_start();
include '../core/connect.php';
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email1 = $_POST['email'];
    $senha = $_POST['password'];
    
    $sql="SELECT id_utilizador, email1, senha FROM utilizador WHERE email1='$email1'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_array($result);
    $hash=$row['senha'];
    $id_utilizador=$row['id_utilizador'];
    $_SESSION['id_utilizador']=$id_utilizador;
    include '../core/pw_handle.php';
    verifyPw($senha,$hash);
    
}
?>