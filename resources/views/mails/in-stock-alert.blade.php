<p>
    Product "{{ $product->product_name }}" in the store
</p>
<a href="{{ route('good', ['product' => $product->product_slug]) }}">Buy Now</a>
