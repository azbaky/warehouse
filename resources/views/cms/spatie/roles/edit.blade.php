@extends('cms.parent')
@section('title','Edit Role')
@section('page-big-title','Edit role')
@section('page-sub-title',' roles')
@section('page-main-title','Edit')

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
              <h3 class="card-title">Role</h3>
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
                  <input type="text" class="form-control" id="name" value="{{$role->name}} "  placeholder="Enter Name">
                </div>
                
              
              </div>
                
                <!-- /.card-body -->

              <div class="card-footer">
                <button type="button" onclick="update('{{$role->id}}')" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.card -->

         
         

        </div>
       
  </section>

@endsection

@section('scripts')
    <script>

      function update(id){
        
        axios.put('/cms/admin/roles/'+id,{
          name:        document.getElementById('name').value,
          description: document.getElementById('description').value,
          status:      document.getElementById('status').checked,

        })
        .then(function (response) {
          // handle success
          console.log(response);
          window.location.href ='/cms/admin/admins';
          toastr.success(response.data.message);
        })
        .catch(function (error) {
          // handle errorx  x x x x x x
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
