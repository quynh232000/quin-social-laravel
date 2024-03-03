<div class="main-content right-chat-active">

    <div class="middle-sidebar-bottom">
        <div class="middle-sidebar-left pe-0">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card shadow-xss w-100 d-block d-flex border-0 p-4 mb-3">
                        <div class="card-body d-flex align-items-center p-0">
                            <h2 class="fw-700 mb-0 mt-0 font-md text-grey-900">Pages
                                @if ($count)
                                    ({{$count}})
                                @endif
                            </h2>
                            <div  class="search-form-2 ms-auto">
                                {{-- <i class="fa-solid fa-magnifying-glass font-xss" ></i> --}}
                                <input type="text" name="search" wire:model.lazy="search"
                                    class="form-control text-grey-500 mb-0 bg-greylight theme-dark-bg border-0"
                                    placeholder="Search here...">
                            </div>
                            <a href="{{ route('create-page') }}"
                                class="  btn-round-md btn-success  bg-success ms-2 bg-greylight theme-dark-bg rounded-3"><i
                                    class="fa-solid fa-plus font-xss text-white"></i></a>
                        </div>
                    </div>

                    <div class="row ps-2 pe-1">

                        @forelse ($pages as $page)
                            <div class="col-md-4 col-sm-6 pe-2 ps-2">
                                <div class="card d-block border-0 shadow-xss rounded-3 overflow-hidden mb-3">
                                    <div class="card-body d-block w-100 p-4 text-center">
                                        <figure class="avatar ms-auto me-auto mb-0 position-relative w90 z-index-1">
                                            <a href="{{route('page',$page->uuid)}}">
                                                <img
                                                style="width: 90px;height:90px;object-fit:cover;border-radius:50%"
                                                src="{{ asset('storage/' . $page->icon) }}" alt="image"
                                                class="float-right p-1 bg-white rounded-circle w-100">
                                            </a>
                                        </figure>
                                        <div class="clearfix"></div>
                                        <a href="{{route('page',$page->uuid)}}" class="d-block fw-700 text-dark font-xss mt-3 mb-0">{{ $page->name }} </a>
                                        <a href="{{route('page',$page->uuid)}}" class="fw-500 font-xssss text-grey-500 mt-0 mb-3">{{ $page->location }}</a>
                                        <ul class="d-flex align-items-center justify-content-center mt-1">
                                            <li class="m-2">
                                                <h4 class="fw-700 font-sm">
                                                    {{ App\models\Post::where('page_id', $page->id)->count() }}
                                                    <span
                                                        class="font-xsssss fw-500 mt-1 text-grey-500 d-block">Posts</span>
                                                </h4>
                                            </li>
                                            <li class="m-2">
                                                <h4 class="fw-700 font-sm">{{ $page->members }} <span
                                                        class="font-xsssss fw-500 mt-1 text-grey-500 d-block">Follower</span>
                                                </h4>
                                            </li>

                                        </ul>
                                        <ul class="d-flex align-items-center justify-content-center mt-1">
                                            {{-- <li class="m-1"><img src="images/top-student.svg" alt="icon"></li>
                                            <li class="m-1"><img src="images/onfire.svg" alt="icon"></li>
                                            <li class="m-1"><img src="images/challenge-medal.svg" alt="icon">
                                            </li>
                                            <li class="m-1"><img src="images/fast-graduate.svg" alt="icon"></li> --}}
                                        </ul>
                                        @if (App\models\PageLike::where(['user_id' => auth()->id(), 'page_id' => $page->id])->exists())
                                            <a wire:click='unfollow({{ $page->id }})'
                                                class="mt-4 p-0 btn p-2 lh-24 w100 ms-1 ls-3 d-inline-block rounded-xl bg-danger font-xsssss fw-700 ls-lg text-white">UNFOLLOW</a>
                                        @else
                                            <a wire:click='follow({{ $page->id }})'
                                                class="mt-4 p-0 btn p-2 lh-24 w100 ms-1 ls-3 d-inline-block rounded-xl bg-current font-xsssss fw-700 ls-lg text-white">FOLLOW</a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        @empty
                            <div class="text-center text-danger my-4">No page!</div>
                        @endforelse
                        <div class="card w-100 text-center shadow-xss rounded-xxl border-0 p-4 mb-3 mt-3">
                            <div class="snippet mt-2 ms-auto me-auto" data-title=".dot-typing">
                                <div class="stage">
                                    <div class="dot-typing"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
