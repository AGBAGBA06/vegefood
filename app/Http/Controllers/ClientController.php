<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Models\Client;
use App\Models\Contact;
use App\Cart;
use Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Stripe\Charge;
use Stripe\Stripe;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use App\Mail\SendMail;



class ClientController extends Controller
{
    //
    function home(){
     $slider=Slider::where('status',1)->get();
     $product=Product::where('status',1)->get();

        return view ('client.home')->with('slider',$slider)->with('product',$product);
    }


    function contact(){
           return view ('client.contact');
       }

            //  function sendEmail(Request $request){
            //      $this->validate($request, ['email' => 'email|required', 
            //                                      'nom' => 'required',
            //                                  'subject' => 'required',
            //                                  'message' => 'required']);
            //        $client = new contact();
            //        $client->nom = $request->input('nom');
            //      $client->email = $request->input('email');
            //      $client->subject = $request->input('subject');
            //      $client->message= $request->input('message');
            //      $client->save();
            //  return back()->with ('status','message bien envoyer');
            //      return view ('client.contact')->with('status','message envoye avec succes');
            //     }


        // function sendEmail(Request $request){
        //    $details=[
        //     'name'=>$request->name,
        //     'email'=>$request->email,
        //     'subject'=>$request->subject,
        //     'message'=>$request->message
        //    ];
           
        //    Mail::to('agbagbaameyo@gmail.com')->send(new ContactMail($details));
        //     //return back()->with ('status','message bien envoyer');
        //     return view ('client.contact')->with('status','message envoye avec succes');
        // }




         
 //pour afficher notre panier
    function cart(){
        if(!Session::has('cart')){
            return view('client.cart');
        }

        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        return view('client.cart', ['products' => $cart->items]);
    
        //return view ('client.cart');
    }




    function shop(){
        $categories=category::get();
        $product=Product::where('status',1)->get();
        return view ('client.shop')->with('categories',$categories)->with('product',$product);
    }


    function select_by_cat($name){
        $categories=Category::get();
        $product=Product::where('product_category',$name)->where('status',1)->get();
        return view  ('client.shop')->with('product',$product)->with('categories',$categories);
    }

   //*****pour ajouter des produits au panier****** */
    function ajouter_au_panier($id){
        $products=Product::find($id);
        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($products, $id);
        Session::put('cart', $cart);
        //dd(Session::get('cart'));
       return redirect('/shop');
    }
// pour retirer un produit du panier
    function retirer_produit($id){
        
        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
       
        if(count($cart->items) > 0){
            Session::put('cart', $cart);
        }
        else{
            Session::forget('cart');
        }
        //dd(Session::get('cart'));
        return redirect::to('/cart');
    }

        
    //********pour modifier la quantite de produit ajoutee au panier**********/
    function modifier_panier(Request $request, $id){
        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->updateQty($id, $request->quantity);
        Session::put('cart', $cart);
        //dd(Session::get('cart'));
        return redirect::to('/cart');
    }


       //***pour acceder a la page paiement**** */
    function checkout(){
       
        if (!Session::has('client')) {
            # code...
            return view ('client.loogin');
        }
        if (!Session::has('cart')) {
            # code...
            return view ('client.cart');
        }
        return view ('client.checkout');
       }



       function payer(Request $request){
        if(!Session::has('cart')){
            return view('client.cart');
        }
        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        
        Stripe::setApiKey('sk_test_51LMxEzEbkqWBGaKiqPSJApwwbOOqVMvJKO86EaeBFFOsO8kI7LUmsyBfAXifKH1KDDUQUMQcFa3nbsuZu2lwEdMc005POgJelo');
        try {


            $charge = Charge::create(array(
                "amount" => $cart->totalPrice * 100,
                "currency" => "usd",
                "source" => $request->input('stripeToken'), // obtainded with Stripe.js
                "description" => "Test Charge"
            ));

          $order=new Order();
          $order->nom=$request->input('name');
          $order->adresse=$request->input('address');
          $order->panier=serialize($cart);
          $order->payment_id=$charge->id;
          $order->save();

          $orders=Order::where('payment_id',$charge->id)->get();
          $orders->transform (function($orders,$key){
         $orders->panier= serialize($orders->panier);
          return $orders;
          
    });

    $email=Session::get('client')->email;
    Mail::to($email)->send(new SendMail($orders));

              
        } catch(\Exception $e){
            Session::put('error', $e->getMessage());
            return redirect('/checkout');
        }

        Session::forget('cart');
        //Session::put('success', 'Purchase accomplished successfully !');
        return redirect::to('/cart')->with('status','achat accompli avec succes');
       }

       
  //**pour acceder a la page signup** */
    function signup(){
        return view ('client.signup');
    }

  //**pour acceder a la page loogin** */
 function loogin(){
        return view ('client.loogin');
    }

   //***pour creer un compte*** */
    function creer_compte(Request $request){
        $this->validate($request, ['email' => 'email|required|unique:clients', 
                                    'password' => 'required|min:4']);
          $client = new client();
        $client->email = $request->input('email');
        $client->password = bcrypt($request->input('password'));
        $client->save();
        return back()->with ('status','compte bien creer');
    }


  //**pour acceder a son compte***/
    
    function acceder_compte(Request $request){
        $this->validate($request, ['email' => 'email|required',
                                    'password' =>'required']);

                                    $client=Client::where('email',$request->input('email'))->first();
                                    
                                    if ($client) {
                                        # code...
                                        if (Hash::check($request->input('password'),$client->password )) {
                                            # code...
                                            Session::put('client',$client);
                                            return redirect ('/shop');
                                        } else {
                                            # code...
                                        return back()->with ('status','mauvais mot de pass ou email ');

                                        }
                                        
                                    } else {
                                        # code...
                                        return back()->with ('status','vous n\'avez pas compte ');

                                    }
                                    
          }

  //pour se deconnecter//
          function logout(){
           Session::forget('client');
            return back();
        }

         
}
