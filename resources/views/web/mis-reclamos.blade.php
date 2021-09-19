@extends('web.plantilla')
@section('contenido')

<section class="m-t" id="reclamo">
    <div class="container" data-aos="fade-up">

        <header class="section-header">
            <h2>Reclamos</h2>
            <p>Historial de reclamos</p>
        </header>
        @if(isset($msg))
            <div class="row">
                <div class="col-12">
                    <p class="alert alert-success">{{ $msg }}</p>
                </div>
            </div>
        @endif
        
        <?php
        if(isset($msg)) {
            echo '<div id = "msg"></div>';
            echo '<script>msgShow("' . $msg . '")</script>';
        }
        ?>

        <div class="row gy-4">
            <div class="col-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Código de reclamo</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Tipo de reclamo</th>
                            <th>Seguro</th>
                            <th>Comentarios</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($aReclamos) and count($aReclamos) > 0)
                            @for($i = 0; $i < count($aReclamos); $i++)
                            <tr>
                                <td>{{ $aReclamos[$i]->codigo }}</td>
                                <td>{{ $aReclamos[$i]->fecha }}</td>
                                <td>{{ $aReclamos[$i]->estado }}</td>
                                <td>{{ $aReclamos[$i]->tipo }}</td>
                                <td>{{ $aReclamos[$i]->seguro }}</td>
                                <td>{{ $aCantidadMensajes[$i] }} Comentarios</td>
                                <td>
                                    <a href="/mis-reclamos/{{ $aReclamos[$i]->idreclamo }}" title="Ver"><i class="fas fa-search"></i></a>
                                    <a href="/mis-reclamos/eliminar/{{ $aReclamos[$i]->idreclamo }}" title="Cancelar"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            @endfor
                        @else
                            <tr><td colspan="7">No posee reclamos registrados.</td></tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection