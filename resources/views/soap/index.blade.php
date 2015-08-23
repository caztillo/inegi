<!DOCTYPE html>
<html>
<head>
    <!--Import materialize.css-->
    {!! Html::style('css/materialize.min.css',['media' => "screen,projection"]) !!}
    {!! Html::style('css/ladda.min.css') !!}
    {!! Html::style('css/prettify.css') !!}
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>


<div class="container">
    <nav>
        <div class="nav-wrapper  blue darken-4 ">
            <a href="#" class="brand-logo center">INEGI</a>
            <ul id="nav-mobile" class="left hide-on-med-and-down">
                <li class="active"><a href="inegi-soap">SOAP</a></li>
                <li><a href="inegi-rest">REST</a></li>
            </ul>
        </div>
    </nav>
    <div class="row">
        <div class="col s12">
            <h4>Webservice SOAP</h4>

            <form id="form_data">
                <div class="input-field col s6">
                    <input name="indicador" placeholder="1002000001" type="text" class="validate">
                        <label for="indicador">Indicador</label>
                    </div>
                <div class="input-field col s6">
                    <input name="ubicacion_geografica" placeholder="32" type="text" class="validate">
                    <label for="ubicacion_geografica">ubicacionGeografica</label>
                </div>
            </form>
            <div class="col offset-s5 ">
                <br>

                <button id="btn_enviar" class="ladda-button waves-effect waves-light teal accent-4" data-style="expand-right"><span class="ladda-label">Enviar</span></button>

            </div>

        </div>



        <div class="col s12">
            <p>Respuesta:</p>
            <pre style="min-height: 400px;"><code id="xml_response" ></code></pre>
        </div>

    </div>

</div>

<!--Import jQuery before materialize.js-->
{!! Html::script('js/jquery-2.1.1.min.js') !!}
{!! Html::script('js/materialize.min.js') !!}
{!! Html::script('js/spin.min.js') !!}
{!! Html::script('js/ladda.min.js') !!}
{!! Html::script('js/prettify.js') !!}






<script>
    Ladda.bind( '#btn_enviar' );


    $(function() {
        $('#btn_enviar').click(function(e){
            e.preventDefault();
            var l = Ladda.create(this);
            var indicador = $('input[name="indicador"]').val();
            var ubicacion_geografica = $('input[name="ubicacion_geografica"]').val();
            var ajaxData  = {'indicador' : indicador, ubicacion_geografica: ubicacion_geografica, _token: '{{ csrf_token() }}'};

            $.ajax(
                    {
                        type    : "POST",
                        url : '{{ url("soap-inegi-webservice") }}',
                        data : ajaxData,
                        dataType: "xml",

                        beforeSend : function()
                        {
                            //btn.prop('disabled', 'disabled');
                            l.start();
                        },

                        success : function(response, textStatus, jqXHR)
                        {
                            l.stop();
                            var xml = jqXHR.responseText;

                            var xml_formatted = formatXml(xml);

                            $('#xml_response').text(xml_formatted);
                            $('pre').removeClass("prettyprint prettyprinted ").addClass("prettyprint");
                            prettyPrint();

                        },

                        error   : function ( jqXhr, json, errorThrown )
                        {
                            l.stop();
                            var jsonErrors = jqXhr.responseJSON;
                            var errors = '';
                            console.log(jqXhr.responseJSON);
                            $.each( jsonErrors, function( key, value )
                            {
                                errors += '<li>' + value + '</li>';
                            });

                            Materialize.toast(errors, 4000) // 4000 is the duration of the toast
                            //toastr.error( errors , "Error " + jqXhr.status +': '+ errorThrown);

                            return false;
                        }

                    });//end ajax




            return false;
        });
    });

    function formatXml(xml) {
        var formatted = '';
        var reg = /(>)(<)(\/*)/g;
        xml = xml.replace(reg, '$1\r\n$2$3');
        var pad = 0;
        jQuery.each(xml.split('\r\n'), function(index, node) {
            var indent = 0;
            if (node.match( /.+<\/\w[^>]*>$/ )) {
                indent = 0;
            } else if (node.match( /^<\/\w/ )) {
                if (pad != 0) {
                    pad -= 1;
                }
            } else if (node.match( /^<\w[^>]*[^\/]>.*$/ )) {
                indent = 1;
            } else {
                indent = 0;
            }

            var padding = '';
            for (var i = 0; i < pad; i++) {
                padding += '  ';
            }

            formatted += padding + node + '\r\n';
            pad += indent;
        });

        return formatted;
    }
</script>
</body>
</html>