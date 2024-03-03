<div class="main-content bg-lightblue theme-dark-bg right-chat-active">

    <div class="middle-sidebar-bottom">
        <div class="middle-sidebar-left">
            <div class="middle-wrap">
                <div class="card w-100 border-0 bg-white shadow-xs p-0 mb-4">

                    <div class="card-body p-lg-5 p-4 w-100 border-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <h4 class="mb-4 font-xxl fw-700 mont-font mb-lg-5 mb-4 font-md-xs">Settings</h4>
                                <div class="nav-caption fw-600 font-xssss text-grey-500 mb-2">Genaral</div>
                                <ul class="list-inline mb-4">
                                    <li class="list-inline-item d-block border-bottom me-0"><a
                                            href="{{route('settings.account')}}"
                                            class="pt-2 pb-2 d-flex align-items-center"><i
                                                class="btn-round-md bg-primary-gradiant text-white fa-solid fa-user font-md me-3"></i>
                                            <h4 class="fw-600 font-xsss mb-0 mt-0">Acount Information</h4><i
                                                class="fa-solid fa-angle-right font-xsss text-grey-500 ms-auto mt-3"></i>
                                        </a></li>
                                    {{-- <li class="list-inline-item d-block border-bottom me-0"><a
                                            href="{{route('settings.address')}}"
                                            class="pt-2 pb-2 d-flex align-items-center"><i
                                                class="btn-round-md bg-gold-gradiant text-white fa-solid fa-location-dot font-md me-3"></i>
                                            <h4 class="fw-600 font-xsss mb-0 mt-0">Saved Address</h4><i
                                                class="fa-solid fa-angle-right font-xsss text-grey-500 ms-auto mt-3"></i>
                                        </a></li> --}}

                                    <li class="list-inline-item d-block me-0"><a href="{{route('settings.accountsocial')}}"
                                            class="pt-2 pb-2 d-flex align-items-center"><i
                                                class="btn-round-md bg-red-gradiant text-white fa-brands fa-twitter font-md me-3"></i>
                                            <h4 class="fw-600 font-xsss mb-0 mt-0">Social Acount</h4><i
                                                class="fa-solid fa-angle-right font-xsss text-grey-500 ms-auto mt-3"></i>
                                        </a></li>
                                        <li class="list-inline-item d-block border-bottom me-0"><a
                                            href="{{route('settings.savepost')}}"
                                            class="pt-2 pb-2 d-flex align-items-center"><i
                                                class="btn-round-md bg-gold-gradiant text-white fa-solid fa-bookmark font-md me-3"></i>
                                            <h4 class="fw-600 font-xsss mb-0 mt-0">Save Posts</h4><i
                                                class="fa-solid fa-angle-right font-xsss text-grey-500 ms-auto mt-3"></i>
                                        </a></li>
                                </ul>

                                <div class="nav-caption fw-600 font-xsss text-grey-500 mb-2">Acount</div>
                                <ul class="list-inline mb-4">
                                    {{-- <li
                                        class="list-inline-itehttps://fontawesome.com/iconsm d-block border-bottom me-0">
                                        <a href="{{route('settings.card')}}" class="pt-2 pb-2 d-flex align-items-center"><i
                                                class="btn-round-md bg-mini-gradiant text-white fa-regular fa-credit-card font-md me-3"></i>
                                            <h4 class="fw-600 font-xsss mb-0 mt-0">My Cards</h4><i
                                                class="fa-solid fa-angle-right font-xsss text-grey-500 ms-auto mt-3"></i>
                                        </a></li> --}}
                                    <li class="list-inline-item d-block  me-0"><a href="{{route('settings.password')}}"
                                            class="pt-2 pb-2 d-flex align-items-center"><i
                                                class="btn-round-md bg-blue-gradiant text-white fa-solid fa-lock font-md me-3"></i>
                                            <h4 class="fw-600 font-xsss mb-0 mt-0">Password</h4><i
                                                class="fa-solid fa-angle-right font-xsss text-grey-500 ms-auto mt-3"></i>
                                        </a></li>

                                </ul>

                                <div class="nav-caption fw-600 font-xsss text-grey-500 mb-2">Other</div>
                                <ul class="list-inline">
                                    <li class="list-inline-item d-block border-bottom me-0"><a
                                            href="{{route('settings.notifications')}}"
                                            class="pt-2 pb-2 d-flex align-items-center"><i
                                                class="btn-round-md bg-gold-gradiant text-white fa-solid fa-bell font-md me-3"></i>
                                            <h4 class="fw-600 font-xsss mb-0 mt-0">Notification</h4><i
                                                class="fa-solid fa-angle-right font-xsss text-grey-500 ms-auto mt-3"></i>
                                        </a></li>
                                    <li class="list-inline-item d-block border-bottom me-0"><a href="{{route('settings.help')}}"
                                            class="pt-2 pb-2 d-flex align-items-center"><i
                                                class="btn-round-md bg-primary-gradiant text-white fa-solid fa-circle-info font-md me-3"></i>
                                            <h4 class="fw-600 font-xsss mb-0 mt-0">Help</h4><i
                                                class="fa-solid fa-angle-right font-xsss text-grey-500 ms-auto mt-3"></i>
                                        </a></li>
                                    <li class="list-inline-item d-block me-0"><a wire:click="logout"
                                            class="pt-2 pb-2 d-flex align-items-center poiter"><i
                                                class="btn-round-md bg-red-gradiant text-white fa-solid fa-right-from-bracket font-md me-3"></i>
                                            <h4 class="fw-600 font-xsss mb-0 mt-0">Logout</h4><i
                                                class="fa-solid fa-angle-right font-xsss text-grey-500 ms-auto mt-3"></i>
                                        </a></li>

                                </ul>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
