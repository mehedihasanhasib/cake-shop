@extends('layouts.app')
@section('style')
    <style>
        /* General Styles */
        body {
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        @media only screen and (max-width: 600px) {
            .container2 {
                margin: 0 !important;
            }
        }

        .container2 {
            max-width: 400px;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        /* Form Styles */
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Additional Styles */
        .forgot-password {
            text-align: right;
            margin-top: 10px;
        }

        .forgot-password a {
            color: #666;
            text-decoration: none;
        }

        .forgot-password a:hover {
            color: #333;
        }
    </style>
@endsection
@section('content')
    <div class="container2">

        <h2>Sign up</h2>
        <form>
            <label for="username">Username</label>
            <input type="text" id="username" placeholder="Enter Username" name="username" required>

            <label for="password">Password</label>
            <input type="password" id="password" placeholder="Enter Password" name="password" required>

            <button type="submit">Login</button>
            <div class="forgot-password">
                <a href="#">Forgot Password?</a>
            </div>
        </form>

    </div>
@endsection
