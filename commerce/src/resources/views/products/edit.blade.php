@extends('leafr.core::_layouts.app')

@section('content-header', 'Product / Edit / ' . $product->name)

@section('content')

@include('leafr.commerce::products.nav')

<form class="container flex is-primary" action="{{ route('commerce.products.update', $product->id ) }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="put" />
    <input type="hidden" name="product_id" value="{{ $product->id }}" />

    @include('leafr.commerce::products.form', ['product' => $product, 'formButtonText' => 'Save'])

</form>

@endsection



@section('scripts')

<script>
    var simplemde = new SimpleMDE({
        forceSync: true,
        promptURLs: true,
        element: $(".markdown-editor")[0]
    });

    $(document).ready(function() {

        Sortable.create(thumbnails, {
            group: "sorting",
            sort: true,

            store: {
                /**
                 * Get the order of elements. Called once during initialization.
                 * @param   {Sortable}  sortable
                 * @returns {Array}
                 */
                get: function (sortable) {
                    var order = localStorage.getItem(sortable.options.group.name);
                    return order ? order.split('|') : [];
                },

                /**
                 * Save the order of elements. Called onEnd (when the item is dropped).
                 * @param {Sortable}  sortable
                 */
                set: function (sortable) {
                    var order = sortable.toArray();

                    $.post( '/backoffice/medias/reorder',  { medias: order, mediableId: '{{ $product->id }}', mediableType: 'Product' })
                }
            }
        });
    });



    

</script>

@endsection
