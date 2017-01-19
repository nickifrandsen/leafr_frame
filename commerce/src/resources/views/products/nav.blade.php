<ul class="flex">
    <li><a class="btn" href="/backoffice/products/{{ $product->id }}/edit">Generelt</a></li>
    @if($product->has_variations)
    	<li><a class="btn" href="/backoffice/products/{{ $product->id }}/variations">Varianter</a></li>
    @endif
    <li><a class="btn" href="/backoffice/products/{{ $product->id }}/categories">Kategorier</a></li>
    <li><a class="btn" href="/backoffice/products/{{ $product->id }}/meta">Meta</a></li>
    <li><a class="btn" href="/backoffice/products/{{ $product->id }}/inventory">Lagerhåndtering</a></li>
</ul>