<!DOCTYPE html>
<html>
<head>
    <title>custom login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/customAuth.css">
    <link rel="stylesheet" type="text/css" href="/fontawesome-free-5.9.0-web/css/all.css">


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"><h2><STRONG>HARVEST</STRONG></h2></a>


</nav>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-5">
            <form class="card p-3 mb-3" method="POST" action="/invitation">
                @csrf
                <input type="text" name="token" hidden value="{{ $token??'' }}">

                <h3>UPDATE PASSWORD</h3>
                <p >{{ $user_email }}</p>
                <br>

                <div class="form-group">
                    <input type="password" value="{{ old('password') }}" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    @error('password')
                    <small class="text-muted">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="password" value="{{ old('password_confirmation') }}" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                </div>
                <button type="submit" class="mb-3 mt-5 btn btn-primary">Update Password and Login</button>
            </form>
        </div>
    </div>
</div>



</body>
</html>
