@extends('cms.parent')
@section('title','Items')
@section('page-big-title','Item')
@section('page-sub-title','Items')
@section('page-main-title','Item')

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
              <h3 class="card-title">Items</h3>

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
                    <th>Item Name</th>
                    {{-- <TH>description</TH> --}}
                    <th>quantity</th>
                    <th>location</th>
                    <th>unit_price</th>
                    <th>reorder_level</th>
                    <th>created_at	</th>
                    <th>expiry_date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ( $items as $key=>$item )
                    <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$item->name}}</td>
                    {{-- <td><span class="badge @if ($item->item_status) bg-success @else  bg-danger   @endif " > @if ($item->item_status)
                      Activ
                      @else Non-Activ
                    @endif  </span></td> --}}
                    {{-- <td>{{$item->description}}</td> --}}
                    <td>{{$item->quantity}}</td>
                    <td>{{$item->location}}</td>

                    <td>{{$item->unit_price}}</td>
                    <td>{{$item->reorder_level}}</td>
                    <td>{{$item->created_at}}</td>
                    <td>{{$item->expiry_date}}</td>


                    <td>
                      @can('restock-Inventory')
                      <div class="btn-group">
                        <button type="button" class="btn btn-warning" data-id="{{ $item->id }}" data-toggle="modal" data-target="#modal-secondary" onclick="openModal(this)">
                          <i class="fas fa-arrow-up fa-lg"></i> 
                        </button>
                    </div>
                      @endcan
                     
                      <a href="{{route('items.edit',$item->id)}}" class="btn btn-info">
                        <i class="fas fa-edit"></i>
                      </a>
                      <a   onclick="confirmDestroy('{{$item->id}}',this)" class="btn btn-danger"  >
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
    <div class="modal fade" id="modal-secondary">
      <div class="modal-dialog">
        <div class="modal-content bg-warning">
          <div class="modal-header">
            <h4 class="modal-title" style="color: black">New Quntity Of Inventory</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="hidden" id="itemId">
            <div class="form-group">
              <label for="quantity">Quantity</label>
              <input type="number" min="1" id="quantity" name="quantity" placeholder="Enter quantity" required class="form-control">
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
            {{-- <a href="#" onclick="update()" class="btn btn-outline-light">Submit</a> --}}
            <button type="button" onclick="update(document.getElementById('itemId').value)" class="btn btn-outline-light">Submit</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
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
      // function openModal(button){
      //   let itemId =button.getAttribute("data-id");
      //   document.getElementById("itemId").value=itemId;

      // }
      
      // function update(itemId){
        
      //   axios.put('/cms/admin/items/'+itemId +'/quntity',{
          
      //     quantity: document.getElementById('quantity').value,

      //   })
      //   .then(function (response) {
      //     // handle success
      //     console.log(response);
      //     window.location.href ='/cms/admin/items';
      //     toastr.success(response.data.message);
      //   })
      //   .catch(function (error) {
      //     // handle error
      //     console.log(error);
      //     toastr.error(error.response.data.message);


      //   })
        
      // }
      function openModal(button) {
    let itemId = button.getAttribute("data-id");
    document.getElementById("itemId").value = itemId; // Set the item ID in the hidden input
}

function update(itemId) {
    const quantity = document.getElementById('quantity').value;

    // Validate quantity input
    if (!quantity || quantity <= 0) {
        alert("Please enter a valid quantity.");
        return;
    }

    axios.put('/cms/admin/items/'+itemId +'/quantity', {
        quantity: quantity,
    })
    .then(response => {
        // Handle success (e.g., show a success message)
        console.log(response.data.message);
        toastr.success(response.data.message);
        // Optionally, you can close the modal here
        location.reload();
        

        $('#modal-secondary').modal('hide');
    })
    .catch(error => {
        // Handle error (e.g., show an error message)
        console.error('There was an error updating the quantity!', error);
    });
}

    </script>
@endsection
