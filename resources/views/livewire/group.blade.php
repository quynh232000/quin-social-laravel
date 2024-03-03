<div class="main-content right-chat-active">

    <div class="middle-sidebar-bottom">
        <div class="middle-sidebar-left">
            <div class="row">
                <div class="col-xl-4 col-xxl-3 col-lg-4 pe-0">
                    <div class="card w-100 shadow-xss rounded-xxl overflow-hidden border-0 mb-3 mt-3 pb-3">
                        <div class="card-body position-relative h150 bg-image-cover bg-image-center"
                            style="background-image: url({{ asset('storage/' . $group->thumbnail) }});"></div>
                        <div class="card-body d-block pt-4 text-center">
                            <figure class="avatar mt--6 position-relative w75 z-index-1 w100 z-index-1 ms-auto me-auto">
                                <img src="{{ asset('storage/' . $group->icon) }}" width="100px" height="100px"
                                    alt="image" style="border-radius:50%;object-fit:cover;width:100px;height:100px "
                                    class="p-1 bg-white  w-100">
                            </figure>
                            <h4 class="font-xs ls-1 fw-700 text-grey-900">{{ $group->name }}
                                <span class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">{{ $group->location }}
                                </span>
                            </h4>
                        </div>
                        <div class="card-body d-flex align-items-center justify-center ps-4 pe-4 pt-0">
                            <h4 class="font-xsssss text-center text-grey-500 fw-600 ms-2 me-2"><b
                                    class="text-grey-900 mb-1 font-xss fw-700 d-inline-block ls-3 text-dark">
                                    {{ App\Models\Post::where('group_id', $group->id)->count() }} </b> Posts</h4>
                            <h4 class="font-xsssss text-center text-grey-500 fw-600 ms-2 me-2"><b
                                    class="text-grey-900 mb-1 font-xss fw-700 d-inline-block ls-3 text-dark">{{ $group->members }}
                                </b> Members</h4>
                        </div>
                        <div class="card-body d-flex align-items-center justify-content-center ps-4 pe-4 pt-0">
                            {{-- <a href="#"
                                class="bg-success p-3 z-index-1 rounded-3 text-white font-xsssss text-uppercase fw-700 ls-3">Add
                                Friend</a> --}}

                            @if (App\models\GroupMember::where(['user_id' => auth()->id(), 'group_id' => $group->id])->exists())
                                <button wire:click='leave({{ $group->id }})'
                                    class="bg-danger flex-1 p-3 z-index-1 rounded-3 text-white font-xsssss text-uppercase fw-700 ls-3">
                                    LEAVE
                                </button>
                            @else
                                <button wire:click='join({{ $group->id }})'
                                    class="bg-success p-3 flex-1 z-index-1 rounded-3 text-white font-xsssss text-uppercase fw-700 ls-3">
                                    JOIN
                                </button>
                            @endif


                            <a href="#" class="bg-greylight btn-round-lg ms-2 rounded-3 text-grey-700"><i
                                    class="fa-regular fa-message font-md"></i></a>
                        </div>
                    </div>
                    <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3">
                        <div class="card-body d-block p-4">
                            <h4 class="fw-700 mb-3 font-xsss text-grey-900">About</h4>
                            <p class="fw-500 text-grey-500 lh-24 font-xssss mb-0">{{ $group->description ?? '...' }}</p>
                        </div>
                        {{-- <div class="card-body border-top-xs d-flex">
                            <i class="feather-lock text-grey-500 me-3 font-lg"></i>
                            <h4 class="fw-700 text-grey-900 font-xssss mt-0">Private <span
                                    class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">What's up, how are
                                    you?</span></h4>
                        </div>

                        <div class="card-body d-flex pt-0">
                            <i class="feather-eye text-grey-500 me-3 font-lg"></i>
                            <h4 class="fw-700 text-grey-900 font-xssss mt-0">Visble <span
                                    class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">Anyone can find you</span>
                            </h4>
                        </div>
                        <div class="card-body d-flex pt-0">
                            <i class="feather-map-pin text-grey-500 me-3 font-lg"></i>
                            <h4 class="fw-700 text-grey-900 font-xssss mt-1">Flodia, Austia </h4>
                        </div>
                        <div class="card-body d-flex pt-0">
                            <i class="feather-users text-grey-500 me-3 font-lg"></i>
                            <h4 class="fw-700 text-grey-900 font-xssss mt-1">Genarel Group</h4>
                        </div> --}}
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
                                More</a>
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

                    @if (App\Models\GroupMember::where(['user_id' => auth()->id(), 'group_id' => $group->id])->exists())
                        @livewire('components.create-post', ['groupid' => $group->id])
                    @endif

                    {{-- <div class="card w-100 shadow-xss rounded-xxl border-0 ps-4 pt-4 pe-4 pb-3 mb-3 mt-3">
                        <div class="card-body p-0">
                            <a href="#"
                                class=" font-xssss fw-600 text-grey-500 card-body p-0 d-flex align-items-center"><i
                                    class="btn-round-sm font-xs text-primary feather-edit-3 me-2 bg-greylight"></i>Create
                                Post</a>
                        </div>
                        <div class="card-body p-0 mt-3 position-relative">
                            <figure class="avatar position-absolute ms-2 mt-1 top-5"><img src="images/user-8.png"
                                    alt="image" class="shadow-sm rounded-circle w30"></figure>
                            <textarea name="message"
                                class="h100 bor-0 w-100 rounded-xxl p-2 ps-5 font-xssss text-grey-500 fw-500 border-light-md theme-dark-bg"
                                cols="30" rows="10" placeholder="What's on your mind?"></textarea>
                        </div>
                        <div class="card-body d-flex p-0 mt-0">
                            <a href="#"
                                class="d-flex align-items-center font-xssss fw-600 ls-1 text-grey-700 text-dark pe-4"><i
                                    class="font-md text-danger feather-video me-2"></i><span class="d-none-xs">Live
                                    Video</span></a>
                            <a href="#"
                                class="d-flex align-items-center font-xssss fw-600 ls-1 text-grey-700 text-dark pe-4"><i
                                    class="font-md text-success feather-image me-2"></i><span
                                    class="d-none-xs">Photo/Video</span></a>
                            <a href="#"
                                class="d-flex align-items-center font-xssss fw-600 ls-1 text-grey-700 text-dark pe-4"><i
                                    class="font-md text-warning feather-camera me-2"></i><span
                                    class="d-none-xs">Feeling/Activity</span></a>
                            <a href="#" class="ms-auto" id="dropdownMenu4" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"><i
                                    class="ti-more-alt text-grey-900 btn-round-md bg-greylight font-xss"></i></a>
                            <div class="dropdown-menu dropdown-menu-end p-4 rounded-xxl border-0 shadow-lg"
                                aria-labelledby="dropdownMenu4">
                                <div class="card-body p-0 d-flex">
                                    <i class="feather-bookmark text-grey-500 me-3 font-lg"></i>
                                    <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4">Save Link <span
                                            class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Add this to your
                                            saved items</span></h4>
                                </div>
                                <div class="card-body p-0 d-flex mt-2">
                                    <i class="feather-alert-circle text-grey-500 me-3 font-lg"></i>
                                    <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4">Hide Post <span
                                            class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Save to your
                                            saved items</span></h4>
                                </div>
                                <div class="card-body p-0 d-flex mt-2">
                                    <i class="feather-alert-octagon text-grey-500 me-3 font-lg"></i>
                                    <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4">Hide all from Group <span
                                            class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Save to your
                                            saved items</span></h4>
                                </div>
                                <div class="card-body p-0 d-flex mt-2">
                                    <i class="feather-lock text-grey-500 me-3 font-lg"></i>
                                    <h4 class="fw-600 mb-0 text-grey-900 font-xssss mt-0 me-4">Unfollow Group <span
                                            class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Save to your
                                            saved items</span></h4>
                                </div>
                            </div>
                        </div>
                    </div> --}}


                    {{-- list post --}}
                    {{-- post --}}
                    @forelse ($posts as $post)
                        <div class="card w-100 shadow-xss rounded-xxl border-0 p-4 mb-3">
                            <div class="card-body p-0 d-flex">
                                <a href="{{ route('user', $post->user->uuid) }}" class="avatar me-3"><img
                                        style="width:45px;height:45px;border-radius:50%;object-fit:cover"
                                        src="{{ asset('storage/' . $post->user->profile) }}" alt="image"
                                        class="shadow-sm rounded-circle w45"></a>
                                <a href="{{ route('user', $post->user->uuid) }}"
                                    class="fw-700 text-grey-900 font-xssss mt-1">{{ $post->user->username }} <span
                                        class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">{{ $post->created_at->diffForHumans() }}</span>
                                </a>
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
                                <a class="text-grey-500"
                                    href="{{ route('single-post', ['useruuid' => $post->user->uuid, 'postuuid' => $post->uuid]) }}">
                                    <p class="fw-500 text-grey-500 lh-26 font-xssss w-100">{{ $post->content }}
                                    </p>
                                    {{-- <a href="#" class="fw-600 text-primary ms-2">See more</a> --}}
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

                </div>
            </div>
        </div>

    </div>
</div>
