<?php
use App\producto;
use Illuminate\Database\Seeder;

class ProductoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $producto = new producto();
        $producto->titulo = 'Letra A';
        $producto->categoria = '3D';
        $producto->precio = '$50';
        $producto->descripcion = '5 x 10 cm';
        $producto->imagenProducto = '';
        $producto->save();

        $producto = new producto();
        $producto->titulo = 'Letra B';
        $producto->categoria = '3D';
        $producto->precio = '$50';
        $producto->descripcion = '5 x 10 cm';
        $producto->imagenProducto = '';
        $producto->save();

        $producto = new producto();
        $producto->titulo = 'Letra C';
        $producto->categoria = '3D';
        $producto->precio = '$50';
        $producto->descripcion = '5 x 10 cm';
        $producto->imagenProducto = '';
        $producto->save();

        $producto = new producto();
        $producto->titulo = 'Letra D';
        $producto->categoria = '3D';
        $producto->precio = '$50';
        $producto->descripcion = '5 x 10 cm';
        $producto->imagenProducto = '';
        $producto->save();
    }
}
