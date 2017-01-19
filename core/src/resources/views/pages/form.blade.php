<section id="content-main" class="flex column is-primary box">
    <section class="content-form is-full-width">

        <input type="text" id="tile" name="title" value="{{ old('name') ?? $page->title }}" placeholder="Page Name" tabindex="1" />
        {{ $errors->first('title') }}

        <div class="form-group flex align-middle is-transparent">
            <label for="slug">https://localhost:8000/</label>
            <input type="text" id="slug" name="slug" class="is-primary" value="{{ old('slug') ?? $page->slug }}" placeholder="Type slug here..." />
            {{ $errors->first('slug') }}
        </div>

        <textarea name="content" rows="8" cols="40" class="markdown-editor">{{ old('content') ?? $page->content }}</textarea>

        <input type="file" name="media[]" multiple>
        <div class="thumbnails">
            @foreach($page->medias as $media)
                <img src="{{ Storage::disk('local')->url($media->src) }}" alt="" height="75" />
            @endforeach
        </div>
    </section>
</section>

<aside id="content-aside">
    <div class="content-form inline is-primary">

        <div class="form-group">
            <label for="parent_id">Parent</label>
            <select class="select wide" id="parent_id" name="parent_id">
                <option data-display="-- Choose Parent --">Choose Parent</option>
                @foreach($page->list() as $id => $name)
                    <option value="{{ $id }}" @if($id == $page->parent_id) selected @endif>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
            {{ $errors->first('parent_id') }}
        </div>

        <div class="form-group">
            <label for="meta_title">Meta title</label>
            <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title') ?? $page->meta_title }}" placeholder="Type meta title here..." />
            {{ $errors->first('meta_title') }}
        </div>

        <div class="form-group">
            <label for="meta_title">Meta description</label>
            <textarea id="meta_description" name="meta_description" placeholder="Type meta description here..." value="{{ old(' meta_description ') ?? $page->meta_description }}"></textarea>
            {{ $errors->first('meta_description') }}
        </div>

        <div class="checkbox">
            <input type="checkbox" id="show_in_menu" name="show_in_menu" value="1" @if($page->show_in_menu) checked @endif>
            <label for="show_in_menu">Show in menu</label>
        </div>

    </div>

    <div class="content-form-actions">
        <button type="submit" class="is-large success is-wide" name="submit">{{ $formButtonText ?? 'Create' }} Page</button>
    </div>

</aside>
