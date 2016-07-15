<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html" />
	<meta charset="utf-8">
    <title>Library</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">   
</head>
<body>
<div class="container">
    <h1>@yield('pagetitle')</h1>
    <nav class="navbar navbar-inverse">
        <ul class="nav navbar-nav">
            <li><a href="{{ URL::to('users') }}">View Users</a></li>
            <li><a href="{{ URL::to('users/create') }}">Create User</a></li>
            <li><a href="{{ URL::to('books') }}">View Books</a></li>
            <li><a href="{{ URL::to('books/create') }}">Create book</a></li>
        </ul>
    </nav>
    
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    
    @yield('content')
</div>
</body>
</html>