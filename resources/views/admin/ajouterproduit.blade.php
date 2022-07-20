@extends('layout.appad')
@section('title')
Ajouter utilisateur
@endsection
@section('content')
      <div class="row grid-margin">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">ajouter utilisateur</h4>
              
              @if (Session::has('status'))
                  <div class="alert alert-success">
                    {{Session::get('status')}}
                  </div>
                @endif
                @if (count($errors)>0)
                  <div class="alert alert-danger">
                    <ul>
                      @foreach ($errors->all() as $error)
                      <li>{{$error}}</li>
                      @endforeach
                    </ul>
                  </div>
               @endif
               <div>
               {!!Form::open(['action'=>'App\Http\Controllers\PoductController@sauverproduit',
               'method'=>'POST','class'=>'cmxform','id'=>'commentForm','enctype'=>'multipart/form-data'])!!}
                 {{ csrf_field() }}
                  <div class="form-group">
                   {{Form::label('','nom du produit',['for'=>'cname'])}}
                   {{Form::text('nom','',['class'=>'form-control','id'=>'cname'])}}
                  </div>

                  <div class="form-group">
                    {{Form::label('','prix du produit',['for'=>'cprenom'])}}
                    {{Form::number('prix','',['class'=>'form-control','id'=>'cprenom'])}}
                   </div>

                     <div class="form-group">
                    {{Form::label('','categorie du produit') }}
                    {{Form::select('product_category',$categories,null,
                    ['placeholder'=>'select category' ,'class'=>'form-control'])}}
                   </div> 


                
                   <div class="form-group">
                    {{Form::label('','status du produit',['for'=>'cstatus'])}}
                    {{Form::text('status','',['class'=>'form-control','id'=>'cstatus'])}}
                   </div>

                   
                 
                  <div class="form-group">
                    {{Form::label('','image du produit',['for'=>'cname'])}}
                    {{Form::file('product_image',['class'=>'form-control','id'=>'cname'])}}
                   </div> 

                  {{Form::submit('ajouter',['class'=>'btn btn-primary'])}}
                  {!!Form::close()!!}
               
              </div>
            </div>
          </div>
        </div>
     
      </div>
@endsection

@section('script')
{{-- <script src="backend/js/form-validation.js"></script>
<script src="backend/js/bt-maxLength.js"></script> --}}
@endsection