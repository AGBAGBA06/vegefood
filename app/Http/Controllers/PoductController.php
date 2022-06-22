<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;
use App\Models\Category;
use App\Models\Product;



class PoductController extends Controller
{
    //
    public function products(){
        $utilisateurs= Product::get();
        return view('admin.products')->with('utilisateurs', $utilisateurs);
    }

    public function ajouterproduit(){
      $categories=Category::All()->pluck('category_name','category_name');
        return view('admin.ajouterproduit')->with('categories',$categories);
    }

    //pour l'ajout
    public function sauverproduit(Request $request){
        //$this->validate($request, [''=>'required|unique:utilisateur']);
        $this->validate($request, ['nom'=>'required|unique:products',
                                    'prix'=>'required',
                                    //  'groupe_utilisateur '=>'required',
                                    // 'mot_de_passe'=>'required',
                                    // 'email'=>'required',
                                    'status'=>'required',
                                    'utilisateur_image'=>'image|nullable|max:1999']);

                                    if($request->hasFile('utilisateur_image')){
                                       //1-select image with extension
                                       $fileNameWithExt=$request->file('utilisateur_image')->getClientOriginalName();
                                       //2-get just file name
                                       $fileName=pathinfo($fileNameWithExt,PATHINFO_FILENAME);
                                       //3-get just extension
                                        $extension = $request->file('utilisateur_image')->getClientOriginalExtension();
                                       //4-file name store
                                       $fileNametostore=$fileName.'_'.time().'.'.$extension;
                                       //uplaoder l'image
                                       $path=$request->file('utilisateur_image')->storeAs('public/utilisateur_images',
                                                  $fileNametostore);
                                    }
                                    else{
                                        
                                        $fileNametostore='noimage.jpg';
                                    }
                                    $utilisateur=new Product();
                                    $utilisateur->nom=$request->input('nom');
                                    $utilisateur->prix=$request->input('prix');
                                    // $utilisateur->groupe_utilisateur=$request->input('groupe_utilisateur');
                                    // $utilisateur->mot_de_passe=$request->input('mot_de_passe');
                                    // $utilisateur->email=$request->input('email');
                                    
                                    // $product->product_category=$request->input('product_category');
                                    $utilisateur->utilisateur_image=$fileNametostore;
                                    $utilisateur->status=1;
                                    $utilisateur->save();
                                    return redirect('/ajouterproduit')->with('status','le  produit  '
                                                       .$utilisateur->nom.'  a ete bien ajoute');
                                 
                                }
    
     //pour la modification
     public function edit_produit($id){
        $utilisateur= Product::find($id);
        // $groupeutilisateurs=Utilisateur::All()->pluck('nom','nom');


        return view ('admin.edit_produit')->with('utilisateur',$utilisateur);

         }
         public function modifiermodifier(Request $request){
            $this->validate($request, ['nom'=>'required',
                                        'prix'=>'required',
                                        // 'mot_de_passe'=>'required',
                                        // 'email'=>'required',
                                        'utilisateur_image'=>'image|nullable|max:1999']);
                                        
            $utilisateur= Product::find($request->input('id'));
            $utilisateur->nom=$request->input('nom');
            $utilisateur->prix=$request->input('prix');
            // $utilisateur->mot_de_passe=$request->input('mot_de_passe');
            // $utilisateur->email=$request->input('email');
            // dd($utilisateur);
            if($request->hasFile('utilisateur_image')){
                //1-select image with extension
                $fileNameWithExt=$request->file('utilisateur_image')->getClientOriginalName();
                //2-get just file name
                $fileName=pathinfo($fileNameWithExt,PATHINFO_FILENAME);
                //3-get just extension
                 $extension = $request->file('utilisateur_image')->getClientOriginalExtension();
                //4-file name store
                $fileNametostore=$fileName.'_'.time().'.'.$extension;
                //uplaoder l'image
                $path=$request->file('utilisateur_image')->storeAs('public/utilisateur_images',
                           $fileNametostore);

                           if ($utilisateur->utilisateur_image!='noimage.jpg') {
                            Storage::delete('public/utilisateur_images/'.$utilisateur->image);
                           
                           }
                           $utilisateur->utilisateur_image=$fileNametostore;
             }


            $utilisateur->update();
            return redirect('/products')->with('status',
          'le produit '.$utilisateur->nom.' a ete bien modifier');
         }

    
        //pour activer un produit
public function activer_produit($id){
    $utilisateur= Product::find($id);
    $utilisateur->status=1;
        $utilisateur->update();
        return redirect('/products')->with('status',
        'le produit '.$utilisateur->nom.' a ete bien desactiver');
        
        //pour desactiver un produit
    }
     public function desactiver_produit($id){
        $utilisateur= Product::find($id);
        $utilisateur->status=0;
        $utilisateur->update();
        return redirect('/products')->with('status',
        'la produit '.$utilisateur->nom.' a ete bien active');
}

}
