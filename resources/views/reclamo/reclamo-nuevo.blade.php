@extends('plantilla')
@section('titulo', "$titulo")
@section('scripts')
<script>
    globalId = '<?php echo isset($reclamo->idreclamo) && $reclamo->idreclamo> 0 ? $reclamo->idreclamo : 0; ?>';
    <?php $globalId = isset($reclamo->idreclamo) ? $reclamo->idreclamo : "0"; ?>
</script>
@endsection
@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/admin/home">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/admin/reclamos">Reclamo</a></li>
    <li class="breadcrumb-item active">Modificar</li>
</ol>
<ol class="toolbar">
    <li class="btn-item"><a title="Nuevo" href="/admin/reclamo/nuevo" class="fa fa-plus-circle" aria-hidden="true"><span>Nuevo</span></a></li>
    <li class="btn-item"><a title="Guardar" href="#" class="fa fa-floppy-o" aria-hidden="true" onclick="javascript: $('#modalGuardar').modal('toggle');"><span>Guardar</span></a></li>
    @if($globalId > 0)
    <li class="btn-item"><a title="Eliminar" href="#" class="fa fa-trash-o" aria-hidden="true" onclick="javascript: $('#mdlEliminar').modal('toggle');"><span>Eliminar</span></a></li>
    @endif
    <li class="btn-item"><a title="Salir" href="#" class="fa fa-arrow-circle-o-left" aria-hidden="true" onclick="javascript: $('#modalSalir').modal('toggle');"><span>Salir</span></a></li>
</ol>
<script>
function fsalir() {
    location.href ="/admin/reclamos";
}
</script>
@endsection
@section('contenido')
<?php
if (isset($msg)) {
    echo '<div id = "msg"></div>';
    echo '<script>msgShow("' . $msg["MSG"] . '", "' . $msg["ESTADO"] . '")</script>';
}
?>
<div class="panel-body">
    <div id = "msg"></div>
    <?php
    if (isset($msg)) {
        echo '<script>msgShow("' . $msg["MSG"] . '", "' . $msg["ESTADO"] . '")</script>';
    }
    ?>
    <form id="form1" method="POST">
        <div class="row">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
            <input type="hidden" id="id" name="id" class="form-control" value="{{ $globalId }}" required>
            @if (isset($reclamo))
                <div class="form-group col-lg-6">
                    <label for="codigo">Código: *</label>
                    <input type="text" id="codigo" name="codigo" class="form-control" value="{{ $reclamo->codigo }}" disabled>
                    <input type="hidden" id="txtCodigo" name="txtCodigo" class="form-control" value="{{ $reclamo->codigo }}" required>
                </div>
                <div class="form-group col-lg-6">
                    <label for="usuario">Usuario: *</label>
                    <input type="text" id="usuario" name="usuario" class="form-control" value="{{ $reclamo->usuario }}" disabled>
                    <input type="hidden" id="txtUsuario" name="txtUsuario" class="form-control" value="{{ $reclamo->usuario }}" required>
                </div>
            @else
                <input type="hidden" id="txtCodigo" name="txtCodigo" class="form-control" value="{{ @date('YmdHims') }}" required>
            @endif
            <div class="form-group col-lg-2">
                <label for="dia">Día: *</label>
                <select name="dia" id="dia" class="form-control" required>
                    <option value="{{ @date('d') }}" selected>{{ @date("d") }}</option>
                    <option value="" disabled>Seleccionar</option>
                    @for ($i = 1; $i <= 31; $i++)
                        @if (isset($reclamo) and $i == date_format(date_create($reclamo->fecha), "d"))
                            <option value="{{ $i }}" selected>{{ $i }}</option>
                        @else
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endif
                    @endfor
                </select>
            </div>
            <div class="form-group col-lg-2">
                <label for="mes">Mes: *</label>
                <select name="mes" id="mes" class="form-control" required>
                    <option value="{{ @date('m') }}" selected>{{ @date("m") }}</option>
                    <option value="" disabled>Seleccionar</option>
                    @for ($i = 1; $i <= 12; $i++)
                        @if (isset($reclamo) and $i == date_format(date_create($reclamo->fecha), "m"))
                            <option value="{{ $i }}" selected>{{ $i }}</option>
                        @else
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endif
                    @endfor
                </select>
            </div>
            <div class="form-group col-lg-2">
            <label for="anio">Año: *</label>
                <select name="anio" id="anio" class="form-control" required>
                    <option value="{{ @date('Y') }}" selected>{{ @date("Y") }}</option>
                    <option value="" disabled>Seleccionar</option>
                    @for ($i = date("Y"); $i >= date("Y") - 125; $i--)
                        @if (isset($reclamo) and $i == date_format(date_create($reclamo->fecha), "Y"))
                            <option value="{{ $i }}" selected>{{ $i }}</option>
                        @else
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endif
                    @endfor
                </select>
            </div>
            <div class="form-group col-lg-6">  
                <label for="estado">Estado: *</label>
                <select name="estado" id="estado" class="form-control" required>
                    <option value="" selected disabled>Seleccionar</option>
                    @for ($i = 0; $i < count($aEstados); $i++)
                        @if (isset($reclamo) and $aEstados[$i]->idestado == $reclamo->fk_idestado)
                            <option selected value="{{ $aEstados[$i]->idestado }}">{{ $aEstados[$i]->nombre }}</option>
                        @else
                            <option value="{{ $aEstados[$i]->idestado }}">{{ $aEstados[$i]->nombre }}</option>
                        @endif
                    @endfor
                </select>
            </div>
            <div class="form-group col-lg-6">
                <label for="tipo">Tipo: *</label>
                <select name="tipo" id="tipo" class="form-control" required>
                    <option value="" selected disabled>Seleccionar</option>
                    @for ($i = 0; $i < count($aTipos); $i++)
                        @if (isset($reclamo) and $aTipos[$i]->idtiporeclamo == $reclamo->fk_idtipo_reclamo)
                            <option selected value="{{ $aTipos[$i]->idtiporeclamo }}">{{ $aTipos[$i]->nombre }}</option>
                        @else
                            <option value="{{ $aTipos[$i]->idtiporeclamo }}">{{ $aTipos[$i]->nombre }}</option>
                        @endif
                    @endfor
                </select>
            </div>
            <div class="form-group col-lg-6">
                <label for="prioridad">Prioridad: *</label>
                <select name="prioridad" id="prioridad" class="form-control" required>
                    <option value="" selected disabled>Seleccionar</option>
                    @for ($i = 0; $i < count($aPrioridades); $i++)
                        @if (isset($reclamo) and $aPrioridades[$i]->idtipo_prioridad == $reclamo->fk_idtipo_prioridad)
                            <option selected value="{{ $aPrioridades[$i]->idtipo_prioridad }}">{{ $aPrioridades[$i]->nombre }}</option>
                        @else
                            <option value="{{ $aPrioridades[$i]->idtipo_prioridad }}">{{ $aPrioridades[$i]->nombre }}</option>
                        @endif
                    @endfor
                </select>
            </div>
            <div class="form-group col-lg-6">
                <label for="seguro">Seguro: *</label>
                <select name="seguro" id="seguro" class="form-control" required>
                    <option value="" selected disabled>Seleccionar</option>
                    @for ($i = 0; $i < count($aSeguros); $i++)
                        @if (isset($reclamo) and $aSeguros[$i]->idseguro == $reclamo->fk_idseguro)
                            <option selected value="{{ $aSeguros[$i]->idseguro }}">{{ $aSeguros[$i]->nombre }}</option>
                        @else
                            <option value="{{ $aSeguros[$i]->idseguro }}">{{ $aSeguros[$i]->nombre }}</option>
                        @endif
                    @endfor
                </select>
            </div>
            <div class="form-group col-lg-12">
                <label for="txtDescripcion">Descripcion: *</label>
                <textarea name="txtDescripcion" id="txtDescripcion" class="form-control" required>@if (isset($reclamo)) {{ $reclamo->descripcion }} @endif</textarea>
            </div>
            @if (isset($reclamo))
                <!-- Validar que exista un mensaje asociado al reclamo !-->
                @if (isset($aMensajes) and count($aMensajes) > 0)
                    <div class="col-lg-12 mt-3">
                        <h2 class="text-center">Mensajes</h2>
                    </div>
                    @for ($i = 0; $i < count($aMensajes); $i++)
                        <div class="col-lg-10 offset-1">
                            <table class="table table-bordered my-2">
                                <tr><th>{{ $aMensajes[$i]->usuario }}</th><th width="200">{{ $aMensajes[$i]->fecha }}</th></tr>
                                <tr><td colspan="2">{{ $aMensajes[$i]->mensaje }}</td></tr>
                            </table>
                        </div>
                    @endfor
                @endif
                <div class="form-group col-lg-12 my-5">
                    <input type="hidden" id="txtReclamo" name="txtReclamo" class="form-control" value="{{ $reclamo->idreclamo }}" required>
                    <label for="txtMensaje">Mensaje: </label>
                    <textarea name="txtMensaje" id="txtMensaje" class="form-control" rows="3"></textarea>
                    <a title="Guardar" href="#" class="btn btn-primary my-2" aria-hidden="true" onclick="javascript: $('#modalGuardar').modal('toggle');"><span>Enviar nuevo mensaje</span></a>
                </div>
            @endif
        </div>
    </form>
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
            url: "{{ asset('admin/reclamo/eliminar') }}",
            data: { id:globalId },
            async: true,
            dataType: "json",
            success: function (data) {
                if (data.err = "0") {
                    msgShow("Registro eliminado exitosamente.", "success");
                    $("#btnEnviar").hide();
                    $("#btnEliminar").hide();
                    $('#mdlEliminar').modal('toggle');
                } else {
                    msgShow("Error al eliminar", "success");
                }
            }
        });
    }

</script>
@endsection