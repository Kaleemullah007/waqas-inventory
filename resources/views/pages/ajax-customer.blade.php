


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

        @php
         if(request('page')>1)

        $counter = ((request('page')-1)*10) +1;
        else
        $counter = 1;
        @endphp
        @foreach ($customers as $customer )
            <tr>
                <td>{{$counter}}</td>
                <td>{{$customer->name}}</td>
                <td>{{$customer->email}}</td>
                <td>
                    <a href="{{ route('sale.index',['customer_id'=>$customer->id]) }} " data-bs-toggle="tooltip" data-bs-placement="bottom" title="View"
                        class="box border border-1 border-secondary rounded-pill px-2 py-0 fs-6 link-secondary">
                        <i class="bi bi-eye-fill"></i></a>
                    <a href="{{route('customer.edit',$customer->id)}}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"
                        class="box border border-1 border-secondary rounded-pill px-2 py-0 fs-6 link-secondary mx-2">
                        <i class="bi bi-pencil"></i></a>
                </td>
            </tr>
            @php
            $counter++;
        @endphp
        @endforeach
        @else
        <tr>
            <td class="text-center" colspan="4" >No record found</td>
        </tr>
        @endif

    </tbody>
</table>
