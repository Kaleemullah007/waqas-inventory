<table class="table border table-striped">
    <thead>
        <tr>
            <th>{{__('en.Id')}}</th>
            <th>{{__('en.Customer')}}</th>
            <th>{{__('en.Product')}}</th>
            <th>{{__('en.Price')}}</th>
            <th>{{__('en.Quantity')}}</th>
            <th>{{__('en.Action')}}</th>
        </tr>

    </thead>
    <tbody>
        @if ($sales->count() > 0)


        @php
         if(request('page')>1)

        $counter = (request('page')-1)*10;
        else
        $counter = 1;
        @endphp
        @foreach ($sales as $sale )
        <tr>
            
            <td>{{$counter}}</td>
            <td> {{$sale->Customer->name}}</td>

            <td>{{$sale->Products->pluck('product_name')->join(',')}}</td>
            <td>{{$sale->total}}</td>
            <td>{{$sale->total_qty}}</td>
            <td>
                <a href="{{route('sale.show',$sale->id)}}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View"
                    class="box border border-1 border-secondary rounded-pill px-2 py-0 fs-6 link-secondary">
                    <i class="bi bi-eye-fill"></i></a>
                <a href="{{route('sale.edit',$sale->id)}}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"
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
            <td class="text-center" colspan="6" >No record found</td>
        </tr>
        @endif

    </tbody>
</table>
