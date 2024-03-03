<div class="main-content right-chat-active">

    <div class="middle-sidebar-bottom">
        <div class="middle-sidebar-left pe-0">
            <div class="row">

                <div class="col-xl-12">
                    <div class="chat-wrapper p-3 w-100 position-relative scroll-bar bg-white theme-dark-bg">
                        <h2 class="fw-700 mb-4 mt-2 font-md text-grey-900 d-flex align-items-center">Notification
                            @if ($count && $count >0)
                            <span
                                class="circle-count bg-warning text-white font-xsssss rounded-3 ms-2 ls-3 fw-600 p-2  mt-0">
                            {{$count}}
                            </span>
                                
                            @endif
                            <a href="#" class="ms-auto btn-round-sm bg-greylight rounded-3"><i
                                    class="fa-solid fa-hard-drive font-xss text-grey-500"></i></a>

                            <a href="#" class="ms-2 btn-round-sm bg-greylight rounded-3"><i
                                    class="fa-solid fa-bell font-xss text-grey-500"></i></a>
                            <a href="#" class="ms-2 btn-round-sm bg-greylight rounded-3"><i
                                    class="fa-solid fa-trash-can font-xss text-grey-500"></i></a>
                        </h2>



                        <ul class="notification-box">
                            @forelse ($notifications as $item)
                                <li>
                                    <a href="{{ $item->url }}"
                                        class="d-flex align-items-center p-3 rounded-3 
                                        {{$item->read_at ==null ? 'bg-lightblue':''}}
                                        theme-light-bg">
                                        <img src="{{ asset('storage/' . $item->fromuser->profile) }}" alt="user"
                                            class="w45 me-3 img-border-45">
                                        {{-- <i
                                            class="fa-solid fa-heart text-white bg-red-gradiant me-2 font-xssss notification-react"></i> --}}
                                        <h6 class="font-xssss text-grey-900 text-grey-900 mb-0 mt-0 fw-500 lh-20">
                                            <strong>{{ $item->fromuser->first_name . ' ' . $item->fromuser->last_name }}</strong>
                                            <strong></strong> :
                                            “{{ Str::limit($item->message, 120, '...') }}” <span
                                                class="d-block text-grey-500 font-xssss fw-600 mb-0 mt-0 0l-auto"> 12
                                                minutes ago</span> </h6>
                                        <i class="fa-solid fa-ellipsis-vertical text-grey-500 font-xs ms-auto"></i>

                                    </a>
                                </li>
                            @empty
                                <div class="text-center text-danger">No notification fund!</div>
                            @endforelse

                            {{-- <li>
                                <a href="#" class="d-flex align-items-center p-3 rounded-3  theme-light-bg">
                                    <img src="https://jsbasic.mr-quynh.com/img/a2.jpg" alt="user" class="w45 me-3 img-border-45">
                                    <i class="fa-regular fa-thumbs-up text-white bg-primary-gradiant me-2 font-xssss notification-react"></i>
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
