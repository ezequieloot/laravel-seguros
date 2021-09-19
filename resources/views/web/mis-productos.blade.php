@extends('web.plantilla')
@section('contenido')
<section id="productos" class="m-t">
    <div class="container" data-aos="fade-up">

        <header class="section-header">
            <h2>Seguros</h2>
            <p>Mis seguros contratados</p>
        </header>
        <div class="row">

        @if(isset($array_seguros) && count($array_seguros)>0):
            @for($i=0; $i< count($array_seguros); $i++)
                <div class="col-3">
                    <a href="/listado-poliza/{{$array_seguros[$i]->fk_idseguro}}">
                    <div class="col section-header casilla mt-3">
                    <i class="{{ $array_seguros[$i]->icono }}"></i>
                    <h2>{{ $array_seguros[$i]->nombre }}</h2>
                    </div>  
                    </a>
                </div>
            @endfor
        
        </div>    
        <div class="row m-t">
            <div class="col-12 section-header">
                <h2>Reclamos</h2>
                <p>Por acá podés dejarnos un reclamo</p>
            </div>
            <div class="col-12">
            <div class="row">
                <div class="col-6 py-4">
                    <a href="/mis-reclamos" class="a-reclamo">Ver mis reclamos</a>                
                </div>
            </div>
                <form action="" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                    <div class="row">
                        <input type="hidden" id="id" name="id" class="form-control" value="0" required>
                        <input type="hidden" id="txtCodigo" name="txtCodigo" class="form-control" value="{{ @date('YmdHims') }}" required>
                        <input type="hidden" id="anio" name="anio" calss="form-control" value="{{ @date('Y') }}" required>
                        <input type="hidden" id="mes" name="mes" calss="form-control" value="{{ @date('m') }}" required>
                        <input type="hidden" id="dia" name="dia" calss="form-control" value="{{ @date('d') }}" required>
                        <input type="hidden" id="estado" name="estado" calss="form-control" value="1" required>
                        <input type="hidden" id="prioridad" name="prioridad" calss="form-control" value="1" required>
                        <div class="col-12 col-sm-6 offset-sm-3 form-group">
                            <label for="tipo" class="form-label">Asunto: *</label>
                            <select name="tipo" id="tipo" class="form-control" required>
                                <option value="" selected disabled>Seleccionar</option>
                                @for ($i = 0; $i < count($aTipos); $i++)
                                    <option value="{{ $aTipos[$i]->idtiporeclamo }}">{{ $aTipos[$i]->nombre }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-12 col-sm-6 offset-sm-3 form-group">
                            <label for="seguro" class="form-label">Seguro: *</label>
                            <select name="seguro" id="seguro" class="form-control" required>
                                <option value="" selected disabled>Seleccionar</option>
                                @for ($i = 0; $i < count($aSeguros); $i++)
                                    <option value="{{ $aSeguros[$i]->idseguro }}">{{ $aSeguros[$i]->nombre }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-12 col-sm-6 offset-sm-3 form-group">
                            <label for="txtDescripcion" class="form-label">Dejanos tu mensaje: *</label>
                            <textarea name="txtDescripcion" id="txtDescripcion" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

