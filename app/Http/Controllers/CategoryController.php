<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    //pour acceder a la page ajouter categorie
    public function ajoutercategorie()
    {

        return view('admin.ajoutercategorie');
    }
    //pour acceder a la page categorie
    public function categories()
    {
        $categories = Category::get();
        return view('admin.categories')->with('categories', $categories);
    }
    //pour l'ajout
    public function sauvercategorie(Request $request)
    {
        $this->validate($request, ['category_name' => 'required|unique:categories']);
        $categorie = new category();
        $categorie->category_name = $request->input('category_name');
        $categorie->save();
        return redirect('/ajoutercategorie')->with('status','la categorie' . $categorie->category_name . 'a ete bien ajoute'
        );
    }

    //pour la modification
    public function edit_categorie($id)
    {
        $categorie = category::find($id);
        return view('admin.editcategorie')->with('categorie', $categorie);
    }

    public function modifiercategorie(Request $request)
    {
        $this->validate($request, ['category_name' => 'required']);
        $categorie->category::find($request->input('id'));
        $categorie->category_name = $request->input('category_name');
        $categorie->update();
        return redirect('/categories')->with(
            'status',
            'la categorie' . $categorie->category_name . 'a ete bien ajoute'
        );
    }

    //pour la suppression
    public function deletecategorie($id)
    {
        $categorie = Category::find($id);
        $categorie->delete();
        return redirect('/categories')->with(
            'status',
            'la categorie' . $categorie->category_name . 'a ete bien supprimer'
        );
    }
    // public function sauverproduit(Request $request){ }
}
