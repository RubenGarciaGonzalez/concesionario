<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Coche;

class CocheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Desactivamos las constraints
        DB::statement("SET FOREIGN_KEY_CHECKS=0;");
        DB::table('coches')->truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS=1;");

        Coche::create([
            'matricula'=>'1234-JJJ',
            'modelo'=>'Leon',
            'color'=>'Rojo',
            'tipo'=>'Diesel',
            'klms'=>'23000',
            'pvp'=>'14000',
            'marca_id'=>'1'
        ]);

        Coche::create([
            'matricula'=>'2312-SFK',
            'modelo'=>'Golf',
            'color'=>'Azul',
            'tipo'=>'Gasolina',
            'klms'=>'3260',
            'pvp'=>'21000',
            'marca_id'=>'2'
        ]);

        Coche::create([
            'matricula'=>'5235-ASD',
            'modelo'=>'Punto',
            'color'=>'Gris',
            'tipo'=>'Diesel',
            'klms'=>'40000',
            'pvp'=>'12000',
            'marca_id'=>'3'
        ]);

        Coche::create([
            'matricula'=>'1341-TRD',
            'modelo'=>'Clio',
            'color'=>'Amarillo',
            'tipo'=>'Diesel',
            'klms'=>'15340',
            'pvp'=>'9000',
            'marca_id'=>'4'
        ]);

        Coche::create([
            'matricula'=>'1387-TTD',
            'modelo'=>'Megane',
            'color'=>'Verde',
            'tipo'=>'Gasolina',
            'klms'=>'54240',
            'pvp'=>'10500',
            'marca_id'=>'4'
        ]);


        Coche::create([
            'matricula'=>'6346-FOP',
            'modelo'=>'Astra',
            'color'=>'Blanco',
            'tipo'=>'Gasolina',
            'klms'=>'48709',
            'pvp'=>'9500',
            'marca_id'=>'5'
        ]);



    }
}
