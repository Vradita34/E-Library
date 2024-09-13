<x-layout_backend>
    <section class="section">
        <div class="row" id="table-striped">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Users Data</h4>
                    </div>
                    <div class="card-content">
                        <!-- table striped -->
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Avatar</th>
                                        <th>Username</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Address</th>
                                        @if (Auth::user()->role === 'admin')
                                        <th>ACTION</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td class="text-bold-500">{{$loop->iteration}}</td>
                                        <td>
                                            <div class="avatar avatar-lg me-3">
                                                <img src="{{ $user->avatar ? asset('storage/'.$user->avatar) : asset('backend/assets/compiled/jpg/2.jpg')}}" alt="" srcset="">
                                            </div>
                                        </td>
                                        <td>{{$user->username}}</td>
                                        <td class="text-bold-500">{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->role}}</td>
                                        <td>{{$user->address}}</td>
                                        @if (Auth::user()->role === 'admin')
                                        <td>
                                            <div class="d-flex">
                                                <form action="{{route('users.destroy',$user->id)}}" method="POST" enctype="multipart/form-data" onsubmit="confirm('are you sure!')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger m-2">Delete</button>
                                                </form>
                                                <a href="{{route('users.edit',$user->id)}}">
                                                    <button type="button" class="btn btn-warning m-2">Edit</button>
                                                </a>
                                            </div>
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout_backend>
