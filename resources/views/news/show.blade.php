@extends('layouts.app')
@section('content')
    <div style="text-align: center;margin-bottom: 20px;">
        <a class="btn btn-danger" style="text-decoration: none;" href="{{ url("news")}} "> Go back </a>
    </div>

    <div class="row">
        <div class="card" style="width: 18rem; margin: 0 auto">
            <div class="card-body">
                <h3 class="card-title">{{ $news->name }}</h3>
                <p class="card-text">{{ $news->description }}</p>
                @if ($news->is_active)
                    <p> Active </p>
                @else
                    <p>Disable</p>
                @endif
                <p>Created at {{ $news->created_at }}</p>
            </div>
        </div>
    </div>

    @endsection