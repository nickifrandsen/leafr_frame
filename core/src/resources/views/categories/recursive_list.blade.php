@if($category)
    <tr>
        <td>{{ $category->name }}</td>
        <td>{{ $category->slug }}</td>
        <td>
            @if($category->parent)
                {{  $category->parent->slug }}
            @endif
        </td>
        <td>
            <a href="/backoffice/categories/{{ $category->id }}/edit">
              <i class="material-icons">edit</i>
            </a>
        </td>
    </tr>


    @if($category->hasChildren())
        @each('leafr.core::categories.recursive_list', $category->children, 'category')
    @endif
@endif
