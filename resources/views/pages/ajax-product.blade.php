<table class="table border">
    <thead>
        <tr>
            <th>{{__('en.Id')}}</th>
            <th>{{__('en.Name')}}</th>
            <th>{{__('en.Selling price')}}</th>
            <th>{{__('en.Stock')}}</th>
            <th>{{__('en.Stock alert')}}</th>
            <th>{{__('en.Action')}}</th>
        </tr>
    </thead>
    <tbody>
        @if ($products->count() > 0)

            @foreach ($products as $product )
                <tr  @if($product->stock <= $product->stock_alert) class=" text-white bg-danger" @endif>
                    <th>{{$product->id}}</th>
                    <td>{{$product->name}}</td>
                    <td>{{$product->sale_price}}</td>
                    <td>{{$product->stock}}</td>
                    <td>{{$product->stock_alert}}</td>
                    <td>
                        <a href="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View"
                            class="box border border-1 border-secondary rounded-pill px-2 py-0 fs-6 link-secondary">
                            <i class="bi bi-eye-fill"></i></a>
                        <a href="{{route('product.edit',$product->id)}}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"
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
            <td class="text-center" colspan="6" >No record found</td>
        </tr>
        @endif
    </tbody>
</table>