@extends('cms.parent')
@section('title','Edit Admin')
@section('page-big-title','Edit Admin')
@section('page-sub-title',' Admins')
@section('page-main-title','Edit')

@section('styles')
<link rel="stylesheet" href="{{asset('cms/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('cms/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    
@endsection
@php
    $skipMainContent = true; 
@endphp
@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit Admin</h3>
            </div>
           
           
            <!-- /.card-header -->
            <!-- form start -->
            <form id="create_form" >
                @csrf
              <div class="card-body">
                <div class="form-group">
                  <label>Role</label>
                  <select class="form-control" id="role" style="width: 100%;">
                    @foreach ($roles as $role ){
                      <option value="{{$role->id}}" @if($adminrole->id == $role->id) selected @endif > {{$role->name}} </option>
                    }
                      
                    @endforeach
                    {{-- <option value="admin"  >Admin</option>
                    <option value="brker" >Broker</option> --}}
                    
                  </select>
                </div>
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" value="{{$admin->name}}"   placeholder="Enter Name">
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" value="{{$admin->email}}"  placeholder="Enter Email">
                </div>
                
              
              </div>
                
                <!-- /.card-body -->

              <div class="card-footer">
                <button type="button" onclick="update({{$admin->id}})" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.card -->

         
         

        </div>
       
  </section>

@endsection

@section('scripts')
    <script src="{{asset('cms/plugins/select2/js/select2.full.min.js')}}"></script>
    <script>
      $('#role').select2({
      theme: 'bootstrap4'
    })

      function update(id){
        
        axios.put('/cms/admin/admins/'+id,{
          role_id:      document.getElementById('role').value,
          name:         document.getElementById('name').value,
          email:        document.getElementById('email').value,

        })
        .then(function (response) {
          // handle success
          console.log(response);
          toastr.success(response.data.message);
        })
        .catch(function (error) {
          // handle error
          console.log(error);
          toastr.error(error.response.data.message);


        })
        

      }
      function showMessage(data){
        Swal.fire({
          // position: 'top-end',
          icon: data.icon,
          title: data.title,
          showConfirmButton: false,
          timer: 1000
})}
    </script>
@endsection
