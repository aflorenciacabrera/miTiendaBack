<?php
use App\cliente;
use Illuminate\Database\Seeder;

class ClienteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $cliente = new cliente();
        $cliente->nombre = 'Flor';
        $cliente->apellido = 'Cabrera';
        $cliente->correo = 'florCab@gmail.com';
        $cliente->telefono = '3795053426';
        $cliente->save();

        $cliente = new cliente();
        $cliente->nombre = 'Ivan';
        $cliente->apellido = 'Sambrana';
        $cliente->correo = 'ivanSamb@gmail.com';
        $cliente->telefono = '3795053426';
        $cliente->save();
    }
}
