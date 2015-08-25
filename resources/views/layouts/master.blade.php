<!DOCTYPE html>
<html lang="es">
<head>
    <!--Import materialize.css-->
    {!! Html::style('css/materialize.min.css',['media' => "screen,projection"]) !!}
    {!! Html::style('css/ladda.min.css') !!}
    {!! Html::style('css/prettify.css') !!}

    <title>INEGI WebServices</title>
    <meta charset=UTF-8">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>


<div class="container">
    @yield('content')
</div>

<!--Import jQuery before materialize.js-->
{!! Html::script('js/jquery-2.1.1.min.js') !!}
{!! Html::script('js/materialize.min.js') !!}
{!! Html::script('js/spin.min.js') !!}
{!! Html::script('js/ladda.min.js') !!}
{!! Html::script('js/prettify.js') !!}

@yield('scripts')

</body>
</html>
