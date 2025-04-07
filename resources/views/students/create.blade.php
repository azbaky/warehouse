<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{asset('cssFile/style.css')}}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Create New Student</h1>
    <form action="{{url('student')}}" method="POST" >
        @csrf
        <div class="container">
          <h1>Register</h1>
          <p>Please fill in this form.</p>
          <hr>
      
          <label for="text"><b>Name</b></label>
          <input type="text" placeholder="Enter Name" name="name" id="name" required>
          <br>
          <label for="add"><b>Address</b></label>
          <input type="text" placeholder="Enter Address" name="address" id="add" required>
            <br>
          <label for="mobile"><b>Mobile</b></label>
          <input type="text" placeholder="Enter mobile" name="mobile" id="mobile" required>
          <hr>
          <br>
          <input type="submit" value="Save" >
        </div>
      
        <div class="container signin">
        </div>
      </form>
</body>
</html>