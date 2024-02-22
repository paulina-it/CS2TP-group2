@extends('layouts.app')

@section('main')
    <div class="main">
        <div>
        <form action="{{ route('admin-users-save', $user['id']) }}" method="POST">
            @csrf
            <label>First Name</label>
            <input name="firstName" type="text" value="{{ $user['firstName'] }}">
            <label>Last Name</label>
            <input name="lastName" type="text" value="{{ $user['lastName'] }}">
            <label>Email</label>
            <input name="email" type="text" value="{{ $user['email'] }}">
            <label>Phone Number</label>
            <input name="phone" type="text" value="{{ $user['phone'] }}">
            <label>Role</label>
            <select name="role">
                <option value="user" <?php if($user['role'] == "user"){echo("selected");} ?>>User</option>
                <option value="admin" <?php if($user['role'] == "admin"){echo("selected");} ?>>Admin</option>
            </select>
            <input type="submit" value="Update">
        </form>
        </div>
    </div>
@endsection