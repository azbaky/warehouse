@extends('cms.parent')
@section('title','Create Role')
@section('page-big-title','Create Role')
@section('page-sub-title',' Roles')
@section('page-main-title','Create')

@section('styles')
<link rel="stylesheet" href="{{asset('cms/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('cms/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    
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
              <h3 class="card-title">Create Role</h3>
            </div>
           
           
            <!-- /.card-header -->
            <!-- form start -->
            <form id="create_form" >
                @csrf
              <div class="card-body">
                <div class="form-group">
                  <label>Role</label>
                  <select class="form-control" id="role" style="width: 100%;">
                    <option value="admin"  >Admin</option>
                    <option value="broker" >Broker</option>
                    
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" id="name"   placeholder="Enter Name">
                </div>
                
              
              </div>
                
                <!-- /.card-body -->

              <div class="card-footer">
                <button type="button" onclick="store()" class="btn btn-primary">Submit</button>
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

      function store(){
        
        axios.post('/cms/admin/roles',{
          name:      document.getElementById('name').value,
          guard:     document.getElementById('role').value,

        })
        .then(function (response) {
          // handle success
          console.log(response);
          document.getElementById('create_form').reset();
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
