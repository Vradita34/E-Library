<x-layout_backend>
    <section class="section">
        <div class="row" id="table-hover-row">
            <a href="{{route('permissionsLastHandle')}}">
                <button class="btn btn-outline-info mb-3">PermissionLastHandle</button>
            </a>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Permissions</h4>
                    </div>
                    <div class="card-content">
                        <!-- table hover -->
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Reader</th>
                                        <th>Book</th>
                                        <th>Status</th>
                                        <th>Request at</th>
                                        <th>Expired at</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($permissions as $permit)
                                    <tr>
                                        <td class="text-bold-800">{{$loop->iteration}}</td>
                                        <td>{{$permit->user->username}}</td>
                                        <td>{{$permit->book->title}}</td>
                                        <td class="text-bold-500">{{$permit->status}}</td>
                                        <td>{{$permit->created_at}}</td>
                                        <td>{{$permit->expired_date}}</td>
                                        @if (Auth::user()->role === 'librarian')
                                        <td>
                                            <div class="modal-primary me-1 mb-1 d-inline-block">
                                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#primary">
                                                    Accept or Decline
                                                </button>

                                                <!--primary theme Modal -->
                                                <div class="modal fade text-left" id="primary" tabindex="-1" aria-labelledby="myModalLabel160" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal" role="document">
                                                        <form action="{{route('handlePermissions',$permit->id)}}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-primary">
                                                                    <h5 class="modal-title white" id="myModalLabel160">Action
                                                                    </h5>
                                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                                    </button>
                                                                </div>
                                                                        <div class="card-header">
                                                                            Add Note (Optional)
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <div class="form-floating" >
                                                                                <textarea name="note"  class="form-control" placeholder="Leave a note here" id="floatingTextarea" rows="3" cols="30">
                                                                                    {{old('note')}}
                                                                                </textarea>
                                                                                <label for="floatingTextarea">Your Note</label>
                                                                            </div>
                                                                            @error('note')
                                                                                <p class="text-danger">{{$message}}</p>
                                                                            @enderror
                                                                        </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Close</span>
                                                                    </button>
                                                                    <button type="submit" name="action" value="approved" class="btn btn-primary ms-1" data-bs-dismiss="modal">
                                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Accept</span>
                                                                    </button>
                                                                    <button type="submit" name="action" value="decline" class="btn btn-primary ms-1" data-bs-dismiss="modal">
                                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Decline</span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        @endif
                                    </tr>
                                    @empty
                                        <h1>Empy</h1>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout_backend>
