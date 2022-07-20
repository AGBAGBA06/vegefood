@extends('layout.appad')
@section('title')
Edit produit
@endsection
@section('content')
      <div class="row grid-margin">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Editer produit</h4>
              
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
                {!!Form::open(['action'=>'App\Http\Controllers\PoductController@modifierproduit',
                  'method'=>'POST','class'=>'cmxform' ,'id'=>'commentForm'])!!}
                 {{ csrf_field() }}
                 {{ Form::hidden ('id',$product->id) }}

                 <div class="form-group">
                   {{Form::label('','nom du produit',['for'=>'cname'])}}
                   {{Form::text('nom',$product->nom,['class'=>'form-control','id'=>'cname'])}}
                  </div>
                  
                  <div class="form-group">
                    {{Form::label('','prix du produit',['for'=>'cprenom'])}}
                    {{Form::number('prix',$product->prix,['class'=>'form-control','id'=>'cprenom'])}}
                   </div>

                   <div class="form-group">
                    {{Form::label('','categorie du produit') }}
                    {{Form::select('product_category',$categories,$product->product_category,
                    ['class'=>'form-control'])}}
                   </div>

                    

                   <div class="form-group">
                    {{Form::label('','status du produit',['for'=>'cstatus'])}}
                    {{Form::number('status',$product->status,['class'=>'form-control','id'=>'cstatus'])}}
                   </div>
                  
                  <div class="form-group">
                    {{Form::label('','image du produit',['for'=>'cname'])}}
                    {{Form::file('product_image',['class'=>'form-control','id'=>'cname'])}}
                   </div> 
                  
                  {{Form::submit('modifier',['class'=>'btn btn-primary'])}}
                  {!!Form::close()!!}
               
              </form>
            </div>
          </div>
        </div>
      
      </div>
@endsection

@section('script')
{{-- <script src="backend/js/form-validation.js"></script>
<script src="backend/js/bt-maxLength.js"></script> --}}
@endsection