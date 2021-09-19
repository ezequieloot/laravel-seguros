@extends('web.plantilla')

@section('contenido')
<section class="m-t" id="listado">
    <div class="container">
        <div class="row gy-4">
            <div class="col-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Número de póliza</th>
                            <th>Seguro</th>
                            <th>Bien asegurado</th>
                            <th>Aseguradora</th>
                            <th>Fecha emisión</th>
                            <th>Fecha vencimineto</th>
                            <th>Archivo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for($i = 0; $i < count($array_polizas); $i++):
                            <th>{{$array_polizas[$i]->numero_poliza}}</th>
                            <th>{{$array_polizas[$i]->seguro}}</th>
                            <th>{{$array_polizas[$i]->bien}}</th>
                            <th>{{$array_polizas[$i]->aseguradora}}</th>
                            <th>{{$array_polizas[$i]->fecha_emision}}</th>
                            <th>{{$array_polizas[$i]->fecha_fin}}</th>
                        @endfor
                </table>
            </div>
        </div>
    </div>
</section>
@endsection