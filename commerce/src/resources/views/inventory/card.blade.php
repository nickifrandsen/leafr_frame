<tr>
    <td>{{ $transaction->sku }}</td>
    <td>
        @if($transaction->in)
            <i class="material-icons is-success-text">expand_more</i> {{ $transaction->in }} 
        @else
            <i class="material-icons is-danger-text">expand_less</i> {{ $transaction->out }}
        @endif
    </td>
    <td>{{ $transaction->price }}</td>
    <td>{{ $transaction->origin }}</td>
    <td>{{ $transaction->created_at->diffForHumans(null, true) }}</td>
</tr>
