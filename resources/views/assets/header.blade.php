<!--Import Google Icon Font-->
<link href="{{ URL::asset('http://fonts.googleapis.com/icon?family=Material+Icons') }}" rel="stylesheet">

<!-- ReCaptcha -->
<script src="{{ URL::asset('https://www.google.com/recaptcha/api.js') }}"></script>

<!--Import materialize.css-->
<link type="text/css" rel="stylesheet" href="{{ URL::asset('css/materialize.css') }}"  media="screen,projection"/>

<!--Let browser know website is optimized for mobile-->
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ $title }} | ZE Lab</title>