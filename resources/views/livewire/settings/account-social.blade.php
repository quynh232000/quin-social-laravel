<div class="main-content bg-lightblue theme-dark-bg right-chat-active">
            
    <div class="middle-sidebar-bottom">
        <div class="middle-sidebar-left">
            <div class="middle-wrap">
                <div class="card w-100 border-0 bg-white shadow-xs p-0 mb-4">
                    <div class="card-body p-4 w-100 bg-current border-0 d-flex rounded-3">
                        <a href="{{route('settings')}}" class="d-inline-block mt-2"><i class="fa-solid fa-chevron-left font-sm text-white"></i></a>
                        <h4 class="font-xs text-white fw-600 ms-4 mb-0 mt-2">Social Network</h4>
                    </div>
                    <div class="card-body p-lg-5 p-4 w-100 border-0">
                        <form action="#" wire:submit.prevent="save">
                             

                            <div class="row">
                                
                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label class="mont-font fw-600 font-xsss">Facebook</label>
                                        <input placeholder="Aa.." type="text" name="Facebook" wire:model="Facebook" class="form-control">
                                    </div>        
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label class="mont-font fw-600 font-xsss">Twitter</label>
                                        <input placeholder="Aa.." type="text" name="Twitter" wire:model="Twitter" class="form-control">
                                    </div>        
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label class="mont-font fw-600 font-xsss">Linkedin</label>
                                        <input placeholder="Aa.." type="text" name="Linkedin" wire:model="Linkedin" class="form-control">
                                    </div>        
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label class="mont-font fw-600 font-xsss">Instagram</label>
                                        <input placeholder="Aa.." type="text" name="Instagram" wire:model="Instagram" class="form-control">
                                    </div>        
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label class="mont-font fw-600 font-xsss">Github</label>
                                        <input placeholder="Aa.." type="text" name="Github" wire:model="Github" class="form-control">
                                    </div>        
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label class="mont-font fw-600 font-xsss">Google</label>
                                        <input placeholder="Aa.."  type="text" name="Google" wire:model="Google" class="form-control">
                                    </div>        
                                </div>




                                <div class="col-lg-12 mb-0 mt-2">
                                    <button type="submit" class="bg-current text-center text-white font-xsss fw-600 p-3 w175 rounded-3 d-inline-block">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
         
    </div>            
</div>