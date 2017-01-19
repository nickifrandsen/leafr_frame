@if($page)
    <tr>
        <td>{{ $page->title }}</td>
        <td>{{ $page->slug }}</td>
        <td>
            @if($page->show_in_menu)
                <span class="tag is-info">
                    vises i menu
                </span>
            @endif
        </td>
        <td>
            @if($page->parent)
                {{  $page->parent->slug }}
            @endif
        </td>
        <td>
            <a href="/backoffice/pages/{{ $page->id }}/edit">
              <i class="material-icons">edit</i>
            </a>
        </td>
    </tr>


    @if($page->hasChildren())
        @each('leafr.core::pages.recursive_list', $page->children, 'page')
    @endif
@endif
