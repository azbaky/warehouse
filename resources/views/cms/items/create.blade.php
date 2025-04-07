@extends('cms.parent')
@section('title','Add New Item')
@section('page-big-title','Add Items')
@section('page-sub-title',' Item')
@section('page-main-title','Add')

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
              <h3 class="card-title">Add New Item</h3>
            </div>
           
           
            <!-- /.card-header -->
            <!-- form start -->
            <form id="create_form" >
                @csrf
              <div class="card-body">
                
                <div class="form-group">
                  <label for="item_name">Item Name</label>
                  <input type="text" class="form-control" id="item_name"   placeholder="Enter Full Name">
                </div>
                <div class="form-group">
                  <label>Description</label>
                  <textarea class="form-control" rows="3" id="description" placeholder="Enter ..."></textarea>
                </div>
                <div class="form-group">
                  <label for="category">Location</label>
                  <select id="location" name="location" required class="form-control" >
                    <option value="">Select Location</option>
                      <option value="Stand 1">Stand 1</option>
                      <option value="Stand 2">Stand 2</option>
                      <option value="Stand 3">Stand 3</option>
                      <option value="Stand 4">Stand 4</option>
                      <option value="Stand 5">Stand 5</option>
                      <!-- Add more categories as needed -->
                  </select>
              </div>
              <div class="form-group">
                <label for="category">Category</label>
                <select id="category" name="category" required class="form-control" >

                  <option value="">Select a category</option>
                  @foreach ($categories as $category ){
                    <option value=" {{$category->id}}">{{$category->name}}</option>
                  }
                    @endforeach
                    <!-- Add more categories as needed -->
                </select>
              </div>
              <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" id="quantity" name="quantity" placeholder="Enter quantity" required class="form-control">
              </div>
              <div class="form-group">
                <label for="unit_price">Unit Price</label>
                <input type="number" id="unit_price" name="unit_price" step="0.01" placeholder="Enter unit price" required class="form-control">
              </div>
              <div class="form-group">
                <label for="reorder_level">Reorder Level</label>
                <input type="number" id="reorder_level" name="reorder_level" placeholder="Enter reorder level" class="form-control">
               </div>
               <div class="form-group">
                <label for="barcode">Barcode</label>
                <input type="text" id="barcode" name="barcode" placeholder="Enter barcode" class="form-control">
                </div>
                <div class="form-group">
                  <label for="expiry_date">Expiry Date</label>
                  <input type="date" id="expiry_date" name="expiry_date" class="form-control">
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
                <button style="background: green" type="button" onclick="store()" class="btn btn-primary">Add</button>
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
        
        axios.post('/cms/admin/items',{
          item_name:       document.getElementById('item_name').value,
          description:       document.getElementById('description').value,
          location:       document.getElementById('location').value,
          category:document.getElementById('category').value,
          quantity:document.getElementById('quantity').value,
          unit_price:document.getElementById('unit_price').value,
          reorder_level:document.getElementById('reorder_level').value,
          barcode:document.getElementById('barcode').value,

          expiry_date:document.getElementById('expiry_date').value,

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
        //       function showMessage(data){
        //         Swal.fire({
        //           // position: 'top-end',
        //           icon: data.icon,
        //           title: data.title,
        //           showConfirmButton: false,
        //           timer: 1000
        // })}
    </script>
@endsection
