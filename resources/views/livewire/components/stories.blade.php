<div class="card w-100 shadow-none bg-transparent bg-transparent-card border-0 p-0 mb-0">
    <div class="owl-carousel category-card owl-theme overflow-hidden nav-none">
        <div class="item">
            <div style="background-image: url({{ asset('storage/' . auth()->user()->profile) }});"
                class="card w125 h200 d-block border-0 shadow-none rounded-xxxl bg-dark overflow-hidden mb-3 mt-3 bg-image-center bg-image-cover">
                <div class="card-body d-block p-3 w-100 position-absolute bottom-0 text-center">
                    {{-- <style>
                        .upload-btn-wrapper {
                            position: relative;
                            overflow: hidden;
                            display: inline-block;
                        }

                        .upload-btn-wrapper input[type=file] {
                            font-size: 100px;
                            position: absolute;
                            left: 0;
                            top: 0;
                            opacity: 0;
                        }
                    </style> --}}
                    <a href="{{ route('create-story') }}" class="upload-btn-wrapper">
                        <div wire:loading wire:target="images">
                            <div class="preloader"></div>
                        </div>
                        <span class="bg-white btn-round-lg"><i class="fa-solid fa-plus"></i></span>
                        <div class="clearfix"></div>
                        <h4 class="mt-2 mb-1 text-white fw-700 position-relative z-index-1 ls-1 font-xssss">
                            Add Story </h4>
                        {{-- <input type="file" name="images" multiple accept="png, jpeg, jpg" id="story"
                            wire:model="images"> --}}
                    </a>

                </div>
            </div>
        </div>

        @foreach ($stories as $story)
            <div class="item item-story" data-bs-toggle="modal" data-bs-target="#story{{ $story->user->id }}">
                <div class="card w125 h200 d-block border-0 shadow-xss rounded-xxxl bg-gradiant-bottom overflow-hidden cursor-pointer mb-3 mt-3 bg-image-center bg-image-cover"
                    style="background-image: url({{ asset('storage/' . json_decode($story->story)[0]) }});">
                    <div class="card-body d-block p-3 w-100 position-absolute bottom-0 text-center">

                        <a href="#">
                            <figure class="avatar ms-auto me-auto mb-0 position-relative w50 z-index-1">
                                <img style="width: 50px;height:50px;object-fit:cover;border-radius:50%"
                                    src="{{ asset('storage/' . $story->user->profile) }}" alt="image"
                                    class="float-right p-0 bg-white rounded-circle w-100 shadow-xss">
                            </figure>
                            <div class="clearfix"></div>
                            <h4 class="fw-600 position-relative z-index-1 ls-1 font-xssss text-white mt-2 mb-1">
                                {{ $story->user->first_name . ' ' . $story->user->last_name }} </h4>
                        </a>
                    </div>
                </div>
            </div>
           
        @endforeach

    </div>
</div>
