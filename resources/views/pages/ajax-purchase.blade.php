<table class="table border table-striped">
    <thead>
        <tr>
            <th>{{ __('en.Id') }}</th>
            <th>{{ __('en.Vendor') }}</th>
            <th>{{ __('en.Selling price') }}</th>
            <th>{{ __('en.Price') }}</th>
            <th>{{ __('en.Quantity') }}</th>
            <th>{{ __('en.Action') }}</th>
        </tr>
    </thead>
    <tbody>
        @if ($purchases->count() > 0)

            @foreach ($purchases as $purchase)
                <tr>
                    <th>{{ $purchase->id }}</th>
                    <td>{{ $purchase->user_id }}</td>
                    <td>{{ $purchase->sale_price }}</td>
                    <td>{{ $purchase->price }}</td>
                    <td>{{ $purchase->qty }}</td>
                    <td>
                        <a href="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View"
                            class="box border border-1 border-secondary rounded-pill px-2 py-0 fs-6 link-secondary me-2">
                            <i class="bi bi-eye-fill"></i></a>
                        <a href="{{ route('purchase.edit', $purchase->id) }}" data-bs-toggle="tooltip"
                            data-bs-placement="bottom" title="Edit"
                            class="box border border-1 border-secondary rounded-pill px-2 py-0 fs-6 link-secondary me-2">
                            <i class="bi bi-pencil"></i></a>
                        <a href="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"
                            class="box border border-1 border-secondary rounded-pill px-2 py-0 fs-6 link-secondary me-2">
                            <i class="bi bi-trash-fill"></i></a>
                        {{-- <button data-bs-toggle="modal" data-bs-target="#process_product" data-bs-toggle="tooltip"
                            data-bs-placement="bottom" title="Processed"
                            class="box border border-1 border-secondary rounded-pill px-2 py-0 fs-6 link-secondary me-2">
                            <i class="bi bi-repeat"></i></button> --}}
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td class="text-center" colspan="6" >No record found</td>
            </tr>
        @endif

    </tbody>
</table>