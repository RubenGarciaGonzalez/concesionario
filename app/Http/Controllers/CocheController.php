<?php

namespace App\Http\Controllers;

use App\Coche;
use App\Marca;
use App\Rules\Matricula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CocheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $miMarca = $request->get('marca_id');

        $marcas = Marca::orderBy('nombre')->get();
        
        $coches = Coche::orderBy('marca_id')
            ->marca_id($miMarca)
            ->paginate(3);
        return view('coches.index', compact('coches', 'marcas', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $marcas = Marca::orderBy('nombre')->get();
        return view('coches.create', compact('marcas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'matricula' => ['required', 'unique:coches,matricula', new Matricula()],
            'modelo' => ['required'],
        ]);
        //Compruebo si he subido archivos
        if ($request->has('foto')) {
            $request->validate([
                'foto' => ['image'],
            ]);
            //Todo bien -> hemos subido un archivo y es de imagen
            $file = $request->file('foto');
            //Creo un nombre
            $nombre = 'coches/' . time() . '_' . $file->getClientOriginalName();
            //Guardo el archivo de imagen
            Storage::disk('public')->put($nombre, \File::get($file));
            //Guardo el coche pero la imagen estaría mal
            $coche = Coche::create($request->all());
            //Actualiza el registro foto del coche guardado
            $coche->update(['foto' => "img/$nombre"]);
        } else {
            Coche::create($request->all());
        }

        return redirect()->route('coches.index')->with('mensaje', "Coche guardado correctamente");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Coche  $coche
     * @return \Illuminate\Http\Response
     */
    public function show(Coche $coch)
    {
        return view('coches.show', compact('coch'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Coche  $coche
     * @return \Illuminate\Http\Response
     */
    public function edit(Coche $coch)
    {
        $marcas = Marca::orderBy('nombre')->get();
        $tipos = ['Diesel', 'Gasolina', 'Hibrido', 'Eléctrico', 'Gas (GNC/GLC)'];
        return view('coches.edit', compact('coch', 'marcas', 'tipos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coche  $coche
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coche $coch)
    {
        $request->validate([
            'matricula' => ['required', 'unique:coches,matricula, ' . $coch->id, new Matricula()],
            'modelo' => ['required'],
        ]);
        //Compruebo si he subido archivos
        if ($request->has('foto')) {
            $request->validate([
                'foto' => ['image'],
            ]);
            //Todo bien -> hemos subido un archivo y es de imagen
            $file = $request->file('foto');
            //Creo un nombre
            $nombre = 'coches/' . time() . '_' . $file->getClientOriginalName();
            //Guardo el archivo de imagen
            Storage::disk('public')->put($nombre, \File::get($file));
            //Si he subido una foto nueva, borro la vieja salvo que sea default.jpg
            if (basename($coch->foto) != 'default.jpg') {
                unlink($coch->foto);
            }
            //Ahora actualizo el coche
            $coch->update($request->all());
            $coch->update(['foto' => "img/$nombre"]);

        } else {
            $coch->update($request->all());
        }

        return redirect()->route('coches.index')->with('mensaje', "Coche modificado");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coche  $coche
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coche $coch)
    {
        //Dos cosas: borrar la imagen si no es default.jpg
        //Y borrar registro
        $foto = $coch->foto;
        if (basename($foto) != 'default.jpg') {
            //La fotografía NO es default.jpg
            unlink($foto);
        }
        //En cualquier caso borro el registro
        $coch->delete();
        return redirect()->route('coches.index')->with('mensaje', 'Coche Eliminado');
    }
}
