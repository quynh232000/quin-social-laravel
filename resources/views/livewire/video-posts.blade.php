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
                <div class="col-xl-12 col-xxl-9 col-lg-12">
                    {{-- post --}}
                    @forelse ($posts as $post)
                        <div class="card w-100 shadow-xss rounded-xxl border-0 p-4 mb-3">
                            <div class="card-body p-0 d-flex">
                                <figure class="avatar me-3"><img
                                        style="width:45px;height:45px;border-radius:50%;object-fit:cover"
                                        src="{{ asset('storage/' . $post->user->profile) }}" alt="image"
                                        class="shadow-sm rounded-circle w45"></figure>
                                <h4 class="fw-700 text-grey-900 font-xssss mt-1">{{ $post->user->username }} <span
                                        class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">{{ $post->created_at->diffForHumans() }}</span>
                                </h4>
                                <a href="#" class="ms-auto" id="dropdownMenu2" data-bs-toggle="dropdown"
                                    aria-expanded="false"><i
                                        class="fa-solid fa-ellipsis-vertical text-grey-900 btn-round-md bg-greylight font-xss"></i></a>
                                <div class="dropdown-menu dropdown-menu-end p-4 rounded-xxl border-0 shadow-lg"
                                    aria-labelledby="dropdownMenu2">
                                    <div class="card-body p-0 d-flex">
                                        <i class="fa-solid fa-bookmark text-grey-500 me-3 font-lg"></i>
                                        <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4">Save Link <span
                                                class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Add this
                                                to your saved items</span></h4>
                                    </div>
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
                                                        <source src="{{ Storage::url($media->file) }}" type="video/mp4">
                                                    </video>
                                                </div>
                                            </div>
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
                                <a href="#" id="dropdownMenu21" data-bs-toggle="dropdown" aria-expanded="false"
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
                                                        class="font-xs fa-brands fa-facebook text-white"></i></a></li>
                                            <li class="me-1"><a href="#" class="btn-round-lg bg-youtube"><i
                                                        class="font-xs fa-brands fa-youtube text-white"></i></a></li>
                                            <li class="me-1"><a href="#"
                                                    class="btn-round-lg bg-black text-white"><i
                                                        class="fa-brands fa-github"></i></a></li>

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
                            <form id="form-cmt" action="" method="post" class="my-4 position-relative "
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

                            {{-- comment --}}
                            <div class="card w-100 border-0 shadow-none right-scroll-bar">
                                @forelse ($post->comment as $comment)
                                    @php
                                        $user = App\models\User::where('id', $comment->user_id)->first();
                                    @endphp
                                    <div class="card-body border-top-xs pt-4 pb-3 pe-4 d-block ps-5">
                                        <figure class=" position-absolute left-0 ms-2 mt-1"><img
                                                style="width: 35px;height:35px;object-git:cover;border-radius:50%"
                                                src="{{ asset('storage/' . $user->profile) }}" alt="image"
                                                class="shadow-sm rounded-circle "></figure>
                                        <div class="chat p-3 bg-greylight rounded-xxl d-block text-left theme-dark-bg">
                                            <h4 class="fw-700 text-grey-900 font-xssss mt-0 mb-1">
                                                {{ $user->first_name . ' ' . $user->last_name }}<a href="#"
                                                    class="ms-auto"><i
                                                        class="fa-solid fa-ellipsis-vertical float-right text-grey-800 font-xsss"></i></a>
                                            </h4>
                                            <small
                                                class="fw-500 text-grey-500 lh-20 font-xssss w-100">{{ $comment->updated_at->diffForHumans() }}</small>
                                            <p class="text-dark mt-2 mb-0">
                                                {{ $comment->comment }}
                                            </p>
                                        </div>
                                    </div>

                                @empty
                                @endforelse

                            </div>
                        </div>

                    @empty
                        <div class="text-center text-danger">No post fund!</div>
                    @endforelse
                </div>
            </div>


        </div>
    </div>

</div>
</div>
