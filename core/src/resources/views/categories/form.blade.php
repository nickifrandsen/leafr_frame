<form action="/backoffice/categories" method="post">
        
        {{ csrf_field() }}

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name">
            {{ $errors->first('name') }}
        </div>

        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" name="slug" id="slug">
            {{ $errors->first('slug') }}
        </div>

        <div class="form-group">
            <label for="description">Beskrivelse</label>
            <textarea name="description" id="description" cols="30" rows="10"></textarea>
            {{ $errors->first('description') }}
        </div>

         <div class="form-group">
            <label for="parent_id">Parent</label>
            <select class="select wide" id="parent_id" name="parent_id">
                <option value="" data-display="-- Choose parent id --">Vælg parent id</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            {{ $errors->first('parent_id') }}
        </div>

        <input type="hidden" name="meta" id="meta">

        <button type="submit" class="btn is-wide is-info">
             <div>
                <span class="icon-left">
                    <i class="material-icons">done</i>
                </span>
                Opret kategori
            </div>
        </button>

    </form>