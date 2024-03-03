<form wire:submit.prevent="createstory" enctype="multipart/form-data" class="main-content right-chat-active">

    <div class="middle-sidebar-bottom">
        <div class="middle-sidebar-left pe-0">
            <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-lg-12 col-xl-12 col-md-6 mb-4 mt-2 pe-2">
                            <div class="card p-0 bg-white rounded-3 shadow-xs border-0">
                                <div class="card-body p-3 border-top-lg border-size-lg border-primary p-0">
                                    <h4><span
                                            class="font-xsss fw-700 text-grey-900 mt-2 d-inline-block text-dark">Create
                                            your story </span>
                                        <a href="#" class="float-right btn-round-sm bg-greylight"
                                            data-bs-toggle="modal" data-bs-target="#Modaltodo">
                                            {{-- <i class="feather-plus font-xss text-grey-900"></i> --}}
                                        </a>
                                    </h4>
                                </div>

                                <style>
                                    .create-story {
                                        display: flex;
                                        justify-content: center;
                                        padding: auto;
                                    }

                                    .create-story-body {
                                        position: relative;
                                        width: fit-content;
                                    }

                                    .create-story-icon {
                                        position: absolute;
                                        top: 50%;
                                        left: 50%;
                                        transform: translate(-50%, -50%);
                                        display: flex;
                                        flex-direction: column;
                                        align-items: center;
                                        text-align: center;
                                        gap: 14px;
                                        cursor: pointer;
                                    }

                                    .create-story-icon span {
                                        color: white;
                                        font-size: 14px;
                                        font-weight: bold
                                    }

                                    .create-story-icon-body {
                                        width: 44px;
                                        height: 44px;
                                        border-radius: 50%;
                                        display: flex;
                                        justify-content: center;
                                        align-items: center;

                                    }
                                </style>



                                <div
                                    class=" create-story ard-body p-3 bg-lightblue theme-dark-bg mt-0 mb-3 ms-3 me-3 rounded-3">
                                    <div wire:loading wire:target="images">
                                        <div class="preloader"></div>
                                    </div>
                                    @if ($images)
                                        <div class="row ps-2 pe-2">
                                            @foreach ($images as $image)
                                                <div class="col-xs-4 col-sm-4 p-1"><a
                                                        href="{{ $image->temporaryUrl() }}"
                                                        data-lightbox="roadtrip"><img src="{{ $image->temporaryUrl() }}"
                                                            style="height:294px;object-fit:cover"
                                                            class="rounded-3 w-100" alt="image"></a></div>
                                            @endforeach
                                            <div class="col-xs-4 col-sm-4 p-1"> <label class="create-story-body"
                                                    for="images">
                                                    <i data-visualcompletion="css-img"
                                                        class="x1ey2m1c xds687c x10l6tqk x17qophe x13vifvy "
                                                        style="background-image: url(&quot;https://static.xx.fbcdn.net/rsrc.php/v3/ye/r/0_etHRYkr4X.png&quot;); background-position: 0px 0px; background-size: 222px 690px; width: 220px; height: 330px; background-repeat: no-repeat; display: inline-block;"></i>
                                                    <div class="create-story-icon">
                                                        <div class="create-story-icon-body bg-white">
                                                            <i data-visualcompletion="css-img" class="x1b0d499 xep6ejk"
                                                                style="background-image: url(&quot;https://static.xx.fbcdn.net/rsrc.php/v3/yB/r/IlbG8w-Nl9j.png&quot;); background-position: 0px -246px; background-size: 26px 398px; width: 20px; height: 20px; background-repeat: no-repeat; display: inline-block;"></i>
                                                        </div>
                                                        <span>Upload images</span>
                                                    </div>
                                                    <input type="file" name="images" multiple
                                                        accept="png, jpeg, jpg" id="images" hidden
                                                        wire:model="images">
                                                </label></div>
                                        </div>
                                    @else
                                        <label class="create-story-body" for="images">
                                            <i data-visualcompletion="css-img"
                                                class="x1ey2m1c xds687c x10l6tqk x17qophe x13vifvy"
                                                style="background-image: url(&quot;https://static.xx.fbcdn.net/rsrc.php/v3/ye/r/0_etHRYkr4X.png&quot;); background-position: 0px 0px; background-size: 222px 690px; width: 220px; height: 330px; background-repeat: no-repeat; display: inline-block;"></i>
                                            <div class="create-story-icon">
                                                <div class="create-story-icon-body bg-white">
                                                    <i data-visualcompletion="css-img" class="x1b0d499 xep6ejk"
                                                        style="background-image: url(&quot;https://static.xx.fbcdn.net/rsrc.php/v3/yB/r/IlbG8w-Nl9j.png&quot;); background-position: 0px -246px; background-size: 26px 398px; width: 20px; height: 20px; background-repeat: no-repeat; display: inline-block;"></i>
                                                </div>
                                                <span>Upload images</span>
                                            </div>
                                            <input type="file" name="images" multiple accept="png, jpeg, jpg"
                                                id="images" hidden wire:model="images">
                                        </label>
                                    @endif



                                </div>
                                <x-input-error :messages="$errors->get('images')" class="mt-2" />
                                <div class="d-flex justify-center my-4">
                                    <button class="btn btn-primary text-white" type="submit">Create story</button>
                                </div>



                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>

    </div>
</form>
