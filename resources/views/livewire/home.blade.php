<div class="main-content right-chat-active">

    <div class="middle-sidebar-bottom">
        <div class="middle-sidebar-left">
            <!-- loader wrapper -->
            <div class="preloader-wrap p-3">
                <div class="box shimmer">
                    <div class="lines">
                        <div class="line s_shimmer"></div>
                        <div class="line s_shimmer"></div>
                        <div class="line s_shimmer"></div>
                        <div class="line s_shimmer"></div>
                    </div>
                </div>
                <div class="box shimmer mb-3">
                    <div class="lines">
                        <div class="line s_shimmer"></div>
                        <div class="line s_shimmer"></div>
                        <div class="line s_shimmer"></div>
                        <div class="line s_shimmer"></div>
                    </div>
                </div>
                <div class="box shimmer">
                    <div class="lines">
                        <div class="line s_shimmer"></div>
                        <div class="line s_shimmer"></div>
                        <div class="line s_shimmer"></div>
                        <div class="line s_shimmer"></div>
                    </div>
                </div>
            </div>
            <!-- loader wrapper -->
            <div class="row feed-body">
                <div class="col-xl-8 col-xxl-9 col-lg-8">

                    @livewire('components.stories')
                    @livewire('components.create-post')

                    {{-- post --}}
                    @forelse ($posts as $post)
                        <div class="card w-100 shadow-xss rounded-xxl border-0 p-4 mb-3">
                            <div class="card-body p-0 d-flex">
                                @if ($post->is_group_post == 1)
                                    <a href="{{ route('group', $post->group->uuid) }}" class="avatar me-3"><img
                                            style="width:45px;height:45px;border-radius:50%;object-fit:cover"
                                            src="{{ asset('storage/' . $post->group->icon) }}" alt="image"
                                            class="shadow-sm rounded-circle w45"></a>
                                    <a href="{{ route('group', $post->group->uuid) }}"
                                        class="fw-700 text-grey-900 font-xssss mt-1">{{ $post->group->name }}

                                        <span
                                            class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">{{ $post->created_at->diffForHumans() }}</span>
                                    </a>
                                    <a href="#" class="ms-auto" id="dropdownMenu2" data-bs-toggle="dropdown"
                                        aria-expanded="false"><i
                                            class="fa-solid fa-ellipsis-vertical text-grey-900 btn-round-md bg-greylight font-xss"></i>
                                    </a>
                                @elseif($post->is_page_post == 1)
                                    <a href="{{ route('page', $post->page->uuid) }}" class="avatar me-3"><img
                                            style="width:45px;height:45px;border-radius:50%;object-fit:cover"
                                            src="{{ asset('storage/' . $post->page->icon) }}" alt="image"
                                            class="shadow-sm rounded-circle w45"></a>
                                    <a href="{{ route('page', $post->page->uuid) }}"
                                        class="fw-700 text-grey-900 font-xssss mt-1">{{ $post->page->name }}
                                        <span
                                            class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">{{ $post->created_at->diffForHumans() }}</span>
                                    </a>
                                    <a href="#" class="ms-auto" id="dropdownMenu2" data-bs-toggle="dropdown"
                                        aria-expanded="false"><i
                                            class="fa-solid fa-ellipsis-vertical text-grey-900 btn-round-md bg-greylight font-xss"></i>
                                    </a>
                                @else
                                    <a href="{{ route('user', $post->user->uuid) }}" class="avatar me-3"><img
                                            style="width:45px;height:45px;border-radius:50%;object-fit:cover"
                                            src="{{ asset('storage/' . $post->user->profile) }}" alt="image"
                                            class="shadow-sm rounded-circle w45"></a>
                                    <a href="{{ route('user', $post->user->uuid) }}"
                                        class="fw-700 text-grey-900 font-xssss mt-1">{{ $post->user->first_name . ' ' . $post->user->last_name }}
                                        <span
                                            class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">{{ $post->created_at->diffForHumans() }}</span>
                                    </a>
                                    <a href="#" class="ms-auto" id="dropdownMenu2" data-bs-toggle="dropdown"
                                        aria-expanded="false"><i
                                            class="fa-solid fa-ellipsis-vertical text-grey-900 btn-round-md bg-greylight font-xss"></i>
                                    </a>
                                @endif
                                <div class="dropdown-menu dropdown-menu-end p-4 rounded-xxl border-0 shadow-lg"
                                    style="width: 280px" aria-labelledby="dropdownMenu2">
                                    {{-- save post --}}

                                    @if (App\models\SavePost::where(['user_id' => auth()->id(), 'post_id' => $post->id])->exists())
                                        <button wire:click = "unsavePost({{ $post->id }})"
                                            class="card-body p-0 d-flex">
                                            <i class="fa-solid fa-bookmark text-info me-3 font-me"></i>
                                            <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4 text-left">Unsave Post
                                                <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Remove
                                                    this
                                                    to your saved post</span>
                                            </h4>
                                        </button>
                                    @else
                                        <button wire:click = "savePost({{ $post->id }})"
                                            class="card-body p-0 d-flex">
                                            <i class="fa-solid fa-bookmark text-grey-500 me-3 font-me"></i>
                                            <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4 text-left">Save Post
                                                <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Add
                                                    this
                                                    to your saved post</span>
                                            </h4>
                                        </button>
                                    @endif
                                    <div class="card-body p-0 d-flex mt-2">
                                        <i class="fa-regular fa-bell text-grey-500 me-3 font-me"
                                            style="min-with:26px !importain"></i>
                                        <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4">Hide Post <span
                                                class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Save to
                                                your saved items</span></h4>
                                    </div>


                                    @if ($post->is_group_post == 1)
                                        <button wire:click="hide_all_from('group',{{ $post->group->id }})"
                                            class="card-body p-0 d-flex mt-2 text-left">
                                            <i class="fa-solid fa-exclamation text-grey-500 me-3 font-me"
                                                style="min-with:26px !importain"></i>
                                            <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4">Hide all from
                                                {{ $post->group->name }}
                                                <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Save
                                                    to your saved items</span>
                                            </h4>
                                        </button>
                                        <div class="card-body p-0 d-flex mt-2">
                                            <i class="fa-solid fa-lock text-grey-500 me-3 font-me"
                                                style="min-with:26px !importain"></i>
                                            <h4 class="fw-600 mb-0 text-grey-900 font-xssss mt-0 me-4">Unfollow
                                                {{ $post->group->name }}
                                                <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Save
                                                    to your saved items</span>
                                            </h4>
                                        </div>
                                    @elseif($post->is_page_post == 1)
                                        <button wire:click="hide_all_from('page',{{ $post->page->id }})"
                                            class="card-body p-0 d-flex mt-2 text-left">
                                            <i class="fa-solid fa-exclamation text-grey-500 me-3 font-me"
                                                style="min-with:26px !importain"></i>
                                            <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4">Hide all from
                                                {{ $post->page->name }}
                                                <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Save
                                                    to your saved items</span>
                                            </h4>
                                        </button>
                                        <div class="card-body p-0 d-flex mt-2">
                                            <i class="fa-solid fa-lock text-grey-500 me-3 font-me"
                                                style="min-with:26px !importain"></i>
                                            <h4 class="fw-600 mb-0 text-grey-900 font-xssss mt-0 me-4">Unfollow
                                                {{ $post->page->name }}
                                                <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Save
                                                    to your saved items</span>
                                            </h4>
                                        </div>
                                    @else
                                        <button wire:click="hide_all_from('user',{{ $post->user->id }})"
                                            class="card-body p-0 d-flex mt-2 text-left">
                                            <i class="fa-solid fa-exclamation text-grey-500 me-3 font-me"
                                                style="min-with:26px !importain"></i>
                                            <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4">Hide all from
                                                {{ $post->user->first_name . ' ' . $post->user->last_name }}
                                                <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Save
                                                    to your saved items</span>
                                            </h4>
                                        </button>
                                        <div class="card-body p-0 d-flex mt-2">
                                            <i class="fa-solid fa-lock text-grey-500 me-3 font-me"
                                                style="min-with:26px !importain"></i>
                                            <h4 class="fw-600 mb-0 text-grey-900 font-xssss mt-0 me-4">Unfollow
                                                {{ $post->user->first_name . ' ' . $post->user->last_name }}
                                                <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Save
                                                    to your saved items</span>
                                            </h4>
                                        </div>
                                    @endif


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
                <div class="col-xl-4 col-xxl-3 col-lg-4 ps-lg-0">
                    @if (count($friend_requests) > 0)
                        <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3">
                            <div class="card-body d-flex align-items-center p-4">
                                <h4 class="fw-700 mb-0 font-xssss text-grey-900">Friend Request</h4>
                                <a href="{{ route('explore') }}" class="fw-600 ms-auto font-xssss text-primary">See
                                    all</a>
                            </div>

                            @forelse ($friend_requests as $friend)
                                <div class="card-body d-flex pt-4 ps-4 pe-4 pb-0 border-top-xs bor-0">
                                    <figure class="avatar me-3"><img src="{{ asset('storage/' . $friend->profile) }}"
                                            style="wi45px;height:45px;border-radius:50%;object-fit:cover"
                                            alt="image" class="shadow-sm rounded-circle w45"></figure>
                                    <h4 class="fw-700 text-grey-900 font-xssss mt-1">
                                        {{ $friend->first_name . ' ' . $friend->last_name }} <span
                                            class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">{{ 0 }}
                                            mutual
                                            friends</span></h4>
                                </div>
                                <div
                                    class="card-body d-flex align-items-center justify-content-center pt-0 ps-4 pe-4 pb-4">
                                    <button wire:click='acceptfriend({{ $friend->user_id }})'
                                        class="p-2 lh-20 w100 bg-primary-gradiant me-2 text-white text-center font-xssss fw-600 ls-1 rounded-xl">Confirm</button>
                                    <button wire:click="rejectfriend({{ $friend->user_id }})"
                                        class="p-2 lh-20 w100 bg-grey text-grey-800 text-center font-xssss fw-600 ls-1 rounded-xl">Delete</button>
                                </div>
                            @empty
                                <div class="text-center text-danger">No friend request!</div>
                            @endforelse



                        </div>

                    @endif

                    <div class="card w-100 shadow-xss rounded-xxl border-0 p-0 ">
                        <div class="card w-100 shadow-xss rounded-xxl border-0 p-0">
                            <div class="card-body d-flex align-items-center p-4 mb-0">
                                <h4 class="fw-700 mb-0 font-xssss text-grey-900">
                                    Suggest Friends
                                </h4>
                                <a href="{{ route('explore') }}" class="fw-600 ms-auto font-xssss text-primary">See
                                    all</a>
                            </div>

                            @forelse ($suggested_users as $item)
                                <div class="card-body bg-transparent-card d-flex p-3 bg-greylight ms-3 me-3 rounded-3">
                                    <a href="{{ route('user', $item->uuid) }}" class="avatar me-2 mb-0">
                                        <img src="{{ asset('storage/' . $item->profile) }}" alt="image"
                                            class="shadow-sm rounded-circle w45 img-border-45">
                                    </a>
                                    <a href="{{ route('user', $item->uuid) }}"
                                        class="fw-700 text-grey-900 font-xssss mt-2">
                                        {{ $item->first_name . ' ' . $item->last_name }}
                                        <span
                                            class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">{{ $item->mutual_friends() ?? 0 }}
                                            mutual
                                            friends</span>
                                    </a>
                                    <button wire:click="addfriend('{{ $item->uuid }}')" class="ms-auto mt-2">
                                        <i
                                            class="btn-round-sm bg-white text-grey-900 fa-solid fa-user-plus font-xss ms-auto mt-2"></i>
                                    </button>
                                </div>
                            @empty
                                <div class="text-center text-danger">No user suggestion fund!</div>
                            @endforelse


                            {{-- <div class="card-body bg-transparent-card d-flex p-3 bg-greylight m-3 rounded-3"
                                style="margin-bottom: 0 !important">
                                <figure class="avatar me-2 mb-0">
                                    <img src="images/user-8.png" alt="image" class="shadow-sm rounded-circle w45">
                                </figure>
                                <h4 class="fw-700 text-grey-900 font-xssss mt-2">
                                    David Agfree
                                    <span class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">12 mutual
                                        friends</span>
                                </h4>
                                <i
                                    class="btn-round-sm bg-white text-grey-900 fa-solid fa-user-minus font-xss ms-auto mt-2"></i>
                            </div> --}}

                        </div>

                    </div>

                    <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3 mt-3">
                        <div class="card-body d-flex align-items-center p-4">
                            <h4 class="fw-700 mb-0 font-xssss text-grey-900">Suggest Groups</h4>
                            <a href="{{ route('groups') }}" class="fw-600 ms-auto font-xssss text-primary">See
                                all</a>
                        </div>

                        @forelse ($suggested_groups as $group)
                            <a href="{{ route('group', $group->uuid) }}"
                                class="card-body d-flex pt-4 ps-4 pe-4 pb-0 overflow-hidden border-top-xs bor-0">
                                <img src="{{ asset('storage/' . $group->thumbnail) }}" alt="img"
                                    class="img-fluid rounded-xxl mb-2">
                            </a>
                            <a href="{{ route('group', $group->uuid) }}" class="px-4 fw-600 text-grey-700 font-xsss">
                                {{ $group->name }}
                            </a>
                            <div class="card-body dd-block pt-0 ps-4 pe-4 pb-4">
                                <ul class="memberlist mt-1 mb-2 ms-0 d-block">
                                    @php
                                        $countGroups =
                                            App\Models\GroupMember::where('group_id', $group->id)->count() ?? 0;
                                    @endphp
                                    @if ($countGroups > 3)
                                        @foreach (App\Models\GroupMember::with('user')->where('group_id', $group->id)->limit(3)->get() as $item)
                                            <li class="img-border-35"><a class="img-border-35"
                                                    href="{{ route('user', $item->user->uuid) }}"><img
                                                        src="{{ asset('storage/' . $item->user->profile) }}"
                                                        alt="user" class="w35 d-inline-block img-border-35"
                                                        style="opacity: 1;"></a></li>
                                        @endforeach
                                        <li class="last-member"><a href="{{ route('group', $group->uuid) }}"
                                                class="bg-greylight fw-600 text-grey-500 font-xssss w35 ls-3 text-center"
                                                style="height: 35px; line-height: 35px;">+
                                                {{ $countGroups - 3 }}
                                            </a></li>
                                    @elseif($countGroups == 0)
                                        <li class="last-member"><a href="#"
                                                class="bg-greylight fw-600 text-grey-500 font-xssss w35 ls-3 text-center"
                                                style="height: 35px; line-height: 35px;">
                                                0
                                            </a></li>
                                    @else
                                        @foreach (App\Models\GroupMember::with('user')->where('group_id', $group->id)->get() as $item)
                                            <li class=" img-border-35"><a
                                                    href="{{ route('user', $item->user->uuid) }}"
                                                    class="img-border-35"><img
                                                        src="{{ asset('storage/' . $item->user->profile) }}"
                                                        alt="user" class=" d-inline-block img-border-35"
                                                        style="opacity: 1;"></a></li>
                                        @endforeach
                                    @endif

                                    <li class="ps-3 w-auto ms-1"><a href="#"
                                            class="fw-400 text-grey-500 font-xssss">Members</a></li>
                                </ul>
                                @if (App\models\GroupMember::where(['user_id' => auth()->id(), 'group_id' => $group->id])->exists())
                                    <button wire:click='leave({{ $group->id }})'
                                        class="p-2 lh-28 w-100 bg-grey text-grey-800 text-center font-xssss fw-700 rounded-xl bg-danger  text-white ">
                                        <i class="fa-solid fa-arrow-up-from-bracket font-xss me-2"></i>

                                        LEAVE</button>
                                @else
                                    <button wire:click='join({{ $group->id }})'
                                        class="p-2 lh-28 w-100 bg-grey text-grey-800 text-center font-xssss fw-700 rounded-xl  text-white ">
                                        <i class="fa-solid fa-right-to-bracket font-xss me-2"></i>
                                        JOIN</button>
                                @endif
                            </div>
                        @empty
                            <div class="text-danger text-center">No page fund!</div>
                        @endforelse

                    </div>



                    <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3">
                        <div class="card-body d-flex align-items-center p-4">
                            <h4 wire:click="likepage(2)" class="fw-700 mb-0 font-xssss text-grey-900">Suggest Pages
                            </h4>
                            <a href="{{ route('pages') }}" class="fw-600 ms-auto font-xssss text-primary">See
                                all</a>
                        </div>
                        @forelse ($suggested_pages as $page)
                            <a href="{{ route('page', $page->uuid) }}"
                                class="card-body d-flex pt-4 ps-4 pe-4 pb-0 overflow-hidden border-top-xs bor-0">
                                <img src="{{ asset('storage/' . $page->thumbnail) }}" alt="img"
                                    class="img-fluid rounded-xxl mb-2">
                            </a>
                            <div class="card-body d-flex align-items-center pt-0 ps-4 pe-4 pb-4">

                                @if (App\models\PageLike::where(['user_id' => auth()->id(), 'page_id' => $page->id])->exists())
                                    <button wire:click='unlikepage(<?= $page->id ?>)'
                                        class="p-2 lh-28 w-100 bg-grey text-grey-800 text-center font-xssss fw-700 rounded-xl bg-danger  text-white">
                                        <i class="fa-solid fa-thumbs-down font-xss me-2"></i>

                                        UNLIKE</button>
                                @else
                                    <button wire:click='likepage(<?= $page->id ?>)'
                                        class="p-2 lh-28 w-100 bg-grey text-grey-800 text-center font-xssss fw-700 rounded-xl  text-white">
                                        <i class="fa-solid fa-thumbs-up font-xss me-2"></i>
                                        LIKE</button>
                                @endif



                            </div>
                        @empty
                            <div class="text-center text-danger">No page fund!</div>
                        @endforelse


                    </div>


                    <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3">
                        <div class="card-body d-flex align-items-center  p-4">
                            <h4 class="fw-700 mb-0 font-xssss text-grey-900">Event</h4>
                            <a href="default-event.html" class="fw-600 ms-auto font-xssss text-primary">See
                                all</a>
                        </div>
                        <div class="card-body d-flex pt-0 ps-4 pe-4 pb-3 overflow-hidden">
                            <div class="bg-success me-2 p-3 rounded-xxl">
                                <h4 class="fw-700 font-lg ls-3 lh-1 text-white mb-0"><span
                                        class="ls-1 d-block font-xsss text-white fw-600">FEB</span>22</h4>
                            </div>
                            <h4 class="fw-700 text-grey-900 font-xssss mt-2">Meeting with clients <span
                                    class="d-block font-xsssss fw-500 mt-1 lh-4 text-grey-500">41 madison ave,
                                    floor 24 new work, NY 10010</span> </h4>
                        </div>

                        <div class="card-body d-flex pt-0 ps-4 pe-4 pb-3 overflow-hidden">
                            <div class="bg-warning me-2 p-3 rounded-xxl">
                                <h4 class="fw-700 font-lg ls-3 lh-1 text-white mb-0"><span
                                        class="ls-1 d-block font-xsss text-white fw-600">APR</span>30</h4>
                            </div>
                            <h4 class="fw-700 text-grey-900 font-xssss mt-2">Developer Programe <span
                                    class="d-block font-xsssss fw-500 mt-1 lh-4 text-grey-500">41 madison ave,
                                    floor 24 new work, NY 10010</span> </h4>
                        </div>

                        <div class="card-body d-flex pt-0 ps-4 pe-4 pb-3 overflow-hidden">
                            <div class="bg-primary me-2 p-3 rounded-xxl">
                                <h4 class="fw-700 font-lg ls-3 lh-1 text-white mb-0"><span
                                        class="ls-1 d-block font-xsss text-white fw-600">APR</span>23</h4>
                            </div>
                            <h4 class="fw-700 text-grey-900 font-xssss mt-2">Aniversary Event <span
                                    class="d-block font-xsssss fw-500 mt-1 lh-4 text-grey-500">41 madison ave,
                                    floor 24 new work, NY 10010</span> </h4>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
