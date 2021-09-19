@extends('plantilla')
@section('titulo', "$titulo")
@section('scripts')
<script>
    globalId = '<?php echo isset($poliza->idpoliza) && $poliza->idpoliza > 0 ? $poliza->idpoliza : 0; ?>';
    <?php $globalId = isset($poliza->idpoliza) ? $poliza->idpoliza : "0"; ?>
</script>
@endsection
@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/admin/home">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/admin/polizas">Poliza</a></li>
    <li class="breadcrumb-item active">Modificar</li>
</ol>
<ol class="toolbar">
    <li class="btn-item"><a title="Nuevo" href="/admin/poliza/nuevo" class="fa fa-plus-circle" aria-hidden="true"><span>Nuevo</span></a></li>
    <li class="btn-item"><a title="Guardar" href="/admin/poliza/nuevo" class="fa fa-floppy-o" aria-hidden="true" onclick="javascript: $('#modalGuardar').modal('toggle');"><span>Guardar</span></a>
    </li>
    @if($globalId > 0)
    <li class="btn-item"><a title="Eliminar" href="/admin/poliza/nuevo" class="fa fa-trash-o" aria-hidden="true" onclick="javascript: $('#mdlEliminar').modal('toggle');"><span>Eliminar</span></a>
    </li>
    @endif
    <li class="btn-item"><a title="Salir" href="/admin/polizas" class="fa fa-arrow-circle-o-left" aria-hidden="true" onclick="javascript: $('#modalSalir').modal('toggle');"><span>Salir</span></a></li>
</ol>
<script>
    function fsalir() {
        location.href = "/admin/polizas";
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
    <div id="msg"></div>
    <?php
    if (isset($msg)) {
        echo '<script>msgShow("' . $msg["MSG"] . '", "' . $msg["ESTADO"] . '")</script>';
    }
    ?>
    <form id="form1" method="POST">
        <div class="row">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
            <input type="hidden" id="id" name="id" class="form-control" value="{{ $globalId }}" required>
            <div class="form-group col-lg-6">
                <label>Número de poliza: *</label>
                <input type="text" id="txtPoliza" name="txtPoliza" class="form-control" value="{{ $poliza->numero_poliza or '' }}" required>
            </div>
            <div class="form-group col-lg-6">
                <label>Fecha de emisión:</label>
                <input type="date" id="txtFecha" name="txtFecha" class="form-control" value="{{ $poliza->fecha_emision or '' }}" required>
            </div>
            <div class="form-group col-lg-6">
                <label for="txtBien">Bien: *</label>
                <input type="text" name="txtBien" id="txtBien" class="form-control" value="{{ $poliza->bien or '' }}">
            </div>
            <div class="form-group col-lg-6">
                <label for="txtFechaInicio">Fecha de Inicio:</label>
                <input type="date" id="txtFechaInicio" name="txtFechaInicio" class="form-control" value="{{ $poliza->fecha_inicio or '' }}" required>
            </div>
            <div class="form-group col-lg-6">
                <label for="txtFechaFin">Fecha de vencimiento:</label>
                <input type="date" id="txtFechaFin" name="txtFechaFin" class="form-control" value="{{ $poliza->fecha_fin or '' }}" required>
            </div>
            <div class="form-group col-lg-6">
                <label for="lstCliente">Cliente: *</label>
                <select name="lstCliente" id="lstCliente" class="form-control selectpicker" data-live-search="true">
                <option value="" disabled>Seleccionar</option>
                @for($i = 0 ; $i < count($array_clientes); $i++)
                @if(isset($poliza)  && $array_clientes[$i]->idcliente   == $poliza->fk_idcliente)
                    <option selected value="{{ $array_clientes[$i]->idcliente or '' }}">{{ $array_clientes[$i]->nombre }}</option>
                    @else
                    <option value="{{ $array_clientes[$i]->idcliente or '' }}">{{ $array_clientes[$i]->nombre }}</option>
                @endif
                @endfor
                </select>
            </div>
            <div class="form-group col-lg-6">
                <label for="txtDomicilioRiesgo">Domicilio de riesgo: *</label>
                <input type="text" name="txtDomicilioRiesgo" id="txtDomicilioRiesgo" class="form-control" value="{{ $poliza->domicilio_riesgo or '' }}">
            </div>
            <div class="form-group col-lg-6">
                <label for="txtRiesgo">Riesgo: *</label>
                <input type="text" name="txtRiesgo" id="txtRiesgo" class="form-control">
            </div>
            <div class="form-group col-lg-6">
                <label for="lstAseguradora">Aseguradora: *</label>
                <select name="lstAseguradora" id="lstAseguradora" class="form-control selectpicker" data-live-search="true">
                <option value="" disabled>Seleccionar</option>
                @for($i = 0 ; $i < count($array_aseguradoras); $i++)
                @if(isset($poliza) && $array_aseguradoras[$i]->idaseguradora  == $poliza->fk_idaseguradora)
                    <option selected value="{{ $array_aseguradoras[$i]->idaseguradora or '' }}">{{ $array_aseguradoras[$i]->nombre }}</option>
                    @else
                    <option value="{{ $array_aseguradoras[$i]->idaseguradora or '' }}">{{ $array_aseguradoras[$i]->nombre }}</option>
                @endif
                @endfor
                </select>
            </div>
            <div class="form-group col-lg-6">
                <label for="lstSeguro">Seguro *</label>
                <select name="lstSeguro" id="lstSeguro" class="form-control selectpicker" data-live-search="true" >
                <option value="" disabled>Seleccionar</option>
                @for($i = 0; $i < count($array_seguros); $i++)
                @if(isset($poliza) && $array_seguros[$i]->idseguro == $poliza->fk_idseguro)
                    <option selected value="{{ $array_seguros[$i]->idseguro }}">{{ $array_seguros[$i]->nombre}}</option>
                @else
                <option value="{{ $array_seguros[$i]->idseguro }}">{{ $array_seguros[$i]->nombre}}</option>
                @endif
                @endfor
                </select>
            </div>
            <div class="form-group col-lg-6">
                <label for="txtSumaAsegurada">Suma asegurada:</label>
                <input type="text" id="txtSumaAsegurada" name="txtSumaAsegurada" class="form-control" value="{{ $poliza->suma_asegurada or '' }}" required>
            </div>
            <div class="form-group col-lg-6">
                <label for="txtEndoso">Endoso:</label>
                <input type="number" id="txtEndoso" name="txtEndoso" class="form-control" value="{{ $poliza->endoso or '' }}" required>
            </div>
            <div class="form-group col-6">
                <label for="txtObservaciones">Observaciones:</label>
                <textarea name="txtObservaciones" id="txtObservaciones" cols="30" rows="10" class="form-control" placeholder="observaciones">
                {{ $poliza->observaciones or '' }}
                </textarea>
            </div>
        </div>

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
            url: "{{ asset('admin/poliza/eliminar') }}",
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
                } else {
                    msgShow("Error al eliminar", "success");
                }
            }
        });
    }
</script>
@endsection