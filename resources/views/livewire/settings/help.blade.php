<div class="main-content right-chat-active">

    <div class="middle-sidebar-bottom">
        <div class="middle-sidebar-left">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="card w-100 border-0 p-0 rounded-3 overflow-hidden bg-image-contain bg-image-center"
                        style="background-image: url(images/help-bg.png);">
                        <div class="card-body p-md-5 p-4 text-center" style="background-color:rgba(0,85,255,0.8)">
                            <h2 class="fw-700 display2-size text-white display2-md-size lh-2">Welcome to the Quin Social!
                            </h2>
                            <p class="font-xsss ps-lg-5 pe-lg-5 lh-28 text-grey-200">If you have any question or
                                problem, please send them to us, then we solve that</p>
                            <div
                                class="form-group w-lg-75 mt-4 border-light border p-1 bg-white rounded-3 ms-auto me-auto">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group icon-input mb-0">
                                            <i class="fa-solid fa-search font-xs text-grey-400"></i>
                                            <input type="text" name="search" wire:model.lazy="search"
                                                class="w-full style1-input border-0 ps-5 font-xsss mb-0 text-grey-500 fw-500 bg-transparent"
                                                placeholder="Search...">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit"
                                            class="w-100 d-block btn bg-current text-white font-xssss fw-600 ls-3 style1-input p-0 border-0 text-uppercase ">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card w-100 border-0 shadow-none bg-transparent mt-5">
                        <div class="accordion mb-0">
                            @forelse ($helps as $item)
                                <a class="card shadow-xss" data-bs-toggle="collapse"
                                    href="#question-{{ $item->id }}" role="button" aria-expanded="false"
                                    aria-controls="question-{{ $item->id }}">
                                    <div class="card-header d-flex align-center">
                                        <h5 class="mb-0">
                                            <div class="btn btn-link text-black fw-700">
                                                {{ $item->question }} ?
                                            </div>
                                        </h5>
                                        <i class="fa-solid fa-angle-down font-xsss text-grey-500 ms-auto mt-3"></i>
                                    </div>
                                </a>
                                <div class="collapse" id="question-{{ $item->id }}">
                                    <div class="card card-body " style="padding: 0 20px">
                                        {{ $item->answer }}
                                    </div>
                                </div>

                            @empty
                                <div class="text-center text-danger">
                                    No question fund!
                                </div>
                            @endforelse



                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
