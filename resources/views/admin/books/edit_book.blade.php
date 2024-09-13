<x-layout_backend>
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add Book</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" action="{{ route('books.update',$book->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Title</label>
                                            <input type="text" id="first-name-column" class="form-control"
                                                placeholder="Title" name="title" value="{{ old('title',$book->title) }}">
                                        </div>
                                        @error('title')
                                            <p class="text-warning text-small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Author</label>
                                            <input type="text" id="first-name-column" class="form-control"
                                                placeholder="Author" name="author" value="{{ old('author',$book->author) }}">
                                        </div>
                                        @error('author')
                                            <p class="text-warning text-small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Release Date</label>
                                            <input type="date" id="first-name-column" class="form-control"
                                                name="release_date" value="{{old('release_date',$book->release_date)}}">
                                        </div>
                                        @error('release_date')
                                            <p class="text-warning text-small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Publisher</label>
                                            <input type="text" id="first-name-column" class="form-control"
                                                placeholder="Author" name="publisher" value="{{ old('publisher',$book->publisher) }}">
                                        </div>
                                        @error('publisher')
                                            <p class="text-warning text-small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Category</label>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="basicSelect" name="category_id">
                                                    <option>Select Role</option>
                                                    @foreach ($category as $item)
                                                    <option value="{{$item->id}}" {{$book->role == $item->role ? 'selected' : ''}}>{{$item->name}}</option>s
                                                    @endforeach
                                                </select>
                                            </fieldset>
                                        </div>
                                        @error('category_id')
                                        <p class="text-warning text-small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Synopsis</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="synopsis">{{old('synopsis',$book->synopsis)}}</textarea>
                                        </div>
                                        @error('synopsis')
                                            <p class="text-warning text-small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Read Duration</label>
                                            <input type="int" min="1" max="200" id="first-name-column" class="form-control"
                                                placeholder="Read Duration" name="read_duration" value="{{ old('read_duration',$book->read_duration) }}">
                                        </div>
                                        @error('read_duration')
                                            <p class="text-warning text-small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Cover</label>
                                            <input class="form-control" type="file" id="formFile"  placeholder="Cover (optional)" name="cover" >
                                        </div>
                                        @error('cover')
                                            <p class="text-warning text-small">{{ $message }}</p>s
                                        @enderror
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">File</label>
                                            <input class="form-control" type="file" id="formFile"  placeholder="File PDF" name="file" >
                                        </div>
                                        @error('file')
                                            <p class="text-warning text-small">{{ $message }}</p>s
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
</x-layout_backend>
