<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</head>
<style>
    .container {
        max-width: 500px;
        margin: 10 auto;
        margin-top: 10px;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f9f9f9;
    }


    #userForm label {
        font-weight: bold;
        margin-bottom: 5px;
    }


    #userForm input[type="text"],
    #userForm input[type="number"],
    #userForm input[type="password"],
    #userForm input[type="email"],
    #userForm textarea,
    #userForm input[type="file"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }


    #userForm input[type="radio"] {
        margin-right: 5px;
    }


    #userForm input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    #userForm input[type="submit"]:hover {
        background-color: #45a049;
    }


    #userForm input[type="file"] {
        padding: 6px;
    }


    #userForm label[for="image"] {
        margin-top: 10px;
        display: block;
        font-weight: normal;
    }


    #userForm textarea {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        resize: vertical;
    }
</style>

<body>
    <div class="container">
        <form id="userForm"  method="POST" enctype="multipart/form-data">
            @csrf

            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" value="{{ $user->username }}" required><br>

            <label for="phone">Mobile:</label><br>
            <input type="text" id="phone" name="phone" value="{{ $user->phone }}" required><br>

            <label for="age">Email ID :</label><br>
            <input type="email" id="email" name="email" value="{{ $user->email }}" required><br>

            <label>Gender:</label><br>
            <input type="radio" id="male" name="gender" value="Male" {{ $user->gender == 'Male' ? 'checked' : '' }}>
            <label for="male">Male</label><br>
            <input type="radio" id="female" name="gender" value="Female" {{ $user->gender == 'Female' ? 'checked' : '' }}>
            <label for="female">Female</label><br>
            <input type="radio" id="other" name="gender" value="Other" {{ $user->gender == 'Other' ? 'checked' : '' }}>
            <label for="other">Other</label><br>

            <label for="address">Address:</label><br>
            <textarea id="address" name="address" required rows="4" cols="50">{{ $user->address }}</textarea><br>

            <label for="image">Edit Image:</label>
            <img src="{{$user->photo}}" alt="image not found" id="oldimagename" style="width: 50px">
            <input type="file" name="image" id="image"><br>

            <label for="password">Enter your password:</label><br>
            <input type="password" id="password" name="password" value="{{$user->password }}"  required><br>

            <input type="submit" value="Submit" class="btn btn-success">
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var filePath = "{{$user->photo}}";
        $(document).ready(function() {
            $('#image').on('change', function() {
                var file = $(this)[0].files[0]; 

                if (file) {
                    var formData = new FormData();
                    formData.append('image', file);                   
                    $.ajax({
                        url: '/uploadimage',
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            console.log("Image uploaded successfully.",response);
                            filePath = response.filePath;
                            
                        },
                        error: function(xhr, status, error) {
                            console.error("Error uploading image: " + error);
                        }
                    });
                }
            });
      
            $('#userForm').on('submit', function(event) {
                event.preventDefault();

                var name = $('#name').val();
                var phone = $('#phone').val();
                var email = $('#email').val();
                var gender = $('input[name="gender"]:checked').val();
                var address = $('#address').val();
                var password = $('#password').val();
                var oldimagename = $('#oldimagename').val();
                $.ajax({
                    url: '/update/{{ $user->id }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        name: name,
                        phone: phone,
                        email: email,
                        gender: gender,
                        address: address,
                        filePath : filePath,
                        password : password
                    },
                    success: function(response) {
                        console.log("success", response);
                        alert("user updated successfully");
                        window.location.href = '/manage';
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        console.log('error', error);
                    }
                });
            });
        });
    </script>

</body>

</html>
