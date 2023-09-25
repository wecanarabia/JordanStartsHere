<x-admin-layouts.admin-app>
    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="page-titles">
            <ol class="breadcrumb">
                <li><h5 class="bc-title">{{ __('Edit Partner') }}</h5></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">
                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.125 6.375L8.5 1.41667L14.875 6.375V14.1667C14.875 14.5424 14.7257 14.9027 14.4601 15.1684C14.1944 15.4341 13.8341 15.5833 13.4583 15.5833H3.54167C3.16594 15.5833 2.80561 15.4341 2.53993 15.1684C2.27426 14.9027 2.125 14.5424 2.125 14.1667V6.375Z" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6.375 15.5833V8.5H10.625V15.5833" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Home </a>
                </li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{  __('Edit Partner') }} </a></li>
            </ol>
            <a class="text-primary fs-13" href="{{ route('admin.partners.index') }}" >{{  __('Partners') }}</a>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="offcanvas-body">
                                <div class="container-fluid">
                                <h4 class="heading mb-0"> {{ __('Edit Partner') }}</h4>

                            <form method="POST" action="{{ route("admin.partners.update",$partner->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                        <input name="id" type="hidden" value="{{ $partner->id }}">
                                        <div class="col-xl-8 mb-3">
                                            <label for="ckeditor" class="form-label">Name-En<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="exampleFormControlInputfirst" name="name_en" value="{{ old('name_en',$partner->getTranslation('name','en')) }}">

                                            @error('name_en')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-xl-8 mb-3">
                                            <label for="ckeditor1" class="form-label">Name-Ar<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="exampleFormControlInputfirst" name="name_ar" value="{{ old('name_ar',$partner->getTranslation('name','ar')) }}">

                                            @error('name_ar')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-xl-8 mb-3">
                                            <label for="ckeditor2" class="form-label">Name-Fr</label>
                                            <input type="text" class="form-control" id="exampleFormControlInputfirst" name="name_fr" value="{{ old('name_fr',$partner->getTranslation('name','fr')) }}">

                                        </div>
                                        <div class="col-xl-8 mb-3">
                                            <label for="ckeditor3" class="form-label">Name-Es</label>
                                            <input type="text" class="form-control" id="exampleFormControlInputfirst" name="name_es" value="{{ old('name_es',$partner->getTranslation('name','es')) }}">

                                        </div>
                                        <div class="col-xl-8 mb-3">
                                            <label for="ckeditor4" class="form-label">Name-Ru</label>
                                            <input type="text" class="form-control" id="exampleFormControlInputfirst" name="name_ru" value="{{ old('name_ru',$partner->getTranslation('name','ru')) }}">

                                        </div>

                                        </div> <div class="col-xl-8 mb-3">
                                            <label class="form-label">Body-En<span class="text-danger">*</span></label>
                                            <textarea class="form-txtarea form-control" rows="8" name="description_en">{{ old('description_en',$partner->getTranslation('description','en')) }}</textarea>
                                            @error('description_en')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-xl-8 mb-3">
                                            <label for="ckeditor1" class="form-label">Body-Ar<span class="text-danger">*</span></label>
                                            {{-- <div class="card-body custom-ekeditor"> --}}
                                            <textarea id="ckeditor1" class="form-txtarea form-control" rows="8" name="description_ar">{{ old('description_ar',$partner->getTranslation('description','ar')) }}</textarea>
                                            {{-- </div> --}}
                                            @error('description_ar')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-xl-8 mb-3">
                                            <label for="ckeditor2" class="form-label">Body-Fr</label>
                                        {{-- <div class="card-body custom-ekeditor"> --}}
                                            <textarea id="ckeditor2" class="form-txtarea form-control" rows="8" name="description_fr">{{ old('description_fr',$partner->getTranslation('description','fr')) }}</textarea>
                                        {{-- </div> --}}
                                        </div>
                                        <div class="col-xl-8 mb-3">
                                            <label for="ckeditor3" class="form-label">Body-Es</label>
                                            {{-- <div class="card-body custom-ekeditor"> --}}
                                            <textarea id="ckeditor3" class="form-txtarea form-control" rows="8" name="description_es">{{ old('description_es',$partner->getTranslation('description','es')) }}</textarea>
                                            {{-- </div> --}}
                                        </div>
                                        <div class="col-xl-8 mb-3">
                                            <label for="ckeditor4" class="form-label">Body-Ru</label>
                                            {{-- <div class="card-body custom-ekeditor"> --}}
                                            <textarea id="ckeditor4" class="form-txtarea form-control" rows="8" name="description_ru">{{ old('description_ru',$partner->getTranslation('description','ru')) }}</textarea>
                                            {{-- </div> --}}
                                        </div>

                                        <div class="col-xl-8 mb-3">
                                            <label class="form-label">Phone<span class="text-danger">*</span></label>
                                            <input type="phone" class="form-control" name="phone" value="{{ old('phone',$partner->phone) }}">
                                            @error('phone')
                                            <div class="text-danger">{{ $message }}</div>
                                             @enderror
                                        </div>

                                        <div class="col-xl-8 mb-3">
                                            <label class="form-label">Whatsapp<span class="text-danger">*</span></label>
                                            <input type="phone" class="form-control" name="whatsapp" value="{{ old('whatsapp',$partner->whatsapp) }}">
                                            @error('whatsapp')
                                            <div class="text-danger">{{ $message }}</div>
                                             @enderror
                                        </div>

                                        <div class="col-xl-8 mb-3">
                                            <label for="exampleFormControlInputthird" class="form-label">Start Price<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="exampleFormControlInputthird" name="start_price" value="{{ old('start_price',$partner->start_price) }}">
                                            @error('start_price')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-xl-8 mb-3">
                                            <label for="exampleFormControlInputthird" class="form-label">Price Rate<span class="text-danger">*</span></label>
                                            <input type="number" min="1" max="5" class="form-control" id="exampleFormControlInputthird" name="price_rate" value="{{ old('price_rate',$partner->price_rate) }}">
                                            @error('price_rate')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-xl-8 mb-3">
                                            <label class="form-label">Video Url</label>
                                            <input type="url" class="form-control" name="video_url" value="{{ old('video_url',$partner->video_url) }}">
                                            @error('video_url')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        <div id="cats-list" class="col-xl-8 mb-3">
                                            <label class="form-label">Subcategories</label>
                                        <div class="dropdown bootstrap-select show-tick default-select form-control wide">
                                            <select name="subcategories[]" multiple="" class="default-select form-control wide" tabindex="null">
                                                @if (count($subcategories)>0)
                                                    @foreach ($subcategories as $subcategory)
                                                        <option value="{{ $subcategory->id }}" @selected(in_array($subcategory->id,old('subcategories',$partner?->subcategories?->pluck('id')->toArray())))>{{ $subcategory->name }}</option>
                                                    @endforeach
                                                @else
                                                    <option selected>Add Subcategories It's required</option>
                                                @endif
                                            </select>
                                        </div>


                                        @error('subcategories')
                                        <div class="text-danger">{{ $message }}</div>
                                         @enderror
                                        </div>
                                        <div class="col-xl-8 mb-3">
                                            <label for="image" class="form-label">Logo</label>
                                            <input class="form-control" type="file" name="logo" id="image">
                                            @error('logo')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-xl-8 mb-3">
                                            <label for="file" class="form-label">Attachement</label>
                                            <input class="form-control" type="file" name="file" id="file">
                                            @error('file')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-xl-8 mb-3">
                                            <label class="form-label">Suggested As Start<span class="text-danger">*</span></label>
                                            <div class="form-check">
                                                <input class="form-check-input" id="notsuggested" type="radio" name="start_status" value="0" @checked(old('start_status',$partner->start_status)==0)>
                                                <label class="form-check-label" for="notsuggested">
                                                    Not Suggested
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" id="suggested" type="radio" name="start_status" value="1" @checked(old('start_status',$partner->start_status)==1)>
                                                <label class="form-check-label" for="suggested">
                                                    Suggested
                                                </label>
                                            </div>
                                            @error('start_status')
                                            <div class="text-danger">{{ $message }}</div>
                                             @enderror
                                        </div>
                                        <div class="col-xl-8 mb-3">
                                            <label class="form-label">Status<span class="text-danger">*</span></label>
                                            <div class="form-check">
                                                <input class="form-check-input" id="inActive" type="radio" name="status" value="0" @checked(old('status',$partner->status)==0)>
                                                <label class="form-check-label" for="inActive">
                                                    InActive
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" id="active" type="radio" name="status" value="1" @checked(old('status',$partner->status)==1)>
                                                <label class="form-check-label" for="active">
                                                    Active
                                                </label>
                                            </div>
                                            @error('status')
                                            <div class="text-danger">{{ $message }}</div>
                                             @enderror
                                        </div>
                                    <div class="col-xl-8 mb-3">
                                        <input type="submit" class="btn btn-primary me-1" value='Update '>
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

    <!--**********************************
        Content body end
    ***********************************-->
    {{-- @push('javasc')
    <script>
    ClassicEditor
    .create( document.querySelector( '#ckeditor1'),{language: 'en'} )
        .catch( error => {
            console.error( error );
        } );
    ClassicEditor
    .create( document.querySelector( '#ckeditor2'),{language: 'fr'} )
        .catch( error => {
            console.error( error );
        } );
    ClassicEditor
    .create( document.querySelector( '#ckeditor3'),{language: 'es'} )
        .catch( error => {
            console.error( error );
        } );
    ClassicEditor
    .create( document.querySelector( '#ckeditor4'),{language: 'ru'} )
        .catch( error => {
            console.error( error );
        } );
    </script>
    @endpush --}}
</x-admin-layouts.admin-app>
