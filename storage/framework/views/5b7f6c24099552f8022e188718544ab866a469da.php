<html>
	<!-- Master template -->
	<head>
		<?php echo $__env->yieldContent('header'); ?>
	</head>
	<body>
		<nav>
			<?php echo $__env->yieldContent('navigation'); ?>
		</nav>
		<?php echo $__env->yieldContent('parallax-container'); ?>
		<?php echo $__env->yieldContent('content'); ?>
		<?php echo $__env->yieldContent('footer'); ?>
	</body>
</html>

