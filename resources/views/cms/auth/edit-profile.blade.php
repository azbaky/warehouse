@extends('cms.parent')
@section('title','Edit profile')
@section('page-big-title','Edit profile ')
@section('page-sub-title',' Auth')
@section('page-main-title','edit profile')

@section('styles')
    
@endsection
@section('content')
<section class="content" style="background: #ffffff ; height: 100vh; display: flex; justify-content: center; align-items: center;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header" style="background: #11212D;">
                        <h3 class="card-title">Profile Information</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="create_form" style="background: #9babab;">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" value="{{$user->name}}" placeholder="Enter Name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" value="{{$user->email}}" placeholder="Enter Email">
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer" style="background: #11212D;">
                            <button type="button" id="refreshButton" onclick="updateProfile()" class="btn btn-primary">Submit</button>
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
      {{-- <script>
        document.getElementById("refreshButton").addEventListener("click", function() {
            // Refresh the page
            location.reload();
        });
      </script>  --}}
          <script>

      function updateProfile(){
        
        axios.put('/cms/admin/update-profile',{
          name:        document.getElementById('name').value,
          email: document.getElementById('email').value,
          

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
