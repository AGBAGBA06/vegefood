@extends('layout.appad')
@section('title')
   Slider
@endsection

@section('content')
<div class="card">
        <div class="card-body">
          <h4 class="card-title">Slider</h4>
          {{Form::hidden('',$increment=1)}}
@section('content')
<div class="card">
        <div class="card-body">
          <h4 class="card-title">produitss</h4>
          
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
                        <th>images</th>
                       <th>description one</th>
                       <th>description two</th>
                      <th>status</th>
                        <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      @foreach ($sliders as $slider)
                      <tr>
                        <td>{{$increment}}</td>
                        <td><img src="/storage/product_images/{{$slider->slider_image}}" alt=""></td>
                        <td>{{$slider->description_one}}</td>
                        <td>{{$slider->description_two}}</td>
                        {{-- <td>{{$slider->product_category}}</td> --}}
                        <td>
                          @if ($slider->status==1)
                          <label class="badge badge-success">Activé</label>
                            
                          @else
                          <label class="badge badge-danger">desactive</label>
                            
                          @endif</td>
                        
                          
                          <td>
                            <button class="btn btn-outline-primary" >                         
                              <a href="{{url('/edit_slider/'.$slider->id)}}" id="edit">edit</a></button>
  
                            <a href="{{url('/deleteslider/'.$slider->id)}}" id="delete" class="btn btn-outline-danger">Delete</a>
                            @if ($slider->status==1)
                            <button class="btn btn-outline-warning" >
                                 <a href="{{url('/desactiver_slider/'.$slider->id)}}"> desactive</a></button>
                              @else
                               <button class="btn btn-outline-primary" >
                                 <a href="{{url('/activer_slider/'.$slider->id)}}">active</a></button>
                            
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
<script src="backend/js/data-table.js"></script>    
@endsection