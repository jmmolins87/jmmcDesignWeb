<?php

$msg = null;

if(isset($_POST["phpmailer"])) {
	
	$nombre=htmlspecialchars($_POST["nombre"]);
	$empresa=htmlspecialchars($_POST["empresa"]);
	$email=htmlspecialchars($_POST["email"]);
	$phone=htmlspecialchars($_POST["phone"]);
	$adjunto=($_FILES["adjunto"]);
	$asunto=htmlspecialchars($_POST["asunto"]);
	$mensaje=($_POST["mensaje"]);
	
	$recaptcha = $_POST["g-recaptcha-response"];
 
	$url = 'https://www.google.com/recaptcha/api/siteverify';
	$data = array(
		'secret' => '6LfZVEYUAAAAAJ9LSJh0YuzKgHOMkNPjydXaBK0K',
		'response' => $recaptcha
	);
	
	$options = array(
		'http' => array (
			'method' => 'POST',
			'content' => http_build_query($data)
		)
	);
	
	$context  = stream_context_create($options);
	$verify = file_get_contents($url, false, $context);
	$captcha_success = json_decode($verify);
	
	if ($captcha_success->success) {
		
		require "../PHPMailer/class.phpmailer.php";
	
		$mail=new PHPMailer;
		$mail->Host = "mx1.hostinger.es";
		$mail->From = "$email";
		$mail->FromName = "jmmcDesign";
		$mail->Subject = $asunto;
		$mail->addAddress("hola@jmmcdesign.com");
		$mail->msgHTML($mensaje);
		$mail->Body = 	'<!DOCTYPE html>
						<html>
							<head>
								<meta http-equiv=”Content-Type” content=”text/html; charset=iso-8859-1″>
								<title>Formulario de jmmcDesign</title>
							</head>
							<body>
								<h1>Formulario de contacto de jmmcDesign.com</h1>
								<p>Nombre: '.$_POST["nombre"].'</p>
								<p>Empresa: '.$_POST["empresa"].'</p>
								<p>E-mail: '.$_POST["email"].'</p>
								<p>Teléfono: '.$_POST["phone"].'</p>
								<p>Asunto: '.$_POST["asunto"].'</p>
								<p>Mensaje: '.$_POST["mensaje"].'</p>
							</body>
						</html>';
	
	// ============================ Archivo adjunto	
	if ($adjunto["size"] > 0) {
		$mail->addAttachment($adjunto["tmp_name"], $adjunto["name"]);
	}
	
	// ============================ Mensaje correo enviado
	if($mail->send()) {
		$msg = "<div class='alert alert-success' style='text-align:center;'><h3>¡¡Perfecto!!</h3><p> El correo enviado des de <b>$email</b>, se ha recibido correctamente. <br/> $nombre, me pondré en contacto con usted antes de 2 días hábiles.</p></div>";
	} else {
		$msg = "<div class='alert alert-danger' style='text-align:center;'><h3>¡¡ATENCIÓN!!</h3><p> $nombre ha habido el siguiente error al enviar el correo: <br/> <b>$mail->ErrorInfo;</b><br/> Revisa los campos o intentalo de nuevo más tarde. <br/> Disculpe las molestias.</p></div>";
	}
} else {
		$msg = "<div class='alert alert-danger' style='text-align:center;'><h3>¡¡ATENCIÓN!!</h3><p>Tiene que verificar el captcha.</p> </div>";
	}
}
	
?>


<!DOCTYPE html>
<html lang="es"><!-- InstanceBegin template="/Templates/espanol.dwt" codeOutsideHTMLIsLocked="false" -->
  <head>
    <meta charset="utf-8">
	<link href="../img/favicon_V.png" rel="icon" type="image/x-icon" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	  
	<!-- ================= SEO ================= -->  
	<!-- Provide a short description of the page. -->
	<meta name="description" content="Página web de un diseñador gráfico, diseñador web, progrmador web y experto en e-commerce">
	<!-- This meta tag tells Google not to show the sitelinks search box. -->
	<meta name="google" content="nositelinkssearchbox" />	
	<!-- Control the behavior of search engine crawling and indexing. 
 	The robots meta tag applies to all search engines, while the "googlebot" meta tag is specific to Google. -->
	<meta name="robots" content="diseño gráfico, diseño web, programación web, e-commerce" />
	<meta name="http-equiv" content="X-Robots-Tag : noindex, follow" />
	<meta name="googlebot" content="diseño gráfico, diseño web, programación web, e-commerce" />	
	<!-- Used for verifying ownership of a site. -->
	<meta name="verify" content="Juan María Molins Cortés"/>

	<!-- Open Graph Meta Tags -->
	<!-- Set the canonical URL for the page you are sharing. -->
	<meta property="og:url" content="http://www.jmmcDesign.com/">
	<!-- The title to accompany the URL. -->
	<meta property="og:title" content="jmmcDesign"/>
	<!-- Provides Facebook the name that you would like your website to be recognized by. -->
	<meta property="og:site_name" content="http://www.jmmcDesign.com/">
	<!-- Provides Facebook the type of website that you would like your website to be categorized by. -->
	<meta property="og:type" content="jmmcDesign">
	<!-- Defines the language, American English is the default. -->
	<meta property="og:locale" content="es-ES">
	<!-- Directs Facebook to use the specified image when the page is shared. -->
	<meta property="og:image" content="image URL">
	<!-- Similar to the meta description tag in HTML. This description is shown below the link title on Facebook. -->
	<meta property="og:description" content="Pagina curriculum"/>

	<!-- Twitter Card data -->
	<!-- The type of card to be created: summary, photo, or video -->
	<meta name="twitter:card" content="summary" />
	<!-- Title of the Twitter Card -->
	<meta name="twitter:title" content="jmmcDesign" />
	<!-- Description of content -->
	<meta name="twitter:description" content="Pagina curriculum, diseño gráfico, diseño web, programación web, e-commerce" />
	<!-- URL of image to use in the card. Used with summary, summary_large_image, player cards -->
	<meta name="twitter:image" content="" />
	 
	<!-- InstanceBeginEditable name="Titulo" -->
    <title>jmmcDesign - Contacto</title>  
	<!-- InstanceEndEditable -->
	
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	
    <!-- ================= Scripts, Style, Fonts & Icons - HEAD ================= -->
	<link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="../css/reset.css" type="text/css">
	<link rel="stylesheet" href="../css/main.css" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet" type="text/css">
	<script src="../js/jquery-1.11.3.min.js"></script>
	<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js" integrity="sha384-SlE991lGASHoBfWbelyBPLsUlwY1GwNDJo3jSJO04KZ33K2bwfV9YBauFfnzvynJ" crossorigin="anonymous"></script>
	
	<!-- ================= Scripts, Style - PRELOADER -->
	<link rel="stylesheet" href="../css/preloader/style_preloader.css" type="text/css">
	<script type="text/javascript" src="../js/preloader/main_preload.js"></script>
	  
	<!-- ================= Style - SUBIR  -->
	<link rel="stylesheet" href="../css/subir/subir.css" type="text/css">
	  
	<!-- ================= Script, Style MENÚ -->
	<link rel="stylesheet" href="../css/menu/style_menu.css" type="text/css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" rel="stylesheet" type="text/css">
	  
	<!-- InstanceBeginEditable name="SCRIPT HEAD" -->
	<link rel="stylesheet" href="../css/contacto.css" type="text/css">
	<script src='https://www.google.com/recaptcha/api.js?hl=es'></script>
	
	 
	<!-- InstanceEndEditable -->

  	</head>
	
  	<!-- InstanceBeginEditable name="BODY" -->
	<body>
	  
	 
	<!-- InstanceEndEditable -->
	<!-- ============================= PRELOADER -->
	<div id="loading">
		<div id="loading-center">
			<div id="loading-center-absolute">	
				<div class="object"></div>
				<div class="object"></div>
				<div class="object"></div>
				<div class="object"></div>
				<div class="object"></div>
				<div class="object"></div>
				<div class="object"></div>
				<div class="object"></div>
				<div class="object"></div>
				<div class="object"></div>
			</div>
		</div>
 	</div>
		
	<!-- ============================= SUBIR -->
	<span class="ir-arriba icon-arrow-up2"><img src="../img/subir.png" alt="Subir" title="Subir" width="15px"></span>
	
		
	<!-- ============================= MENÚ -->
	
	<!-- InstanceBeginEditable name="HEADER" -->
	<header>	  
	 
	<!-- InstanceEndEditable -->
		
	<div class="container">
		<nav id="navigation"><img src="../img/LOGO_blue.png" alt="Logo" title="Logo" width="115px"> <a aria-label="mobile menu" class="nav-toggle"> <span></span> <span></span> <span></span> </a>
      		<ul class="menu-left">
				<!-- InstanceBeginEditable name="MENU" -->
				<li><a href="../index.html"><i class="fas fa-home"></i></a></li>
				<li><a href="herramientas.html">Mis herramientas</a></li>
        		<li><a href="quien.html">¿Quién soy?</a></li>
        		<li><a href="estudios.html">Estudios</a></li>
        		<li><a href="trabajos.html">Experiencia</a></li>
				<li><a href="#" id="dropdownMenu1" data-toggle="dropdown">Portfolio</a>
				<ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownMenu1">
    				<li role="presentation">
      					<a role="menuitem" tabindex="-1" href="portfolio_carteleria.html">Cartelería</a>
    				</li>
					
    				<li role="presentation">
      					<a role="menuitem" tabindex="-1" href="portfolio_logo.html">Logotipo</a>
    				</li>
					
    				<li role="presentation">
      					<a role="menuitem" tabindex="-1" href="portfolio_papeleria.html">Papelería</a>
    				</li>
					
					<li role="presentation">
      					<a role="menuitem" tabindex="-1" href="portfolio_publi.html">Publicidad</a>
    				</li>
					
					<li role="presentation">
      					<a role="menuitem" tabindex="-1" href="portfolio_restaurante.html">Cartas de Restaurante</a>
    				</li>
					
					<li role="presentation">
      					<a role="menuitem" tabindex="-1" href="portfolio_web.html">Web</a>
    				</li>
  				</ul>
				
				</li>
        		<li><a href="contacto.php">Contacto</a></li>
				<li><a href="../index.html"><img src="../img/spanih_flag.png" alt="Español" title="Español" width="25px"></a></li>
				<li><a href="../catala/index.html"><img src="../img/catalan_flag.png" alt="Català" title="Català" width="25px"></a></li>
				<!-- InstanceEndEditable -->
				<br/>
      		</ul>
    	</nav>
  	</div>  
	</header>
		
  	<!-- InstanceBeginEditable name="CONTENIDO" -->
	<!-- ============================= CONTACTO ============================= -->
	<section>
		<div id="container-titulos">
			<div class="titulo">Contacto</div>
		</div>
	</section>
		
	<!-- ============================= Sub Título ============================= -->
	<section>
		<div class="container">
			<div class="col-lg-12">
				<div class="row">
					<div class="subtitulo">
						<h1>Si desea que trabaje para su empresa o desea alguno de mis servicios, se puede poner en contacto conmigo.<br/>
					<span id="frase-contacto">Estoy seguro que juntos podemos llegar a hacer cosas impresionantes</span></h1>
					</div>
				</div>	
			</div>
		</div>
	</section>
		
	<!-- Separador ============================= -->
	<div class="container"><div class="separador-azul"></div></div>		
		
	<!-- ============================= Formulario ============================= -->
	<div class="container" style="padding-bottom: 20px;">
    <div class="row">
        <div class="col-lg-8">
            <div class="well well-sm">
                <form id="formulario" class="form-horizontal" method="POST" enctype="multipart/form-data" 
				action="<?=$_SERVER['PHP_SELF']?>" >
                    <fieldset>
                        <legend class="text-center header">¿Qué desea?</legend>
						
						<div><?php echo $msg; ?></div>
						
                        <div class="form-group">
                            <span class="col-lg-1 col-lg-offset-2 text-center"><span class="iconos-form">
							<i class="fas fa-user"></i></span></span>
                            <div class="col-lg-8">
                                <input id="fname" name="nombre" type="text" placeholder="Su nombre" class="form-control" required>
                            </div>
                        </div>
						
                        <div class="form-group">
                            <span class="col-lg-1 col-lg-offset-2 text-center"><span class="iconos-form">
							<i class="fas fa-briefcase"></i></span></span>
                            <div class="col-lg-8">
                                <input id="lname" name="empresa" type="text" placeholder="Nombre de su emrpesa" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-lg-1 col-lg-offset-2 text-center"><span class="iconos-form">
							<i class="fas fa-envelope"></i></span></span>
                            <div class="col-lg-8">
                                <input id="email" name="email" type="text" placeholder="Correo electrónico" class="form-control" required >
                            </div>
                        </div>
						
						<p style="padding: 5px; color:rgba(255,0,4,1.00); margin-bottom: 5px; text-align: center;">
						Los campos con los iconos rojos <b>NO</b> son obligatorios</p>

                        <div class="form-group">
                            <span class="col-lg-1 col-lg-offset-2 text-center"><span class="iconos-form" style="color: rgba(255,0,4,1.00)"><i class="fas fa-mobile"></i></span></span>
                            <div class="col-lg-8">
                                <input id="phone" name="phone" type="number" placeholder="Teléfono" class="form-control">
                            </div>
                        </div>
						
						 <div class="form-group">
                            <span class="col-lg-1 col-lg-offset-2 text-center"><span class="iconos-form" style="color: rgba(255,0,4,1.00)"><i class="fas fa-paperclip"></i></span></span>
                            <div class="col-lg-8">
                                <input id="adjunto" name="adjunto" type="file" placeholder="Adjuntar archivo" class="form-control">
                            </div>
                        </div>
						
						<p style="padding: 5px; color:rgba(255,0,4,1.00); margin: auto; text-align: center; border-bottom: 1px solid rgba(255,0,4,1.00); width: 50%"></p>
						
						<div class="form-group" style="margin-top: 20px;">
                            <span class="col-lg-1 col-lg-offset-2 text-center"><span class="iconos-form">
							<i class="fas fa-search"></i></span></span>
                            <div class="col-lg-8">
                                <input id="phone" name="asunto" type="text" placeholder="Asunto" class="form-control" required >
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-lg-1 col-lg-offset-2 text-center"><span class="iconos-form">
							<i class="fas fa-edit"></i></span></span>
                            <div class="col-lg-8">
                                <textarea class="form-control" id="message" name="mensaje" placeholder="Escriba su mensaje aquí, me pondre en contacto con usted antes de dos días hábiles." rows="7" required></textarea>
                            </div>
                        </div>
						
						<div class="form-group">
							<span class="col-lg-1 col-lg-offset-2 text-center"><span class="iconos-form">
							<i class="fas fa-lock"></i></span></span>
							<div class="col-lg-8">
								<div class="g-recaptcha" data-sitekey="6LfZVEYUAAAAABSIf3mH63KUVS8xyXF5TgY2t-HE"></div>
							</div>
						</div>
						
						<input type="hidden" name="phpmailer">

                        <div class="form-group">
							<div class="col-lg-6 text-right">
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </div>
							<div class="col-lg-6 text-left">
                                <button type="reset" class="btn btn-danger">Borrar</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
		<div class="col-lg-4">
			<div class="container-fluid-info-contacto">
				<i class="fas fa-mobile"></i>
					<h2><a href="tel:+34655929164">(+34) 655 929 164</a></h2>
				
				<div class="separador-info-formulario"></div>
				<i class="fas fa-envelope"></i>
					<h2> <a href="mailto:hola@jmmcdesign.com">hola@jmmcdesign.com</a></h2>
				
				<div class="separador-info-formulario"></div>
				<i class="fas fa-location-arrow"></i>
					<h2><a href="hhttps://goo.gl/maps/EbUoZmaLm7D8yYBH9" target="_blank">28029 Madrid (Madrid)</a></h2>
				
				<div class="separador-info-formulario"></div>
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d24280.092169665022!2d-3.718283120885838!3d40.47501012891541!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd4229753b073f4b%3A0x1c0340f7338babb0!2s28029+Madrid!5e0!3m2!1ses!2ses!4v1565362823342!5m2!1ses!2ses" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
			</div>
		</div>
		
		<section>
		<div class="col-lg-4">
			<div class="container">
			
			</div>
		</div>
		</section>
    </div>
	</div>
	  
	 
	<!-- InstanceEndEditable -->
	
	
	<!-- InstanceBeginEditable name="SEPARADOR" -->
	<!-- Separador ============================= -->
	<div class="container"><div class="separador"></div></div>	
	  
	 
	<!-- InstanceEndEditable -->	
		
		
	
	<!-- InstanceBeginEditable name="MIGAS" -->	
	<!-- ============================= MIGAS DE PAN -->		
	<section>
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<ol class="breadcrumb">
						<li><a href="../index.html"><i class="fas fa-home"></i></a></li>
  						<li class="active">Contacto</li>
					</ol>
				</div>
			</div>
		</div>
	</section>
		
		
		
	<!-- InstanceEndEditable -->
	
	<!-- ============================= ADORNO FOOTER -->
	<div class="adorno-footer"></div>
	
	<!-- ============================= FOOTER -->
	<!-- InstanceBeginEditable name="FOOTER" -->	
	<footer class="modal-footer">
		<div class="container">
			<div class="row">
				<div class="col-lg-4" style="text-align: left;">
					<nav>
						<div class="enlazes-footer"><a href="aviso-legal.html">Aviso Legal</a></div>
						<div class="enlazes-footer"><a href="cookies.html">Política de Cookies</a></div>
						<div class="enlazes-footer"><a href="privacidad.html">Política de privacidad</a></div>
					</nav>
				</div>
				<div class="col-lg-4">
					<div class="thumbnail" id="logo-footer"><img src="../img/logo_blanc.png" alt="Logo" title="Logo"></div>
				</div>
				<div class="col-lg-4">
					<p class="derechos">&copy; 2018 
					<br/>Todos los derechos reservados.
					<br/><b>Sitio creado con mucho</b> <i class="fas fa-heart"></i></p>
				</div>
			</div>
		</div>	
	</footer>
		
		
		
	<!-- InstanceEndEditable -->
	
		
		
	<!-- ================= Scripts & Style - BODY ================= -->	
	<!-- InstanceBeginEditable name="SCRIPT BODY" -->
	
	  
	 
	<!-- InstanceEndEditable -->
	

	<!-- ============================= jQuery (necessary for Bootstrap's JavaScript plugins) --> 
	<script src="../js/jquery-1.11.3.min.js"></script>
	<!-- ============================= Include all compiled plugins (below), or include individual files as needed --> 
	<script src="../js/bootstrap.js"></script>
	
	<!-- ================= script - MENÚ -->
	<script src="../js/menu/script_menu.js"></script>
		
	<!-- ================= script - SUBIR -->
	<script type="text/javascript" src="../js/subir/subir.js"></script>
		
	<!-- ================= Scripts, Style - PRELOADER -->
	<script src="../js/preloader/preload_final.js"></script>
	
  </body>
<!-- InstanceEnd --></html>