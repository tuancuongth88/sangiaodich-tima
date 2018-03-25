<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

  <title>Dashboard - PixelAdmin: Responsive Bootstrap Template</title>

   <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/frontend/css/font-awesome.min.css') }}" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

  <!-- DEMO ONLY: Function for the proper stylesheet loading according to the demo settings -->
    <script>function _pxDemo_loadStylesheet(a,b,c){var c=c||decodeURIComponent((new RegExp(";\\s*"+encodeURIComponent("px-demo-theme")+"\\s*=\\s*([^;]+)\\s*;","g").exec(";"+document.cookie+";")||[])[1]||"clean"),d="rtl"===document.getElementsByTagName("html")[0].getAttribute("dir");document.write(a.replace(/^(.*?)((?:\.min)?\.css)$/,'<link href="$1'+(c.indexOf("dark")!==-1&&a.indexOf("/css/")!==-1&&a.indexOf("/themes/")===-1?"-dark":"")+(!d||0!==a.indexOf("/frontend/css")&&0!==a.indexOf("/frontend/demo")?"":".rtl")+'$2" rel="stylesheet" type="text/css"'+(b?'class="'+b+'"':"")+">"))}
    </script>

  <!-- DEMO ONLY: Set RTL direction -->
  <script>"ltr"!==document.getElementsByTagName("html")[0].getAttribute("dir")&&"1"===decodeURIComponent((new RegExp(";\\s*"+encodeURIComponent("px-demo-rtl")+"\\s*=\\s*([^;]+)\\s*;","g").exec(";"+document.cookie+";")||[])[1]||"0")&&document.getElementsByTagName("html")[0].setAttribute("dir","rtl");</script>

  <!-- DEMO ONLY: Load PixelAdmin core stylesheets -->
  <script>
    _pxDemo_loadStylesheet('/frontend/css/bootstrap.min.css', 'px-demo-stylesheet-bs');
    _pxDemo_loadStylesheet('/frontend/css/bootstrap.min.css', 'px-demo-stylesheet-bs');
    _pxDemo_loadStylesheet('/frontend/css/pixeladmin.min.css', 'px-demo-stylesheet-core');
    _pxDemo_loadStylesheet('/frontend/css/widgets.min.css', 'px-demo-stylesheet-widgets');
  </script>

  <!-- DEMO ONLY: Load theme -->
  <script>
    function _pxDemo_loadTheme(a){var b=decodeURIComponent((new RegExp(";\\s*"+encodeURIComponent("px-demo-theme")+"\\s*=\\s*([^;]+)\\s*;","g").exec(";"+document.cookie+";")||[])[1]||"clean");_pxDemo_loadStylesheet(a+b+".min.css","px-demo-stylesheet-theme",b)}
    _pxDemo_loadTheme('/frontend/css/themes/');
  </script>

  <!-- Demo frontend -->
  <script>_pxDemo_loadStylesheet('/frontend/demo/demo.css');</script>
  <!-- / Demo frontend -->

  <!-- holder.js -->
  <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/holder/2.9.0/holder.js"></script>

  <!-- Pace.js -->
  <script src="{{ URL::asset('/frontend/pace/pace.min.js') }}"></script>

  <script src="{{ URL::asset('/frontend/demo/demo.js') }}"></script>

  <!-- Custom styling -->
  <style>
    .page-header-form .input-group-addon,
    .page-header-form .form-control {
      background: rgba(0,0,0,.05);
    }
  </style>
  <!-- / Custom styling -->
</head>
<body>