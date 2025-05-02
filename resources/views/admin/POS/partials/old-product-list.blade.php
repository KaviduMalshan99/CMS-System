@php
    function getConditionBadgeClass($condition)
    {
        switch ($condition) {
            case 'Good':
                return 'bg-success';
            case 'Average':
                return 'bg-warning';
            case 'Poor':
                return 'bg-danger';
            default:
                return 'bg-secondary';
        }
    }
@endphp

@foreach ($products as $battery)
    <div class="col-xxl-3 col-sm-4">
        <div class="our-product-wrapper h-100 widget-hover" dataId="{{ $battery->id }}"
            data-name="Old Battery - {{ $battery->old_battery_type }}" data-price="{{ $battery->old_battery_value }}">
            <div class="our-product-content">
                <div class="battery-status mb-2">
                    <span class="badge {{ $battery->battery_status === 'Direct' ? 'bg-success' : 'bg-warning' }}">
                        {{ $battery->battery_status }}
                    </span>
                    <span class="badge {{ getConditionBadgeClass($battery->old_battery_condition) }}">
                        {{ $battery->old_battery_condition }}
                    </span>
                </div>
                <h6 class="f-14 f-w-500 pt-2 pb-1">{{ $battery->old_battery_type }}</h6>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="txt-primary">RS {{ number_format($battery->old_battery_value, 2) }} </h6>
                        <small class="text-muted">Added:
                            {{ \Carbon\Carbon::parse($battery->created_at)->format('m/d/Y') }} </small>
                    </div>
                    <div class="add-quantity btn border text-gray f-12 f-w-500">
                        <i class="fa fa-minus remove-minus count-decrease"></i>
                        <button class="btn add-btn btn-sm p-1">Add</button>
                        <i class="fa fa-plus count-increase"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
