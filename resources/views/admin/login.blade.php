<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <form action="{{url('login')}}" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="" placeholder="masukan email anda">
        </div>
        <div class="form-group">
            <label for="email">Password</label>
            <input type="password" name="password" class="form-control" id="" placeholder="masukan password anda">
        </div>
        <div class="form-group">
            <button type="submit">Login</button>
        </div>
    </form>
</body>
</html>