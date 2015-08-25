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
                    <input name="url" type="text" class="validate">
                    <label for="url">URL</label>
                </div>
            </form>
            <div class="col offset-s5 ">
                <br>

                <button id="btn_enviar" class="ladda-button waves-effect waves-light teal accent-4" data-style="expand-right"><span class="ladda-label">Enviar</span></button>

            </div>

        </div>



        <div class="col s12">
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

                                var json_formatted = JSON.stringify(JSON.parse(json), null, "\t"); // Indented with tab

                                $('#json_response').fadeOut().fadeIn().text(json_formatted);
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


    </script>
@endsection
