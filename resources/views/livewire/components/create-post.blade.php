<form wire:submit.prevent="createpost" id="form-create-post" enctype="multipart/form-data"
    class="card w-100 shadow-xss rounded-xxl border-0 ps-4 pt-4 pe-4 pb-3 mb-3">
    <div class="card-body p-0">
        <a href="#" class=" font-xssss fw-600 text-grey-500 card-body p-0 d-flex align-items-center">
            <i class="btn-round-sm font-xs text-primary bg-greylight mx-2 fa-solid fa-pen-to-square"></i>
            Create Post
        </a>
    </div>
    <div class="card-body p-0 mt-3 position-relative">
        <figure class="avatar position-absolute ms-2 mt-1 top-5"><img
                src="{{ Storage::url(auth()->user()->profile) ?? 'images/user-8.png' }}" alt="image"
                class="shadow-sm rounded-circle  border-avatar" style="width: 34px; height:34px"></figure>
        <textarea wire:model.lazy="message" name="message"
            class="h100 bor-0 w-100 rounded-xxl p-2 ps-5 font-xssss text-grey-500 fw-500 border-light-md theme-dark-bg"
            cols="30" rows="10" placeholder="What's on your mind? "></textarea>
    </div>
    @error('message')
        <span class="error text-danger">{{ $message }}</span>
    @enderror
    <div wire:loading wire:target= "images" style="color: green">Loading...</div>
    <div wire:loading wire:target= "video" style="color:green">Loading...</div>

    {{-- show image priview --}}
    @if ($images)
        <div class="row ps-2 pe-2">
            @foreach ($images as $image)
                <div class="col-xs-4 col-sm-4 p-1" ><a href="{{ $image->temporaryUrl() }}" data-lightbox="roadtrip"><img
                            src="{{ $image->temporaryUrl() }}" style="height:294px;object-fit:cover" class="rounded-3 w-100" alt="image"></a></div>
            @endforeach
        </div>
    @endif
    @if ($video)
        <video src="{{ $video->temporaryUrl() }}" autoplay controls style="width: 100%"></video>
    @endif

    <div class="card-body d-flex p-0 mt-0">
        <label for="post-image" href="#"
            class="d-flex align-items-center font-xssss fw-600 ls-1 text-grey-700 text-dark pe-4"><i
                class="font-md text-success fa-solid fa-images me-2"></i><span class="d-none-xs">Photo</span></label>
        <input type="file" hidden multiple wire:model="images" id="post-image">

        <label for="post-video" class="d-flex align-items-center font-xssss fw-600 ls-1 text-grey-700 text-dark pe-4"><i
                class="font-md text-success  me-2 fa-solid fa-video"></i><span class="d-none-xs">Video</span></label>
        <input type="file" hidden wire:model="video" id="post-video" accept="video/mp4,video/x-m4v,video/*">


        <button type="submit" class="outline-none ms-auto border-none bg-none">
            <i class="btn-round-sm font-xs text-primary bg-greylight mx-2 fa-solid fa-paper-plane"></i>
        </button>
    </div>
</form>

@push('js')
    <script>
       
    </script>
@endpush
