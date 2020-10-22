<div class="container">
    <table class="table table-bordered">
        <tr>
            <th>Fact</th>
        </tr>
        @foreach($data as $post)
        <tr>
            <td>{{ $post['fact'] }}</td>
        </tr>
        @endforeach
    </table>
    {{ $data->links() }}
</div>
