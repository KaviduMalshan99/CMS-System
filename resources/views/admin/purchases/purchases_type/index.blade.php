@extends('AdminDashboard.master')
@section('title', 'Ecommerce')

@section('css')

@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
@endsection

@section('breadcrumb-title')
<h3>Purchase Management</h3>
@endsection


        @section('breadcrumb-items')
        <li class="breadcrumb-item"> <a class="breadcrumb-item"
                href="{{ request()->query('ref') === 'view' ? route('purchases.show', $purchase->id) : route('purchases.index') }}">
                Purchase
            </a>
        </li>

        <li class="breadcrumb-item active">Add New Purchase</li>
        
      @endsection
  




@section('content')
<div class="container">

    <div class="row  my-3">
        <div class="col-sm-6"><h2>Purchase Types</h2></div>
        <div class="col-sm-6"> <a href="{{ route('purchases_type.create') }}" class="btn btn-primary">Add New Purchase Type</a></div>
    </div>
    
   



<table class="display" id="keytable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Purchase Type ID</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($purchaseTypes as $purchaseType)
                <tr>
                    <td>{{ $purchaseType->id }}</td>
                    <td>{{ $purchaseType->purchase_type_id }}</td>
                    <td>{{ $purchaseType->name }}</td>
                    <td>
                        <a href="" class="btn btn-warning">Edit</a>
                        <form action="" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this purchase type?');">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
    </tbody>
</table>
{{-- Display pagination links if available --}}
{{-- {{ $batteries->links() }} --}}
</div>
</div>
</div>
</div>
</div>
</div>
@endsection

@section('script')
<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js') }}"></script>

<!-- Initialize the DataTable -->
<script>
$(document).ready(function() {
$('#keytable').DataTable({
"paging": true, // Enable pagination
"searching": true, // Enable search box
"ordering": true, // Enable sorting
"responsive": true, // Enable responsive design for mobile devices
"lengthChange": true, // Allow changing the number of rows displayed
"pageLength": 10, // Set default page length to 10 rows
"language": {
"search": "Search records:", // Customize search label
"lengthMenu": "Display _MENU_ records per page" // Customize per-page dropdown
}
});
});
</script>
@endsection



@section('script')
    <script src="{{ asset('assets/js/chart/apex-chart/apex-chart.js') }}"></script>
    <script src="{{ asset('assets/js/chart/apex-chart/stock-prices.js') }}"></script>
    <script src="{{ asset('assets/js/counter/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/js/counter/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/js/counter/counter-custom.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard/dashboard_2.js') }}"></script>
    <script src="{{ asset('assets/js/animation/wow/wow.min.js') }}"></script>
@endsection



 
