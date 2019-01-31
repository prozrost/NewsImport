@extends('layouts.app')
@section('content')


    @if (Session::has('status'))
        <div class=" alert alert-success">{{ Session::get('status') }}</div>
    @endif
    <table class="table table-bordered" style="width: 800px;margin: 0 auto">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">is_active</th>
            <th scope="col">Controls</th>
        </tr>
        </thead>
        <tbody>


        @foreach($newsArray as $news)
            <tr>
                <th scope="row">{{ $news->id }}</th>
                <td>{{ $news->name }}</td>
                <td>{{ $news->is_active }}</td>
                <td>
                    <a class="btn btn-primary" href="{{ url("news/$news->id")}}" style="text-decoration: none; display: inline-block">Show </a>
                    <a class="btn btn-warning" href="{{ url("news/$news->id/edit")}}" style="text-decoration: none; display: inline-block">Edit </a>
                    <form method="POST" action="{{ url("news/$news->id") }}" style="display: inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>


            </tr>
        @endforeach
        </tbody>
    </table>
    <div style="text-align: center;margin-top: 20px;">
        <a class="btn btn-primary" style="text-decoration: none;" href="{{ url("news/create")}} "> Create news </a>
    </div>
@endsection