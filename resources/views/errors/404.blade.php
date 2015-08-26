@extends('layouts.master')
@section('content')
    <nav>
        <div class="nav-wrapper  blue darken-4 ">
            <a href="#" class="brand-logo center">INEGI</a>
            <ul id="nav-mobile" class="left hide-on-med-and-down">
                <li class="active"><a href="soap">SOAP</a></li>
                <li><a href="rest">REST</a></li>
            </ul>
        </div>
    </nav>
    <div class="row center-align">
        <h1>Error 404</h1>
        <h4>La página que busca no esta disponible.</h4>
            <a href="{{url('/')}}" class="waves-effect waves-light teal accent-4 btn">
                Regresar al inicio </a>
            <a href="mailto:pablo.castillo@cimat.mx?Subject=INEGI%20de%20WebServices" class="waves-effect waves-light blue darken-4 btn">Contacto </a>

    </div>
@endsection