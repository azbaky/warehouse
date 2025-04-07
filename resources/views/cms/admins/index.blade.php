@extends('cms.parent')
@section('title','Admins')
@section('page-big-title','Admins Table')
@section('page-sub-title','INDEX')
@section('page-main-title','admin')

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
            <div class="card-header"style="background: #b51a2b">
              <h3 class="card-title" > <b>admins</b></h3>

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
                    <th>Email</th>
                    <th>created_at</th>
                    <th>updated_at</th>
                    @canany(['Edit-Admin', 'Delete-Admin'])
                       <th>Settings</th> 
                    @endcanany
                    
                  </tr>
                </thead>
                <tbody>
                  @foreach ($admins as $key=>$admin )
                    <tr>
                    <td> {{$key+1}} </td>
                    <td><b>{{$admin->name}}</b></td>
                     <td>{{$admin->email}}</td> 
                    
                    <td>{{$admin->created_at}}</td>
                    <td>{{$admin->updated_at}}</td>

                    @if (  auth('admin')->user()->id != $admin->id)
                   
                      
                    
                    <td><div class="btn-group"> 
                      @can('Edit-Admin')
                      <a href="{{route('admins.edit',$admin->id)}}" class="btn btn-info">
                        <i class="fas fa-edit"></i>
                      </a>
                      @endcan
                      @can('Delete-Admin')
                        
                      
                      <a  href="#" onclick="confirmDestroy('{{$admin->id}}',this)" class="btn btn-danger"  >
                        <i class="fas fa-trash"></i>
                      </a>
                      @endcan

                    </div></td>
                    
                    @endif
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
          axios.delete('/cms/admin/admins/'+id)
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
