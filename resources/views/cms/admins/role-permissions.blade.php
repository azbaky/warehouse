@extends('cms.parent')
@section('title','permissions')
@section('page-big-title','INDEX')
@section('page-sub-title','INDEX')
@section('page-main-title','role')

@section('styles')
<link rel="stylesheet" href="{{asset('cms/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
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
            <div class="card-header"style="background: #b51a2b">
              <h3 class="card-title" > <b>{{$role->name}} </b>Permissions </h3>

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
                    <th>name</th>
                    <th>Guard</th>
                    <th>Assigned</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($permissions as $permission )
                    <tr>
                    <td>{{$permission->name}}</td>
                    <td><span class="badge bg-success " > {{$permission->guard_name}} </span></td>
                    <td>
                      <div class="icheck-success d-inline">
                      <input type="checkbox" onchange="updateRolePermission({{$role->id}},{{$permission->id}})"  @if($permission->assigned) checked="" @endif  id="permission_{{$permission->id}}">
                      <label for="permission_{{$permission->id}}"  >
                      </label>
                    </div>
                  </td>
                    
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
    
      function updateRolePermission(roleId,permissionId){
          axios.put('/cms/admin/roles/'+roleId+'/permission',{
            permission_id: permissionId
          })
          .then(function (response) {
            // handle success
            console.log(response);
            toastr.success(response.data);
          })
          .catch(function (error) {
            // handle error
            console.log(error);
            toastr.error(error.response.data);


          })
      // .finally(function () { });
      }
    </script>
@endsection
