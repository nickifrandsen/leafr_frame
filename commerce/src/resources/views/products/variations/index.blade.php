    @extends('leafr.core::_layouts.app')

@section('content-header', 'Product / Edit / ' . $product->name . ' / Varianter')

@section('content')

@include('leafr.commerce::products.nav')

<form class="container flex is-primary" action="/backoffice/products/{{ $product->id }}/variations" method="post">

    <div class="flex column is-primary box" id="content-main">
        {{ csrf_field() }}

        @foreach($product->variationGroups() as $id => $name)

            @if($product->hasVariationsInGroup($id)->count() > 0)

                <h3>{{ $name }}</h3>
                <div id="variations-group-{{ $id }}">
                    @each('leafr.commerce::products.variations.single', $product->hasVariationsInGroup($id), 'variation')
                </div>
                <a href="" class="add-variation-group" data-variation-group-id="{{ $id }}">Add variation</a>

            @else

                <div id="variations-group-{{ $id }}"></div>
                <a href="" class="add-variation-group" data-variation-group-id="{{ $id }}">Add {{ $name }}</a>

            @endif

        @endforeach

        <button type="submit" name="button">Submit</button>

    </div>
</form>

@endsection

@section('scripts')

    <script>

        $(document).ready(function() {

            var variationNum = 0;

            $('.add-variation-group').on('click', function(e) {
                e.preventDefault();

                var groupId = $(this).attr('data-variation-group-id');

                var variationRow = '<div class="flex is-row">' +
                                        '<input type="hidden" name="variations[' + variationNum + '][attribute_id]" value="' + groupId + '" placeholder="SKU">' +
                                        '<div class="flex is-primary">' +
                                          '<label for="variation[][sku]">SKU</label>' +
                                          '<input type="text" name="variations[' + variationNum + '][sku]" value="" placeholder="SKU">' +
                                        '</div>' +
                                        '<div class="flex is-primary">' +
                                          '<label for="variation[][name]">Variation name</label>' +
                                          '<input type="text" name="variations[' + variationNum + '][name]" value="" placeholder="Name">' +
                                        '</div>' +
                                        '<div class="flex is-primary">' +
                                          '<label for="variation[][unit_price]" class="">Unit Price</label>' +
                                          '<input type="text" name="variations[' + variationNum + '][unit_price]" value="" placeholder="Unit Price">' +
                                        '</div>' +
                                        '<div class="flex is-primary">' +
                                          '<label for="variations[][sale_price]" class="">Sale Price</label>' +
                                          '<input type="text" name="variations[' + variationNum + '][sale_price]" value="" placeholder="Unit Price">' +
                                        '</div>' +
                                        '<div class="flex is-primary">' +
                                          '<label for="variation[][cost_price]" class="">Cost Price</label>' +
                                          '<input type="text" name="variations[' + variationNum + '][cost_price]" value="" placeholder="Cost Price">' +
                                        '</div>'+
                                        '<div class="flex">' +
                                            '<button type="button" name="button">X</button>' +
                                        '</div>' +
                                    '</div>';
                variationNum = variationNum + 1;
                $('#variations-group-' + groupId).append(variationRow);

                console.log(groupId);
            });
        });

    </script>

@endsection
