<!DOCTYPE html>

<html>
<head>

	<title></title>

	<link href="/favicon.ico" rel="icon" type="image/x-icon" />

	<meta name='description' content='Medieval Europe is an historical browser game with elements of rpg content=strategy and deep mechanics.' />
	<meta name='content-type' content='text/html; charset=utf-8'  />
	<meta name='viewport' content='width=device-width content=initial-scale=1.0' />
	<meta name='Content-Language' content='en' />
	<meta name='X-UA-Compatible' content='IE=8' />
	<meta name='keywords' content='medieval, historical, browser game, rpg content=strategy'  />
	<meta name='robots' content='all' />

    <?php
	// fogli di stile

	echo <link rel="stylesheet" type="text/css" href="{{ asset('media/js/bootstrap/css/bootstrap.css') }}" />
	echo <link rel="stylesheet" type="text/css" href="{{ asset('media/js/bootstrap/css/theme.min.css') }}" />
	echo <link rel="stylesheet" type="text/css" href="{{ asset('media/js/bootstrap/css/custom.css') }}" />

?>
</head>

<body>

<div class="container">

<?= $content ; ?>

</div>
	<!-- Scripts -->
	<script src="{{ asset('media/js/jquery/jquery-2.1.4.min.js') }}"></script>
	<script src="{{ asset('media/js/bootstrap/js/bootstrap.min.js') }}"></script>
</body>
</html>
