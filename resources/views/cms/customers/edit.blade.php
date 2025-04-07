@extends('cms.parent')
@section('title','Edit Customer')
@section('page-big-title','Edit Customer')
@section('page-sub-title',' Edit')
@section('page-main-title','Edit')

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
              <h3 class="card-title">Edit Customer</h3>
            </div>
           
           
            <!-- /.card-header -->
            <!-- form start -->
            <form id="create_form" >
                @csrf
              <div class="card-body">
                
                <div class="form-group">
                  <label for="customer_name">Full Name</label>
                  <input type="text" class="form-control" id="customer_name"  value="{{$customer->name}}" placeholder="Enter Full Name">
                </div>
                
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email"  value="{{$customer->email}}" placeholder="Enter Email">
                </div>
                <div class="form-group">
                  <label for="phone_number">phone Number</label>
                  <input type="number" class="form-control" id="phone_number" value="{{$customer->phone_number}}"  placeholder="Enter phone Number">
                </div>
                <div class="form-group">
                  <label for="address">Address</label>
                  <input type="text" class="form-control" id="address"  value="{{$customer->address}}" placeholder="Enter Address">
                </div>
              </div>
                  
                </div>
                <div class="form-group">
                  <div class="custom-control custom-switch">
                    <input type="checkbox" @if ($customer->customer_status)
                        checked 
                    
                      
                    @endif class="custom-control-input" id="customer_status" >
                    <label class="custom-control-label" for="customer_status">Customer status</label>
                  </div>
                </div>

               
              
              
              </div>
                
                <!-- /.card-body -->

              <div class="card-footer">
                <button style="background: green" type="button" onclick="update({{$customer->id}})" class="btn btn-primary">Submit</button>
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
        
        axios.put('/cms/admin/customers/'+id,{
          customer_name:       document.getElementById('customer_name').value,
          email:               document.getElementById('email').value,
          phone_number:        document.getElementById('phone_number').value,
          address:             document.getElementById('address').value,
          customer_status:     document.getElementById('customer_status').checked,

        })
        .then(function (response) {
          // handle success
          console.log(response);
          window.location.href ='/cms/admin/customers';
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
