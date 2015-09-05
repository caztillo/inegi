@extends('layouts.master')
@section('content')
    <nav>
        <div class="nav-wrapper  blue darken-4 ">
            <a href="#" class="brand-logo center">INEGI</a>
            <ul id="nav-mobile" class="left hide-on-med-and-down">
                <li ><a href="soap">SOAP</a></li>
                <li class="active"><a href="rest">REST</a></li>
            </ul>
        </div>
    </nav>
    <div class="row">
        <div class="col s12">
            <h4>Webservice REST</h4>

            <form id="form_data">
                <div class="input-field col s12">
                    <input name="url" type="text" class="validate" value="{{url("rest/api/v1/indicador/1002000001/ubicacion/32/periodo/2010")}}">
                    <label for="url">URL</label>
                </div>
            </form>
            <div class="col offset-s5 ">
                <br>

                <button id="btn_enviar" class="ladda-button waves-effect waves-light teal accent-4" data-style="expand-right"><span class="ladda-label">Enviar</span></button>

            </div>

        </div>



        <div class="col s12">
            <p>Gráfica</p>
            <div id="chart"></div>
            <p>Respuesta:</p>
            <pre style="min-height: 400px;"><code id="json_response" ></code></pre>
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        Ladda.bind( '#btn_enviar' );


        $(document).ready(function() {


            $('#btn_enviar').click(function(e){
                e.preventDefault();
                var btn = $('#btn_enviar');
                var l = Ladda.create(this);
                var url_rest = $('input[name="url"]').val();


                var ajaxData  = {'url' : url_rest, _token: '{{ csrf_token() }}'};
                $.ajax(
                        {
                            type    : "POST",
                            url : '{{ url("curl") }}',
                            data : ajaxData,
                            dataType: "json",

                            beforeSend : function()
                            {
                                //btn.prop('disabled', 'disabled');
                                l.start();
                                btn.prop('disabled', true);
                            },

                            success : function(response, textStatus, jqXHR)
                            {

                                l.stop();
                                btn.prop('disabled', false);
                                var json = jqXHR.responseText;
                                var json_parsed = JSON.parse(json);
                                var json_formatted = JSON.stringify(json_parsed, null, "\t"); // Indented with tab

                                $('#json_response').fadeOut().fadeIn().text(json_formatted);
                                $('pre').removeClass("prettyprint prettyprinted ").addClass("prettyprint");
                                prettyPrint()

                                if(!json_parsed.error)
                                {
                                    var url_params = url_rest.split("/api/").pop();


                                    $.get("{{url('graph')}}?url="+url_params,function(data) {

                                        var chart = c3.generate({
                                            data: {
                                                json: data.json,
                                            },
                                            axis: {
                                                x: {
                                                    type: 'category',
                                                    categories: data.keys
                                                }
                                            },

                                        });

                                    }, "json").success(function() { $('#chart').fadeOut().fadeIn();  })
                                            .error(function()
                                            {

                                                $('#chart').fadeOut(); Materialize.toast(json_parsed.mensaje, 4000)
                                            })
                                }
                                else
                                {
                                    $('#chart').fadeOut(); Materialize.toast(json_parsed.mensaje, 4000)
                                }



                            },

                            error   : function ( jqXhr, json, errorThrown )
                            {
                                l.stop();
                                var jsonErrors = jqXhr.responseJSON;
                                var errors = '';
                                var json = jqXhr.responseText;
                                var json_parsed = JSON.parse(json);
                                $.each( jsonErrors, function( key, value )
                                {
                                    errors += '<li>' + value + '</li>';
                                });

                                Materialize.toast(json_parsed.mensaje, 4000) // 4000 is the duration of the toast
                                //toastr.error( errors , "Error " + jqXhr.status +': '+ errorThrown);

                                return false;
                            }

                        });//end ajax




                return false;
            });


        });





    </script>
@endsection
