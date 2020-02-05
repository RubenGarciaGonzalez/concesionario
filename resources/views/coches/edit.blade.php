@extends('plantillas.plantilla')
@section('titulo')
    Editar Coche
@endsection
@section('cabecera')
    Modificar Coche
@endsection
@section('contenido')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $miError)
                <li>{{$miError}}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form name="c" method="POST" action="{{route('coches.update', $coch)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-row">
            <div class="col">
                <input type="text" class="form-control" value="{{$coch->matricula}}" name="matricula" required>
            </div>
            <div class="col">
                <select name="marca_id" class="form-control">
                    @foreach ($marcas as $item)
                        @if ($coch->marca_id==$item->id)
                            <option value="{{$item->id}}" selected>{{$item->nombre}}</option>
                            @else
                            <option value="{{$item->id}}">{{$item->nombre}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col">
                <input type="text" class="form-control" value="{{$coch->modelo}}" name="modelo" required>
            </div>
        </div>

        <div class="form-row mt-3">
            <div class="col">
              <input type="text" class="form-control" value="{{$coch->color}}" name="color">
            </div>
            <div class="col">
              <select name="tipo" class="form-control">
                  @foreach ($tipos as $tipo)
                      @if ($tipo==$coch->tipo)
                        <option selected>{{$tipo}}</option>
                        @else
                        <option>{{$tipo}}</option>
                      @endif
                  @endforeach
              </select>
            </div>
            <div class="col">
                <input type="text" class="form-control" value="{{$coch->klms}}" name="klms" required>
            </div>
            <div class="col">
                <input type="number" class="form-control" value="{{$coch->pvp}}" name="pvp" step="0.50" min="100" required >
            </div>
        </div>
        <div class="form-row mt-3">
            <div class="col">
                <img src="{{asset($coch->foto)}}" width="60vw" height="60vh" class="mr-5 rounded-circle">
                <b>Imagen</b>&nbsp; <input type="file" name="foto" accept="image/*">
            </div>  
        </div>
        <div class="form-row mt-3">
            <div class="col">
                <input type="submit" value="Modificar" class="btn btn-success mr-3">
                <a href="{{route('coches.index')}}" class="btn btn-info mr-3">Volver</a>
            </div>  
        </div>
    </form>
@endsection