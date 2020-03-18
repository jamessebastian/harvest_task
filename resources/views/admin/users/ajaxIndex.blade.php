<table class="table">
    <thead>
    <tr>
       
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Roles</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)

    <tr @if($user->id==Auth::user()->id) style="background-color: antiquewhite" @endif>
        
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{{implode(',',$user->roles()->get()->pluck('name')->toArray())}}</td>
        <td>
            @can('edit-users')
            <a href="{{ route('admin.users.edit',$user->uuid) }}" class="btn btn-sm btn-primary float-left">Edit</a>
            @endcan
            @can('delete-users')
            <form method="POST" action="{{ route('admin.users.destroy',$user->uuid) }}" class="float-left">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-warning ml-2">Delete</button>
            </form>
            @endcan
        </td>
    </tr>
    @endforeach

    </tbody>
</table>