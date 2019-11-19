<?php

$toName  = 'Emerson Carvalho';
$toEmail = 'abc@abc.com.br';
	

$name    = '';
$email 	 = '';
$phone   = '';
$subject = '';
$message = '';

$return  = array( 'status' => null, 'msg' => null);

if(isset($_POST['form']) && empty($_POST['form'])){
	
	
	$name    = trim($_POST['name']);
	$email 	 = trim(strtolower($_POST['email']));
	$phone   = trim($_POST['phone']);
	$subject = trim($_POST['subject']);
	$message = $_POST['message'];
	
	$async = ( isset($_POST['type'])  && $_POST['type'] == 'async' );
	
	
	//Format message
	$content = '<h1>Contato Site</h1>';
	$content.= sprintf('<strong>Nome</strong>: %s<br/>', $name);
	$content.= sprintf('<strong>Email</strong>: %s<br/>', $email);
	$content.= sprintf('<strong>Telefone</strong>: %s<br/>', $phone);
	$content.= sprintf('<strong>Assunto</strong>: %s<br/>', $subject);
	$content.= sprintf('<strong>Mensagem</strong>:<br/> %s<br/>', $message);
	$content.= sprintf('<small>enviado em: %s</small><br/>', date('d/m/Y - H:i:s'));
	
	if(isset($_SERVER['HTTP_REFERER']))
		$content.= sprintf('<small>%s</small><br/>', $_SERVER['HTTP_REFERER']);
	
	
	$newline = "\r\n";
	
	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . $newline;
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . $newline;

	// Additional headers
	$headers .= sprintf('To: %s <%s>', $toName, $toEmail ) . $newline;
	$headers .= sprintf('From: %s <%s>', $name, $email ) . $newline;
	
	// Mail it
	$sent = mail($toEmail, $subject, $content, $headers);
	if($sent){
		
		$name    = '';
		$email 	 = '';
		$message = '';
		$phone   = ''; 
		
		$return['status'] = 'ok';
		$return['msg']    = 'Contato enviado com sucesso';
		
	}else{
		$return['status'] = 'error';
		$return['msg']    = 'Contato enviado com sucesso';
	}
	
	if( $async )
	{
		echo json_encode($return);
		die();
	}

}

?>


<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8" />

  <!-- Set the viewport width to device width for mobile -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- For third-generation iPad with high-resolution Retina display: -->
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="image-144x144.png">
  <!-- For iPhone with high-resolution Retina display: -->
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="image-114x114.png">
  <!-- For first- and second-generation iPad: -->
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="image-72x72.png">
  <!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
  <link rel="apple-touch-icon-precomposed" href="image-pre-composed.png">
  <!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->

  <link rel="icon" href="favicon.ico" type="image/x-icon" />

  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <meta name="copyright" content="" />

  <title>WebSite Title</title>

	<!-- Included CSS Files -->
	<!--<link rel="stylesheet" href="style.css">-->
  
	<!-- IE Fix for HTML5 Tags -->
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

</head>
<body>

<!-- WEBSITE CONTENT -->

<span id="feedback"><?php echo ($return['msg']) ? $return['msg'] : '' ; ?></span>

 <form action="" method="post" id="contact">  <!-- obs -->
<input type='hidden' name="form" id="form"value="" />

<input type='text' name="name" id="name" value="<?php echo $name; ?>" placeholder="Nome"/><br/>
<input type='text' name="email" id="email" value="<?php echo $email; ?>" placeholder="Email"/><br/>
<input type='text' name="phone" id="phone" value="<?php echo $phone; ?>" placeholder="Telefone"/><br/>
<input type='text' name="subject" id="subject" value="<?php echo $subject; ?>" placeholder="Assunto"/><br/>
<textarea cols="30" rows="5" name="message" id="message"><?php echo $message; ?></textarea>
<input type="submit" value="Enviar"/>

</form>



<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.8.0/jquery-1.8.0.min.js" ></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" ></script>
<script type="text/javascript">
var URL = window.location.protocol + '//'+ window.location.host;
$(document).ready(function(){

        $('#contact').validate({
            rules:{
                name:{
                    required: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    email: true
                },
                phone: {
                    required: true
                },
               message:{
                    required: true,
                    minlength: 3
				}
               
            },
            messages:{
                name:{
                    required: 'O campo nome deve ser preenchido',
                    minlength: 'O nome deve conter no mínimo 3 caracteres'
                },
                email: {
                    required: 'O campo email deve ser preenchido',
                    email: 'O campo email deve ser um email válido'
                },
                phone: {
                    required: 'O campo telefone deve ser preenchido'
                },
               message:{
                    required: 'O campo mensagem deve ser preenchido',
                    minlength: 'O nome deve conter no mínimo 3 caracteres'
				}
            },
            submitHandler: function( form ){
				var info = $( form ).serialize();
                $.ajax({
                    type: 'POST',
                    url: URL,
                    data: info+'&type=async',
                    success: function( data )
                    {
                       	data = eval('('+data+')');
                       	
                       	if(data.status == 'ok')
                       		$('#feedback').text(data.msg);
                       	else
                       		$('#feedback').text(data.msg);
                       		
                       
                    },
                    error: function (request, status, error) {
                    	//Error
                        $('#feedback').text('Erro ao enviar contato, tente novamente mais tarde.');
                    }
                });

                return false;
            }

 
        });
    });
</script>
</body>

</html>