
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<section>
    <h1>Delete Account</h1>
    <form action="{{ route('delete') }}" method="post">
        @csrf
        <input type="text" name="email" placeholder="email" required>
        <button>Submit</button>
    </form>
</section>

</body>
</html>
