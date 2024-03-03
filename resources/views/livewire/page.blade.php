{{-- ================= --}}
<div class="main-content right-chat-active">

    <div class="middle-sidebar-bottom">
        <div class="middle-sidebar-left">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card w-100 border-0 p-0 bg-white shadow-xss rounded-xxl">
                        <div class="card-body h250 p-0 rounded-xxl overflow-hidden m-3 w-full"><img class="w-full"
                                style="max-height: 250px;object-fit:cover"
                                src="{{ asset('storage/' . $page->thumbnail) }}" alt="image"></div>
                        <div class="card-body p-0 position-relative">
                            <figure class="avatar position-absolute w100 z-index-1" style="top:-40px; left: 30px;">
                                <img src="{{ asset('storage/' . $page->icon) }}"
                                    style="width: 100px;height:100px;object-fit:contain;border-radius:50%;
                                    border:1px solid rgba(22,22,24,.12)"
                                    alt="image" class="float-right p-1 bg-white rounded-circle w-100">
                            </figure>
                            <h4 class="fw-700 font-sm mt-2 mb-lg-5 mb-4 pl-15">{{ $page->name }} <span
                                    class="fw-500 font-xssss text-grey-500 mt-1 mb-3 d-block">

                                    {{ App\Models\Post::where('page_id', $page->id)->count() ?? 0 }}
                                    Posts - {{ App\Models\PageLike::where('page_id', $page->id)->count() ?? 0 }}
                                    Followers



                                </span></h4>
                            <div
                                class="d-flex align-items-center justify-content-center position-absolute-md right-15 top-0 me-2">
                                {{-- button --}}
                                @if (!($page->user_id == auth()->id()))

                                    @if (App\models\PageLike::where(['user_id' => auth()->id(), 'page_id' => $page->id])->exists())
                                        <a wire:click='unfollow({{ $page->id }})'
                                            class="mt-1 p-0 btn p-2 lh-24 w100 ms-1 ls-3 d-inline-block rounded-xl bg-danger font-xsssss fw-700 ls-lg text-white">UNFOLLOW</a>
                                    @else
                                        <a wire:click='follow({{ $page->id }})'
                                            class="mt-1 p-0 btn p-2 lh-24 w100 ms-1 ls-3 d-inline-block rounded-xl bg-current font-xsssss fw-700 ls-lg text-white">FOLLOW</a>
                                    @endif
                                @else
                                    <button
                                        class="d-none d-lg-block btn btn-outline-primary p-3 z-index-1 rounded-3  font-xsssss text-uppercase fw-700 ls-3">
                                        Edit profile</button>
                                @endif
                                {{-- setting --}}
                                <a href="#"
                                    class="d-none d-lg-block bg-greylight btn-round-lg ms-2 rounded-3 text-grey-700"><i
                                        class="fa-regular fa-comment font-md"></i></a>

                                <a href="#" id="dropdownMenu88"
                                    class="d-none d-lg-block btn-round-lg ms-2 rounded-3 text-grey-700 bg-greylight"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                        class="fa-solid fa-ellipsis-vertical font-md"></i></a>

                                <div class="dropdown-menu dropdown-menu-end p-4 rounded-xxl border-0 shadow-lg"
                                    aria-labelledby="dropdownMenu88">
                                    <div class="card-body p-0 d-flex">
                                        <i class="feather-bookmark text-grey-500 me-3 font-lg"></i>
                                        <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-0">Save Link <span
                                                class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Add this to
                                                your saved items</span></h4>
                                    </div>
                                    <div class="card-body p-0 d-flex mt-2">
                                        <i class="feather-alert-circle text-grey-500 me-3 font-lg"></i>
                                        <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-0">Hide Post <span
                                                class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Save to your
                                                saved items</span></h4>
                                    </div>
                                    <div class="card-body p-0 d-flex mt-2">
                                        <i class="feather-alert-octagon text-grey-500 me-3 font-lg"></i>
                                        <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-0">Hide all from Group <span
                                                class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Save to your
                                                saved items</span></h4>
                                    </div>
                                    <div class="card-body p-0 d-flex mt-2">
                                        <i class="feather-lock text-grey-500 me-3 font-lg"></i>
                                        <h4 class="fw-600 mb-0 text-grey-900 font-xssss mt-0 me-0">Unfollow Group <span
                                                class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Save to your
                                                saved items</span></h4>
                                    </div>
                                </div>




                            </div>
                        </div>

                        <div class="card-body d-block w-100 shadow-none mb-0 p-0 border-top-xs">
                            <ul class="nav nav-tabs h55 d-flex product-info-tab border-bottom-0 ps-4" id="pills-tab"
                                role="tablist">
                                <li class="active list-inline-item me-5"><a
                                        class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block active"
                                        href="#navtabs1" data-toggle="tab">About</a></li>
                                <li class="list-inline-item me-5"><a
                                        class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block"
                                        href="#navtabs2" data-toggle="tab">Membership</a></li>
                                <li class="list-inline-item me-5"><a
                                        class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block"
                                        href="#navtabs3" data-toggle="tab">Discussion</a></li>
                                <li class="list-inline-item me-5"><a
                                        class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block"
                                        href="#navtabs4" data-toggle="tab">Video</a></li>
                                <li class="list-inline-item me-5"><a
                                        class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block"
                                        href="#navtabs3" data-toggle="tab">Group</a></li>
                                <li class="list-inline-item me-5"><a
                                        class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block"
                                        href="#navtabs1" data-toggle="tab">Events</a></li>
                                <li class="list-inline-item me-5"><a
                                        class="fw-700 me-sm-5 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block"
                                        href="#navtabs7" data-toggle="tab">Media</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-xxl-3 col-lg-4 pe-0">

                    <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3">
                        <div class="card-body d-block p-4">
                            <h4 class="fw-700 mb-3 font-xsss text-grey-900">About</h4>
                            <p class="fw-500 text-grey-500 lh-24 font-xssss mb-0">{{ $page->description }}</p>
                        </div>



                    </div>
                    <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3">
                        <div class="card-body d-flex align-items-center  p-4">
                            <h4 class="fw-700 mb-0 font-xssss text-grey-900">Photos</h4>
                            <a href="#" class="fw-600 ms-auto font-xssss text-primary">See all</a>
                        </div>
                        <div class="card-body d-block pt-0 pb-2">
                            <div class="row">
                                @forelse ($post_media as $images)
                                    @php
                                        $listimg = json_decode($images->file);
                                    @endphp

                                    @foreach ($listimg as $image)
                                        <div class="col-6 mb-2 pe-1"><a href="{{ asset('storage/' . $image) }}"
                                                data-lightbox="roadtrip"><img src="{{ asset('storage/' . $image) }}"
                                                    alt="image" class="img-fluid rounded-3 w-100"></a></div>
                                    @endforeach
                                @empty
                                    <div class="text-center my-2">No photo</div>
                                @endforelse
                            </div>
                        </div>
                        <div class="card-body d-block w-100 pt-0">
                            <a href="#"
                                class="p-2 lh-28 w-100 d-block bg-grey text-grey-800 text-center font-xssss fw-700 rounded-xl">
                                More
                                <i class="fa-solid fa-angles-right font-xss me-2"></i>
                            </a>
                        </div>
                    </div>

                    <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3">
                        <div class="card-body d-flex align-items-center  p-4">
                            <h4 class="fw-700 mb-0 font-xssss text-grey-900">Event</h4>
                            <a href="#" class="fw-600 ms-auto font-xssss text-primary">See all</a>
                        </div>
                        <div class="card-body d-flex pt-0 ps-4 pe-4 pb-3 overflow-hidden">
                            <div class="bg-success me-2 p-3 rounded-xxl">
                                <h4 class="fw-700 font-lg ls-3 lh-1 text-white mb-0"><span
                                        class="ls-1 d-block font-xsss text-white fw-600">FEB</span>22</h4>
                            </div>
                            <h4 class="fw-700 text-grey-900 font-xssss mt-2">Meeting with clients <span
                                    class="d-block font-xsssss fw-500 mt-1 lh-4 text-grey-500">41 madison ave, floor 24
                                    new work, NY 10010</span> </h4>
                        </div>

                        <div class="card-body d-flex pt-0 ps-4 pe-4 pb-3 overflow-hidden">
                            <div class="bg-warning me-2 p-3 rounded-xxl">
                                <h4 class="fw-700 font-lg ls-3 lh-1 text-white mb-0"><span
                                        class="ls-1 d-block font-xsss text-white fw-600">APR</span>30</h4>
                            </div>
                            <h4 class="fw-700 text-grey-900 font-xssss mt-2">Developer Programe <span
                                    class="d-block font-xsssss fw-500 mt-1 lh-4 text-grey-500">41 madison ave, floor 24
                                    new work, NY 10010</span> </h4>
                        </div>

                        <div class="card-body d-flex pt-0 ps-4 pe-4 pb-3 overflow-hidden">
                            <div class="bg-primary me-2 p-3 rounded-xxl">
                                <h4 class="fw-700 font-lg ls-3 lh-1 text-white mb-0"><span
                                        class="ls-1 d-block font-xsss text-white fw-600">APR</span>23</h4>
                            </div>
                            <h4 class="fw-700 text-grey-900 font-xssss mt-2">Aniversary Event <span
                                    class="d-block font-xsssss fw-500 mt-1 lh-4 text-grey-500">41 madison ave, floor 24
                                    new work, NY 10010</span> </h4>
                        </div>

                    </div>
                </div>
                <div class="col-xl-8 col-xxl-9 col-lg-8">


                    @if ($page->user_id == auth()->id())
                        @livewire('components.create-post', ['pageid' => $page->id])
                    @endif

                    {{-- post --}}
                    @forelse ($posts as $post)
                        <div class="card w-100 shadow-xss rounded-xxl border-0 p-4 mb-3">
                            <div class="card-body p-0 d-flex">
                                <figure class="avatar me-3"><img
                                        style="width:45px;height:45px;border-radius:50%;object-fit:contain"
                                        src="{{ asset('storage/' . $page->icon) }}" alt="image"
                                        class="shadow-sm rounded-circle w45"></figure>
                                <h4 class="fw-700 text-grey-900 font-xssss mt-1">{{ $page->name }} <span
                                        class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">{{ $post->created_at->diffForHumans() }}</span>
                                </h4>
                                <a href="#" class="ms-auto" id="dropdownMenu2" data-bs-toggle="dropdown"
                                    aria-expanded="false"><i
                                        class="fa-solid fa-ellipsis-vertical text-grey-900 btn-round-md bg-greylight font-xss"></i></a>
                                <div class="dropdown-menu dropdown-menu-end p-4 rounded-xxl border-0 shadow-lg"
                                    aria-labelledby="dropdownMenu2">
                                    {{-- save post --}}

                                    @if (App\models\SavePost::where(['user_id' => auth()->id(), 'post_id' => $post->id])->exists())
                                        <button wire:click = "unsavePost({{ $post->id }})"
                                            class="card-body p-0 d-flex">
                                            <i class="fa-solid fa-bookmark text-info me-3 font-lg"></i>
                                            <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4 text-left">Unsave Post
                                                <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Remove
                                                    this
                                                    to your saved post</span>
                                            </h4>
                                        </button>
                                    @else
                                        <button wire:click = "savePost({{ $post->id }})"
                                            class="card-body p-0 d-flex">
                                            <i class="fa-solid fa-bookmark text-grey-500 me-3 font-lg"></i>
                                            <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4 text-left">Save Post
                                                <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Add
                                                    this
                                                    to your saved post</span>
                                            </h4>
                                        </button>
                                    @endif
                                    <div class="card-body p-0 d-flex mt-2">
                                        <i class="fa-regular fa-bell text-grey-500 me-3 font-lg"></i>
                                        <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4">Hide Post <span
                                                class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Save to
                                                your saved items</span></h4>
                                    </div>
                                    <div class="card-body p-0 d-flex mt-2">
                                        <i class="fa-solid fa-exclamation text-grey-500 me-3 font-lg"></i>
                                        <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4">Hide all from Group
                                            <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Save
                                                to your saved items</span>
                                        </h4>
                                    </div>
                                    <div class="card-body p-0 d-flex mt-2">
                                        <i class="fa-solid fa-lock text-grey-500 me-3 font-lg"></i>
                                        <h4 class="fw-600 mb-0 text-grey-900 font-xssss mt-0 me-4">Unfollow Group
                                            <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Save
                                                to your saved items</span>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0 me-lg-5">
                                <a class="fw-500 text-grey-500"
                                    href="{{ route('single-post', ['useruuid' => $post->user->uuid, 'postuuid' => $post->uuid]) }}">
                                    <p class="fw-500 text-grey-500 lh-26 font-xssss w-100">{{ $post->content }}
                                        {{-- <a href="#" class="fw-600 text-primary ms-2">See more</a> --}}
                                    </p>
                                </a>
                            </div>
                            <div class="card-body d-block p-0">
                                <div class="row ps-2 pe-2">
                                    @php
                                        $post_media = App\Models\PostMedia::where('post_id', $post->id)->get();

                                    @endphp
                                    @foreach ($post_media as $media)
                                        @if ($media->file_type == 'video')
                                            <div class="card-body p-0 mb-3 rounded-3 overflow-hidden">
                                                <div class="video-btn">
                                                    <video controls loop class="float-right w-100">
                                                        <source src="{{ Storage::url($media->file) }}"
                                                            type="video/mp4">
                                                    </video>
                                                </div>
                                            </div>
                                        @else
                                            @php
                                                $listimg = json_decode($media->file);
                                            @endphp
                                            @foreach ($listimg as $key => $img)
                                                @if ($loop->index < 3)
                                                    <div
                                                        class="
                                        <?php
                                        if (count($listimg) == 1) {
                                            echo 'col-xs-12 col-sm-12';
                                        } elseif (count($listimg) == 2) {
                                            echo 'col-xs-6 col-sm-6';
                                        } else {
                                            echo 'col-xs-4 col-sm-4';
                                        }
                                        ?>
                                         p-1">
                                                        <a href="{{ asset('storage/' . $img) }}"
                                                            data-lightbox="roadtrip"
                                                            class="{{ $loop->index == 2 ? 'position-relative d-block' : '' }}">
                                                            <img src="{{ asset('storage/' . $img) }}"
                                                                class="rounded-3 w-100" alt="image"
                                                                style="height:294px;object-fit:cover">
                                                            @if ($loop->index == 2)
                                                                <span
                                                                    class="img-count font-sm text-white ls-3 fw-600"><b>+{{ count($listimg) - 3 }}</b></span>
                                                            @endif
                                                        </a>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                    {{-- <div class="col-xs-4 col-sm-4 p-1"><a href="images/t-10.jpg"
                                        data-lightbox="roadtrip"><img src="images/t-10.jpg"
                                            class="rounded-3 w-100" alt="image"></a></div>
                                <div class="col-xs-4 col-sm-4 p-1"><a href="images/t-11.jpg"
                                        data-lightbox="roadtrip"><img src="images/t-11.jpg"
                                            class="rounded-3 w-100" alt="image"></a></div>
                                <div class="col-xs-4 col-sm-4 p-1"><a href="images/t-12.jpg"
                                        data-lightbox="roadtrip" class="position-relative d-block"><img
                                            src="images/t-12.jpg" class="rounded-3 w-100" alt="image"><span
                                            class="img-count font-sm text-white ls-3 fw-600"><b>+2</b></span></a>
                                </div> --}}
                                </div>
                            </div>
                            <div class="card-body d-flex p-0 mt-3">
                                <?php
                                $like = App\Models\Like::where(['post_id' => $post->id, 'user_id' => auth()->id()])->first();
                                ?>
                                @if ($like)
                                    <a href="#" wire:click.prevent="dislike({{ $post->id }})"
                                        class="emoji-bttn d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss me-2">
                                        <i
                                            class="fa-solid fa-thumbs-up text-white bg-primary-gradiant me-1 btn-round-xs font-xss"></i>

                                        {{ $post->likes ?? 0 }}
                                        Like</a>
                                @else
                                    <a href="#" wire:click.prevent="like({{ $post->id }})"
                                        class="emoji-bttn d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss me-2">
                                        <i class="fa-solid fa-thumbs-up me-1 btn-round-xs font-xss"></i>
                                        {{-- <i
                                    class="fa-solid fa-heart text-white bg-red-gradiant me-2 btn-round-xs font-xss"></i> --}}
                                        {{ $post->likes ?? 0 }}
                                        Like</a>
                                @endif
                                {{-- <div class="emoji-wrap">
                                <ul class="emojis list-inline mb-0">
                                    <li class="emoji list-inline-item"><i class="em em---1"></i> </li>
                                    <li class="emoji list-inline-item"><i class="em em-angry"></i></li>
                                    <li class="emoji list-inline-item"><i class="em em-anguished"></i> </li>
                                    <li class="emoji list-inline-item"><i class="em em-astonished"></i> </li>
                                    <li class="emoji list-inline-item"><i class="em em-blush"></i></li>
                                    <li class="emoji list-inline-item"><i class="em em-clap"></i></li>
                                    <li class="emoji list-inline-item"><i class="em em-cry"></i></li>
                                    <li class="emoji list-inline-item"><i class="em em-full_moon_with_face"></i>
                                    </li>
                                </ul>
                            </div> --}}
                                <a href="#"
                                    class="d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss"><i
                                        class="fa-regular fa-comment text-dark text-grey-900 btn-round-sm font-lg"></i><span
                                        class="d-none-xss">{{ $post->comments ?? 0 }} Comment</span></a>
                                <a href="#" id="dropdownMenu21" data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                    class="ms-auto d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss"><i
                                        class="fa-solid fa-share-nodes text-grey-900 text-dark btn-round-sm font-lg"></i><span
                                        class="d-none-xs">Share</span></a>
                                <div class="dropdown-menu dropdown-menu-end p-4 rounded-xxl border-0 shadow-lg"
                                    aria-labelledby="dropdownMenu21">
                                    <h4 class="fw-700 font-xss text-grey-900 d-flex align-items-center">Share <i
                                            class="fa-solid fa-share-nodes ms-auto font-xssss btn-round-xs bg-greylight text-grey-900 me-2"></i>
                                    </h4>
                                    <div class="card-body p-0 d-flex">
                                        <ul class="d-flex align-items-center justify-content-between mt-2">
                                            <li class="me-1"><a href="#" class="btn-round-lg bg-facebook"><i
                                                        class="font-xs ti-facebook text-white"></i></a></li>
                                            <li class="me-1"><a href="#" class="btn-round-lg bg-twiiter"><i
                                                        class="font-xs ti-twitter-alt text-white"></i></a></li>
                                            <li class="me-1"><a href="#" class="btn-round-lg bg-linkedin"><i
                                                        class="font-xs ti-linkedin text-white"></i></a></li>
                                            <li class="me-1"><a href="#" class="btn-round-lg bg-instagram"><i
                                                        class="font-xs ti-instagram text-white"></i></a></li>
                                            <li><a href="#" class="btn-round-lg bg-pinterest"><i
                                                        class="font-xs ti-pinterest text-white"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="card-body p-0 d-flex">
                                        <ul class="d-flex align-items-center justify-content-between mt-2">
                                            <li class="me-1"><a href="#" class="btn-round-lg bg-tumblr"><i
                                                        class="font-xs ti-tumblr text-white"></i></a></li>
                                            <li class="me-1"><a href="#" class="btn-round-lg bg-youtube"><i
                                                        class="font-xs ti-youtube text-white"></i></a></li>
                                            <li class="me-1"><a href="#" class="btn-round-lg bg-flicker"><i
                                                        class="font-xs ti-flickr text-white"></i></a></li>
                                            <li class="me-1"><a href="#" class="btn-round-lg bg-black"><i
                                                        class="font-xs ti-vimeo-alt text-white"></i></a></li>
                                            <li><a href="#" class="btn-round-lg bg-whatsup"><i
                                                        class="font-xs feather-phone text-white"></i></a></li>
                                        </ul>
                                    </div>
                                    <h4 class="fw-700 font-xssss mt-4 text-grey-500 d-flex align-items-center mb-3">
                                        Copy Link</h4>
                                    <i class="feather-copy position-absolute right-35 mt-3 font-xs text-grey-500"></i>
                                    <input type="text"
                                        value="{{ route('single-post', ['useruuid' => $post->user->uuid, 'postuuid' => $post->uuid]) }}"
                                        class="bg-grey text-grey-500 font-xssss border-0 lh-32 p-2 font-xssss fw-600 rounded-3 w-100 theme-dark-bg">
                                </div>
                            </div>
                            @error('comment')
                                <span class="error text-danger">{{ $comment }}</span>
                            @enderror
                            <form id="form-cmt" action="" method="post" class="my-2 position-relative "
                                wire:submit.prevent="saveComment({{ $post->id }})">
                                <input type="text" placeholder="Write your comment..." wire:model.lazy="comment"
                                    name="comment" class="form-control ">
                                <button type="submit"
                                    class="outline-none ms-auto border-none bg-none position-absolute"
                                    style="right: 1px;
                            top: 50%;
                            transform: translateY(-50%);">
                                    <i
                                        class="btn-round-sm font-xs text-primary bg-greylight mx-2 fa-solid fa-paper-plane"></i>
                                </button>
                            </form>
                            <script>
                                $("#form-cmt").submit(function(e) {
                                    e.preventDefault()
                                    $("#form-cmt input").val("")
                                })
                            </script>
                        </div>
                    @empty
                        <h1 class="text-center text-danger">No post found!</h1>
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
