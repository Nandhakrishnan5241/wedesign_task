<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Manage Users</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<body>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tbody tr:hover {
            background-color: #ddd;
        }

        .btn-add {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #ffffff;
            margin-bottom: 10px;
            transition: background-color 0.3s ease;
        }

        .btn-add:hover {
            background-color: #0056b3;
        }
    </style>

    <body>
        <a href="/adduser" class="btn-add">Add New User</a>
        <a href="/array" class="btn-add">Array</a>
        <a href="/funny" class="btn-add">Funny Predictions</a>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th>Photo</th>
                    <th>view</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->gender }}</td>
                        <td>{{ $user->address }}</td>
                        <td><img src="{{ $user->photo }}" alt="" style="width: 50px"></td>
                        <td><button class="btn btn-success view-user" data-toggle="modal" data-target="#userModal"
                                data-user="{{ json_encode($user) }}">View</button></td>
                        <td><a href="edit/{{ $user->id }}" class="btn btn-warning">Edit</a></td>
                        <td><a href="delete/{{ $user->id }}" class="btn btn-danger">Delete</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Modal -->
        <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userModalLabel">User Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="userDetails">
                            <p><strong>Name:</strong> <span id="userName"></span></p>                           
                            <p><strong>Phone:</strong> <span id="userPhone"></span></p>
                            <p><strong>Email:</strong> <span id="userEmail"></span></p>
                            <p><strong>Gender:</strong> <span id="userGender"></span></p>
                            <p><strong>Address:</strong> <span id="userAddress"></span></p>
                            <p><strong>Created At:</strong> <span id="userCreatedAt"></span></p>
                            <p><strong>Updated At:</strong> <span id="userUpdatedAt"></span></p>
                            <p><strong>Photo:</strong></p>
                            <img id="userPhoto" src="" alt="User Photo" class="img-fluid">
                            {{-- <p><strong>Password:</strong> <span id="userPassword"></span></p> --}}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <script>
            $(document).ready(function() {
                $('.view-user').click(function() {
                    var userData = $(this).data('user');

                    $('#userName').text(userData.username);                    
                    $('#userPhone').text(userData.phone);
                    $('#userEmail').text(userData.email);
                    $('#userGender').text(userData.gender);
                    $('#userAddress').text(userData.address);
                    $('#userCreatedAt').text(userData.created_at);
                    $('#userUpdatedAt').text(userData.updated_at);
                    $('#userPhoto').attr('src', userData.photo);
                    // $('#userPassword').text(userData.password);

                    $('#userModal').modal('show');
                });
            });
        </script>
    </body>

</html>
