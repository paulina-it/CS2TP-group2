@extends('layouts.app')

@section('main')
    <div class="main">
        @foreach ($users as $user)
        <div>
            <label>{{$user['firstName']}}</label>
            <label>{{$user['lastName']}}</label>
            <label>{{$user['email']}}</label>
            <form action="{{ route('admin-users-edit', $user['id']) }}">
                @csrf
                <button>Edit</button>
            </form>
        </div>
        @endforeach
    </div>
@endsection