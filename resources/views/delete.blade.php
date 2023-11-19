
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>

            section {
                width: 100%;
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            form {
                width: 50%;
                height: 50%;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }

            input {
                width: 50%;
                height: 50px;
                border: 1px solid #000;
                border-radius: 5px;
                margin-bottom: 20px;
                padding: 0 10px;
            }

            button {
                width: 50%;
                height: 50px;
                border: 1px solid #000;
                border-radius: 5px;
                background-color: #000;
                color: #fff;
                font-weight: bold;
                cursor: pointer;
            }

    </style>
</head>
<body>

<section>
    <h1>Delete Account</h1>
    <form action="{{ route('delete') }}" method="post">
        @csrf
        <input type="email" name="email" placeholder="email" required>
        <button>Submit</button>
    </form>
</section>

</body>
</html>
