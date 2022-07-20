

@extends('layout.appad')
@section('title')
Produits
@endsection
{{Form::hidden('',$increment=1)}}
@section('content')
<div class="card">
        <div class="card-body">
          <h4 class="card-title">Produits</h4>
          
          @if (Session::has('status'))
          <div class="alert alert-success">
            {{Session::get('status')}}
          </div>
        @endif
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                <table id="order-listing" class="table">
                  <thead>
                    <tr>
                        <th>Order #</th>
                        <th>image <br> du produit</th>
                        <th>nom de<br>  produit</th>
                        <th>prix<br>  du produit</th>
                        <th>categorie</th>
                        <th>status <br> du produit</th>
                        <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($produits as $user)
                      <tr>
                        <td>{{$increment}}</td>
                      <td><img src="storage/product_images/{{$user->product_image}}" alt=""></td>
                      <td>{{$user->nom}}</td>
                      <td>{{$user->prix}}</td>
                      <td>{{$user->product_category}}</td>
                      
                      <td>
                        @if ($user->status==1)
                        <label class="badge badge-success">Activé</label>
                        @else
                        <label class="badge badge-danger">desactivé</label>
                        @endif
                      </td>
                      {{-- <td>
                          <label class="badge badge-info">On hold</label>
                        </td> --}}
                        <td>
                          <button class="btn btn-outline-primary" >
                            <a href="{{url('/editproduit/'.$user->id)}}"> edit</a></button>
                          <a href="{{url('/deleteproduit/'.$user->id)}}" id="delete" class="btn btn-outline-danger">Delete</a>
                        @if ($user->status==1)
                       <button class="btn btn-outline-warning" >
                            <a href="{{url('/desactiver_produit/'.$user->id)}}"> desactivé</a></button>
                         @else
                          <button class="btn btn-outline-primary" >
                            <a href="{{url('/activer_produit/'.$user->id)}}">activé</a></button>
                        @endif
                        </td>
                      </tr>
                      {{Form::hidden('',$increment=$increment+1)}}
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
 
@endsection
@section('script')
{{-- <script src="backend/js/data-table.js"></script>     --}}
@endsection