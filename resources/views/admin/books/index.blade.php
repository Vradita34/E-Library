<x-layout_backend>
    <div class="row">
        @forelse ($books as $book)
        <div class="col-md-6 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <img class="card-img-bottom img-fluid" src="{{$book->cover ? asset('storage/'.$book->cover) : asset('backend/assets/compiled/jpg/building.jpg')}}" alt="Card image cap" style="height: 20rem; object-fit: cover;">
                    <div class="card-body">
                        <h4 class="card-title">{{$book->title}}</h4>
                        <p class="card-title text-warning"><span class="font-semibold">Category</span> : {{$book->category->name}}</p>
                        <p class="card-title "><span class="font-semibold">Author</span> : {{$book->author}}</p>
                        <p class="card-title "><span class="font-semibold">Publisher</span> : {{$book->publisher}}</p>
                        <p class="card-title "><span class="font-semibold">Release</span> : {{$book->release_date}}</p>
                        <p class="card-title "><span class="font-semibold">Duration</span> : {{$book->read_duration}} days</p>
                        <p class="card-text">
                            {{$book->synopsis}}
                        </p>
                        <a href="#" class="card-link"><small>Read 12 Comments</small></a>
                    </div>
                    <div class="btn-group align-items-center mx-2 px-1">
                        <button type="button" class="btn btn-link p-2 m-1 text-decoration-none">
                            <i class="bi bi-heart d-flex align-items-center justify-content-center text-secondary"></i>
                        </button>
                        <button type="button" class="btn btn-link p-2 m-1 text-decoration-none">
                            <i class="bi bi-chat d-flex align-items-center justify-content-center text-secondary"></i>
                        </button>
                        <button type="button" class="btn btn-link p-2 m-1 text-decoration-none">
                            <i class="bi bi-bookmark d-flex align-items-center justify-content-center text-secondary"></i>
                        </button>
                    </div>
                    @if (Auth::user()->role === 'admin')
                    <div class="btn-group d-flex m-2 px-1">
                        <form action="{{route('books.destroy',$book->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        <a href="{{route('books.edit',$book->id)}}">
                            <button type="button" class="btn btn-warning">Edit</button>
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @empty
            <h1>Book Empty</h1>
        @endforelse
    </div>
</x-layout_backend>
