@extends('layout.appad')
@section('title')
Edit produit
@endsection
@section('content')
      <div class="row grid-margin">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Edit produit</h4>
              
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
                 {{ Form::hidden ('id',$utilisateur->id) }}

                 <div class="form-group">
                   {{Form::label('','nom du produit',['for'=>'cname'])}}
                   {{Form::text('nom',$utilisateur->nom,['class'=>'form-control','id'=>'cname'])}}
                  </div>
                  
                  <div class="form-group">
                    {{Form::label('','prix du produit',['for'=>'cprenom'])}}
                    {{Form::number('prix',$utilisateur->prix,['class'=>'form-control','id'=>'cprenom'])}}
                   </div>

                    {{-- pour faire la selection des categorie d'element --}}
                   {{-- <div class="form-group">
                    {{Form::label('','categorie du produit') }}
                    {{Form::select('groupe_utilisateur',$utilisateurs,$user->groupe_utilisateur,
                    ['placeholder'=>'select groupe' ,'class'=>'form-control'])}}
                   </div> --}}

                   {{-- <div class="form-group">
                    {{Form::label('','mot de passe de l\'utilisateur',['for'=>'cpassword'])}}
                    {{Form::text('mot_de_passe',$utilisateur->mot_de_passe,['class'=>'form-control','id'=>'cpassword'])}}
                   </div> --}}

                   {{-- <div class="form-group">
                    {{Form::label('','email de l\'utilisateur',['for'=>'cemail'])}}
                    {{Form::email('email',$utilisateur->email,['class'=>'form-control','id'=>'cemail'])}}
                   </div> --}}

                   <div class="form-group">
                    {{Form::label('','status du produit',['for'=>'cstatus'])}}
                    {{Form::number('status',$utilisateur->status,['class'=>'form-control','id'=>'cstatus'])}}
                   </div>
                  
                  <div class="form-group">
                    {{Form::label('','image du produit',['for'=>'cname'])}}
                    {{Form::file('utilisateur_image',['class'=>'form-control','id'=>'cname'])}}
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