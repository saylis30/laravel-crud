<table id="usertable" class="table table-bordered table-hover mt-2">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Mobile No.</th>
            <th scope="col">Profile Picture</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <th scope="row">{{$user->id}}</th>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->mobileno}}</td>
                <td><img src="{{url('assets/images/'.$user->profilepic)}}" height="30" width="30"></img></td>
                <td>{{$user->statusname}}</td>
                <td>
                    <button id="edituser" type="button" class="btn btn-primary btn-sm" onclick="getRecord({{$user->id}});">Edit</button>
                    <button id="deleteuser" type="button" class="btn btn-danger btn-sm" onclick="deleteRecord({{$user->id}});">Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>