@extends('cms.parent')
@section('title','customers')
@section('page-big-title','customer')
@section('page-sub-title','INDEX')
@section('page-main-title','customer')

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
              <h3 class="card-title">customers</h3>

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
                    <th>Customers Name</th>
                    <TH>Status</TH>
                    <th>email</th>
                    <th>phone_number</th>
                    <th>address</th>
                    {{-- <th>customer_type</th> --}}
                    <th>orders</th>
                    <th>created_at</th>
                    {{-- <th>updated_at</th> --}}
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ( $customers as $key=>$customer )
                    <tr>
                    <td>{{$key+1}}</td>
                    <td> <b>{{$customer->name}}</b> </td>
                    <td><span class="badge @if ($customer->customer_status) bg-success @else  bg-danger   @endif " > @if ($customer->customer_status)
                      Activ
                      @else Non-Activ
                    @endif  </span></td>
                    <td>{{$customer->email}}</td>
                    <td>{{$customer->phone_number}}</td>
                    <td>{{$customer->address}}</td>
                    {{-- <td>
                      <span class="badge 
                          @if ($customer->customer_type == 'customer') 
                              badge-warning 
                          @elseif ($customer->customer_type == 'member_customer') 
                              badge-success 

                          @endif">
                          {{ $customer->customer_type }}
                      </span>
                   </td> --}}
                    <td><a href="{{route('customers.show',$customer->id)}}"  class="btn btn-block btn-primary"> ({{$customer->orders_count}}) Orders </a> </td>
                    <td>{{$customer->created_at}}</td>
                    {{-- <td>{{$customer->updated_at}}</td> --}}


                    <td><div class="btn-group">
                      <a href="{{route('customers.edit',$customer->id)}}" class="btn btn-info">
                        <i class="fas fa-edit"></i>
                      </a>
                      <a   onclick="confirmDestroy('{{$customer->id}}',this)" class="btn btn-danger"  >
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
          axios.delete('/cms/admin/customers/'+id)
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
