<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login</title>
</head>
<style>
    /* public/css/login.css */

    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .login-container {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        width: 300px;
        text-align: center;
    }

    .login-form {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    h2 {
        margin-bottom: 20px;
        color: #333;
    }

    .input-group {
        margin-bottom: 15px;
        width: 100%;
    }

    .input-group label {
        display: block;
        text-align: left;
        margin-bottom: 5px;
        color: #666;
    }

    .input-group input {
        width: calc(100% - 20px);
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .btn {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 5px;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    .btn:hover {
        background-color: #0056b3;
    }

    .btn:focus {
        outline: none;
    }
</style>

<body>
    <div class="login-container">
        <form action="/validate" method="POST" class="login-form">
            @csrf

            <h2>Login</h2>

            <div class="input-group">
                <label for="username">User Name</label>
                <input type="text" id="username" name="name" autocomplete="off" required>
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" autocomplete="off" required>
            </div>

            <button type="submit" class="btn">Login</button>
        </form>
    </div>

</body>

</html>
