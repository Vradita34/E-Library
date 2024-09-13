<x-layout_backend>
    <section class="section">
        <div class="row" id="table-striped">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Category Data</h4>
                    </div>
                    <div class="card-content">
                        <!-- table striped -->
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        @if (Auth::user()->role === 'admin')
                                        <th>ACTION</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                    <tr>
                                        <td class="text-bold-500">{{$loop->iteration}}</td>
                                        <td class="text-bold-500">{{$category->name}}</td>
                                        @if (Auth::user()->role === 'admin')
                                        <td>
                                            <div class="d-flex">
                                                <form action="{{route('categories.destroy',$category->id)}}" method="POST" enctype="multipart/form-data" onsubmit="confirm('are you sure!')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger m-2">Delete</button>
                                                </form>
                                                <a href="{{route('categories.edit',$category->id)}}">
                                                    <button type="button" class="btn btn-warning m-2">Edit</button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                        @endif
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
