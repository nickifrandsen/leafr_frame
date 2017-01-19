<section id="content-main" class="flex column is-primary box">
    <section class="content-form is-full-width">

        <input type="text" id="name" name="name" value="{{ old('name') ?? $product->name }}" placeholder="Product Name" tabindex="1" />
        {{ $errors->first('name') }}

        <div class="form-group flex align-middle is-transparent">
            <label for="slug">https://localhost:8000/products/</label>
            <input type="text" id="slug" name="slug" class="is-primary" value="{{ old('slug') ?? $product->slug }}" placeholder="Type slug here..." />
            {{ $errors->first('slug') }}
        </div>

        <textarea name="description" rows="8" cols="40" class="markdown-editor">{{ old('content') ?? $product->description }}</textarea>

        <input type="file" name="media[]" multiple>
        <ol id="thumbnails" class="sortable">
            @foreach($product->present()->media as $media)
                <li data-product-id="{{ $product->id }}" data-id="{{ $media->id }}">
                    <img src="{{ Storage::disk('local')->url($media->src) }}" alt="" height="75" />
                </li>
            @endforeach
        </ol>
    </section>
</section>

<aside id="content-aside">
    <div class="content-form inline is-primary">

        <div class="form-group">
            <label for="product_type_id">Type</label>
            <select class="select wide" id="product_type_id" name="product_type_id">
                <option data-display="-- Choose Product Type --">Choose Product Type</option>
                @foreach($product->types() as $id => $name)
                    <option value="{{ $id }}" @if($id == $product->product_type_id) selected @endif>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
            {{ $errors->first('product_type_id') }}
        </div>

        @if(!$product->has_variations)
            <div class="form-group">
                <label for="sku">SKU</label>
                <input type="text" id="sku" name="sku" value="{{ old('sku') ?? $product->sku }}" placeholder="SKU">
                {{ $errors->first('sku') }}
            </div>
        @endif

        <div class="form-group">
            <label for="unit_price">Unit Price</label>
            <input type="text" id="unit_price" name="unit_price" value="{{ old('unit_price') ?? $product->unit_price }}" placeholder="Unit Price">
            {{ $errors->first('unit_price') }}
        </div>

        <div class="form-group">
            <label for="sale_price">Sale Price</label>
            <input type="text" id="sale_price" name="sale_price" value="{{ old('sale_price') ?? $product->sale_price }}" placeholder="Sale Price">
            {{ $errors->first('sale_price') }}
        </div>

        <div class="form-group">
            <label for="cost_price">Cost Price</label>
            <input type="text" id="cost_price" name="cost_price" value="{{ old('cost_price') ?? $product->cost_price }}" placeholder="Cost Price">
            {{ $errors->first('cost_price') }}
        </div>

        <div class="form-group">
            <label for="weight">Weight</label>
            <input type="text" id="weight" name="weight" value="{{ old('weight') ?? $product->weight }}" placeholder="Weight">
            {{ $errors->first('weight') }}
        </div>

        <div class="form-group">
            <label for="supplier_id">Supplier</label>
            <select class="select wide" id="supplier_id" name="supplier_id">
                <option value="">Choose Supplier</option>
                @foreach($product->suppliers() as $id => $name)
                    <option value="{{ $id }}" @if($id == $product->supplier_id) selected @endif>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
            {{ $errors->first('supplier_id') }}
        </div>

        <div class="form-group">
            <label for="brand_id">Brand</label>
            <select class="select wide" id="brand_id" name="brand_id">
                <option value="">Choose Brand</option>
                @foreach($product->brands() as $id => $name)
                    <option value="{{ $id }}" @if($id == $product->brand_id) selected @endif>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
            {{ $errors->first('brand_id') }}
        </div>

        <div class="checkbox">
            <input type="hidden" name="has_variations" value="0">
            <input type="checkbox" id="has_variations" name="has_variations" value="1" @if($product->has_variations) checked @endif>
            <label for="has_variations">Has Variations</label>
        </div>

        <div class="checkbox">
            <input type="hidden" name="is_online" value="0">
            <input type="checkbox" id="is_online" name="is_online" value="1" @if($product->is_online) checked @endif>
            <label for="is_online">Is Online</label>
        </div>
    </div>

    <div class="content-form-actions">
        <button type="submit" class="is-large success is-wide" name="submit">{{ $formButtonText ?? 'Create' }} Product</button>
    </div>

</aside>
