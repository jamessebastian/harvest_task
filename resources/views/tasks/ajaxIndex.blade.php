<table class="table table-hover mt-4">
    <thead>
    <tr>
        <th scope="col"><span id="nameSort">Name </span>@if(request()->sort=='name'){!! request()->order=='asc'?'<i class="fas fa-arrow-up"></i>':'<i class="fas fa-arrow-down"></i>' !!} @endif</th>
        <th scope="col"><span id="hourlyRateSort">Hourly Rate </span>@if(request()->sort=='hourly_rate'){!!  request()->order=='asc'?'<i class="fas fa-arrow-up"></i>':'<i class="fas fa-arrow-down"></i>'  !!} @endif</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>



    @foreach ($tasks as $task)
        <tr>
            <td>
                {{$task->name}}
            </td>
            <td>
                {{$task->hourly_rate}}
            </td>
            <td>
                <form onsubmit="return false;" method="POST" style="display:inline;" action="/tasks/{{$task->uuid}}">
                    @csrf
                    @method('DELETE')
                    <button data-toggle="modal" data-task-name="{{$task->name}}" data-target="#exampleModal" data-uuid="{{$task->uuid}}" class="btn btn-danger btn-sm delete" type="submit">Delete</button>
                </form>
                <a class="btn btn-sm btn-info" href="/tasks/{{$task->uuid}}/edit">Edit</a>
            </td>

        </tr>
    @endforeach


    @if(count($tasks)==0)
        <tr><td colspan="3">No Records found</td></tr>
    @endif

    </tbody>
</table>
{{$tasks->links()}}
