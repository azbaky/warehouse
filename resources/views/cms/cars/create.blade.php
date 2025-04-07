@extends('cms.parent')
@section('title','Generte car')
@section('page-big-title','Create car')
@section('page-sub-title',' cars')
@section('page-main-title','Create')

@section('styles')
    
@endsection

@section('main-content')
@endsection
@section('content')

<section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header"style="background-color: red ;"  >
              <h3 class="card-title">Generate New Car</h3>
            </div>
           
           
            <!-- /.card-header -->
            <!-- form start -->
            <form id="create_form" >
                @csrf
              <div class="card-body">
                
                <div class="form-group">
                  <label>car Num</label>
                  <input type="number" class="form-control" id="num"   placeholder="car Num" >

                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Car name</label>
                  <input type="text" class="form-control" id="name"   placeholder="Car Name">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">product city</label>
                  <input type="text" class="form-control" id="city"   placeholder="Car city">
                </div>
                <div class="form-group">
                  
                </div>
                <div class="form-group">
                  <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="status" >
                    <label class="custom-control-label" for="status">Car Visible</label>
                  </div>
                </div>

               
              
              
              </div>
                
                <!-- /.card-body -->

              <div class="card-footer">
                <button style="background: green" type="button" onclick="store()" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.card -->

         
         

        </div>
       
  </section>

@endsection

@section('scripts')
    <script>

      function store(){
        
        axios.post('/cms/admin/cars',{
          car_num:        document.getElementById('num').value,
          car_name:       document.getElementById('name').value,
          car_city:       document.getElementById('city').value,
          car_status:     document.getElementById('status').checked,

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
