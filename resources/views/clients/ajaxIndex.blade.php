<table class="table table-hover mt-4">
    <thead>
    <tr>
        <th scope="col"><a href="{{ $nameSortHref }}">Name </a>@if(request()->sort=='name'){!! request()->order=='asc'?'<i class="fas fa-arrow-up"></i>':'<i class="fas fa-arrow-down"></i>'!!} @endif</th>
        <th scope="col"><a href="{{ $currencySortHref }}">Currency </a>@if(request()->sort=='currency'){!! request()->order=='asc'?'<i class="fas fa-arrow-up"></i>':'<i class="fas fa-arrow-down"></i>' !!} @endif</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>


    @foreach ($clients as $client)
        <tr>
            {{--                        <th scope="row"><a class="btn btn-sm btn-secondary" href="#" role="button">Edit</a></th>--}}
            <td>{{$client->name}}</td>
            <td>{{$client->currency}}</td>
            <td>
                <button class="mx-2 btn btn-sm btn-info" onclick="window.location.href = '/clients/{{$client->uuid}}/edit';">Edit</button>
                <form onsubmit="return false;" style="display:inline;" method="POST" action="/clients/{{$client->uuid}}">
                    @csrf
                    @method('DELETE')
                    <button data-toggle="modal" data-client-name="{{$client->name}}" data-uuid="{{$client->uuid}}" data-target="#exampleModal" class="btn btn-sm btn-danger delete">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>
{{ $clients->links() }}

