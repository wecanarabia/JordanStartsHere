<x-admin-layouts.admin-app>
    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="page-titles">
            <ol class="breadcrumb">
                <li><h5 class="bc-title">{{ __('Edit City') }}</h5></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">
                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.125 6.375L8.5 1.41667L14.875 6.375V14.1667C14.875 14.5424 14.7257 14.9027 14.4601 15.1684C14.1944 15.4341 13.8341 15.5833 13.4583 15.5833H3.54167C3.16594 15.5833 2.80561 15.4341 2.53993 15.1684C2.27426 14.9027 2.125 14.5424 2.125 14.1667V6.375Z" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6.375 15.5833V8.5H10.625V15.5833" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Home </a>
                </li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{  __('Edit City') }} </a></li>
            </ol>
            <a class="text-primary fs-13" href="{{ route('admin.cities.index') }}" >{{  __('Cities') }}</a>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="offcanvas-body">
                                <div class="container-fluid">
                                <h4 class="heading mb-0"> {{ __('Edit City') }}</h4>

                            <form method="POST" action="{{ route("admin.cities.update",$city->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <input type="hidden" name="id" value="{{ $city->id }}">
                                    <div class="col-xl-8 mb-3">
                                        <label for="ckeditor" class="form-label">Name-En<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="exampleFormControlInputfirst" name="name_en" value="{{ old('name_en',$city->getTranslation('name','en')) }}">

                                        @error('name_en')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-xl-8 mb-3">
                                        <label for="ckeditor1" class="form-label">Name-Ar<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="exampleFormControlInputfirst" name="name_ar" value="{{ old('name_ar',$city->getTranslation('name','ar')) }}">

                                        @error('name_ar')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-xl-8 mb-3">
                                        <label for="ckeditor2" class="form-label">Name-Fr</label>
                                        <input type="text" class="form-control" id="exampleFormControlInputfirst" name="name_fr" value="{{ old('name_fr',$city->getTranslation('name','fr')) }}">

                                    </div>
                                    <div class="col-xl-8 mb-3">
                                        <label for="ckeditor3" class="form-label">Name-Es</label>
                                        <input type="text" class="form-control" id="exampleFormControlInputfirst" name="name_es" value="{{ old('name_es',$city->getTranslation('name','es')) }}">

                                    </div>
                                    <div class="col-xl-8 mb-3">
                                        <label for="ckeditor4" class="form-label">Name-Ru</label>
                                        <input type="text" class="form-control" id="exampleFormControlInputfirst" name="name_ru" value="{{ old('name_ru',$city->getTranslation('name','ru')) }}">

                                    </div>
                                    <div class="col-xl-6 mb-3">
                                        <label for="exampleFormControlInputfirst" class="form-label">Title One(En)<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="exampleFormControlInputfirst" name="title_one_en" value="{{ old('title_one_en',$city->getTranslation('title_one','en')) }}">
                                        @error('title_one_en')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-xl-6 mb-3">
                                        <label for="exampleFormControlInputfirst" class="form-label">Title Two(En)<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="exampleFormControlInputfirst" name="title_two_en" value="{{ old('title_two_en',$city->getTranslation('title_two','en')) }}">
                                        @error('title_two_en')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-xl-6 mb-3">
                                        <label for="exampleFormControlInputfirst" class="form-label">Title One(Ar)<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="exampleFormControlInputfirst" name="title_one_ar" value="{{ old('title_one_ar',$city->getTranslation('title_one','ar')) }}">
                                        @error('title_one_ar')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-xl-6 mb-3">
                                        <label for="exampleFormControlInputfirst" class="form-label">Title Two(Ar)<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="exampleFormControlInputfirst" name="title_two_ar" value="{{ old('title_two_ar',$city->getTranslation('title_two','ar')) }}">
                                        @error('title_two_ar')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-xl-6 mb-3">
                                        <label for="exampleFormControlInputfirst" class="form-label">Title One(Fr)</label>
                                        <input type="text" class="form-control" id="exampleFormControlInputfirst" name="title_one_fr" value="{{ old('title_one_fr',$city->getTranslation('title_one','fr')) }}">

                                    </div>

                                    <div class="col-xl-6 mb-3">
                                        <label for="exampleFormControlInputfirst" class="form-label">Title Two(Fr)</label>
                                        <input type="text" class="form-control" id="exampleFormControlInputfirst" name="title_two_fr" value="{{ old('title_two_fr',$city->getTranslation('title_two','fr')) }}">

                                    </div>

                                    <div class="col-xl-6 mb-3">
                                        <label for="exampleFormControlInputfirst" class="form-label">Title One(Es)</label>
                                        <input type="text" class="form-control" id="exampleFormControlInputfirst" name="title_one_es" value="{{ old('title_one_es',$city->getTranslation('title_one','es')) }}">

                                    </div>

                                    <div class="col-xl-6 mb-3">
                                        <label for="exampleFormControlInputfirst" class="form-label">Title Two(Es)</label>
                                        <input type="text" class="form-control" id="exampleFormControlInputfirst" name="title_two_es" value="{{ old('title_two_es',$city->getTranslation('title_two','es')) }}">

                                    </div>
                                       <div class="col-xl-6 mb-3">
                                        <label for="exampleFormControlInputfirst" class="form-label">Title One(Ru)</label>
                                        <input type="text" class="form-control" id="exampleFormControlInputfirst" name="title_one_ru" value="{{ old('title_one_ru',$city->getTranslation('title_one','ru')) }}">

                                    </div>

                                    <div class="col-xl-6 mb-3">
                                        <label for="exampleFormControlInputfirst" class="form-label">Title Two(Ru)</label>
                                        <input type="text" class="form-control" id="exampleFormControlInputfirst" name="title_two_ru" value="{{ old('title_two_ru',$city->getTranslation('title_two','ru')) }}">

                                    </div>

                                    <div class="col-xl-8 mb-3">
                                        <label for="image" class="form-label">Image</label>
                                        <input class="form-control" type="file" name="image" id="image">
                                        @error('image')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>



                                    <div class="col-xl-8 mb-3">
                                        <input type="submit" class="btn btn-primary me-1" value='Update'>
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

</x-admin-layouts.admin-app>
