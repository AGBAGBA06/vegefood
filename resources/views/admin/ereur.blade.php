@extends('layout.appad')
@section('title')
Ajouter produit 
@endsection
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="row grid-margin">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">ajouter produit</h4>
              {!!Form::open(['action'=>'App\Http\Controllers\PoductController@sauverproduit',
                  'method'=>'POST' ,'class'=>'cmxform' , 'id'=>'commentForm']) !!}
               {{ csrf_field() }}
                  <div class="form-group">
                    {{Form::label('','nom produit',['for'=>'cname']) }}
                    {{Form::text('product_name','',['id'=>'cname','class'=>'form-control' ])}}  
                </div>

                <div class="form-group">
                    {{Form::label('','nom produit',['for'=>'cname']) }}
                    {{Form::number('product_price','',['id'=>'cname','class'=>'form-control' ])}} 
                </div>

                <div class="form-group">
                    {{Form::label('','categorie du produit') }}
                    {{-- {!!Form::select('product_category',$categories,null,
                    ['placehoder'=>'select category' ,'class'=>'form-control']) !!}--}}
                   </div> 

                   <div class="form-group">
                    {{Form::label(',"image du produit',['for'=>'cname'])}}
                    {{Form::file('product_picture',['id'=>'cname','class'=>'form-control' ])}}  
                </div>
                 
                {{Form::submit('ajouter',['class'=>'btn btn-primary' ,'id'=>'cname'])}}
                {{!!Form::close()!!}}
            </div>
          </div>
        </div>
      </div>
     </div>
</div>
@endsection
@section('script')
<script src="backend/js/form-validation.js"></script>
<script src="backend/js/bt-maxLength.js"></script>
@endsection