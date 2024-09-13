<x-layout_frontend>
    <!-- Banner Section Begin -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible show fade">
        {{session('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @elseif (session('error'))
    <div class="alert alert-danger alert-dismissible show fade">
        {{session('error')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <iframe src="{{asset('storage/'.$book->file)}}#toolbar=0" frameborder="0" width="100%" height="600em"></iframe>
    <section class="">
    </section>
</x-layout_frontend>
