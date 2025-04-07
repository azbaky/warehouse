@extends('cms.parent')
@if (auth('admin')->check())
@section('title', 'Dashboard')
@section('page-big-title', 'Dashboard Overview')
@section('page-sub-title', 'Key Metrics')
@section('page-main-title', 'Admin Panel')
@else
@section('title', 'Dashboard')
@section('page-big-title', 'ITEMS ')
@section('page-sub-title', 'Your Orders and Information')
@section('page-main-title', 'Customer Panel')
@endif

@section('styles')
    <style>
        .black-text {
            color: black;
        }
    .floating-button {
        position: fixed; /* Fixes the button to the viewport */
        bottom: 20px; /* Distance from the bottom */
        right: 20px; /* Distance from the right */
        z-index: 1000; /* Ensures the button is above other elements */
    }

    .floating-button a {
        text-decoration: none; /* Remove underline from the link */
    }

    </style>
@endsection

@section('content')
@if (auth('admin')->check()=='admin')
    <div class="row pl-3 pr-3">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
              <div class="icon">
                <i class="fas fa-shopping-cart"></i>
              </div>
                <h3 class="black-text">{{$newOrdersCount}} Orders</h3>
                <p>Total of Orders added Today</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="{{ route('orders.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{$sumOfOrders}}<b style="font-size: 40px">₪</b></h3>
                <p>Total Income of orders in this day</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{ route('orders.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6 ">
        <div class="small-box bg-success">
            <div class="inner">
              <div class="icon">
                <i class="fas fa-user-plus"></i>
              </div>
                <h3>{{$newCustomersCount}} customers</h3>
                <p>New Customers added in the last Week</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route('customers.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{$newItemsCount}} items</h3>
                <p>Total of items added Today</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{ route('items.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
<div class="row">
  <div class="col-md-9 pl-3">
    <div class="card">
      <div class="card-header border-transparent">
        <h3 class="card-title">Latest Orders</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table m-0">
            <thead>
              <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Status</th>
                <th>Customer_type</th>
                <th> Supplier </th>
                <th>Total</th>
                <th>payment Type </th>
              </tr>
            </thead>
            <tbody>
              @foreach ($lastOrders as $order )
                              <tr>
                <td><a href="{{route('orders.show',$order->id)}}">{{$order->id}}</a></td>
                <td>
                  <b>
                      @if($order->customer_name)
                          {{ $order->customer_name }}
                      @else
                          {{ $order->broker_name }}
                      @endif
                  </b>
              </td>                <td>
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
               <td>{{$order->customer_type}}</td>
                <td>
                  <div class="sparkbar" data-color="#00a65a" data-height="20">{{$order->supplier}}</div>
                </td>
                <td> {{$order->total}} <b>₪</b>  </td>
                <td>
                  @if($order->payment_type === 'credit_card')
                      <span class="badge badge-primary">Credit Card</span>
                  @elseif($order->payment_type === 'paypal')
                      <span class="badge badge-success">PayPal</span>
                  @elseif($order->payment_type === 'bank_transfer')
                      <span class="badge badge-warning">Bank Transfer</span>
                  @else
                      <span class="badge badge-secondary">Unknown</span>
                  @endif
              </td>              </tr>
              @endforeach


            </tbody>
          </table>

          <div class="card-footer clearfix">
            <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a>
            <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All Orders</a>
          </div>
          <!-- /.card-footer -->
        </div>
      </div>
      <!-- /.table-responsive -->
    </div>
    <!-- /.card -->
  </div>

  <div class="col-md-3"> <!-- Adjusted column size -->
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-exclamation-triangle"></i>
                Alerts
            </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <!-- Alerts for low stock items -->
            @foreach($lowStockItems as $item)
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i> Low Stock Alert!</h5>
                    Item "{{ $item->name }}" is at or below the reorder level (Current: {{ $item->quantity }}, Reorder Level: {{ $item->reorder_level }}).
                </div>
            @endforeach

            <!-- Alerts for expiring items -->
                                        <!-- Expired Items -->
<!-- Expired Items -->
        @foreach($expiredItems as $item)
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-exclamation-triangle"></i> Expiration Alert!</h5>
            Item "{{ $item->name }}" has expired on 
            {{ !empty($item->expiry_date) ? \Carbon\Carbon::parse($item->expiry_date)->format('Y-m-d') : 'Unknown date' }}.
        </div>
        @endforeach

<!-- Soon Expiring Items -->
        @foreach($soonExpiringItems as $item)
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-exclamation-triangle"></i> Expiration Alert!</h5>
            Item "{{ $item->name }}" will expire on 
            {{ !empty($item->expiry_date) ? \Carbon\Carbon::parse($item->expiry_date)->format('Y-m-d') : 'Unknown date' }}.
        </div>
        @endforeach

        <!-- Items Without Expiration Date -->
        @foreach($itemsWithoutExpiration as $item)
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-info-circle"></i> Info!</h5>
            Item "{{ $item->name }}" does not have an expiration date set.
        </div>
        @endforeach
        </div>

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
</div>
@else
<div class="container">
  <h1>Select Items to Order</h1>

  <!-- Payment Type Dropdown -->
  <div class="form-group">
      <label for="paymentType">Select Payment Type</label>
      <select id="paymentType" class="form-control">
          <option value="paypal">PayPal</option>
          <option value="credit_card">Credit Card</option>
          <option value="bank_transfer">Bank Transfer</option>
      </select>
  </div>

  <div class="row">
      @foreach ($items as $item)
          <div class="col-12 col-sm-6 col-md-4 mb-4">
              <div class="card">
                  <img src="{{ asset('cms/dist/img/prod-1.jpg') }}" class="card-img-top product-image" alt="Product Image">
                  <div class="card-body">
                      <h3 class="card-title">{{ $item->name }}</h3>
                      <p class="card-text">{{ $item->description }}</p>
                      <div class="bg-gray py-2 px-3 mt-4">
                          <h2 class="mb-0">
                              $ {{ $item->unit_price }}
                          </h2>
                          <h4 class="mt-0">
                              <small>Ex Tax: $ {{ $item->unit_price }}</small>
                          </h4>
                      </div>
                      <div class="mt-4">
                          <div class="form-group">
                              <label>Quantity</label>
                              <input type="number" class="form-control quantity" name="quantity[{{ $item->id }}]" value="1" min="1" required />
                          </div>
                          <div class="form-group">
                              <input type="checkbox" class="item-checkbox" data-item-id="{{ $item->id }}" />
                              <label for="item-{{ $item->id }}">Select this item</label>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      @endforeach
  </div>

  <!-- Single Order Button -->
  <div class="floating-button">
    <a href="#" onclick="addToCart(event)">
        <div class="btn btn-primary btn-lg btn-flat">
            <i class="fas fa-cart-plus fa-lg mr-2"></i>
            Order Selected Items
        </div>
    </a>
</div>
</div>

@endif

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
{{-- <script>
  // Assuming you have a global variable that holds the logged-in broker's ID
  const loggedInBrokerId = {{ auth()->user()->id }}; // Replace with the actual way to get the logged-in user's ID

  function addToCart(event) {
      event.preventDefault(); // Prevent the default anchor click behavior

      const items = [];
      const checkboxes = document.querySelectorAll('.item-checkbox:checked');

      checkboxes.forEach(checkbox => {
          const itemId = checkbox.getAttribute('data-item-id');
          const quantityInput = checkbox.closest('.col-12').querySelector('.quantity');
          const quantity = quantityInput.value;

          items.push({
              item_id: itemId,
              quantity: quantity
          });
      });

      if (items.length === 0) {
          toastr.error('Please select at least one item.');
          return;
      }

      // Prepare the data to send
      const data = {
          broker_id: loggedInBrokerId, // Use the logged-in broker's ID
            payment_type: paymentType, // Get the selected payment type
          items: items
      };

      // Send the data to the server
      axios.post('/cms/admin/orders', data)
          .then(response => {
              toastr.success('Order created successfully');
          })
          .catch(error => {
              console.error('There was an error creating the order!', error);
              toastr.error('Failed to create order: ' + error.response.data.error);
          });
  }
</script> --}}
<script>
  // Assuming you have a global variable that holds the logged-in broker's ID
  const loggedInBrokerId = {{ auth()->user()->id }}; // Replace with the actual way to get the logged-in user's ID

  function addToCart(event) {
      event.preventDefault(); // Prevent the default anchor click behavior

      const items = [];
      const checkboxes = document.querySelectorAll('.item-checkbox:checked');
      const paymentType = document.getElementById('paymentType').value; // Get the selected payment type

      checkboxes.forEach(checkbox => {
          const itemId = checkbox.getAttribute('data-item-id');
          const quantityInput = checkbox.closest('.col-12').querySelector('.quantity');
          const quantity = quantityInput.value;

          items.push({
              item_id: itemId,
              quantity: quantity
          });
      });

      if (items.length === 0) {
          toastr.error('Please select at least one item.');
          return;
      }

      // Prepare the data to send
      const data = {
          broker_id: loggedInBrokerId, // Use the logged-in broker's ID
          payment_type: paymentType, // Get the selected payment type
          items: items
      };

      // Send the data to the server
      axios.post('/cms/admin/orders', data)
          .then(response => {
              toastr.success('Order created successfully');
              // Optionally, redirect or update the UI
          })
          .catch(error => {
              console.error('There was an error creating the order!', error);
              toastr.error('Failed to create order: ' + (error.response?.data?.error || 'Unknown error'));
          });
  }
</script>

@endsection