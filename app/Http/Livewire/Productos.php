<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Producto;

class Productos extends Component
{
    public $producto, $descripcion, $cantidad, $id_producto;
    public $modal = false;
    public function render()
    {
        $this->productos = Producto::all();
        return view('livewire.productos');
    }

    public function crear()
    {
        $this->resetInputs();
        $this->modal();

    }

    public function modal()
    {
        $this->modal = !$this->modal;
    }

    public function resetInputs()
    {
        $this->descripcion = '';
        $this->cantidad = 0;
        $this->id_producto = '';
    }

    public function editar($id)
    {
        $producto = Producto::findOrFail($id);

        $this->id_producto = $id;
        $this->descripcion = $producto->descripcion;
        $this->cantidad = $producto->cantidad;

        $this->modal();
    }

    public function borrar($id)
    {
        Producto::find($id)->delete();
        session()->flash('message', 'Registro eliminado correctamente!');
    }

    public function guardar()
    {
        Producto::updateOrCreate(
            [
                'id' => $this->id_producto
            ],
            [
                'descripcion' => $this->descripcion,
                'cantidad' => $this->cantidad,
            ]
        );

        session()->flash('message', 
            $this->id_producto ?
                'Actualizacion exitosa!' : 
                'Se guardo el registro correctamente!');

        $this->modal();
        $this->resetInputs();
    }
}
