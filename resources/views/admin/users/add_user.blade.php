<x-layout_backend>
    <div class="col-md-6 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Horizontal Form with Icons</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-horizontal" action="{{ route('users.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="first-name-horizontal-icon">Email</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="email" class="form-control" placeholder="Email"
                                                name="email" value="{{ old('email') }}">
                                            <div class="form-control-icon">
                                                <i class="bi bi-person"></i>
                                            </div>
                                            @error('email')
                                                <p class="text-warning text-small">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="contact-info-horizontal-icon">Username</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="text" class="form-control" placeholder="Username"
                                                name="username" value="{{ old('username') }}">
                                            <div class="form-control-icon">
                                                <i class="bi bi-phone"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @error('username')
                                <p class="text-warning text-small">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="contact-info-horizontal-icon">Name</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="text" class="form-control" placeholder="Name"
                                                name="name" value="{{ old('name') }}">
                                            <div class="form-control-icon">
                                                <i class="bi bi-phone"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @error('name')
                                <p class="text-warning text-small">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="contact-info-horizontal-icon">Avatar (optional)1</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input class="form-control" type="file" id="formFile"  placeholder="Avatar (optional)" name="avatar" >
                                            <div class="form-control-icon">
                                                <i class="bi bi-phone"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @error('avatar')
                                <p class="text-warning text-small">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="contact-info-horizontal-icon">Role</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <fieldset class="form-group">
                                                <select class="form-select" id="basicSelect" name="role">
                                                    <option>Select Role</option>
                                                    <option value="admin">Admin</option>
                                                    <option value="librarian">Librarian</option>
                                                    <option value="reader">Reader</option>  
                                                </select>
                                            </fieldset>
                                            <div class="form-control-icon">
                                                <i class="bi bi-phone"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @error('role')
                                <p class="text-warning text-small">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="contact-info-horizontal-icon">Address</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="address">{{old('address')}}</textarea>
                                            <div class="form-control-icon">
                                                <i class="bi bi-phone"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @error('address ')
                                <p class="text-warning text-small">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="password-horizontal-icon">Password</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="password" class="form-control" placeholder="Password" name="password">
                                            <div class="form-control-icon">
                                                <i class="bi bi-lock"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @error('password')
                                <p class="text-warning text-small">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-md-8 offset-md-4">
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout_backend>
