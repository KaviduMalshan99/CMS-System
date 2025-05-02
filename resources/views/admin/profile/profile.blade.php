@extends('AdminDashboard.master')
@section('title', 'User Profile')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <div class="row gx-3">
                            {{-- <div class="col-md-12 mb-4">
                                <div class="row"> --}}
                                    <div class="col-10"><h3>Profile Details</h3></div>

                                    <div class="col-2">
                                        
                                        @if(auth()->user()->user_type === 'SuperAdmin')
                                        <a href="{{ route('admin.users') }}" class="btn btn-air-primary">Back</a>
                                    @endif
                                    
                                    
                                    </div>
                                {{-- </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PUT') <!-- Add this line -->

                            <div class="mb-3">
                                <label for="user_id" class="form-label py-3">User ID</label>
                                <input type="text" class="form-control" id="user_id" name="user_id"
                                    value="{{ $user->user_id }}" readonly>
                            </div>
                            
                            <div class="mb-3">
                                <label for="name" class="form-label py-3">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $user->name }}" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="email" class="form-label py-3">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ $user->email }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label py-3">New Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter new password (leave blank to keep current)">
                            </div>

                            <div class="mb-3">
                                <label for="phone_number" class="form-label py-3">Phone Number</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number"
                                    value="{{ $user->phone_number }}">
                            </div>
                            
                            <div class="mb-3">
                                <label for="user_type" class="form-label py-3">User Type</label>
                                <input type="text" class="form-control" id="user_type" name="user_type"
                                    value="{{ $user->user_type }}" readonly>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
