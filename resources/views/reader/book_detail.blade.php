<x-layout_frontend>
    <!-- Banner Section Begin -->
    <section class="blog-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="blog__details__content">
                        <div class="blog__details__item">
                            <img src="{{$book->cover ? asset('storage/'.$book->cover) : '/frontend/img/blog/details/blog-details.jpg'}}" alt="">
                            <div class="blog__details__item__title">
                                <span class="tip">{{$book->category->name}}</span>
                                <h4>{{$book->title}}</h4>
                                <ul>
                                    <li>by <span>{{$book->author}}</span></li>
                                    <li>{{date('m:d:Y',strtotime($book->release_date))}}</li>
                                    {{-- <li>39 Comments</li> --}}
                                </ul>
                            </div>
                        </div>
                        <div class="blog__details__desc">
                            <p>{{$book->synopsis}}</p>
                        </div>
                        @auth
                        <div class="d-flex">
                            @if($permission)
                                @if ($isExpired)
                                <h4>expired</h4>
                                    <form action="{{route('send_request',$book->id)}}" method="POST">
                                        @csrf
                                        <button class="mx-3 btn btn-outline-primary" type="submit" title="Request Permission Book">
                                        <span class="icon_shield"></span> Request Permit
                                        </button>
                                    </form>
                                @else
                                    @if ($permission->status === 'approved' )
                                        <a class="mx-3 btn btn-outline-info" href="{{route('read_book',$book->id)}}">Read Book</a>
                                    @elseif($permission->status === 'process')
                                        <p class="mx-2 text-pretty btn btn-primary" >Process</p>
                                    @elseif ($permission->status === 'decline')
                                        <form action="{{route('send_request',$book->id)}}" method="POST">
                                            @csrf
                                            <button class="mx-3 btn btn-outline-primary" type="submit" title="Request Permission Book">
                                            <span class="icon_shield"></span>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{route('send_request',$book->id)}}" method="POST">
                                            @csrf
                                            <button class="mx-3 btn btn-outline-primary" type="submit" title="Request Permission Book">
                                            <span class="icon_shield"></span>
                                            </button>
                                        </form>
                                    @endif
                                @endif
                            @else
                                <form action="{{route('send_request',$book->id)}}" method="POST">
                                    @csrf
                                    <button class="mx-3 btn btn-outline-primary" type="submit" title="Request Permission Book">
                                    <span class="icon_shield"></span> Request Permit
                                    </button>
                                </form>
                            @endif
                        </div>
                        <div class="border-collapse">
                            @if ($permission)
                            <div class="card mt-3" style="width: 20rem">
                                <div class="card-body">
                                    <p class="text-primary font-weight-bold">Note :</p>
                                    <p class="text-green text-nowrap font-weight-normal text-left">{{$permission->note}}</p>
                                </div>
                                <div class="card-footer">
                                    @if ($permission->expired_date)
                                        <p class="mx-2 my-1 text-danger"> Expired at <span class="font-weight-bold">{{$permission->expired_date}}</span></p>
                                    @endif
                                </div>
                            </div>
                            @endif
                        </div>
                        @endauth
                        @guest
                            <h4 class="text-warning">Login To Request and Read Book</h4>
                        @endguest
                        {{-- <div class="blog__details__comment">
                            <h5>3 Comment</h5>
                            <a href="#" class="leave-btn">Leave a comment</a>
                            <div class="blog__comment__item">
                                <div class="blog__comment__item__pic">
                                    <img src="img/blog/details/comment-1.jpg" alt="">
                                </div>
                                <div class="blog__comment__item__text">
                                    <h6>Brandon Kelley</h6>
                                    <p>Duis voluptatum. Id vis consequat consetetur dissentiet, ceteros commune perpetua
                                    mei et. Simul viderer facilisis egimus tractatos splendi.</p>
                                    <ul>
                                        <li><i class="fa fa-clock-o"></i> Seb 17, 2019</li>
                                        <li><i class="fa fa-heart-o"></i> 12</li>
                                        <li><i class="fa fa-share"></i> 1</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="blog__comment__item blog__comment__item--reply">
                                <div class="blog__comment__item__pic">
                                    <img src="img/blog/details/comment-2.jpg" alt="">
                                </div>
                                <div class="blog__comment__item__text">
                                    <h6>Brandon Kelley</h6>
                                    <p>Consequat consetetur dissentiet, ceteros commune perpetua mei et. Simul viderer
                                    facilisis egimus ulla mcorper.</p>
                                    <ul>
                                        <li><i class="fa fa-clock-o"></i> Seb 17, 2019</li>
                                        <li><i class="fa fa-heart-o"></i> 12</li>
                                        <li><i class="fa fa-share"></i> 1</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="blog__comment__item">
                                <div class="blog__comment__item__pic">
                                    <img src="img/blog/details/comment-3.jpg" alt="">
                                </div>
                                <div class="blog__comment__item__text">
                                    <h6>Brandon Kelley</h6>
                                    <p>Duis voluptatum. Id vis consequat consetetur dissentiet, ceteros commune perpetua
                                    mei et. Simul viderer facilisis egimus tractatos splendi.</p>
                                    <ul>
                                        <li><i class="fa fa-clock-o"></i> Seb 17, 2019</li>
                                        <li><i class="fa fa-heart-o"></i> 12</li>
                                        <li><i class="fa fa-share"></i> 1</li>
                                    </ul>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="blog__sidebar">
                        <div class="blog__sidebar__item">
                            <div class="section-title">
                                <h4>Categories</h4>
                            </div>
                            <ul>
                                <li><a href="#">All <span>(250)</span></a></li>
                                <li><a href="#">Fashion week <span>(80)</span></a></li>
                                <li><a href="#">Street style <span>(75)</span></a></li>
                                <li><a href="#">Lifestyle <span>(35)</span></a></li>
                                <li><a href="#">Beauty <span>(60)</span></a></li>
                            </ul>
                        </div>
                        <div class="blog__sidebar__item">
                            <div class="section-title">
                                <h4>Feature posts</h4>
                            </div>
                            <a href="#" class="blog__feature__item">
                                <div class="blog__feature__item__pic">
                                    <img src="img/blog/sidebar/fp-1.jpg" alt="">
                                </div>
                                <div class="blog__feature__item__text">
                                    <h6>Amf Cannes Red Carpet Celebrities Kend...</h6>
                                    <span>Seb 17, 2019</span>
                                </div>
                            </a>
                            <a href="#" class="blog__feature__item">
                                <div class="blog__feature__item__pic">
                                    <img src="img/blog/sidebar/fp-2.jpg" alt="">
                                </div>
                                <div class="blog__feature__item__text">
                                    <h6>Amf Cannes Red Carpet Celebrities Kend...</h6>
                                    <span>Seb 17, 2019</span>
                                </div>
                            </a>
                            <a href="#" class="blog__feature__item">
                                <div class="blog__feature__item__pic">
                                    <img src="img/blog/sidebar/fp-3.jpg" alt="">
                                </div>
                                <div class="blog__feature__item__text">
                                    <h6>Amf Cannes Red Carpet Celebrities Kend...</h6>
                                    <span>Seb 17, 2019</span>
                                </div>
                            </a>
                        </div>
                        <div class="blog__sidebar__item">
                            <div class="section-title">
                                <h4>Tags cloud</h4>
                            </div>
                            <div class="blog__sidebar__tags">
                                <a href="#">Fashion</a>
                                <a href="#">Street style</a>
                                <a href="#">Diversity</a>
                                <a href="#">Beauty</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout_frontend>
