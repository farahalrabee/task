<!DOCTYPE html>
<html lang="en">
<head>
    <title>Import Excel in Laravel 5.3</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" >
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Import Excel in Laravel </a>
        </div>
    </div>
</nav>
<div class="container">
    @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('error') }}
        </div>
    @endif

    <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 20px;" action="{{ url('import') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
        <input type="file" name="import_file" />
        {{ csrf_field() }}
        <br/>
        <button class="btn btn-primary">Import Excel File</button>
    </form>
</div>

</body>

</html>