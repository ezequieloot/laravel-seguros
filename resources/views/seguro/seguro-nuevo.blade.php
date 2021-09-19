@extends('plantilla')
@section('titulo', "$titulo")
@section('scripts')
<script>
    globalId = '<?php echo isset($seguro->idseguro) && $seguro->idseguro > 0 ? $seguro->idseguro : 0; ?>';
    <?php $globalId = isset($seguro->idseguro) ? $seguro->idseguro : "0"; ?>
</script>
@endsection
@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/admin/home">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/admin/seguros">Seguros</a></li>
    <li class="breadcrumb-item active">Modificar</li>
</ol>
<ol class="toolbar">
    <li class="btn-item"><a title="Nuevo" href="/admin/seguro/nuevo" class="fa fa-plus-circle" aria-hidden="true"><span>Nuevo</span></a></li>
    <li class="btn-item"><a title="Guardar" href="/admin/seguro/nuevo" class="fa fa-floppy-o" aria-hidden="true" onclick="javascript: $('#modalGuardar').modal('toggle');"><span>Guardar</span></a>
    </li>
    @if($globalId > 0)
    <li class="btn-item"><a title="Eliminar" href="#" class="fa fa-trash-o" aria-hidden="true" onclick="javascript: $('#mdlEliminar').modal('toggle');"><span>Eliminar</span></a>
    </li>
    @endif
    <li class="btn-item"><a title="Salir" href="/admin/seguro/nuevo" class="fa fa-arrow-circle-o-left" aria-hidden="true" onclick="javascript: $('#modalSalir').modal('toggle');"><span>Salir</span></a></li>
</ol>
<script>
    function fsalir() {
        location.href = "/admin/seguro/nuevo";
    }
</script>
@endsection
@section('contenido')

<form id="form1" method="POST">
    <div class="row">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
        <input type="hidden" id="id" name="id" class="form-control" value="{{$globalId}}" required>
        <div class="form-group col-lg-6">
            <label>Nombre: *</label>
            <input type="text" id="txtNombre" name="txtNombre" class="form-control" value="{{ $seguro->nombre }}" required>
        </div>
        <div class="form-group col-lg-6">
            <label>Descripción: *</label>
            <input type="text" id="txtDescripcion" name="txtDescripcion" class="form-control" value="{{ $seguro->descripcion }}" required>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-lg-6">
            <label>Icono: *</label>
            <input type="text" id="txtIcono" name="txtIcono" class="form-control" value="{{ $seguro->icono }}" required>
        </div>
        <div class="form-group col-lg-6">
            <label>Tipo de Seguro: *</label>
            <select name="lstTipoSeguro" id="lstTipoSeguro" class="form-control">
                <option value="" disabled>Seleccionar</option>
                @for($j=0; $j < count($array_tipos); $j++) @if(isset($seguro) && $seguro->fk_idtiposeguro == $array_tipos[$j]->idtiposeguro)
                    <option selected value="{{ $array_tipos[$j]->idtiposeguro }}">{{ $array_tipos[$j]->nombre }}</option>
                    @else
                    <option value="{{ $array_tipos[$j]->idtiposeguro }}">{{ $array_tipos[$j]->nombre }}</option>
                    @endif
                    @endfor
            </select>
        </div>
    </div>

    <div class="modal fade" id="mdlEliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar registro?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">¿Deseas eliminar el registro actual?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary" onclick="eliminar();">Sí</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $("#form1").validate();

        function guardar() {
            if ($("#form1").valid()) {
                modificado = false;
                form1.submit();
            } else {
                $("#modalGuardar").modal('toggle');
                msgShow("Corrija los errores e intente nuevamente.", "danger");
                return false;
            }
        }

        function eliminar() {
            $.ajax({
                type: "GET",
                url: "{{ asset('/admin/seguro/eliminar') }}",
                data: {
                    id: globalId
                },
                async: true,
                dataType: "json",
                success: function(data) {
                    if (data.err = "0") {
                        msgShow("Registro eliminado exitosamente.", "success");
                        $("#btnEnviar").hide();
                        $("#btnEliminar").hide();
                        $('#mdlEliminar').modal('toggle');
                        $("form").hide();
                    } else {
                        msgShow("Error al eliminar", "success");
                    }
                }
            });
        }
    </script>
    @endsection