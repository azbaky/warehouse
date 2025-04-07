<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Order</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Create Order</h1>
    <form > <!-- Replace with your route -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}"> <!-- CSRF Token -->

        <div class="form-group mb-3">
            <label for="customer_id">Customer ID</label>
            <input type="text" class="form-control" id="customer_id" name="customer_id" required>
        </div>

        <div class="form-group mb-3">
            <label for="total">Total</label>
            <input type="number" step="0.01" class="form-control" id="total" name="total" required>
        </div>

        <div class="form-group mb-3">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="pending">Pending</option>
                <option value="completed">Completed</option>
                <option value="overdue">Overdue</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="payment_type">Payment Type</label>
            <select class="form-control" id="payment_type" name="payment_type" required>
                <option value="credit_card">Credit Card</option>
                <option value="paypal">PayPal</option>
                <option value="bank_transfer">Bank Transfer</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="date">Date</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>

        <h3>Order Items</h3>
        <div id="order-items">
            <div class="order-item">
                <div class="form-group mb-3">
                    <label for="item_id">Item ID</label>
                    <input type="text" class="form-control" name="items[0][item_id]" required>
                </div>
                <div class="form-group mb-3">
                    <label for="quantity">Quantity</label>
                    <input type="number" class="form-control" name="items[0][quantity]" required>
                </div>
                <div class="form-group mb-3">
                    <label for="price">Price</label>
                    <input type="number" step="0.01" class="form-control" name="items[0][price]" required>
                </div>
                <div class="form-group mb-3">
                    <label for="total">Total</label>
                    <input type="number" step="0.01" class="form-control" name="items[0][total]" required>
                </div>
            </div>
        </div>

        <button type="button" id="add-item" class="btn btn-secondary mb-3">Add Another Item</button>

        <button type="submit" class="btn btn-primary">Create Order</button>
    </form>
</div>

<script>
    let itemIndex = 1;

    document.getElementById('add-item').addEventListener('click', function() {
        const orderItemsDiv = document.getElementById('order-items');
        const newItemDiv = document.createElement('div');
        newItemDiv.classList.add('order-item');
        newItemDiv.innerHTML = `
            <div class="form-group mb-3">
                <label for="item_id">Item ID</label>
                <input type="text" class="form-control" name="items[${itemIndex}][item_id]" required>
            </div>
            <div class="form-group mb-3">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" name="items[${itemIndex}][quantity]" required>
            </div>
            <div class="form-group mb-3">
                <label for="price">Price</label>
                <input type="number" step="0.01" class="form-control" name="items[${itemIndex}][price]" required>
            </div>
            <div class="form-group mb-3">
                <label for="total">Total</label>
                <input type="number" step="0.01" class="form-control" name="items[${itemIndex}][total]" required>
            </div>`;
        orderItemsDiv.appendChild(newItemDiv);
        itemIndex++;
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


<script>
    document.querySelector('form').addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);

        axios.post('/cms/admin/orders', 
        Object.fromEntries(formData))
            .then(response => {
                alert(response.data.message);
                location.reload(); // Reload or redirect
            })
            .catch(error => {
                console.error(error.response.data);
                alert('An error occurred while creating the order.');
            });
    });
</script>
