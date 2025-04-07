@extends('cms.parent')
@section('title','Orders')
@section('page-big-title','Order ID :'.$order->id)
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
              <div class="row">
                <div class="col-12">
                  <h4 style="color: red">
                  
                    <i  class="fas fa-warehouse"></i>Warehouse 360
                    <small class="float-right">Date:  {{$order->date}}</small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  From
                  <address>
                    <strong>warehouse <b>360</b> </strong><br>
                    Rimal st.<br>
                    
                    Phone:0597777770<br>
                    Email: smart warehouse@smart.com
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  To
                  <address>
                    @if(isset($customer->customer_name))
                        <strong>
                            {{ $customer->customer_name }}
                        </strong><br>
                        Address: {{ $customer->customer_address ?? 'N/A' }}<br>
                        Phone: {{ $customer->customer_phone ?? 'N/A' }}<br>
                        Email: {{ $customer->customer_email ?? 'N/A' }}
                    @elseif(isset($customer->broker_name))
                        <strong>
                            {{ $customer->broker_name }}
                        </strong><br>
                        Address: {{ $customer->broker_address ?? 'N/A' }}<br>
                        Phone: {{ $customer->broker_phone ?? 'N/A' }}<br>
                        Email: {{ $customer->broker_email ?? 'N/A' }}
                    @else
                        <strong>No customer or broker information available.</strong>
                    @endif
                </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Total: {{$order->total}}$  </b><br>
                  <br>
                  @if ($order->status!='completed')
                   <button type="button" onclick="update({{$order->id}})" class="btn btn btn-warning btn-flat">complete</button>
                  @else
                  <button type="button" class="btn btn btn-success disabled">Order Completed</button>

                  @endif
                  <br>
                  <b> supplier: {{$order->supplier}}</b> <br>
                  <b>Order ID:</b> {{$order->id}}<br>
                  <b>Payment Due:</b> {{$order->date}}<br>
                  <b>Payment Type :</b> {{$order->payment_type}}
                </div>
                <!-- /.col -->
              </div>
              {{-- <div class="row">
                <div class="col-12">
                <h6 >Total Order  :  <h5 style="coloer:green">{{$order->total}}$</h5></h6>
                
                <b>date of order :{{$order->date}}</b></div>
              </div> --}}


              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">

                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
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
                    <th>Item Name</th>
                    {{-- <TH>description</TH>
                    <th>quantity</th>
                    <th>location</th> --}}
                    {{-- <th>Action</th> --}}
                    <th>quantity</th>
                    <th>price</th>

                  </tr>
                </thead>
                <tbody>
                  @foreach ($orderItems  as $item  )
                    <tr>
                    <td>{{$item->item_name}}</td>
                    <td>{{$item->quantity}}</td>
                    <td><b>{{$item->price}}$</b></td>

                    {{-- [{"order_item_id":84,"order_id":45,"item_id":12,"item_name":"qui",
                    "item_description":"Sed voluptatum ipsa asperiores omnis odio.","quantity":1,"price":51.05}] --}}
                    <td></td>
                    {{-- <td><span class="badge @if ($item->item_status) bg-success @else  bg-danger   @endif " > @if ($item->item_status)
                      Activ
                      @else Non-Activ
                    @endif  </span></td> --}}
                    {{-- <td></td> --}}
                  


                    {{-- <td><div class="btn-group">
                      <a href="#" class="btn btn-info">
                        <i class="fas fa-edit"></i>
                      </a>
                      <a   onclick="#" class="btn btn-danger"  >
                          <i class="fas fa-trash"></i>
                      </a>
                      

                    </div></td> --}}
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
          axios.delete('/cms/admin/items/'+id)
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
