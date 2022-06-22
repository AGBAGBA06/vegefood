<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;

class SliderController extends Controller
{
    //
    public function slider(){
        $sliders= Slider::get();
        return view('admin.slider')->with('sliders', $sliders);
    }
   
    public function ajouterslider(){
      $sliders=Slider::get();
        return view('admin.ajouterslider')->with('sliders',$sliders);
    }
    
    public function sauverslider( Request $request ){
        $this->validate($request, ['description_one'=>'required',
                                    'description_two'=>'required',
                                    'slider_image'=>'image|nullable|max:1999']);
        if($request->hasFile('slider_image')){
           //1-select image with extension
           $fileNameWithExt=$request->file('slider_image')->getClientOriginalName();
           //2-get just file name
           $fileName=pathinfo($fileNameWithExt,PATHINFO_FILENAME);
           //3-get just extension
            $extension = $request->file('slider_image')->getClientOriginalExtension();
           //4-file name store
           $fileNametostore=$fileName.'_'.time().'.'.$extension;
           //uplaoder l'image
           $path=$request->file('slider_image')->storeAs('public/slider_images',$fileNametostore);
                      
        }
        else{
            $fileNametostore='noimage.jpg';
        }
        $slider=new Slider();
        $slider->description_one=$request->input('description_one');
        $slider->description_two=$request->input('description_two');
        $slider->slider_image=$fileNametostore;
        $slider->status=1;
        $slider->save();
        return redirect('/ajouterslider')->with('status','le  slider  a ete bien ajoute');  
                           
    }
        //pour la suppression
    
         public function deleteslider($id){
        $slider = Slider::find($id);
        $slider->delete();
        return redirect('/slider')->with('status','la slider  a ete bien supprimer'
        );
    }
    //pour activer un slider
     public function activer_slider($id){
        $slider= Slider::find($id);
        $slider->status=1;
            $slider->update();
            return redirect('/slider')->with('status',
            'la slider  a ete bien desactiver');
            
            //pour desactiver un slider
        }
          public function desactiver_slider($id){
            $slider= Slider::find($id);
            $slider->status=0;
            $slider->update();
            return redirect('/slider')->with('status',
            'la slider a ete bien active');
    }
}