


<table class="table border table-striped">
    <thead>
        <tr>
            <th>{{__('en.Id')}}</th>
            <th>{{__('en.Customer')}}</th>
            <th>{{__('en.Email')}}</th>
            <th>{{__('en.Action')}}</th>
        </tr>

    </thead>
    <tbody>
        @if ($customers->count() > 0)


        @foreach ($customers as $customer )
            <tr>
                <td>{{$customer->id}}</td>
                <td>{{$customer->name}}</td>
                <td>{{$customer->email}}</td>
                <td>
                    <a href="{{ route('sale.index',['customer_id'=>$customer->id]) }} " data-bs-toggle="tooltip" data-bs-placement="bottom" title="View"
                        class="box border border-1 border-secondary rounded-pill px-2 py-0 fs-6 link-secondary">
                        <i class="bi bi-eye-fill"></i></a>
                    <a href="{{route('sale.edit',$customer->id)}}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"
                        class="box border border-1 border-secondary rounded-pill px-2 py-0 fs-6 link-secondary mx-2">
                        <i class="bi bi-pencil"></i></a>
                    <a href="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"
                        class="box border border-1 border-secondary rounded-pill px-2 py-0 fs-6 link-secondary">
                        <i class="bi bi-trash-fill"></i></a>
                </td>
            </tr>
        @endforeach
        @else
        <tr>
            <td class="text-center" colspan="4" >No record found</td>
        </tr>
        @endif

    </tbody>
</table>
