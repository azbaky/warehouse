@extends('cms.parent')
@section('title','Create Order')
@section('page-big-title','Create New Order')
@section('page-sub-title',' Order')
@section('page-main-title','Create')

@section('styles')
    
@endsection

@section('main-content')
@endsection
@section('content')

<section class="content">
  <div class="container-fluid">
    <!-- Customer Information -->
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header" style="background-color: red;">
            <h3 class="card-title">Customer Information</h3>
          </div>
          <form id="order_form">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="customer_id">Select Customer</label>
                <select class="form-control"style="width: 100%; "id="customer_id" name="customer_id" required>
                  <option value="" disabled selected>Select a customer</option>
                  @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Order Information -->
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header" style="background-color: red;">
            <h3 class="card-title">Order</h3>
          </div>
          <div class="card-body">
            <h4>Item List</h4>
            <div id="items-container">
              <!-- Dynamic Item Rows will be added here -->
              <div class="row item-row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Select Item</label>
                    <select class="custom-select" name="item_id[]" required>
                      <option value="" disabled selected>Select an item</option>
                      @foreach ($items as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Quantity</label>
                    <input type="number" class="form-control" name="quantity[]" value="1" min="1" required />
                  </div>
                </div>
                <div class="col-sm-2">
                  <button type="button" class="btn btn-danger remove-btn" disabled>Remove</button>
                </div>
              </div>
            </div>
            <button id="add-item-btn" class="btn btn-primary mt-3" type="button">Add Another Item</button>
          </div>

          <div class="card-footer">
            <!-- Order Status -->
            {{-- <div class="form-group">
              <label>Status</label>
              <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" id="pending" name="status" value="pending" required>
                <label for="pending" class="custom-control-label">Pending</label>
              </div>
              <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" id="completed" name="status" value="completed">
                <label for="completed" class="custom-control-label">Completed</label>
              </div>
              <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" id="overdue" name="status" value="overdue">
                <label for="overdue" class="custom-control-label">Overdue</label>
              </div>
            </div> --}}

            <!-- Payment Type -->
            <div class="form-group">
              <label>Payment Type</label>
              <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" id="paypal" name="payment_type" value="paypal" required>
                <label for="paypal" class="custom-control-label">PayPal</label>
              </div>
              <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" id="credit_card" name="payment_type" value="credit_card">
                <label for="credit_card" class="custom-control-label">Credit Card</label>
              </div>
              <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" id="bank_transfer" name="payment_type" value="bank_transfer">
                <label for="bank_transfer" class="custom-control-label">Bank Transfer</label>
              </div>
            </div>

            <button id="submit-btn" class="btn btn-success mt-3" type="button">Submit</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@section('scripts')



<script>
  document.addEventListener("DOMContentLoaded", function () {
    const itemsContainer = document.getElementById("items-container");
    const addItemBtn = document.getElementById("add-item-btn");
    const submitBtn = document.getElementById("submit-btn");
    const orderForm = document.getElementById("order_form");

    // Configure Toastr options
    toastr.options = {
      closeButton: true,
      progressBar: true,
      positionClass: "toast-top-right",
      timeOut: 5000,
    };

    // Add dynamic item row
    addItemBtn.addEventListener("click", function () {
      const newRow = document.createElement("div");
      newRow.classList.add("row", "item-row");
      newRow.innerHTML = `
        <div class="col-sm-6">
          <div class="form-group">
            <label>Select Items</label>
            <select class="custom-select" name="item_id[]" required>
              <option value="" disabled selected>Select an item</option>
              @foreach ($items as $item)
              <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="col-4">
          <div class="form-group">
            <label>Quantity</label>
            <input type="number" class="form-control" name="quantity[]" value="1" min="1" required>
          </div>
        </div>
        <div class="col-2">
          <button type="button" class="btn btn-danger remove-btn">Remove</button>
        </div>
      `;
      itemsContainer.appendChild(newRow);

      // toastr.success("Item row added successfully!");
    });

    // Remove item row
    itemsContainer.addEventListener("click", function (event) {
      if (event.target.classList.contains("remove-btn")) {
        const row = event.target.closest(".item-row");
        row.remove();
        toastr.info("Item row removed.");
      }
    });

    // Handle form submission
    submitBtn.addEventListener("click", function (event) {
      event.preventDefault(); // Prevent default form submission

      // Collect data
      const customerId = document.getElementById("customer_id").value;
    //  const status = document.querySelector('input[name="status"]:checked')?.value;
      const paymentType = document.querySelector('input[name="payment_type"]:checked')?.value;

      if (!customerId  || !paymentType) {
        toastr.error("Please fill in all required fields.");
        return;
      }

      // Collect items and quantities
      const items = [];
      const itemRows = document.querySelectorAll(".item-row");
      itemRows.forEach((row) => {
        const itemId = row.querySelector('select[name="item_id[]"]').value;
        const quantity = row.querySelector('input[name="quantity[]"]').value;

        if (itemId && quantity) {
          items.push({ item_id: itemId, quantity: parseInt(quantity, 10) });
        }
      });

      // Validate items
      if (items.length === 0) {
        toastr.warning("Please add at least one item.");
        return;
      }

      // Prepare data for submission
      const formData = {
        customer_id: customerId,
        // status: status,
        payment_type: paymentType,
        items: items,
      };

      console.log("Form Data:", formData); // Debugging purpose

      // Submit data using Axios
      axios.post("/cms/admin/orders", formData)
        .then((response) => {
          console.log("Response:", response.data);
          toastr.success("Order submitted successfully!");
          orderForm.reset();
          itemsContainer.innerHTML = ""; // Clear items
        })
        .catch((error) => {
          console.error("Error:", error.response.data);
          toastr.error("Failed to submit order. Please try again.");
        });
    });
  });
</script>

@endsection
