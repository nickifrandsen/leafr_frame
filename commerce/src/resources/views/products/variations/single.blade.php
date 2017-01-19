<div class="flex is-row">
    <input type="hidden" name="updateVariation[{{ $variation->id }}][id]" value="{{ $variation->id }}">
    <div class="flex is-primary">
      <label for="">SKU</label>
      <input type="text" name="updateVariation[{{ $variation->id }}][sku]" value="{{ $variation->sku }}" placeholder="SKU">
    </div>
    <div class="flex is-primary">
      <label for="">Variation name</label>
      <input type="text" name="updateVariation[{{ $variation->id }}][name]" value="{{ $variation->value->name }}" placeholder="Name">
    </div>
    <div class="flex is-primary">
      <label for="" class="">Unit Price</label>
      <input type="text" name="updateVariation[{{ $variation->id }}][unit_price]" value="{{ $variation->the_sku->unit_price }}" placeholder="Unit Price">
    </div>
    <div class="flex is-primary">
      <label for="" class="">Sale Price</label>
      <input type="text" name="updateVariation[{{ $variation->id }}][sale_price]" value="{{ $variation->sale_price }}" placeholder="Unit Price">
    </div>
    <div class="flex is-primary">
      <label for="" class="">Cost Price</label>
      <input type="text" name="updateVariation[{{ $variation->id }}][cost_price]" value="{{ $variation->cost_price }}" placeholder="Cost Price">
    </div>

    <div class="flex">
        <button type="button" name="button">X</button>
    </div>
</div>
