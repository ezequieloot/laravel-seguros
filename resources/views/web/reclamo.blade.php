@extends('web.plantilla')
@section('scripts')
<script>
    globalId = '<?php echo isset($reclamo->idreclamo) && $reclamo->idreclamo> 0 ? $reclamo->idreclamo : 0; ?>';
    <?php $globalId = isset($reclamo->idreclamo) ? $reclamo->idreclamo : "0"; ?> 
</script>
@endsection
@section('contenido')
<section id="comentarios" class="m-t">
    <div class="container" data-aos="fade-up">

        <header class="section-header">
            <h2>Comentarios</h2>
            <p>Trazabilidad de mi reclamo</p>
        </header>
        <div class="row">
            <div class="col-6 py-4">
                <a href="/mis-reclamos" class="a-reclamo">Ver mis reclamos</a>                
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="" method="POST">
                    <div class="row">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                        <input type="hidden" id="id" name="id" class="form-control" value="{{ $globalId }}" required>
                        @if(isset($reclamo))
                        <input type="hidden" id="prioridad" name="prioridad" class="form-control" value="{{ $reclamo->fk_idtipo_prioridad }}" required>
                            <div class="col-12 col-sm-6 form-group">
                                <label for="codigo">Código: </label>
                                <input type="text" id="codigo" name="codigo" class="form-control" value="{{ $reclamo->codigo }}" disabled>
                                <input type="hidden" id="txtCodigo" name="txtCodigo" class="form-control" value="{{ $reclamo->codigo }}" required>
                            </div>
                            <div class="col-12 col-sm-3 form-group">
                                <label for="fecha">Fecha: </label>
                                <input type="text" id="fecha" name="fecha" class="form-control" value="{{ @date_format(date_create($reclamo->fecha), 'd/m/Y') }}" disabled>
                                <input type="hidden" id="anio" name="anio" class="form-control" value="{{ @date_format(date_create($reclamo->fecha), 'Y') }}" required>
                                <input type="hidden" id="mes" name="mes" class="form-control" value="{{ @date_format(date_create($reclamo->fecha), 'm') }}" required>
                                <input type="hidden" id="dia" name="dia" class="form-control" value="{{ @date_format(date_create($reclamo->fecha), 'd') }}" required>
                            </div>
                            <div class="col-12 col-sm-3 form-group">
                                <label for="txtEstado">Estado: </label>
                                <input type="text" id="txtEstado" name="txtEstado" class="form-control" value="{{ $reclamo->estado }}" disabled>
                                <input type="hidden" id="estado" name="estado" class="form-control" value="{{ $reclamo->fk_idestado }}" required>
                            </div>
                            <div class="col-12 col-sm-6 form-group">
                                <label for="txtTipo">Asunto: </label>
                                <input type="text" id="txtTipo" name="txtTipo" class="form-control" value="{{ $reclamo->tipo }}" disabled>
                                <input type="hidden" id="tipo" name="tipo" class="form-control" value="{{ $reclamo->fk_idtipo_reclamo }}" required>
                            </div>
                            <div class="col-12 col-sm-6 form-group">
                                <label for="txtSeguro">Seguro: </label>
                                <input type="text" id="txtSeguro" name="txtSeguro" class="form-control" value="{{ $reclamo->seguro }}" disabled>
                                <input type="hidden" id="seguro" name="seguro" class="form-control" value="{{ $reclamo->fk_idseguro }}" required>
                            </div>
                            <div class="col-12 form-group">
                                <label for="descripcion">Descripcion: </label>
                                <textarea name="descripcion" id="descripcion" class="form-control textarea-autosize" rows="3" disabled>{{ $reclamo->descripcion }}</textarea>
                                <input type="hidden" id="txtDescripcion" name="txtDescripcion" class="form-control" value="{{ $reclamo->descripcion }}" required>
                            </div>
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
                            <div class="form-group col-lg-12 mt-3">
                                <input type="hidden" id="txtReclamo" name="txtReclamo" class="form-control" value="{{ $reclamo->idreclamo }}" required>
                                <label for="txtMensaje">Mensaje: </label>
                                <textarea name="txtMensaje" id="txtMensaje" class="form-control textarea-autosize" rows="3" required></textarea>
                                <button type="submit" class="btn btn-primary my-2">Enviar</button>
                            </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
