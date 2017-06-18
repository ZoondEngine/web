<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="<?php echo e(URL::asset('https://code.jquery.com/jquery-2.1.1.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/materialize.min.js')); ?>"></script>
<script>
  $(document).ready(function(){
    $('.parallax').parallax();
});

$(document).ready(function() {
  $('input#password, input#passwordRepeat, input#hashtag, textarea#check_description').characterCounter();
});

$('.datepicker').pickadate({
  selectMonths: true, // Creates a dropdown to control month
  selectYears: 50 // Creates a dropdown of 15 years to control year
});
</script>