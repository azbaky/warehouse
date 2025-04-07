@extends('cms.parent')
@section('title','Edit category')
@section('page-big-title','Edit category')
@section('page-sub-title',' categories')
@section('page-main-title','Edit')

@section('styles')
    
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
              <h3 class="card-title">Edit Category</h3>
            </div>
           
           
            <!-- /.card-header -->
            <!-- form start -->
            <form id="edit_form" >
                @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" id="name"  value="{{$category->name}}"  placeholder="Enter Name">
                </div>
                <div class="form-group">
                  <label>Description</label>
                  <textarea class="form-control" rows="3" id="description" placeholder="Enter ..."> {{$category->description}} </textarea>
                </div> 
                <div class="form-group">
                  
                </div>
                <div class="form-group">
                  <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" @if ($category->status) checked @endif id="status" >
                    <label class="custom-control-label" for="status">Visible</label>
                  </div>
                </div>

               
              
              
              </div>
                
                <!-- /.card-body -->

              <div class="card-footer">
                <button type="button" onclick="update('{{$category->id}}')" class="btn btn-primary">Submit</button>
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
        
        axios.put('/cms/admin/categories/'+id,{
          name:        document.getElementById('name').value,
          description: document.getElementById('description').value,
          status:      document.getElementById('status').checked,

        })
        .then(function (response) {
          // handle success
          console.log(response);
          window.location.href ='/cms/admin/categories';
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
