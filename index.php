<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <title>ElVecino</title>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- css -->
  <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="css/custom.css" rel="stylesheet" media="screen">
  <link href="css/bootstrapindex.min.css" rel="stylesheet" media="screen">
  <link href="css/style.css" rel="stylesheet" media="screen">
  <link href="color/default.css" rel="stylesheet" media="screen">
   <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="js/modernizr.custom.js"></script>
  <!-- Sweet alert -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!-- =======================================================
    Theme Name: Mamba
    Theme URL: https://bootstrapmade.com/mamba-one-page-bootstrap-template-free/
    Author: BootstrapMade
    Author URL: https://bootstrapmade.com
  ======================================================= -->
</head>

<body>

<?php
  include 'headers/header.php';
?>
  <!-- intro area -->
  <div id="intro">

    <div class="intro-text">
      <div class="container">
        <div class="row">


          <div class="col-md-12">

            <div class="brand">
              <h1><a href="index.php">HABITABEM</a></h1>
              <div class="line-spacer"></div>
              <p><span>teremos todo o gosto em habita(r)bem consigo</span></p>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>




  <!-- services -->
  <section id="services" class="home-section bg-white">
    <div class="container">
      <div class="row">
        <div class="col-md-offset-2 col-md-8">
          <div class="section-heading">
            <h2>Serviços</h2>
            <!--<p>We’ve been building unique digital products, platforms, and experiences for the past 6 years.</p>-->
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 mx-0" data-wow-delay="0.1s">
          <div class="box-team wow bounceInDown">
            <div class="card border-0">
              <a class="card-img-top mx-auto my-2">
                  <img class="object-fit-cover" src="assets/admin/manutencoes/repair.png" alt="Card image cap">
              </a>
              <div class="card-body d-flex flex-column">
                <h4 class="card-title">Inserir Incidentes</h4>
              </div>
            </div>
          </div>  
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 mx-0" data-wow-delay="0.3s">
          <div class="box-team wow bounceInDown">
            <div class="card border-0">
              <a class="card-img-top mx-auto my-2">
                  <img class="object-fit-cover" src="assets/admin/gestao/gestao_condominio.png" alt="Card image cap">
              </a>
              <div class="card-body d-flex flex-column">
                <h4 class="card-title">Gestão de condomínios e utilizadores</h4>
              </div>
            </div>
          </div> 
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 mx-0" data-wow-delay="0.5s">
          <div class="box-team wow bounceInDown">
            <div class="card border-0">
              <a class="card-img-top mx-auto my-2">
                  <img class="object-fit-cover" src="assets/admin/manutencoes/agendar.png" alt="Card image cap">
              </a>
              <div class="card-body d-flex flex-column">
                <h4 class="card-title">Gestão de manutenções e reparações</h4>
              </div>
            </div>
          </div> 
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 mx-0" data-wow-delay="0.7s">
          <div class="box-team wow bounceInDown">
            <div class="card border-0">
              <a class="card-img-top mx-auto my-2">
                  <img class="object-fit-cover" src="assets/index/report.png" alt="Card image cap">
              </a>
              <div class="card-body d-flex flex-column">
                <h4 class="card-title">Relatórios</h4>
              </div>
            </div>
          </div> 
        </div>
      </div>
    </div>
  </section>

  <!-- spacer -->
  <section id="spacer1" class="home-section spacer">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="color-light">
            <h2 class="wow bounceInDown" data-wow-delay="1s">O seu bem estar é a nossa maior preocupação!</h2>
            <!--<p class="lead wow bounceInUp" data-wow-delay="2s">We mix all detailed things together</p>-->
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Responsaveis -->
  <section id="responsaveis" class="home-section bg-white">
    <div class="container">
      <div class="row">
        <div class="col-md-offset-2 col-md-8">
          <div class="section-heading">
            <h2>Responsáveis</h2>
            <!--<p>We’ve been building unique digital products, platforms, and experiences for the past 6 years.</p>-->
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
          <div class="box-team wow bounceInDown" data-wow-delay="0.1s">
            <img class="img-responsive_index" src="assets/index/financial.png" alt="">
            <h4>Financeiro</h4>
            <p>Isabel Leal <br>Paula Ferreira - Lic. Psic.<br>Madalena Costa - Lic. FBAUP</p>
          </div>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" data-wow-delay="0.3s">
          <div class="box-team wow bounceInDown">
            <img class="img-responsive_index" src="assets/index/maintenance.png" alt="">
            <h4>Avarias & Manutenção</h4>
            <p>João Barbosa - Electricista <br>Paulo Fernandes - Pichelaria</p>
          </div>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" data-wow-delay="0.7s">
          <div class="box-team wow bounceInDown">
            <img class="img-responsive_index" src="assets/index/propostas.png" alt="">
            <h4>Propostas comerciais</h4>
            <p>Mário Sousa - Eng.º Eletrotécnico O.E.80231</p>
          </div>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" data-wow-delay="0.5s">
          <div class="box-team wow bounceInDown">
            <img class="img-responsive_index" src="assets/index/inspection.png" alt="">
            <h4>Fiscalização</h4>
            <p>Miguel Costa<br>Sara Patricia<br>Paula Ferreira<br>Madalena Costa</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- spacer 2 -->
  <section id="spacer3" class="home-section spacer">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="color-light">
            <h2 class="wow bounceInDown" data-wow-delay="1s">Estragos no condomínio? Reparações não atendidas?</h2>
            <p class="lead wow bounceInUp" data-wow-delay="2s">Registe-se já e reporte ao seu condomínio todos os estragos ou incidentes. Mais fácil, mais rápido. Sem telefonemas, sem troca de emails, sem preocupações. Tudo na sua aplicação.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Multiplataforma -->
  <section id="multiplatform" class="home-section bg-gray">
    <div class="container">
      <div class="row">
        <div class="col-md-offset-2 col-md-8">
          <div class="section-heading">
            <h2>Multiplataforma</h2>
            <p>Todo o sistema encontra-se desenvolvido de forma a poder ser utilizado em todos os dispositivos móveis bem como computador.</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
          <div class="service-box wow bounceInDown" data-wow-delay="0.1s">
            <i class="fa fa-laptop fa-4x"></i>
            <h4>Computador</h4>
            <!--<p>Lorem ipsum dolor sit amet, ut decore iracundia urbanitas sit.</p>
            <a class="btn btn-primary">Learn more</a>-->
          </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" data-wow-delay="0.3s">
          <div class="service-box wow bounceInDown" data-wow-delay="0.1s">
            <i class="fa fa-mobile fa-4x"></i>
            <h4>Telemóvel</h4>
            <!--<p>Lorem ipsum dolor sit amet, ut decore iracundia urbanitas sit.</p>
            <a class="btn btn-primary">Learn more</a>-->
          </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" data-wow-delay="0.5s">
          <div class="service-box wow bounceInDown" data-wow-delay="0.1s">
            <i class="fa fa-tablet fa-4x"></i>
            <h4>Tablet</h4>
            <!--<p>Lorem ipsum dolor sit amet, ut decore iracundia urbanitas sit.</p>
            <a class="btn btn-primary">Learn more</a>-->
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- spacer 3 -->
  <section id="spacer2" class="home-section spacer">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="color-light">
            <h2 class="wow bounceInDown" data-wow-delay="1s">Estragos no condomínio? Reparações não atendidas?</h2>
            <p class="lead wow bounceInUp" data-wow-delay="2s">Registe-se já e reporte ao seu condomínio todos os estragos ou incidentes. Mais fácil, mais rápido. Sem telefonemas, sem troca de emails, sem preocupações. Tudo na sua aplicação.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- equipa -->
  <section id="equipa" class="home-section bg-white">
    <div class="container">
      <div class="row">
        <div class="col-md-offset-2 col-md-8">
          <div class="section-heading">
            <h2>A equipa de desenvolvimento</h2>
            <!--<p>We’ve been building unique digital products, platforms, and experiences for the past 6 years.</p>-->
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 mx-0" data-wow-delay="0.7s">
          <div class="box-team wow bounceInDown">
            <div class="card border-0">
              <a class="card-img-top mx-auto">
                  <img class="object-fit-cover" src="assets/index/ana.jpg" alt="Card image cap">
              </a>
              <div class="card-body d-flex flex-column">
                <h4 class="card-title">Ana Moreira</h4>
                <p>Estudante do 3º ano do curso Engenharia Informática da Universidade Lusófona do Porto.</p>
              </div>
            </div>
          </div>  
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 mx-0" data-wow-delay="0.3s">
          <div class="box-team wow bounceInDown">
            <div class="card border-0">
              <a class="card-img-top mx-auto">
                  <img class="object-fit-cover" src="assets/index/diogo.jpg" alt="Card image cap">
              </a>
              <div class="card-body d-flex flex-column">
                <h4 class="card-title">Diogo Familiar</h4>
                <p>Estudante do 3º ano do curso Engenharia Informática da Universidade Lusófona do Porto.</p>
              </div>
            </div>
          </div> 
        </div>
      </div>
    </div>
  </section>

  <!-- spacer 4 -->
  <section id="spacer4" class="home-section spacer">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="color-light">
            <h2 class="wow bounceInDown" data-wow-delay="1s">Acompanhe os seus incidentes desde o momento que os registou!</h2>
            <p class="lead wow bounceInUp" data-wow-delay="2s">Sem downloads, disponível em qualquer lugar a qualquer altura. <a href="scenes/registar_utilizador.php">Adira já!</a></p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Contatos -->
  <section id="contato" class="home-section bg-white">
    <div class="container">
      <div class="row">
        <div class="col-md-offset-2 col-md-8">
          <div class="section-heading">
            <h2>Contactos</h2>
            <!--<p>We’ve been building unique digital products, platforms, and experiences for the past 6 years.</p>-->
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mx-0" data-wow-delay="0.9s">
          <div class="box-team wow bounceInDown">
            <div class="card border-0">
              <div class="card-body">
                <h4 class="card-title">Propostas: comercial@habitabem.pt</h4>
                <h6 class="row d-flex justify-content-center">Rua do Tenente Valadim n.º 544 – 4100-477 – Porto</h6>
                <h6 class="row d-flex justify-content-center">Emails:</h6>
                <p class="row d-flex justify-content-center"><b>Geral:</b>  geral@habitabem.pt</p>
                <p class="row d-flex justify-content-center"><b>Pagamentos:</b>  pagamentos@habitabem.pt</p>
                <p class="row d-flex justify-content-center"><b>SOS 24 Horas:</b>  avarias@habitabem.pt</p>
                <p class="row d-flex justify-content-center"><b>Propostas:</b>  comercial@habitabem.pt</p>
                <h6 class="row d-flex justify-content-center">Telefones:</h6>
                <p class="row d-flex justify-content-center"><b>Geral:</b>  22 600 6804</p>
                <p class="row d-flex justify-content-center"><b>Telemóvel:</b>  93 744 0101</p>
                <p class="row d-flex justify-content-center"><b>SOS 24 Horas:</b>  93 492 8620</p>
              </div>
            </div>
          </div>  
        </div>
      </div>
    </div>
  </section>

  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <p>Projeto final de curso. <br>Ana Moreira<br>Diogo Familiar</p>
          <div class="credits">
            <!--
              All the links in the footer should remain intact.
              You can delete the links only if you purchased the pro version.
              Licensing information: https://bootstrapmade.com/license/
              Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Mamba
            -->
            <p>Universidade Lusófona do Porto</p>
          </div>

        </div>
      </div>
    </div>
  </footer>

  <!-- js -->
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.smooth-scroll.min.js"></script>
  <script src="js/jquery.dlmenu.js"></script>
  <script src="js/wow.min.js"></script>
  <script src="js/custom.js"></script>

  </body>
</html>

<?php
  if(isset($_COOKIE["pass_errada"])){
?>
      <script>
      swal({
            title: "Acesso negado!",
            text: "O seu e-mail ou password estão incorretos! Tente de novo",
            icon: "error",
            button: "Continuar",
      });
      </script>
<?php
  }
?>

