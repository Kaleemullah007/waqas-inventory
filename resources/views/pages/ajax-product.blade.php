@include('message')
<table class="table border ">
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

        @php

            if(request('page')>1)

            $counter = ((request('page')-1)*10) +1;
            else
            $counter = 1;
        @endphp
            @foreach ($products as $product )
                <tr  @if($product->stock <= $product->stock_alert) class=" text-white bg-danger" @endif>
                    <th>{{$counter}}</th>
                    <td>{{$product->name}}</td>
                    <td>{{$product->sale_price}}</td>
                    <td>{{$product->stock}}</td>
                    <td>{{$product->stock_alert}}</td>
                    <td class="d-flex">
                        <a href="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View"
                            class="box border border-1 border-secondary rounded-pill px-2 py-0 fs-6 link-secondary">
                            <i class="bi bi-eye-fill"></i></a>
                        <a href="{{route('product.edit',$product->id)}}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"
                            class="box border border-1 border-secondary rounded-pill px-2 py-0 fs-6 link-secondary mx-2">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form class="" action="{{ route('product.destroy', $product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"  data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"
                                class="box border border-1 border-secondary rounded-pill px-2 py-0 fs-6 link-secondary">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
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
