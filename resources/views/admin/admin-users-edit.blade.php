@extends('layouts.app')

@section('main')
    <div class="main">
        <div class="back-btn flex self-start">
            <button class="px-5 py-2 rounded my-[1em] flex " id="back-btn" onclick="history.back()">Go Back</button>
        </div>
        <div class="admin-user-edit">
            <form action="{{ route('admin-users-save', $user['id']) }}" method="POST" class="p-12">
                <h1>Edit User Details</h1>
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
                <select name="role" class="mx-3">
                    <option value="user" <?php if ($user['role'] == 'user') {
                        echo 'selected';
                    } ?>>User</option>
                    <option value="admin" <?php if ($user['role'] == 'admin') {
                        echo 'selected';
                    } ?>>Admin</option>
                </select>
                <button type="submit" value="Update" class="py-2 px-4 rounded mt-5 mx-3">Update</button>
            </form>
        </div>
    </div>
@endsection
