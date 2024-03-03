<div class="main-content bg-lightblue theme-dark-bg right-chat-active">

    <div class="middle-sidebar-bottom">
        <div class="middle-sidebar-left">
            <div class="middle-wrap">
                <div class="card w-100 border-0 bg-white shadow-xs p-0 mb-4">
                    <div class="card-body p-4 w-100 bg-current border-0 d-flex rounded-3">
                        <a href="{{ route('settings') }}" class="d-inline-block mt-2"><i
                                class="fa-solid fa-chevron-left font-sm text-white"></i></a>
                        <h4 class="font-xs text-white fw-600 ms-4 mb-0 mt-2">Account Details</h4>
                    </div>
                    <div class="card-body p-lg-5 p-4 w-100 border-0 ">
                        <div class="row justify-content-center">
                            <div class="col-lg-4 text-center">
                                <figure class="avatar ms-auto me-auto mb-0 mt-2 w100" height="100"><img
                                        style="height: 100px;object-fit:cover"
                                        src="{{ asset('storage/' . auth()->user()->profile) }}" alt="image"
                                        class="shadow-sm rounded-3 w-100"></figure>
                                <h2 class="fw-700 font-sm text-grey-900 mt-3">
                                    {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}</h2>
                                <h4 class="text-grey-500 fw-500 mb-3 font-xsss mb-4">{{ auth()->user()->username }}</h4>
                                <!-- <a href="#" class="p-3 alert-primary text-primary font-xsss fw-500 mt-2 rounded-3">Upload New Photo</a> -->
                            </div>
                        </div>

                        <form action="#" wire:submit.prevent="updateProfile" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label class="mont-font fw-600 font-xsss">First Name </label>
                                        <input name="first_name" wire:model.lazy="first_name" type="text"
                                            class="form-control text-black">
                                        @error('first_name')
                                            <span class="error text-danger">{{ $first_name }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label class="mont-font fw-600 font-xsss">Last Name</label>
                                        <input name="last_name" wire:model.lazy="last_name" type="text"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label class="mont-font fw-600 font-xsss">Email</label>
                                        <input readonly name="email" wire:model.lazy="email" type="text"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label class="mont-font fw-600 font-xsss">Phone</label>
                                        <input name="mobile" wire:model.lazy="mobile" type="text"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <div class="form-group">
                                        <label class="mont-font fw-600 font-xsss">Country</label>
                                        <input name="location" wire:model.lazy="location" type="text"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-lg-12 mb-3">
                                    <div class="form-group">
                                        <label class="mont-font fw-600 font-xsss">Address</label>
                                        <input name="address" wire:model.lazy="address" type="text"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <div class="card mt-3 border-0">
                                        <div class="card-body d-flex justify-content-between align-items-end p-0">
                                            <div class="form-group mb-0 w-100">
                                                <label class="mont-font fw-600 font-xsss">Avatar</label>
                                                <input wire:model.lazy="profile" type="file" name="profile"
                                                    id="profile" class="input-file">
                                                <label for="profile"
                                                    class="rounded-3 text-center bg-white btn-tertiary js-labelFile p-4 w-100 border-dashed">
                                                    <i class="fa-solid fa-cloud-arrow-down large-icon me-3 d-block"></i>

                                                    <span class="js-fileName">Drag and drop or click to replace your
                                                        avatar</span>
                                                </label>
                                                <div class="col-2 mt-2">
                                                    <div wire:loading wire:target="profile">Uploading ....</div>
                                                    @if ($profile)
                                                        <img src="{{ $profile->temporaryUrl() }}" alt=""
                                                            style="width: 100%;">
                                                    @elseif(auth()->user()->profile)
                                                        <img src="{{ asset('storage/' . auth()->user()->profile) }}"
                                                            alt="" style="width: 100%;">
                                                    @endif
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12 mb-3">
                                    <div class="card mt-3 border-0">
                                        <div class="card-body d-flex justify-content-between align-items-end p-0">
                                            <div class="form-group mb-0 w-100">
                                                <label class="mont-font fw-600 font-xsss">Thumbnail</label>
                                                <input wire:model.lazy="thumbnail" type="file" name="thumbnail"
                                                    id="thumbnail" class="input-file">
                                                <label for="thumbnail"
                                                    class="rounded-3 text-center bg-white btn-tertiary js-labelFile p-4 w-100 border-dashed">
                                                    <i
                                                        class="fa-solid fa-cloud-arrow-down large-icon me-3 d-block"></i>

                                                    <span class="js-fileName">Drag and drop or click to replace yuor
                                                        thumbnail</span>
                                                </label>
                                                <div class="col-2 mt-2">
                                                    <div wire:loading wire:target="thumbnail">Uploading ....</div>
                                                    @if ($thumbnail)
                                                        <img src="{{ $thumbnail->temporaryUrl() }}" alt=""
                                                            style="width: 100%;">
                                                    @elseif(auth()->user()->thumbnail)
                                                        <img src="{{ asset('storage/' . auth()->user()->thumbnail) }}"
                                                            alt="" style="width: 100%;">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-12 mb-3">
                                    <label class="mont-font fw-600 font-xsss">Description</label>
                                    <textarea name="description" wire:model.lazy="description" class="form-control mb-0 p-3 h100 bg-greylight lh-16"
                                        rows="5" placeholder="Write your description..." spellcheck="false"></textarea>
                                </div>

                                <div class="col-lg-12">
                                    <button type="submit"
                                        class="bg-current text-center text-white font-xsss fw-600 p-3 w175 rounded-3 d-inline-block">Save</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <!-- <div class="card w-100 border-0 p-2"></div> -->
            </div>
        </div>

    </div>
</div>
