a<div class="nav-header bg-white shadow-xs border-0">
    <div class="nav-top">
        <a href="{{ route('home') }}">
            <img width="46px" class="me-2 ms-0" src="{{ asset('images/logo-no-text.png') }}" alt="">
            {{-- <i class=" display1-size me-2 ms-0 fa-brands fa-facebook"></i> --}}

            <span class="d-inline-block fredoka-font ls-3 fw-600 text-current font-xxl logo-text mb-0">
                {{-- uin Social --}}
                {{ config('app.name') }}
            </span> </a>
        <a href="#" class="mob-menu ms-auto me-2 chat-active-btn"><i
                class=" text-grey-900 font-sm btn-round-md bg-greylight fa-regular fa-comment"></i></a>
        <a href="default-video.html" class="mob-menu me-2"><i
                class="fa-solid fa-video text-grey-900 font-sm btn-round-md bg-greylight"></i></a>
        <a href="#" class="me-2 menu-search-icon mob-menu"><i
                class="fa-solid fa-magnifying-glass text-grey-900 font-sm btn-round-md bg-greylight"></i>
        </a>
        <button class="nav-menu me-0 ms-2"></button>
    </div>

    <form action="#" class="float-left header-search">
        <div class="form-group mb-0 icon-input">
            <i class="fa-solid fa-magnifying-glass font-sm text-grey-400"></i>
            <input type="search" wire:model='search' placeholder="Start typing to search.."
                class="bg-grey border-0 lh-32 pt-2 pb-2 ps-5 pe-3 font-xssss fw-500 rounded-xl w350 theme-dark-bg">
        </div>
    </form>
    <a href="{{ route('home') }}" class="p-2 text-center ms-3 menu-icon center-menu-icon"><i
            class="{{ request()->route()->getName() == 'home' ? 'alert-primary text-current theme-dark-bg' : 'bg-greylight text-grey-500' }}  font-lg  btn-round-lg   fa-solid f-center fa-house"></i></a>
    <a href="{{ route('explore') }}" class="p-2 text-center  ms-0 menu-icon center-menu-icon"><i
            class="{{ request()->route()->getName() == 'explore' ? 'alert-primary text-current text-primary ' : 'bg-greylight text-grey-500' }} fa-solid fa-bolt font-lg  btn-round-lg theme-dark-bg  f-center"></i></a>
    <a href="{{ route('videos') }}" class="p-2 text-center ms-0 menu-icon center-menu-icon"><i
            class="{{ request()->route()->getName() == 'videos' ? 'alert-primary text-current text-primary ' : 'bg-greylight text-grey-500' }} fa-solid fa-video font-lg  btn-round-lg theme-dark-bg  f-center"></i></a>
    <a href="default-group.html" class="p-2 text-center ms-0 menu-icon center-menu-icon"><i
            class="fa-regular fa-user font-lg bg-greylight btn-round-lg theme-dark-bg text-grey-500 f-center"></i></a>
    <a href="shop-2.html" class="p-2 text-center ms-0 menu-icon center-menu-icon"><i
            class="fa-solid fa-bag-shopping font-lg bg-greylight btn-round-lg theme-dark-bg text-grey-500 f-center"></i></a>

    <button class="p-2 text-center ms-auto menu-icon " id="dropdownMenu3" data-bs-toggle="dropdown"
        aria-expanded="false">
        @php
            $countNoti = App\Models\Notification::where(['user_id' => auth()->id(), 'read_at' => null])->count();
        @endphp
        @if ($countNoti > 0)
            <span class="dot-count bg-danger text-white font-xssss item-center"
                style="width: 24px;height:24px;border-radius:50%;top: 0px;
            right: -3px;">
                {{ $countNoti }}
            </span>
        @endif
        <i class="fa-regular fa-bell font-xl text-current "></i>
    </button>
    <div class="dropdown-menu dropdown-menu-end p-4 rounded-3 border-0 shadow-lg" aria-labelledby="dropdownMenu3">

        <h4 class="fw-700 font-xss mb-4">Notification</h4>

        <div class="overflow-auto " style="max-height: 500px">
            @forelse ((App\Models\Notification::where(["user_id"=>auth()->id(),'read_at'=>null])->with('fromuser')->latest()->limit(6)->get()) as $item)
                <div class="card bg-transparent-card w-100 border-0 ps-5 mb-3">
                    <a href="{{ route('user', $item->fromuser->uuid) }}">
                        <img src="{{ asset('storage/' . $item->fromuser->profile) }}" alt="user"
                            class="w40 position-absolute left-0 img-border-40">
                    </a>
                    <a href="{{ route('user', $item->fromuser->uuid) }}"
                        class="font-xsss text-grey-900 mb-1 mt-0 fw-700 d-block">{{ $item->fromuser->first_name . ' ' . $item->fromuser->last_name }}<span
                            class="text-grey-400 font-xsssss fw-600 float-right mt-1">
                            {{ $item->created_at->diffForHumans() }}</span></a>
                    <a href="{{ $item->url }}"
                        class="text-grey-500 fw-500 font-xssss lh-4">{{ $item->message }}</a>
                </div>
            @empty
                <div class="text-danger text-center">
                    No notification!
                </div>
            @endforelse
        </div>



    </div>

    <a href="#" class="p-2 text-center ms-3 menu-icon chat-active-btn"><i
            class="fa-regular fa-comment font-xl text-current"></i></a>
    <div class="p-2 text-center ms-3 position-relative dropdown-menu-icon menu-icon cursor-pointer">
        <i class="fa-solid fa-gear animation-spin d-inline-block font-xl text-current"></i>
        <div class="dropdown-menu-settings switchcolor-wrap">
            <h4 class="fw-700 font-sm mb-4">Settings</h4>
            <h6 class="font-xssss text-grey-500 fw-700 mb-3 d-block">Choose Color Theme</h6>
            <ul>
                <li>
                    <label class="item-radio item-content">
                        <input type="radio" name="color-radio" value="red" checked=""><i class="ti-check"></i>
                        <span class="circle-color bg-red" style="background-color: #ff3b30;"></span>
                    </label>
                </li>
                <li>
                    <label class="item-radio item-content">
                        <input type="radio" name="color-radio" value="green"><i class="ti-check"></i>
                        <span class="circle-color bg-green" style="background-color: #4cd964;"></span>
                    </label>
                </li>
                <li>
                    <label class="item-radio item-content">
                        <input type="radio" name="color-radio" value="blue" checked=""><i class="ti-check"></i>
                        <span class="circle-color bg-blue" style="background-color: #132977;"></span>
                    </label>
                </li>
                <li>
                    <label class="item-radio item-content">
                        <input type="radio" name="color-radio" value="pink"><i class="ti-check"></i>
                        <span class="circle-color bg-pink" style="background-color: #ff2d55;"></span>
                    </label>
                </li>
                <li>
                    <label class="item-radio item-content">
                        <input type="radio" name="color-radio" value="yellow"><i class="ti-check"></i>
                        <span class="circle-color bg-yellow" style="background-color: #ffcc00;"></span>
                    </label>
                </li>
                <li>
                    <label class="item-radio item-content">
                        <input type="radio" name="color-radio" value="orange"><i class="ti-check"></i>
                        <span class="circle-color bg-orange" style="background-color: #ff9500;"></span>
                    </label>
                </li>
                <li>
                    <label class="item-radio item-content">
                        <input type="radio" name="color-radio" value="gray"><i class="ti-check"></i>
                        <span class="circle-color bg-gray" style="background-color: #8e8e93;"></span>
                    </label>
                </li>

                <li>
                    <label class="item-radio item-content">
                        <input type="radio" name="color-radio" value="brown"><i class="ti-check"></i>
                        <span class="circle-color bg-brown" style="background-color: #D2691E;"></span>
                    </label>
                </li>
                <li>
                    <label class="item-radio item-content">
                        <input type="radio" name="color-radio" value="darkgreen"><i class="ti-check"></i>
                        <span class="circle-color bg-darkgreen" style="background-color: #228B22;"></span>
                    </label>
                </li>
                <li>
                    <label class="item-radio item-content">
                        <input type="radio" name="color-radio" value="deeppink"><i class="ti-check"></i>
                        <span class="circle-color bg-deeppink" style="background-color: #FFC0CB;"></span>
                    </label>
                </li>
                <li>
                    <label class="item-radio item-content">
                        <input type="radio" name="color-radio" value="cadetblue"><i class="ti-check"></i>
                        <span class="circle-color bg-cadetblue" style="background-color: #5f9ea0;"></span>
                    </label>
                </li>
                <li>
                    <label class="item-radio item-content">
                        <input type="radio" name="color-radio" value="darkorchid"><i class="ti-check"></i>
                        <span class="circle-color bg-darkorchid" style="background-color: #9932cc;"></span>
                    </label>
                </li>
            </ul>

            <div class="card bg-transparent-card border-0 d-block mt-3">
                <h4 class="d-inline font-xssss mont-font fw-700">Header Background</h4>
                <div class="d-inline float-right mt-1">
                    <label class="toggle toggle-menu-color"><input type="checkbox"><span
                            class="toggle-icon"></span></label>
                </div>
            </div>
            <div class="card bg-transparent-card border-0 d-block mt-3">
                <h4 class="d-inline font-xssss mont-font fw-700">Menu Position</h4>
                <div class="d-inline float-right mt-1">
                    <label class="toggle toggle-menu"><input type="checkbox"><span
                            class="toggle-icon"></span></label>
                </div>
            </div>
            <div class="card bg-transparent-card border-0 d-block mt-3">
                <h4 class="d-inline font-xssss mont-font fw-700">Dark Mode</h4>
                <div class="d-inline float-right mt-1">
                    <label class="toggle toggle-dark"><input type="checkbox"><span
                            class="toggle-icon"></span></label>
                </div>
            </div>

        </div>
    </div>


    <a href="{{ route('user', auth()->user()->uuid) }}" class="p-0 ms-3 menu-icon"><img
            src="{{ asset('storage/' . auth()->user()->profile) ?? 'images/profile-4.png' }}" alt="user"
            class="w40 mt--1" style="width: 40px; height:40px; object-fit:cover;border-radius:50%"></a>

</div>
