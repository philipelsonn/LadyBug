<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="/storage/images/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>
<body class="d-flex flex-column min-vh-100 bg-light bg-opacity-25">
    @auth
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <a href="" class="d-flex text-decoration-none">
                    <img src="/assets/image/logo.png" alt="" class="m-2" style="width: 50px; height: 50px">
                    <h4 class="ms-2 my-auto text-info fw-bold">LADYBUG</h4>
                </a>
                <div class="d-flex justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav me-2 mb-lg-0">
                        <li class="nav-item my-auto me-2">
                            <a class="nav-link active" aria-current="page" href="{{ route('dashboard') }}">Home</a>
                        </li>
                        @if (auth()->user()->type == 'ADMIN')
                            <li class="nav-item my-auto me-2">
                                <a class="nav-link active" aria-current="page" href="{{ route('management.index') }}">Manage Users</a>
                            </li>
                        @endif
                        <li class="nav-item my-auto">
                            <a class="nav-link active" aria-current="page" href="">Tickets</a>
                        </li>
                        <li class="nav-item dropdown mt-1 ms-2 border border-secondary border-top-0 border-end-0 border-bottom-0">
                            <a class="nav-link dropdown-toggle text-dark ms-2 fw-bold" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ auth()->user()->name }}
                                <img src="{{ auth()->user()->image }}" alt="" class="rounded-circle ms-2" style="width: 40px; height: 40px">
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="">Edit Profile</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form action="/logout" method="post" class="my-auto me-2">
                        @csrf
                        <button type="submit" class="btn btn-outline-dark">Logout</button>
                    </form>
                </div>
            </div>
        </nav>
    @endauth
    @yield('content')
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
        $(document).ready( function () {
            $('#myTable2').DataTable();
        } );
        $(document).ready( function () {
            $('#myTable3').DataTable();
        } );
    </script>
</body>
@auth
<footer class="d-flex justify-content-center mt-auto">
    <p class="text-black p-2">&#169 2023 Copyright. All Rights Reserved</p>
</footer>
@endauth
</html>
