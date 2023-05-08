<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Presupuesto;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CartList extends Component
{
    //
    protected $listeners = ['cart_update' =>'render'];
    public $cart;
    public $rowId;
    public function render()
    {
        $expectedDate = date("Y-m-d");
        $expectedTime = date("H:i");

        $this->cart = Cart::content();
        $this->rowId = null;
        $categorias = Categoria::all();
        $anio_actual = Carbon::now()->year;
        $presupuesto = Presupuesto::where('idUser', Auth::id())->where('anio', $anio_actual)->first();

        return view('livewire.cart-list', ['cart'=>$this->cart, 'categorias'=>$categorias, "expectedDate" => $expectedDate, "expectedTime" => $expectedTime, "presupuesto" => $presupuesto]);
    }

    public function removeFromCart($productoCarritoJson){
        $productoCarrito = json_decode($productoCarritoJson);
        //@dd($productoCarrito);
        $this->rowId = $productoCarrito->rowId;
        Cart::remove($this->rowId);
        $this->emit('product_listeners');
    }
    public function restElementToProduct($productoCarritoJson){
        $productoCarrito = json_decode($productoCarritoJson);
        //@dd($productoCarrito);
        $this->rowId = $productoCarrito->rowId;
        $this->cart = Cart::get($this->rowId);
        Cart::update($this->rowId, $this->cart->qty-1);
        $this->emit('product_listeners');
    }
    public function addElementToProduct($productoCarritoJson){
        $productoCarrito = json_decode($productoCarritoJson);
        //@dd($productoCarrito);
        $this->rowId = $productoCarrito->rowId;
        $this->cart = Cart::get($this->rowId);
        Cart::update($this->rowId, $this->cart->qty+1);
        $this->emit('product_listeners');
    }
    public function clearCart(){
        Cart::destroy();
        $this->emit('product_listeners');
    }
}
