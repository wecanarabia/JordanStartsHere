<x-admin-layouts.admin-app>
    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="page-titles">
            <ol class="breadcrumb">
                <li><h5 class="bc-title">{{ $area->name }}</h5></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">
                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.125 6.375L8.5 1.41667L14.875 6.375V14.1667C14.875 14.5424 14.7257 14.9027 14.4601 15.1684C14.1944 15.4341 13.8341 15.5833 13.4583 15.5833H3.54167C3.16594 15.5833 2.80561 15.4341 2.53993 15.1684C2.27426 14.9027 2.125 14.5424 2.125 14.1667V6.375Z" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6.375 15.5833V8.5H10.625V15.5833" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Home </a>
                </li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $area->name }} </a></li>
            </ol>
            <a class="text-primary fs-13" href="{{ route('admin.areas.index') }}" >{{  __('Area') }}</a>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="offcanvas-body">
                                <div class="container-fluid">
                                <h4 class="heading mb-5"> {{ $area->name }}</h4>

                                    <p class="mb-3"><strong>Name-En : </strong> {!! $area->getTranslation('name', 'en') !!}</p>
                                    <p class="mb-3"><strong>Name-Ar : </strong> {!! $area->getTranslation('name', 'ar') !!}</p>
                                    <p class="mb-3"><strong>Name-Fr : </strong> {!! $area->getTranslation('name', 'fr') !!}</p>
                                    <p class="mb-3"><strong>Name-Es : </strong> {!! $area->getTranslation('name', 'es') !!}</p>
                                    <p class="mb-3"><strong>Name-Ko : </strong> {!! $area->getTranslation('name', 'ko') !!}</p>
                                    <p class="mb-3"><strong>City : </strong> <a href="{{ route('admin.cities.show',$area->city->id) }}">{{ $area->city->name }}</a></p>

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