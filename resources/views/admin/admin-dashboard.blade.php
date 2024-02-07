@extends('layouts.app')

@section('main')
    <div class="main">
        <div class="admin-dashboard-div">
            <h1 class="mt-5">Admin Dashboard</h1>
            <div class="admin-section">
                <h3>Book Inventory</h3>
                <div class="admin-section-cards flex m-5 space-between">
                    <a href="{{ route('books.create') }}" class="admin-card">
                        <div>
                            <h4>Add Books</h4>
                        </div>
                    </a>
                    <a href="{{ route('admin-books') }}" class="admin-card">
                        <div>
                            <h4>Edit or Delete Books</h4>
                        </div>
                    </a>
                </div>
            </div>
            <div class="admin-section">
                <h3>User Management</h3>
            </div>
            <div class="admin-section">
                <h3>Order Management</h3>
            </div>
            <div class="admin-section">
                <h3>User Quieries</h3>
            </div>
        </div>
    </div>
@endsection
