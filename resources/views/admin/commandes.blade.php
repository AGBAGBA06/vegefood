@extends('layout.appad')
@section('title')
Commandes
@endsection
{{Form::hidden('',$increment=1)}}
@section('content')
<div class="card">
        <div class="card-body">
          <h4 class="card-title">Commandes</h4>
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
                        <th>Nom du client</th>
                       <th>Adresse</th>
                       <th>Panier</th>
                        <th>Actions
                        3800 - 34000
                        </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($orders as $order)
                    <tr>
                      <td>{{$increment}}</td>
                       <td>{{$order->nom}}</td>
                       <td>{{$order->adresse}}</td>
                       <td> 
                        {{-- {{$order['nom'].','}} --}}
                        @foreach ($order->panier->items as $item)
                        <table>
                          <tr>
                            <td>
                        {{$item['nom']}}
                            </td>
                        
                          <td>
                            {{$item['qty']}}
                          </td>
                        </tr>
                        </table>
                        @endforeach
                      </td>
                       <td>
                          <button class="btn btn-outline-primary" onclick="window.location ='{{url('/voir_pdf/'.$order->id)}}'">View</button>
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
<script src="backend/js/data-table.js"></script>    
@endsection