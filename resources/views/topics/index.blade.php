@extends('layout.layout')

@section('title', 'LadyBug | Manage Topic')

@section('content')
    <div class="container my-auto">
        <div class="card p-4 bg-light mt-3 mb-3">
            <div class="d-flex justify-content-between mt-2 mb-4">
                <h2 class="fw-bold">Topics</h2>
                <a class="btn btn-lg btn-success text-white fw-bold" data-bs-toggle="modal" data-bs-target="#addTopic">Add New Topic</a>
            </div>
            <table id="myTable" class="table table-striped bg-light">
                <thead>
                    <tr class="">
                        <th class="col-md-1 align-middle">ID</th>
                        <th class="col-md-9 align-middle">Title</th>
                        <th class="col-md-2 align-middle">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i = 1)
                    @foreach ($topics as $topic)
                        <tr class="">
                            <td class="align-middle fw-bold">{{ $topic->id }}</td>
                            <td class="align-middle">
                                {{ $topic->title }}
                            </td>
                            <td class="align-middle">
                                <div class="d-flex">
                                    <a class="btn btn-sm btn-warning text-dark fw-bold me-2" data-bs-toggle="modal" data-bs-target="#assign{{$topic->id}}">Update</a>
                                    <form action="{{ route('topics.destroy', $topic->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
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
    </div>

    @foreach ($topics as $topic)
        <div class="modal" id="assign{{$topic->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Topic</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('topics.update', $topic->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('UPDATE')
                        <div class="modal-body">
                            <div class="d-flex justify-content-evenly mb-2">
                                <p class="my-auto">Title</p>
                                <div class="col-md-8">
                                    <input type="text" id="title" name="title" class="form-control rounded-pill" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            @method('PUT')
                            <button type="submit" class="btn btn-warning fw-bold">Update Topic</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <div class="modal" id="addTopic" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Topic</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('topics.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="d-flex justify-content-evenly mb-2">
                            <p class="my-auto">Title</p>
                            <div class="col-md-8">
                                <input type="text" id="title" name="title" class="form-control rounded-pill" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning fw-bold">Update Topic</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
