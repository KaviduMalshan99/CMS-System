@extends('AdminDashboard.master')
@section('title', 'User Management')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <div class="row">
                            <div class="col-8"><h3>User Management</h3></div>
                            <div class="col-4"><a href="{{route('profile.show')}}" class="btn btn-air-primary">Update Profile</a></div>
                        </div>
                        
                    </div>


                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>User Type</th>
                                    
                                    <th>Action</th>
                                    {{-- <th>Updated Type</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $id = 1; // Initialize the counter
                                @endphp
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $id++ }}</td> <!-- Increment ID for each user -->
                                        <td>{{ $user->user_id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <form action="{{ route('admin.updateUserType', $user->id) }}" method="POST">
                                                @csrf
                                                @method('POST')
                                    
                                                <select class="form-control usertype-select" name="user_type" id="userTypeSelect-{{ $user->id }}" onchange="updateUserType({{ $user->id }})">
                                                    <option value="{{ $user->user_type }}" id="updated-user-type-{{ $user->id }}" style="display: none;">{{ $user->user_type }}</option>
                                                    <option value="user" {{ $user->user_type == 'user' ? 'selected' : '' }}>User</option>
                                                    <option value="cashier" {{ $user->user_type == 'cashier' ? 'selected' : '' }}>Cashier</option>
                                                    <option value="admin" {{ $user->user_type == 'admin' ? 'selected' : '' }}>Admin</option>
                                                    <option value="superadmin" {{ $user->user_type == 'superadmin' ? 'selected' : '' }}>Superadmin</option>
                                                </select>
                                    
                                                <input type="hidden" name="email" value="{{ $user->email }}">
                                                <input type="hidden" name="user_id" value="{{ $user->user_id }}">
                                    
                                               
                                                
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-primary btn-sm mt-2">Update</button>
                                        </form>
                                        </td>
                                        {{-- <td> <strong>Updated Type:</strong> <span id="updated-user-type-{{ $user->id }}">{{ $user->user_type }}</span></td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-end my-3">
                            <!-- Custom Pagination Design -->
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <!-- Previous Button -->
                                    <li class="page-item {{ $users->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $users->previousPageUrl() }}" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                        
                                    <!-- Page Number Buttons -->
                                    @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                                        <li class="page-item {{ $users->currentPage() == $page ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach
                        
                                    <!-- Next Button -->
                                    <li class="page-item {{ $users->hasMorePages() ? '' : 'disabled' }}">
                                        <a class="page-link" href="{{ $users->nextPageUrl() }}" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        





                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


<script>
    function updateUserType(userId) {
        let form = document.getElementById('userTypeForm-' + userId);
        let select = document.getElementById('userTypeSelect-' + userId);
        let selectedValue = select.value;

        let formData = new FormData(form);
        formData.append('_token', '{{ csrf_token() }}');

        fetch(form.action, {
            method: 'POST',
            body: formData
        }).then(response => response.json())
          .then(data => {
              if (data.success) {
                  // Show the hidden first option with the updated user type
                  let firstOption = document.getElementById('updated-user-type-' + userId);
                  firstOption.textContent = selectedValue;
                  firstOption.value = selectedValue;
                  firstOption.style.display = 'block';

                  // Update the displayed user type
                  document.getElementById('displayUserType-' + userId).textContent = selectedValue;
              }
          }).catch(error => console.log(error));
    }
</script>