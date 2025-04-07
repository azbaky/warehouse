@extends('cms.parent')
@section('title','brokers-orders')
@section('page-big-title','broker order')
@section('page-sub-title',' orders')
@section('page-main-title',' orders')

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
              <h3 class="card-title"><b>{{$broker->name}}</b> orders</h3>

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
                    
                    <TH>Date</TH>
 
                    <th>Payment Type</th>
                    <th>supplier</th>
                    <th>Status</th>
                    @can('Change-order-status')
                      <th></th>
                    @endcan
                    
                    <th>Total</th>
                    
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($orders as $key=>$order)
                  <tr>
                    
                    <td> <a href="{{route('orders.show',$order->id)}}">{{$order->id}}</a> </td>
                    <td>{{$order->date}}</td>
                    <td>{{$order->payment_type}}</td>

                    <td>{{$order->supplier}}</td>
                    
                    <td>
                      <span class="badge
                          @if ($order->status == 'pending') 
                              badge-warning 
                          @elseif ($order->status == 'completed') 
                              badge-success 
                          @elseif ($order->status == 'overdue') 
                              badge-info 
                          @else 
                              badge-secondary 
                          @endif">
                          {{ $order->status }}
                      </span>
                   </td>
                   @can('Change-order-status')
                   @if ($order->status == 'overdue')
                   
                     
                   
                     <td>
                      <button type="button" onclick="update({{$order->id}})" class="btn btn-block btn-info btn-flat">complete</button>
                    </td>
                  @elseif ($order->status == 'pending')
                  <td>
                    {{-- <button  type="button" class="btn btn-block btn-outline-warning  btn-flat">Complete</button> --}}
                    <button type="button" onclick="update({{$order->id}})" class="btn btn-block btn-warning btn-flat">complete</button>
                 </td>
                   @else
                     <td>
                      <button type="button" class="btn btn-block btn-success disabled">Completed</button>
                     </td>
                   @endif
                   
                   @endcan
                  <td> <b> {{$order->total}} $</b></td>
                    
                    
                    <td><div class="btn-group">
                      {{-- <a  href="{{route('orders.show',$order->id)}}" onclick="" class="btn btn-danger"  >
                        <i class="fas fa-list"></i>
                    </a> --}}
                      <a href="#" class="btn btn-info">
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
    
    function update(orderId){
        axios.put('/cms/admin/orders/'+orderId+'/status',{
        })
        .then(function (response) {
          // handle success
          console.log("Response:", response.data);
          // toastr.success("Order submitted successfully!");
          // document.getElementById('create_form').reset();
          toastr.success(response.data.message);
          location.reload();

        })
        .catch(function (error) {
          // handle error
          console.log(error);
          // toastr.error(error.response.data.message);


        })
        

    // .finally(function () { });
    }
    </script>
@endsection
