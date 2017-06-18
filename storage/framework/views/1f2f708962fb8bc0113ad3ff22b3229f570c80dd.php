<!--Import Google Icon Font-->
<link href="<?php echo e(URL::asset('http://fonts.googleapis.com/icon?family=Material+Icons')); ?>" rel="stylesheet">

<!-- ReCaptcha -->
<script src="<?php echo e(URL::asset('https://www.google.com/recaptcha/api.js')); ?>"></script>

<!--Import materialize.css-->
<link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset('css/materialize.css')); ?>"  media="screen,projection"/>

<!--Let browser know website is optimized for mobile-->
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

<title><?php echo e($title); ?> | ZE Lab</title>