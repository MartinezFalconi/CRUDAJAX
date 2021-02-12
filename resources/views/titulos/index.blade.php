@extends('titulos.layout')
<head>
    <meta charset="utf-8">
    <title>CRUD</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="js/ajax.js"></script>
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="css/style.css">
</head>
@section('content')
    <div class="row" style="margin-bottom: 20px;">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h3>Titulos</h3>
            </div>
            <form onsubmit="createTitulo(); return false;" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            <input type="text" name="description" id="description" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <input type="submit" value="Añadir titulo">
                        <!-- <button type="submit" class="btn btn-success">Añadir titulo</button> -->
                    </div>
                </div>

            </form>
        </div>
    </div>
 

    <div class="row" id="section-3">
        
    </div>

    <!-- The Modal -->
    <div id="update" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2 id="msg"></h2>
            <form method="post" onsubmit="updateTitulo(); return false;">
                <input type="hidden" name="id_titulo" id="id_titulo">
                <input type="text" name="name" id="name1">
                <input type="text" name="description" id="description1">
                <div style="padding:10px"><input style="display: block;margin-left: auto;margin-right: auto;" type="submit" value="Actualizar"></div>
            </form>
        </div>
    </div>

    {!! $titulos->links() !!}

@endsection