<div class="main-content bg-white right-chat-active">

    <div class="middle-sidebar-bottom">
        <div class="middle-sidebar-left">
            <div class="row">
                <div class="col-xl-12 mb-4">
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <div
                                class="card p-lg-5 p-4 bg-primary-gradiant rounded-3 shadow-xss bg-pattern border-0 overflow-hidden">
                                <div class="bg-pattern-div"></div>
                                <h2 class="display2-size display2-md-size fw-700 text-white mb-0 mt-0">Create Your Own
                                    Page </h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">


                        <div class="col-xl-8 col-lg-8 mx-auto">
                            <div class="page-title mt-3">
                                <form wire:submit.prevent='createpage' enctype="multipart/form-data">
                                    <p class="text-center text-info">Provide the required infomation in order to create
                                        a page</p>
                                    <div class="row">
                                        <div class="col-12">
                                            @csrf
                                            {{-- @if ($errors->any() && $errors->count() > 0){
                                                @foreach ($errors as $error)
                                                <div class="alert alert-danger" role="alert">
                                                    {{$error}}
                                                </div>
                                                @endforeach
                                            }
                                                
                                            @endif --}}
                                            @if (count($errors->all()) > 0)

                                            <div class="alert alert-danger" role="alert">
                                                Something wrong!
                                            </div>
                                               
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 mb-3">
                                            <div class="form-gorup">
                                                <label class="mont-font fw-600 font-xssss">Page name</label>
                                                <input type="text" name="name" value="{{ old('name') }}"
                                                    wire:model.lazy="name" class="form-control">
                                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <div class="form-gorup">
                                                <label class="mont-font fw-600 font-xssss">Location</label>
                                                <input type="text" name="location" value="{{ old('location') }}"
                                                    wire:model.lazy="location" class="form-control">
                                                <x-input-error :messages="$errors->get('location')" class="mt-2" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mb-3">
                                            <div class="form-gorup">
                                                <label class="mont-font fw-600 font-xssss">Type</label>
                                                <input type="text" name="type" value="{{ old('type') }}"
                                                    wire:model.lazy="type" class="form-control">
                                                <x-input-error :messages="$errors->get('type')" class="mt-2" />
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row ">
                                        <div class="col-ld-12 mb-3">
                                            <label for="" class="mont-font fw-600 font-xssss">Page icon</label>
                                            <div class="custom-file">
                                                <input type="file" id="icon" name="icon" class="custom-file-input"
                                                    wire:model.lazy="icon">
                                                <label for="icon">Page icon</label>
                                            </div>
                                            <div class="row">
                                                @if ($icon)
                                                <div class="col-xs-4 col-sm-4 p-1" ><a href="{{ $icon->temporaryUrl() }}" data-lightbox="roadtrip"><img
                                                    src="{{ $icon->temporaryUrl() }}" style="height:294px;object-fit:cover" class="rounded-3 w-100" alt="image"></a></div>
                                                @endif
                                            </div>
                                            <x-input-error :messages="$errors->get('icon')" class="mt-2" />

                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-ld-12 mb-3">

                                            <label for="" class="mont-font fw-600 font-xssss">Page
                                                thumbnail</label>
                                            <div class="custom-file">
                                                <input type="file" id="thumbnail" class="custom-file-input"
                                                    wire:model.lazy="thumbnail" name="thumbnail">
                                                <label for="thumbnail">Page thumbnail</label>
                                            </div>
                                            <div class="row">
                                                @if ($thumbnail)
                                                <div class="col-xs-4 col-sm-4 p-1" ><a href="{{ $thumbnail->temporaryUrl() }}" data-lightbox="roadtrip"><img
                                                    src="{{ $thumbnail->temporaryUrl() }}" style="height:294px;object-fit:cover" class="rounded-3 w-100" alt="image"></a></div>
                                                @endif
                                            </div>
                                            <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="row ">
                                        <div class="col-12 mb-3">
                                            <div class="form-group">
                                                <label for="decription" class="mont-font fw-600 font-xssss">Page
                                                    Description</label>
                                                <textarea name="decription" class="form-control w-full" id="decription" rows="5" wire:model.lazy="decription"></textarea>
                                            </div>
                                            <x-input-error :messages="$errors->get('decription')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <button class="btn btn-success btn-block" type="submit">Create
                                                Page</button>
                                        </div>
                                    </div>
                                </form>


                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
