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
            <form role="form">
                <div class="form-group">
                <label for="usrname"><span class="glyphicon glyphicon-user"></span> Username</label>
                <input type="text" class="form-control" id="usrname" placeholder="Enter email">
                </div>
                <div class="form-group">
                <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
                <input type="text" class="form-control" id="psw" placeholder="Enter password">
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