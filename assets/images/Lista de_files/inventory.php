<!Doctype html>
<html lang="es">
	<head>
    	<meta charset="utf-8">
        <title>Domus Property Manager</title>
        <meta name="robots" content="noindex" />
	   <style type="text/css">
            body{
                width:100%;
                padding:0;
                margin:0;
                background-color:#2E3C6B;
                font-size: 62.5%;
           }
            img{border:none;}

            #login{
                position:relative;
                width:800px;
                height:410px;
                top:100px;
                margin-left:50%; 
                left:-400px;
                border:2px solid #000;
                border-radius: 2px;
                -moz-border-radius: 2px;
                -webkit-border-radius: 2px;
                background-color:#FFF;
           }
           .headbox{
               text-align: center;
               margin-top: 30px;
           }
           h1{
               font-size: 1.6em;
               color: dimgray;
               text-transform: uppercase;
           }
           .box-login{
               width: 300px;
               margin: 30px auto;
           }
           .form-row{
               width: 100%;
               margin: 0 auto;
           }
           .form-row label{
               display: block;
               text-align: left;
               font-size: 1.4em;
               color: #232323;
               font-weight: 600;
               margin-top: 10px;    
    
           }
           .input-form{
               width: 100%;
               color: #232323;
               font-size: 1.2em;
               border: 1px groove #ddd;
               padding: 4px;
               border-radius: 2px;
           }
           .btn-box{
               width: 100%;
               text-align: right;
               margin-top: 15px;
           }
           .btn-login{
               padding: 5px 25px;
               font-size: 1.4em;
               color: aliceblue;
               background: #2E3C6B;
               border: 1px groove blue;
               border-radius: 4px;
           }
           .btn-login:hover{
               background:darkblue;
           }
           #palm{position:absolute;left:0;top:110px;}
           .error{
               font-size: 1.3em;
               background: darkred;
               color: white;
               padding: 7px;
               margin-top: 15px;
               border-radius: 3px;
               
           }
        </style>
	</head>
	<body>
		<div id='login'>
               <form action='inicia-sesion.php' method='post'>
                    <div class="headbox">
                        <img width="150" src="../images/icons/logoAzul.png" alt="Logo Domus">
                        <h1>Sistema Integral de Administración</h1>
                    </div>
                    <div class="box-login">
                        <div class="form-row">
                            <label for="user">Usuario</label>
                            <input class="input-form"  type="text" name="user" autofocus required>
                        </div>
                        <div class="form-row">
                            <label for="pass">Contraseña</label>
                            <input class="input-form" type="password" name="pass" required>
                        </div>
                        <div class='error'>Los datos son incorrectos</div>                        <div class="btn-box">
                            <input class="btn-login" type="submit" value="Login" name="login">
                        </div>
                    </div>
			    </form>
			<div id='palm'><img src='images/palm.png'/></div>
		</div>
			
	</body>
</html>