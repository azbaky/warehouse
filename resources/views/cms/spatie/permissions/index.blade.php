@extends('cms.parent')
@section('title','Permissions')
@section('page-big-title','Permission Table')
@section('page-sub-title','INDEX')
@section('page-main-title','permission ')

@section('styles')
    
@endsection
@section('content')
<section class="content">
    <div class="container-fluid">
    
      <!-- /.row -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header"style="background: #b51a2b">
              <h3 class="card-title" > <b>permissions</b></h3>

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
                    <th>name</th>
                    <th>Guard</th>
                    
                    <th>created_at</th>
                    <th>updated_at</th>
                    <th>Settings</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($permissions as $key=>$permission )
                    <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$permission->name}}</td>
                   @if ($permission->guard_name=='admin')
                    <td><span class="badge bg-success " >Admin </span></td>
                    @else
                    <td><span class="badge bg-success " >Member-Customer </span></td>                      
                    @endif  
                    <td>{{$permission->created_at}}</td>
                    <td>{{$permission->updated_at}}</td>
                    <td><div class="btn-group">
                      <a href="{{route('permissions.edit',$permission->id)}}" class="btn btn-info">
                        <i class="fas fa-edit"></i>
                      </a>
                      
                      
                        <a  href="#" onclick="confirmDestroy('{{$permission->id}}',this)" class="btn btn-danger"  >
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
            confirmButtonColor: '#2b3dd9',
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
          axios.delete('/cms/admin/permissions/'+id)
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
