@extends('cms.parent')
@section('title','Edit City')
@section('page-big-title','Edit City')
@section('page-sub-title',' Cities')
@section('page-main-title','edit')

@section('styles')
    
@endsection
@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit City</h3>
            </div>
            
            <!-- /.card-header -->
            <!-- form start -->
            @if ($errors->any())
            
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h5><i class="icon fas fa-ban"></i> Alert!</h5>
              @foreach ($errors->all() as $error){
                <li>{{$error}}</li>

              }
              
              @endforeach
              
            </div>
            @endif
            @if (session()->has('message'))
                <div class="alert alert-{{session('alert-type')}} alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-check"></i> Alert!</h5>
                  {{session('message')}}
                </div>
                @endif
            <form action="{{route('cities.update',$city->id)}}" method="POST" >
              @method('PUT')

              @csrf
                  
                            
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="{{$city->Name}}" placeholder="{{$city->name}}" >
                </div>
               
               
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.card -->

         
         

        </div>
       
  </section>

@endsection

@section('scripts')
    
@endsection
