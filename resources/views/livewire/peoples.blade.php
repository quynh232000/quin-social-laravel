<div class="main-content right-chat-active">

    <div class="middle-sidebar-bottom">
        <div class="middle-sidebar-left pe-0">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card shadow-xss w-100 d-block d-flex border-0 p-4 mb-3">
                        <div wire:submit.prevent ="search" class="card-body d-flex align-items-center p-0">
                            <h2 class="fw-700 mb-0 mt-0 font-md text-grey-900">Friends
                                @if ($count)
                                    ({{$count}})
                                @endif


                            </h2>
                            <div class="search-form-2 ms-auto">
                                {{-- <i class="fa-solid fa-magnifying-glass font-xss"></i> --}}
                                <input type="search" wire:model.lazy='search' name="search"
                                    class="form-control text-grey-500 mb-0 bg-greylight theme-dark-bg border-0"
                                    placeholder="Search here...">
                            </div>
                            <button type="submit" class="btn-round-md ms-2 bg-greylight theme-dark-bg rounded-3"><i
                                    class="fa-solid fa-filter font-xss text-grey-500"></i></button>
                        </div>
                    </div>

                    <div class="row ps-2 pe-2">

                        @forelse ($users as $user)
                            <div class="col-md-3 col-sm-4 pe-2 ps-2">
                                <div class="card d-block border-0 shadow-xss rounded-3 overflow-hidden mb-3">
                                    <div class="card-body d-block w-100 ps-3 pe-3 pb-4 text-center">
                                        <figure class="avatar ms-auto me-auto mb-0 position-relative w65 z-index-1"><img
                                                style="width:65px;height:65px;object-fit:cover;border-radius:50%"
                                                src="{{ asset('storage/' . $user->profile) }}" alt="image"
                                                class="float-right p-0 bg-white rounded-circle w-100 shadow-xss">
                                        </figure>
                                        <div class="clearfix"></div>
                                        <div>
                                            <a  href="{{route('user',$user->uuid)}}" class="fw-700 font-xsss mt-3 mb-1 text-dark">{{ $user->first_name }}
                                                {{ $user->last_name }}</a>
                                        </div>
                                        <div>
                                            <a href="{{route('user',$user->uuid)}}" class="fw-500 font-xsssss text-grey-500 mt-0 mb-3">
                                                {{ '@' . $user->username }}
                                            </a>
                                        </div>
                                        @if (App\Models\Friend::where([
                                                'user_id' => $user->id,
                                                'friend_id' => auth()->user()->uuid,
                                                'status' => 'pending',
                                            ])->first())
                                            <button wire:click="acceptfriend('{{ $user->id }}')"
                                                class="mt-0 btn pt-2 pb-2 ps-3 pe-3 lh-24 ms-1 bg-info ls-3 d-inline-block rounded-xl  font-xsssss fw-700 ls-lg text-white">ACCEPT</button>
                                            <button  wire:click="rejectfriend('{{ $user->uuid }}')"
                                                class="mt-0 btn pt-2 pb-2 ps-3 pe-3 lh-24 ms-1 bg-danger ls-3 d-inline-block rounded-xl  font-xsssss fw-700 ls-lg text-white">REJECT</button>
                                        @elseif ($user->is_friend() == 'accepted')
                                            <a href="#"
                                                class="mt-0 btn pt-2 pb-2 ps-3 pe-3 lh-24 ms-1 bg-info ls-3 d-inline-block rounded-xl  font-xsssss fw-700 ls-lg text-white">FRIEND</a>
                                        @elseif ($user->is_friend() == 'pending')
                                            <button wire:click="removefriend('{{ $user->uuid }}')"
                                                class="mt-0 btn pt-2 pb-2 ps-3 pe-3 lh-24 ms-1 ls-3 d-inline-block rounded-xl bg-danger font-xsssss fw-700 ls-lg text-white">CANCEL</button>
                                        @else
                                            <button wire:click="addfriend('{{ $user->uuid }}')"
                                                class="mt-0 btn pt-2 pb-2 ps-3 pe-3 lh-24 ms-1 ls-3 d-inline-block rounded-xl bg-success font-xsssss fw-700 ls-lg text-white">ADD
                                                FRIEND </button>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        @empty
                            <div class="alert alert-danger">No people found!</div>
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
