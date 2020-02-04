@extends('plantillas.plantilla')
@section('titulo')
    Detalle Coche
@endsection
@section('cabecera')
    Detalles Coche Matrícula <i><b>{{($coch->matricula)}}</b></i>
    <a href="{{route('coches.index')}}" class="btn btn-info ml-5">Volver</a>
@endsection
@section('contenido')
    <p class="font-weight-bold ml-3">Matrícula: {{$coch->matricula}}</p>
    <p class="font-weight-bold ml-3">Marca: {{$coch->marca->nombre}}
        <img src="{{asset($coch->marca->logo)}}" width="40vw" height="40vh" class="ml-3">
    </p>
    <p class="font-weight-bold ml-3">País: {{$coch->marca->pais}}</p>
    <table class="ml-3" cellspacing="2" cellpading="3" border="1px solid black">
        <tr>
            <td>
                <p class="font-weight-bold ml-3">Modelo: {{$coch->modelo}}</p>
            </td>
            <td rowspan="3">
                <img src="{{asset($coch->foto)}}" width="100vw" height="100vh">
            </td>
        </tr>
        <tr>
            <td>
                <p class="font-weight-bold ml-3">Color: {{$coch->color}}</p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="font-weight-bold ml-3">Tipo: {{$coch->tipo}}</p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="font-weight-bold ml-3">Precio: {{$coch->pvp}}</p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="font-weight-bold ml-3">Kilómetros: {{$coch->klms}}</p>
            </td>
        </tr>
    </table>
@endsection