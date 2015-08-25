@extends('layouts.master')
@section('content')
    <nav>
        <div class="nav-wrapper  blue darken-4 ">
            <a href="#" class="brand-logo center">INEGI</a>
            <ul id="nav-mobile" class="left hide-on-med-and-down">
                <li class="active"><a href="soap-inegi">SOAP</a></li>
                <li><a href="rest-inegi">REST</a></li>
            </ul>
        </div>
    </nav>
    <div class="row">
        <div class="col s12">
            <h4>Webservice SOAP</h4>

            <form id="form_data">
                <div class="input-field col s6">
                    <select name="indicador">
                        <option value="1002000001">Población total </option>
                        <option value="1002000002">Población total hombres </option>
                        <option value="1002000003">Población total mujeres  </option>
                        <option value="1002000026">Nacimientos </option>
                        <option value="1002000027">Nacimientos hombres </option>
                        <option value="1002000028">Nacimientos mujeres </option>
                        <option value="1002000030">Defunciones generales </option>
                        <option value="1002000031">Defunciones generales hombres </option>
                        <option value="1002000032">Defunciones generales mujeres </option>
                        <option value="1002000038">Matrimonios   </option>
                        <option value="1002000026">Divorcios   </option>
                        <option value="1002000025">Grado de intensidad migratoria hacia Estados Unidos </option>
                        <option value="1002000039">Tasa de alfabetización de las personas de 15 a 24 años de edad  </option>
                        <option value="1004000001">Población derechohabiente a servicios de salud  </option>
                        <option value="1007000012">Conflictos de trabajo  </option>
                        <option value="1005000039">Población de 5 y más años que habla lengua indígena  </option>
                        <option value="1011000029">Tiendas DICONSA  </option>
                    </select>
                    <label for="indicador">Indicador</label>
                </div>
                <div class="input-field col s6">
                    <select name="ubicacion_geografica">
                        <option value="0">Todo México</option>
                        <option value="1">Aguascalientes</option>
                        <option value="2">Baja California</option>
                        <option value="3">Baja California Sur</option>
                        <option value="4">Campeche</option>
                        <option value="5">Coahuila de Zaragoza</option>
                        <option value="6">Colima</option>
                        <option value="7">Chiapas</option>
                        <option value="8">Chihuahua</option>
                        <option value="9">Distrito Federal</option>
                        <option value="10">Durango</option>
                        <option value="11">Guanajuato</option>
                        <option value="12">Guerrero</option>
                        <option value="13">Hidalgo</option>
                        <option value="14">Jalisco</option>
                        <option value="15">México</option>
                        <option value="16">Michoacán de Ocampo</option>
                        <option value="17">Morelos</option>
                        <option value="18">Nayarit</option>
                        <option value="19">Nuevo León</option>
                        <option value="20">Oaxaca</option>
                        <option value="21">Puebla</option>
                        <option value="22">Querétaro</option>
                        <option value="23">Quintana Roo</option>
                        <option value="24">San Luis Potosí</option>
                        <option value="25">Sinaloa</option>
                        <option value="26">Sonora</option>
                        <option value="27">Tabasco</option>
                        <option value="28">Tamaulipas</option>
                        <option value="29">Tlaxcala</option>
                        <option value="30">Veracruz de Ignacio de la Llave</option>
                        <option value="31">Yucatán</option>
                        <option value="32">Zacatecas</option>
                    </select>
                    <label>Ubicación Geográfica</label>
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
@endsection

@section('scripts')
    <script>
        Ladda.bind( '#btn_enviar' );


        $(document).ready(function() {

            $('select').material_select();

            $('#btn_enviar').click(function(e){
                e.preventDefault();
                var l = Ladda.create(this);
                var indicador = $('select[name="indicador"]').val();
                var ubicacion_geografica = $('select[name="ubicacion_geografica"]').val();
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

                                $('#xml_response').fadeOut().fadeIn().text(xml_formatted);
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
@endsection
