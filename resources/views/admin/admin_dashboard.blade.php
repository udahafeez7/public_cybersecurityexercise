<html>
<title>
    Administrator Dashboard
</title>

<body>
    <h1>Cybersecurity Exercise: Admin Dashboard</h1>
    @if (Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
    @endif
    @if (Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    <a href="{{ route('admin.logout') }}">Want to Quit?</a>
</body>

</html>
