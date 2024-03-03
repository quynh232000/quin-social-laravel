<div class="main-content right-chat-active">

    <div class="middle-sidebar-bottom">
        <div class="middle-sidebar-left pe-0">
            <div class="row">

                <div class="col-xl-12">
                    <div class="chat-wrapper p-3 w-100 position-relative scroll-bar bg-white theme-dark-bg">
                        <h2 class="fw-700 mb-4 mt-2 font-md text-grey-900 d-flex align-items-center">Save Posts
                            <span
                                class="circle-count bg-success text-white font-xsssss rounded-3 ms-2 ls-3 fw-600 p-2  mt-0">{{
                                    $count ?$count : ""
                                }}</span>
                            <a href="#" class="ms-auto btn-round-sm bg-greylight rounded-3 bg-warning"><i
                                    class="fa-solid fa-bookmark font-xss text-white"></i></a>

                           
                        </h2>



                        <ul class="notification-box">
                            @forelse ($saveposts as $item)
                                <li>
                                    <a href="{{ route('single-post', ['useruuid' => $item->post->user->uuid, 'postuuid' => $item->post->uuid]) }}"
                                        style="border-bottom: 1px solid rgab(22,22,24,.12)"
                                        class="d-flex align-items-center p-3 rounded-3  theme-light-bg">
                                        <img src="{{ asset('storage/' . $item->post->user->profile) }}" alt="user"
                                            class="w45 me-3 img-border-45">
                                        @if (App\Models\Like::where(['post_id' => $item->post_id, ('user_id')=>auth()->id()])->exists())
                                            <i
                                                class="fa-regular fa-thumbs-up text-white bg-primary-gradiant me-2 font-xssss notification-react"></i>
                                        @endif
                                        <h6 class="font-xssss text-grey-900 text-grey-900 mb-0 mt-0 fw-500 lh-20">
                                            <strong>
                                                {{ $item->post->user->first_name . ' ' . $item->post->user->last_name }}
                                            </strong>
                                            posted
                                            <strong>
                                                @if ($item->post->is_page_post == 1)
                                                    {{ App\Models\Page::findOrFail($item->post->page_id)->name }}
                                                @elseif($item->post->is_group_post == 1)
                                                    {{ App\Models\Group::findOrFail($item->post->group_id)->name }}
                                                @else
                                                @endif


                                            </strong> :
                                            “{{ Str::limit($item->post->content, 120, '...') }}” <span
                                                class="d-block text-grey-500 font-xssss fw-600 mb-0 mt-0 0l-auto">
                                                {{ $item->created_at->diffForHumans() }}
                                            </span>
                                        </h6>
                                        <i class="fa-solid fa-ellipsis-vertical text-grey-500 font-xs ms-auto"></i>

                                    </a>
                                </li>
                            @empty
                                <div class="text-center text-danger">No post saved!</div>
                            @endforelse
                            {{-- <li>
                                <a href="#" class="d-flex align-items-center p-3 rounded-3 bg-lightblue theme-light-bg">
                                    <img src="https://jsbasic.mr-quynh.com/img/a2.jpg" alt="user" class="w45 me-3 img-border-45">
                                    <i class="fa-solid fa-heart text-white bg-red-gradiant me-2 font-xssss notification-react"></i>
                                    <h6 class="font-xssss text-grey-900 text-grey-900 mb-0 mt-0 fw-500 lh-20"><strong>Victor Exrixon</strong> posted in <strong>UI/UX Community</strong> : “Mobile Apps UI Designer is required for Tech…” <span class="d-block text-grey-500 font-xssss fw-600 mb-0 mt-0 0l-auto"> 12 minutes ago</span> </h6>
                                    <i class="fa-solid fa-ellipsis-vertical text-grey-500 font-xs ms-auto"></i>
                                    
                                </a>
                            </li> --}}





                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
