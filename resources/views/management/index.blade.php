@extends('layout.layout')

@section('title', 'LadyBug | Manage User')

@section('content')
    @if (count($users) == 0)
        <div class="container-fluid mx-auto my-auto ">
            <h2 class="fw-bold text-center">No User Registered!</h2>
        </div>
    @else
        <h2 class="fw-bold text-center mt-4">Manage User</h2>
        <div class="container mt-2">
            <table class="table table bg-light">
                <thead>
                    <tr class="text-center">
                        <th class="col-md-1 align-middle">No</th>
                        <th class="col-md-1 align-middle"></th>
                        <th class="col-md-3 align-middle">Name</th>
                        <th class="col-md-3 align-middle">Email</th>
                        <th class="col-md-2 align-middle">Type</th>
                        <th class="col-md-2 align-middle">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i = 1)
                    @foreach ($users as $user)
                        <tr class="text-center">
                            <td class="align-middle fw-bold">{{ $i }}</td>
                            <td class="align-middle">
                                <img src="{{ $user->image }}" alt="" class="rounded-circle" style="width:40px; height: 40px">
                            </td>
                            <td class="align-middle">
                                {{ $user->name }}
                            </td>
                            <td class="align-middle">{{ $user->email }}</td>
                            <td class="align-middle">{{ $user->type }}</td>
                            <td class="align-middle">
                                <div class="d-flex justify-content-center">
                                    <a class="btn btn-sm btn-warning text-dark fw-bold me-2" href="/updateUser/{{ $user->id }}">UPDATE</a>
                                    <form action="/deleteUser/{{ $user->id }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-block btn-danger text-white fw-bold"
                                        onclick="return confirm('Are you sure you want to permanently delete the data?')">
                                        DELETE</button>
                                    </form>
                                </div>
                            </td>
                            </td>
                        </tr>
                        @php($i = $i + 1)
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
