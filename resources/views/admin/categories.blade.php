@extends('layout.appad')
@section('title')
    Categories
@endsection
{{Form::hidden('',$increment=1)}}
@section('content')
<div class="card">
        <div class="card-body">
          <h4 class="card-title">Categories</h4>
          
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
                        <th>nom de la categorie</th>
                       
                        <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($categories as $category)
                      <tr>
                        <td>{{$increment}}</td>
                        <td>{{$category->category_name}}</td>
                        
                        {{-- <td>
                          <label class="badge badge-info">On hold</label>
                        </td> --}}
                        <td>
                          <button class="btn btn-outline-primary" >
                            <a href="{{url('/edit_categorie/'.$category->id)}}"> edit</a></button>
                          <a href="{{url('/deletecategorie/'.$category->id)}}" id="delete" class="btn btn-outline-danger">Delete</a>
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