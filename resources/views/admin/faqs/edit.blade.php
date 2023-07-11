<x-admin-layouts.admin-app>
    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="page-titles">
            <ol class="breadcrumb">
                <li><h5 class="bc-title">{{ __('Edit Faq') }}</h5></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">
                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.125 6.375L8.5 1.41667L14.875 6.375V14.1667C14.875 14.5424 14.7257 14.9027 14.4601 15.1684C14.1944 15.4341 13.8341 15.5833 13.4583 15.5833H3.54167C3.16594 15.5833 2.80561 15.4341 2.53993 15.1684C2.27426 14.9027 2.125 14.5424 2.125 14.1667V6.375Z" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6.375 15.5833V8.5H10.625V15.5833" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Home </a>
                </li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{  __('Edit Faq') }} </a></li>
            </ol>
            <a class="text-primary fs-13" href="{{ route('admin.faqs.index') }}" >{{  __('Faqs') }}</a>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="offcanvas-body">
                                <div class="container-fluid">
                                <h4 class="heading mb-0"> {{ __('Edit Faq') }}</h4>

                            <form method="POST" action="{{ route("admin.faqs.update",$faq->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                        <input name="id" type="hidden" value="{{ $faq->id }}">
                                        <div class="col-xl-8 mb-3">
                                            <label for="exampleFormControlInputfirst" class="form-label">English Question<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="exampleFormControlInputfirst" name="question_en" placeholder="English Title" value="{{ $faq->getTranslation('question', 'en')??  old('question_en') }}">
                                            @error('question_en')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-xl-8 mb-3">
                                            <label for="exampleFormControlInputsecond" class="form-label">Arabic Question<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="exampleFormControlInputsecond" name="question_ar" placeholder="Arabic Title" value="{{ $faq->getTranslation('question', 'ar')??old('question_ar') }}">
                                            @error('question_ar')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-xl-8 mb-3">
                                        <label for="ckeditor" class="form-label">English Answer<span class="text-danger">*</span></label>
                                        <div class="card-body custom-ekeditor">
                                            <textarea id="ckeditor" class="form-txtarea form-control" rows="8" name="answer_en">{{ old('answer_en',$faq->getTranslation('answer', 'en')) }}</textarea>
                                        </div>
                                            @error('answer_en')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-xl-8 mb-3">
                                        <label for="ckeditor1" class="form-label">Arabic Answer<span class="text-danger">*</span></label>
                                        <div class="card-body custom-ekeditor">

                                        <textarea id="ckeditor1" class="form-txtarea form-control" rows="8" name="answer_ar">{{ old('answer_ar',$faq->getTranslation('answer', 'ar')) }}</textarea>
                                        </div>
                                        @error('answer_ar')
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
    @push('javasc')
    <script>
    ClassicEditor
    .create( document.querySelector( '#ckeditor1' ),{language: 'en'} )
        .catch( error => {
            console.error( error );
        } );
    </script>
    @endpush
</x-admin-layouts.admin-app>
