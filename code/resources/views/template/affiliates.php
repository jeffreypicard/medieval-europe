<!DOCTYPE html>

<head>

	<title><?php
		if ( !isset( $title ))
			echo 'Medieval Europe - Affiliate System';
		else
			echo $title ?>
	</title>

	<link href="/favicon.ico" rel="icon" type="image/x-icon" />

	<meta name='description' content='Medieval Europe is an historical game with elements of roleplay and strategy set in medieval age.' />
	<meta name='viewport' content='width=device-width content=initial-scale=1.0' />
	<meta name='content-type' content='text/html; charset=utf-8' />
	<meta name='Content-Language' content='en' />
	<meta name='X-UA-Compatible' content='IE=8' />
	<meta name='keywords' content='medieval, historical, roleplay game content=strategy'  />
	<meta name='robots' content='all' />

	<!-- Bootstrap -->
	<!-- Latest compiled and minified CSS -->

	<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.0/themes/base/jquery-ui" />
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min" />
	<link rel="stylesheet" type="text/css" href="{{ asset('media/css/affiliates.css') }}" />

	<?= html::script('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js', FALSE); ?>
	<?= html::script('https://code.jquery.com/ui/1.12.0/jquery-ui.min.js', FALSE); ?>


	<?= html::script('https://code.jquery.com/jquery-2.1.4.min.js', FALSE); ?>
	<?= html::script('https://code.jquery.com/ui/1.11.4/jquery-ui.min.js', FALSE); ?>

	<script type="text/javascript">
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
          ga('set', 'anonymizeIp', true);
	  ga('create', 'UA-11143472-3', 'medieval-europe.eu');
	  ga('send', 'pageview');

	</script>

</head>

<body>

<div class="container">

	<div class="row" id="header">

			<div class="col-xs-12 col-md-12 text-center">
				<?= html::anchor(kohana::config('medeur.supporturl'), 'Support', array( 'target' => 'blank'  ) );?>	-
				<?= html::anchor(kohana::config('medeur.gameurl'), 'Game', array( 'target' => 'blank'  ) );?>	-
				<?= html::anchor('affiliate/login', 'Login');?>
			</div>


	</div>

	<div class="row">
		<div id="content" class="col-xs-12 ">
			<?php $message = Session::instance()->get('user_message'); echo $message ?>
			<?php echo $content ?>
			<br style='clear:both'/>
		</div>
	</div>


</div> <!-- container-->

<?= html::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', FALSE); ?>
<?= html::script('https://code.jquery.com/ui/1.11.4/jquery-ui.min.js', FALSE); ?>

</body>
</html>
