@extends('cms.parent')
@section('title','CARS')
@section('page-big-title','car')
@section('page-sub-title','CAR')
@section('page-main-title','Car')

@section('styles')
    
@endsection
@php
    $skipMainContent = true; 
@endphp
@section('content')
<section class="content">
    <div class="container-fluid">
    
      <!-- /.row -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">CARS</h3>

              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>car_name</th>
                    <th>car_num</th>
                    <th>visible</th>
                    <th>made_in</th>
                    <th>created_at</th>
                    <th>updated_at</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($cars as $car )
                    <tr>
                    <td>{{$car->id}}</td>
                    <td>{{$car->car_name}}</td>
                    <td>{{$car->car_num}}</td>
                    <td><span class="badge @if ($car->car_status) bg-success @else  bg-danger   @endif " > @if ($car->car_status)
                      Visiblea
                      @else hidden
                    @endif  </span></td>
                    <td>{{$car->made_in}}</td>
                    <td>{{$car->created_at}}</td>
                    <td>{{$car->updated_at}}</td>
                    <td><div class="btn-group">
                      <a href="#" class="btn btn-info">
                        <i class="fas fa-edit"></i>
                      </a>
                      
                      
                        <a  href="#" onclick="#" class="btn btn-danger"  >
                          <i class="fas fa-trash"></i>
                        </a>
                      

                    </div></td>
                  </tr>
                  @endforeach
                  
                  
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
     
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>

@endsection

@section('scripts')
    <script>
      function confirmDestroy(id,ref){
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
             }).then((result) => {
            if (result.isConfirmed) {
              destroy(id,ref)  }
})
      }

      function showMessage(data){
        Swal.fire({
          // position: 'top-end',
          icon: data.icon,
          title: data.title,
          showConfirmButton: false,
          timer: 1000
})
      }
      function destroy(id,ref){
          axios.delete('/cms/admin/categories/'+id)
          .then(function (response) {
            // handle success
            console.log(response);
            ref.closest('tr').remove();
            showMessage(response.data);
          })
          .catch(function (error) {
            // handle error
            console.log(error);
            showMessage(error.response.data);

          })
      // .finally(function () { });
      }
    </script>
@endsection
