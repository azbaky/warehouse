@extends('cms.parent')
@section('title','Edit Password')
@section('page-big-title','Edit Password ')
@section('page-sub-title',' Auth')
@section('page-main-title','Edit Password')

@section('styles')
    
@endsection
@section('content')
<section class="content" style="background: #ffffff; height: 100vh; display: flex; justify-content: center; align-items: center;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card" style="background: #ffffff; border-radius: 10px;">
                    <div class="card-header" style="background: #11212D; color: white;">
                        <h3 class="card-title">PASSWORD MANAGEMENT</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="create_form" style="background: #9babab;">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="Current-Password">Current Password</label>
                                <input type="password" class="form-control" id="Current-Password" placeholder="Enter Current Password">
                            </div>
                            <div class="form-group">
                                <label for="New_Password">New Password</label>
                                <input type="password" class="form-control" id="New_Password" placeholder="Enter New Password">
                            </div>
                            <div class="form-group">
                                <label for="New_Password_confirmation">New Password Confirmation</label>
                                <input type="password" class="form-control" id="New_Password_confirmation" placeholder="Enter Password Confirmation">
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer" style="background: #11212D;">
                            <button type="button" onclick="updatepassword()" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
    <script>

      function updatepassword(){
        
        axios.put('/cms/admin/update-password',{
          password:        document.getElementById('Current-Password').value,
          new_password: document.getElementById('New_Password').value,
          new_password_confirmation:      document.getElementById('New_Password_confirmation').value,

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
