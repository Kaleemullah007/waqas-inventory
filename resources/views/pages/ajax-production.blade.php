
<table class="table border table-striped">
    <thead>
        <tr>
            <th>{{ __('en.Id') }}</th>
            <th>{{ __('en.Raw Material') }}</th>
            <th>{{ __('en.Product') }}</th>
            <th>{{ __('en.Quantity') }}</th>
            <th>{{ __('en.Waste') }}</th>
            <th>{{ __('en.Action') }}</th>
        </tr>
    </thead>
    <tbody>

        @if ($productions->count() > 0)

        @foreach ($productions as $production)
            <tr>
                <th>{{ $production->id }}</th>
                <td>{{ $production->RawMaterial->name }}</td>
                <td>{{ $production->Product->name }}</td>
                <td>{{ $production->qty }}</td>
                <td>{{ $production->wastage_qty }}</td>
                <td>
                    <a href="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View"
                        class="box border border-1 border-secondary rounded-pill px-2 py-0 fs-6 link-secondary me-2">
                        <i class="bi bi-eye-fill"></i></a>
                    <a href="{{ route('production.edit', $production->id) }}" data-bs-toggle="tooltip"
                        data-bs-placement="bottom" title="Edit"
                        class="box border border-1 border-secondary rounded-pill px-2 py-0 fs-6 link-secondary me-2">
                        <i class="bi bi-pencil"></i></a>
                    <a href="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"
                        class="box border border-1 border-secondary rounded-pill px-2 py-0 fs-6 link-secondary me-2">
                        <i class="bi bi-trash-fill"></i></a>
                    {{-- <a href="{{ route('production.create') }}" data-bs-toggle="tooltip"
                        data-bs-placement="bottom" title="Production"
                        class="box border border-1 border-secondary rounded-pill px-2 py-0 fs-6 link-secondary me-2">
                        <i class="bi bi-repeat"></i></a> --}}
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