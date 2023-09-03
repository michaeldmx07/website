<?php

include("admin/bd.php");

if($_POST){

    $nombre=(isset($_POST['nombre']))?$_POST['nombre']:"";
    $correoelectronico=(isset($_POST['correoelectronico']))?$_POST['correoelectronico']:"";
    $numero=(isset($_POST['numero']))?$_POST['numero']:"";
    $mensaje=(isset($_POST['mensaje']))?$_POST['mensaje']:"";

    $sentencia=$conexion ->prepare("INSERT INTO `tbl_mensajes` (`ID`, `nombre`, `correoelectronico`, `numero`, `mensaje`) 
    VALUES (NULL,:nombre,:correoelectronico,:numero,:mensaje);");

    $sentencia ->bindParam(":nombre",$nombre);
    $sentencia ->bindParam(":correoelectronico",$correoelectronico);
    $sentencia ->bindParam(":numero",$numero);
    $sentencia ->bindParam(":mensaje",$mensaje);


    $sentencia->execute();
    $mensaje="Responderemos pronto!";
}

//Seleccionar registros
$sentencia=$conexion->prepare("SELECT * FROM `tbl_servicios`");
$sentencia->execute();
$lista_portafolio=$sentencia->fetchAll(PDO::FETCH_ASSOC);

//Seleccionar registros de portafolio
$sentencia=$conexion->prepare("SELECT * FROM `tbl_portafolio`");
$sentencia->execute();
$lista_portfolio=$sentencia->fetchAll(PDO::FETCH_ASSOC);

//Seleccionar registros de entradas
$sentencia=$conexion->prepare("SELECT * FROM `tbl_entradas`");
$sentencia->execute();
$lista_entradas=$sentencia->fetchAll(PDO::FETCH_ASSOC);

//Seleccionar registros de equipo
$sentencia=$conexion->prepare("SELECT * FROM `tbl_equipo`");
$sentencia->execute();
$lista_equipo=$sentencia->fetchAll(PDO::FETCH_ASSOC);

?>







<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>The Titan's Forge Fitness Center</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/IconoGYM.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top"><img src="assets/img/LOGO_gym.svg" alt="..." /></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ms-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link" href="http://website-production-5b02.up.railway.app/admin/login.php">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link" href="#portfolio">Productos</a></li>
                        <li class="nav-item"><a class="nav-link" href="#about">Gimnasios</a></li>
                        <li class="nav-item"><a class="nav-link" href="#team">Coachs</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Contactanos</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container">
                <div class="masthead-subheading">Transforma tu cuerpo, desafía tus límites</div>
                <div class="masthead-heading text-uppercase">The Titan's Forge Fitness Center</div>
            </div>
        </header>

        <!-- Portfolio Grid-->
        <section class="page-section bg-light" id="portfolio">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Productos</h2>
                    <h3 class="section-subheading text-muted">Technogym, BH Fitness, Tunturi, Matrix Fitness, Optium Nutrition.</h3>
                </div>
                <div class="row">

                <?php foreach($lista_portfolio as $registros){ ?>
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <!-- Portfolio item 1-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal1<?php echo $registros["ID"]?>">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/portfolio/<?php echo $registros["imagen"];?>" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading"><?php echo $registros["titulo"];?></div>
                                <div class="portfolio-caption-subheading text-muted"><?php echo $registros["subtitulo"];?></div>
                            </div>
                        </div>
                    </div>

                    <!-- Portfolio item 1 modal popup-->
        <div class="portfolio-modal modal fade" id="portfolioModal1<?php echo $registros["ID"]?>" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <h2 class="text-uppercase"><?php echo $registros["titulo"];?></h2>
                                    <p class="item-intro text-muted"><?php echo $registros["subtitulo"];?></p>
                                    <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/<?php echo $registros["imagen"];?>" alt="..." />
                                    <p><?php echo $registros["descripcion"];?></p>
                                    <ul class="list-inline">
                                        <li>
                                            <strong>Cliente:</strong>
                                            <?php echo $registros["cliente"];?>
                                        </li>
                                        <li>
                                            <strong>Categoria:</strong>
                                            <?php echo $registros["categoria"];?>
                                        </li>
                                        <li>
                                            <strong>URL:</strong>
                                           <a href=" <?php echo $registros["url"];?>"><?php echo $registros["url"];?></a>
                                        </li>
                                    </ul>
                                    <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                        <i class="fas fa-xmark me-1"></i>
                                        Close Project
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                    <?php } ?>

                </div>
            </div>
        </section>
        <!-- About-->
        <section class="page-section" id="about">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Gimnasios</h2>
                    <h3 class="section-subheading text-muted">Sucursales en Ecuador.</h3>
                </div>
                <ul class="timeline">

                <?php 
                $contador=1;
                foreach($lista_entradas as $registros){ 
                    
                    ?>
                    <li <?php echo (($contador%2)==0)?'class="timeline-inverted"' :""; ?> > 
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/about/<?php echo $registros["imagen"]?>" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4><?php echo $registros["fecha"]?></h4>
                                <h4 class="subheading"><?php echo $registros["titulo"]?></h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted">
                                    <?php echo $registros["descripcion"]?></p></div>
                        </div>
                    </li>

                <?php 
                $contador++;
            } ?>
    
                    <li class="timeline-inverted">
                        <div class="timeline-image">
                            <h4>
                                Shh! Se 
                                <br />
                                acercan
                                <br />
                                novedades!
                            </h4>
                        </div>
                    </li>

                </ul>
            </div>
        </section>
        <!-- Team-->
        <section class="page-section bg-light" id="team">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Contacta con profesionales!</h2>
                    <h3 class="section-subheading text-muted">Aprende como ellos viven su dia a dia de la manera mas saludable.</h3>
                </div>
                <div class="row">
                <?php foreach($lista_equipo as $registros){ ?>
                    <div class="col-lg-4">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="assets/img/team/<?php echo $registros["imagen"]?>" alt="..." />
                            <h4><?php echo $registros["nombrecompleto"]?></h4>
                            <p class="text-muted"><?php echo $registros["puesto"]?></p>
                            <a class="btn btn-dark btn-social mx-2" href="<?php echo $registros["urltwitter"]?>" aria-label="Parveen Anand Twitter Profile"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="<?php echo $registros["urlfacebook"]?>" aria-label="Parveen Anand Facebook Profile"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="<?php echo $registros["urllinkedin"]?>" aria-label="Parveen Anand LinkedIn Profile"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                <?php } ?>
                
                </div>
            </div>
        </section>
        <!-- Clients-->
        <div class="py-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-3 col-sm-6 my-3">
                        <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="assets/img/logos/microsoft.svg" alt="..." aria-label="Microsoft Logo" /></a>
                    </div>
                    <div class="col-md-3 col-sm-6 my-3">
                        <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="assets/img/logos/google.svg" alt="..." aria-label="Google Logo" /></a>
                    </div>
                    <div class="col-md-3 col-sm-6 my-3">
                        <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="assets/img/logos/facebook.svg" alt="..." aria-label="Facebook Logo" /></a>
                    </div>
                    <div class="col-md-3 col-sm-6 my-3">
                        <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="assets/img/logos/ibm.svg" alt="..." aria-label="IBM Logo" /></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact-->
        <section class="page-section" id="contact">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Cuentanos como podemos ayudarte!</h2>
                    <h3 class="section-subheading text-muted">Un experto se pondra en contacto contigo lo antes posible.</h3>
                </div>
                <!-- * * * * * * * * * * * * * * *-->
                <!-- * * SB Forms Contact Form * *-->
                <!-- * * * * * * * * * * * * * * *-->
                <!-- This form is pre-integrated with SB Forms.-->
                <!-- To make this form functional, sign up at-->
                <!-- https://startbootstrap.com/solution/contact-forms-->
                <!-- to get an API token!-->
                <form id="contactForm" data-sb-form-api-token="API_TOKEN">
                    <div class="row align-items-stretch mb-5">
                        <div class="col-md-6">
                            <div class="form-group">
                                <!-- Name input-->
                                <input class="form-control" id="nombre" type="text" placeholder="Nombre completo" data-sb-validations="required" />
                                <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                            </div>
                            <div class="form-group">
                                <!-- Email address input-->
                                <input class="form-control" id="correo" type="text" placeholder="ejemplo@gmail.com" data-sb-validations="required,email" />
                                <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                                <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                            </div>
                            <div class="form-group mb-md-0">
                                <!-- Phone number input-->
                                <input class="form-control" id="numero" type="text" placeholder="Numero telefonico" data-sb-validations="required" />
                                <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-textarea mb-md-0">
                                <!-- Message input-->
                                <textarea class="form-control" for="mensaje" name="correo" id="mensaje" type="text" placeholder="Que tienes para decirnos!"></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- Submit success message-->
                    <!---->
                    <!-- This is what your users will see when the form-->
                    <!-- has successfully submitted-->
                    <div class="d-none" id="submitSuccessMessage">
                        <div class="text-center text-white mb-3">
                            <div class="fw-bolder">Form submission successful!</div>
                            To activate this form, sign up at
                            <br />
                            <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                        </div>
                    </div>
                    <!-- Submit error message-->
                    <!---->
                    <!-- This is what your users will see when there is-->
                    <!-- an error submitting the form-->
                    <!-- Submit Button-->
                    <div class="text-center"><button type="submit" class="btn btn-success">Enviar mensaje.</button></div>
                </form>
            </div>
        </section>
        <!-- Footer-->
        <footer class="footer py-4">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 text-lg-start">Copyright &copy; Your Website 2023</div>
                    <div class="col-lg-4 my-3 my-lg-0">

                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a class="link-dark text-decoration-none me-3" href="#!">Privacy Policy</a>
                        <a class="link-dark text-decoration-none" href="#!">Terms of Use</a>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
