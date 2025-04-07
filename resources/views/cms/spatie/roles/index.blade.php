@extends('cms.parent')
@section('title','Roles')
@section('page-big-title','roles')
@section('page-sub-title','INDEX')
@section('page-main-title','role')

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
              <h3 class="card-title" > <b>Roles</b></h3>

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
                    <th>permissions</th>
                    <th>Guard</th>
                    <th>created_at</th>
                    <th>updated_at</th>
                    <th>Settings</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($roles as $role )
                    <tr>
                    <td>{{$role->id}}</td>
                    <td>{{$role->name}}</td>
                    <td><a href="{{route('roles.show',$role->id)}}"  class="btn btn-block btn-primary"> ({{$role->permissions_count}}) Permissions </a> </td>
                    {{-- <td><span class="badge bg-success " > {{$role->guard_name}} </span></td> --}}
                    <td>
                      <span class="badge 
                          @if ($role->guard_name == 'admin') 
                              badge-warning  
                          @elseif ($role->guard_name == 'broker') 
                              badge-info 
                          @else 
                              badge-secondary 
                          @endif">
                          {{$role->guard_name}} 
                      </span>
                  </td>
                    <td>{{$role->created_at}}</td>
                    <td>{{$role->updated_at}}</td>
                    <td><div class="btn-group">
                      <a href="{{route('roles.edit',$role->id)}}" class="btn btn-info">
                        <i class="fas fa-edit"></i>
                      </a>
                      
                      
                        <a  href="#" onclick="confirmDestroy('{{$role->id}}',this)" class="btn btn-danger"  >
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
          axios.delete('/cms/admin/roles/'+id)
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
