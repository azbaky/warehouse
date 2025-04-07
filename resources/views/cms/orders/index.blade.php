@extends('cms.parent')
@section('title','Orders')
@section('page-big-title','Order')
@section('page-sub-title','Orders')
@section('page-main-title','order')

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
              <h3 class="card-title">Orders</h3>

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
                    {{-- <th>ID</th>
                    <th>order Name</th>
                    <TH>description</TH>
                    <th>quantity</th>
                    <th>location</th>
                    <th>unit_price</th>
                    <th>reorder_level</th>
                    <th>created_at	</th>
                    <th>expiry_date</th>
                    <th>Action</th> --}}
                  </tr>
                </thead>
                <tbody>
                  @foreach ( $orders as $key=>$order )
                    <tr>
                      {{-- <td>{{$key+1}}</td> --}}
                      <td> <a href="{{route('orders.show',$order->id)}}">{{$order->id}}</a> </td>
                      <td>{{$order->status}}</td>
                    {{-- <td><span class="badge @if ($order->order_status) bg-success @else  bg-danger   @endif " > @if ($order->order_status)
                      Activ
                      @else Non-Activ
                    @endif  </span></td> --}}
                    <td>{{$order->payment_type}}</td>
                    <td>{{$order->total}}</td>
                    <td>{{$order->date}}</td>
                    <td>{{$order->supplier}}</td>

                    <td>{{$order->unit_price}}</td>
                    
                    <td>{{$order->created_at}}</td>
                    <td>{{$order->expiry_date}}</td>


                    <td><div class="btn-group">
                      <a href="{{route('orders.edit',$order->id)}}" class="btn btn-info">
                        <i class="fas fa-edit"></i>
                      </a>
                      <a   onclick="confirmDestroy('{{$order->id}}',this)" class="btn btn-danger"  >
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
          axios.delete('/cms/admin/orders/'+id)
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
