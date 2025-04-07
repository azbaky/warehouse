@extends('cms.parent')
@section('title','Edit Item')
@section('page-big-title','Edit Items')
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
              <h3 class="card-title">Edit items</h3>
            </div>
           
           
            <!-- /.card-header -->
            <!-- form start -->
            <form id="create_form" >
              @csrf
            <div class="card-body">
              
              <div class="form-group">
                <label for="item_name">Item Name</label>
                <input type="text" class="form-control" id="item_name" value="{{$item->name}}"  placeholder="Enter Full Name">
              </div>
              <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" rows="3" id="description" value="{{$item->description}}" placeholder="Enter ..."></textarea>
              </div>
              <div class="form-group">
                <label for="category">Location</label>
                <select id="location" name="location" required class="form-control" >
                    <option value="" >set location</option>
                    <!-- Add more categories as needed -->
                </select>
            </div>
            <div class="form-group">
              <label for="category">Category</label>
              <select id="category" name="category" required class="form-control" >
                  <option value="" >Select a category</option>
                  <option value="1">Electronics</option>
                  <option value="2">Furniture</option>
                  <option value="3">Clothing</option>
                  <option value="4">Stationery</option>
                  <!-- Add more categories as needed -->
              </select>
            </div>
            <div class="form-group">
              <label for="quantity">Quantity</label>
              <input type="number" id="quantity" name="quantity" value="{{$item->quantity}}" placeholder="Enter quantity" required class="form-control">
            </div>
            <div class="form-group">
              <label for="unit_price">Unit Price</label>
              <input type="number" id="unit_price" name="unit_price" value="{{$item->unit_price}}" step="0.01" placeholder="Enter unit price" required class="form-control">
            </div>
            <div class="form-group">
              <label for="reorder_level">Reorder Level</label>
              <input type="number" id="reorder_level" name="reorder_level" value="{{$item->reorder_level}} placeholder="Enter reorder level" class="form-control">
             </div>
             <div class="form-group">
              <label for="barcode">Barcode</label>
              <input type="text" id="barcode" name="barcode" value="{{$item->barcode}}  placeholder="Enter barcode" class="form-control">
              </div>
              <div class="form-group">
                <label for="expiry_date">Expiry Date</label>
                <input type="date" id="expiry_date" alue="{{$item->expiry_date}} name="expiry_date" class="form-control">
              </div>
              
              
            </div>
                
              </div>
              {{-- <div class="form-group">
                <div class="custom-control custom-switch">
                  <input type="checkbox" class="custom-control-input" id="customer_status" >
                  <label class="custom-control-label" for="customer_status">Customer status</label>
                </div>
              </div> --}}

             
            
            
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
