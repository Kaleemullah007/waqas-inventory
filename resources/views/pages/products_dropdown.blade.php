<option>{{ __('en.Choose') }}</option>
@foreach ($products as $product)


    <option value="{{ $product->id }}" @if (in_array($product->id,$add_products))
        style="{{'color:red'}}"
        @endif>{{ $product->name }}</option>
@endforeach
