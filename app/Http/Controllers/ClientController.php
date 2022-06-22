<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
class ClientController extends Controller
{
    //
    function home(){
     $slider=Slider::where('status',1)->get();
     $product=Product::where('status',1)->get();

        return view ('client.home')->with('slider',$slider)->with('product',$product);
    }



    function cart(){
        return view ('client.cart');
    }


    function shop(){
        $categorie=category::get();
        $product=Product::where('status',1)->get();
        return view ('client.shop')->with('categorie',$categorie)->with('product',$product);
    }

    function select_by_cat($name){
        $categorie=category::get()->with('product',$product);
        $product=Product::where('product_category',$name)->where('status',1)->get();
        return view ('client.shop')->with('product',$product);
    }

    function checkout(){
        return view ('client.checkout');
    }
    function signup(){
        return view ('client.signup');
    }
    function login(){
        return view ('client.login');
    }
}
