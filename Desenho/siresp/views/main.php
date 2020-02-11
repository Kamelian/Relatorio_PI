<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PI MVC Project!</title>

    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>assets/css/bootstrap.css">
    <!--<link rel="stylesheet" href="<?php echo ROOT_PATH; ?>assets/bootstrap/css/bootstrap.css">-->


	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>-->
	<script src="assets/jquery-3.4.1.min.js"></script>

    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>-->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>


</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand">SiReSp Web Site</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                    <?php if (isset($_SESSION['is_logged_in'])) : ?>
	                <ul class="nav navbar-nav">
	                    <li><a href="<?php echo ROOT_URL; ?>">Home</a></li>
                	    <li><a href="<?php echo ROOT_URL; ?>novidades">Novidades</a></li>
                        <li><a href="<?php echo ROOT_URL; ?>ocorrencias">Ocorrencias</a></li>
                        <li><a href="<?php echo ROOT_URL; ?>piquetes">Piquetes</a></li>
	                </ul>
                    <?php else : ?>
	                <ul class="nav navbar-nav">
	                    <li><a href="<?php echo ROOT_URL; ?>">Home</a></li>
                	    <li><a href="<?php echo ROOT_URL; ?>novidades">Novidades</a></li>
	                </ul>
                    <?php endif; ?>

                <ul class="nav navbar-nav navbar-right">
                    <?php if (isset($_SESSION['is_logged_in'])) : ?>
                        <li><a href="<?php echo ROOT_URL; ?>">Bem Vindo <?php echo $_SESSION['user_data']['name']; ?></a>
                        </li>
                        <!--Resolução Ficha 5 - Código de vista que adiciona ao menu opção de listar utilizaodres -->
                        <li><a href="<?php echo ROOT_URL; ?>users/index">Utilizadores</a></li>
                        <li><a href="<?php echo ROOT_URL; ?>users/logout">Logout</a></li>
                    <?php else : ?>
                        <li><a href="<?php echo ROOT_URL; ?>users/login">Login</a></li>
                    <?php endif; ?>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>

    <footer class="container">

        <div class="row">
            <?php Messages::display(); ?>
            <?php require($view); ?>
        </div>

    </footer><!-- /.container -->

</body>
</html>
