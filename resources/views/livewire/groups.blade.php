<div class="main-content right-chat-active">

    <div class="middle-sidebar-bottom">
        <div class="middle-sidebar-left pe-0">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card shadow-xss w-100 d-block d-flex border-0 p-4 mb-3">
                        <div class="card-body d-flex align-items-center p-0">
                            <h2 class="fw-700 mb-0 mt-0 font-md text-grey-900">Groups

                                @if ($count)
                                    ({{$count}})
                                @endif

                            </h2>
                            <div class="search-form-2 ms-auto">
                                <i class="fa-solid fa-magnifying-glass font-xss"></i>
                                <input type="text" name="search" wire:model.lazy="search"
                                    class="form-control text-grey-500 mb-0 bg-greylight theme-dark-bg border-0"
                                    placeholder="Search here...">
                            </div>
                            <a href="{{ route('create-group') }}"
                                class="  btn-round-md btn-success  bg-success ms-2 bg-greylight theme-dark-bg rounded-3"><i
                                    class="fa-solid fa-plus font-xss text-white"></i></a>
                        </div>
                    </div>

                    <div class="row ps-2 pe-1">

                        @forelse ($groups as $group)
                            <div class="col-md-6 col-sm-6 pe-2 ps-2">
                                <div class="card d-block border-0 shadow-xss rounded-3 overflow-hidden mb-3">
                                    <div class="card-body position-relative h100 bg-image-cover bg-image-center"
                                        style="background-image: url({{ asset('storage/' . $group->thumbnail) }});">
                                    </div>
                                    <div
                                        class="card-body d-block w-100 pl-10 pe-4 pb-4 pt-0 text-left position-relative">
                                        <figure class="avatar position-absolute w75 z-index-1"
                                            style="top:-40px; left: 15px;">
                                            <img style="width: 75px;height:75px;object-fit:cover;border-radius:50%"
                                                src="{{ asset('storage/' . $group->icon) }}" alt="image"
                                                class="float-right p-1 bg-white rounded-circle w-100">
                                        </figure>
                                        <div class="clearfix"></div>
                                        <a href="{{route('group',$group->uuid)}}" class="fw-700 font-xsss mt-3 mb-1">{{ $group->name }}</a>
                                        <p class="fw-500 font-xsssss text-grey-500 mt-0 mb-3">{{ $group->location }}</p>
                                        <p class="fw-500 font-xsss text-grey-500 mt-0 mb-3">{{ $group->members }}
                                            members -
                                            {{ App\models\Post::where('group_id', $group->id)->count() }} posts</p>


                                        @if (App\models\GroupMember::where(['user_id' => auth()->id(), 'group_id' => $group->id])->exists())
                                            <button wire:click='leave({{ $group->id }})' class="position-absolute right-15 top-30 d-flex align-items-center"
                                                style="top:26px">
                                                <div 
                                                    class="text-center p-2 lh-24 w100 ms-1 ls-3 d-inline-block rounded-xl bg-danger font-xsssss fw-700 ls-lg text-white">LEAVE</div>
                                            </button>
                                        @else
                                            <button wire:click='join({{ $group->id }})' class="position-absolute right-15 top-30 d-flex align-items-center"
                                                style="top:26px">
                                                <div
                                                    class="text-center p-2 lh-24 w100 ms-1 ls-3 d-inline-block rounded-xl bg-current font-xsssss fw-700 ls-lg text-white">JOIN</div>
                                            </button>
                                        @endif



                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-danger">No group fund!</div>
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
