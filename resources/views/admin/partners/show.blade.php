<x-admin-layouts.admin-app>
    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="page-titles">
            <ol class="breadcrumb">
                <li><h5 class="bc-title">{{ $partner->name }}</h5></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">
                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.125 6.375L8.5 1.41667L14.875 6.375V14.1667C14.875 14.5424 14.7257 14.9027 14.4601 15.1684C14.1944 15.4341 13.8341 15.5833 13.4583 15.5833H3.54167C3.16594 15.5833 2.80561 15.4341 2.53993 15.1684C2.27426 14.9027 2.125 14.5424 2.125 14.1667V6.375Z" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6.375 15.5833V8.5H10.625V15.5833" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Home </a>
                </li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $partner->name }} </a></li>
            </ol>
            <a class="text-primary fs-13" href="{{ route('admin.partners.index') }}" >{{  __('Services') }}</a>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="offcanvas-body">
                                <div class="container-fluid">
                                <h4 class="heading mb-5"> {{ $partner->name }}</h4>

                                    <p class="mb-3"><strong>Id : </strong> {{  $partner->id  }}</p>
                                    <p class="mb-3"><strong>Name-En : </strong> {{ $partner->getTranslation('name', 'en') }}</p>
                                    <p class="mb-3"><strong>Name-Ar : </strong> {{ $partner->getTranslation('name', 'ar') }}</p>
                                    <p class="mb-3"><strong>Name-Fr : </strong> {{ $partner->getTranslation('name', 'fr') }}</p>
                                    <p class="mb-3"><strong>Name-Es : </strong> {{ $partner->getTranslation('name', 'es') }}</p>
                                    <p class="mb-3"><strong>Name-Ko : </strong> {{ $partner->getTranslation('name', 'ko') }}</p>
                                    <p class="mb-3"><strong>Body-En : </strong> {{ $partner->getTranslation('description', 'en') }}</p>
                                    <p class="mb-3"><strong>Body-Ar : </strong> {{ $partner->getTranslation('description', 'ar') }}</p>
                                    <p class="mb-3"><strong>Body-Fr : </strong> {{ $partner->getTranslation('description', 'fr') }}</p>
                                    <p class="mb-3"><strong>Body-Es : </strong> {{ $partner->getTranslation('description', 'es') }}</p>
                                    <p class="mb-3"><strong>Body-Ko : </strong> {{ $partner->getTranslation('description', 'ko') }}</p>
                                    <p class="mb-3"><strong>Phone :</strong> {{ $partner->phone }}</p>
                                    <p class="mb-3"><strong>Whatsapp :</strong> {{ $partner->whatsapp }}</p>
                                    <p class="mb-3"><strong>Suggested as Start :</strong> {{ $partner->start_status == 1? 'Suggested' : 'Not Suggested' }}</p>
                                    <p class="mb-3"><strong>Status :</strong> {{ $partner->status == 1? 'Active' : 'InActive' }}</p>
                                    <p class="mb-3"><strong>Start Price :</strong> {{ $partner?->start_price}}</p>
                                    <p class="mb-3"><strong>Pricce Rate : </strong> {{ $partner->price_rate }}</p>
                                    <p class="mb-3"><strong>Video Url : </strong> {{ $partner->video_url }}</p>
                                    <p class="mb-3"><strong>Created At :</strong> {{ $partner?->created_at }}</p>
                                    @if ($partner->file)
                                    <p class="mb-3"><strong>File :</strong> <a href="{{ route('admin.partners.file',$partner->id) }}">{{ $partner->name }}</a></p>
                                    @endif
                                    <img class="card-img-bottom img-thumbnail mb-3" style="width: 500px" src="{{ asset( $partner->logo ) }}" alt="{{ $partner->name }}">

                        </div>

                        </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="offcanvas-body">
                                <div class="container-fluid">
                                    <x-admin-layouts.alerts />
                                    <div class="table-responsive active-projects manage-client">
                                        <div class="tbl-caption">
                                            <h4 class="heading mb-0"> {{ __('Subcategories') }}</h4>
                                        </div>
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="Preview" role="tabpanel"
                                                aria-labelledby="home-tab">
                                                <div class="card-body pt-0">
                                                    <div class="table-responsive">
                                                        <table id="example" class="display table"
                                                            style="min-width: 845px">
                                                            <thead>
                                                                <tr>
                                                                    <th>Name-En</th>
                                                                    <th>Name-Ar</th>
                                                                    <th>Category</th>


                                                                    <th>actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse ($partner->subcategories as $subcategory)
                                                                    <tr>

                                                                        <td><span>{{ $subcategory->getTranslation('name', 'en') }}</span>
                                                                        </td>
                                                                        <td>
                                                                            <span>{{ $subcategory->getTranslation('name', 'ar') }}</span>
                                                                        </td>
                                                                        <td>
                                                                            <span><a href="{{ route('admin.categories.show', $subcategory->category->id) }}">{{ $subcategory->category->name }}</a></span>
                                                                        </td>


                                                                        <td>
                                                                            <div class="dropdown">
                                                                                <button type="button"
                                                                                    class="btn btn-success light sharp"
                                                                                    data-bs-toggle="dropdown">
                                                                                    <svg width="20px" height="20px"
                                                                                        viewBox="0 0 24 24"
                                                                                        version="1.1">
                                                                                        <g stroke="none"
                                                                                            stroke-width="1"
                                                                                            fill="none"
                                                                                            fill-rule="evenodd">
                                                                                            <rect x="0"
                                                                                                y="0"
                                                                                                width="24"
                                                                                                height="24" />
                                                                                            <circle fill="#000000"
                                                                                                cx="5"
                                                                                                cy="12"
                                                                                                r="2" />
                                                                                            <circle fill="#000000"
                                                                                                cx="12"
                                                                                                cy="12"
                                                                                                r="2" />
                                                                                            <circle fill="#000000"
                                                                                                cx="19"
                                                                                                cy="12"
                                                                                                r="2" />
                                                                                        </g>
                                                                                    </svg>
                                                                                </button>
                                                                                <div class="dropdown-menu">
                                                                                    <a class="dropdown-item"
                                                                                        href="{{ route('admin.subcategories.edit', $subcategory->id) }}">Edit</a>
                                                                                    <a class="dropdown-item"
                                                                                        href="{{ route('admin.subcategories.show', $subcategory->id) }}">Show</a>                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>

                                                                @empty
                                                                    <tr>
                                                                        <th colspan="5">
                                                                            <h5 class="text-center">There is No data
                                                                            </h5>
                                                                        </th>
                                                                    </tr>
                                                                @endforelse

                                                            </tbody>

                                                        </table>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="offcanvas-body">
                                <div class="container-fluid">
                                    <div class="table-responsive active-projects manage-client">
                                        <div class="tbl-caption">
                                            <h4 class="heading mb-0"> {{ __('Portrait Images') }}</h4>
                                        </div>
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="Preview" role="tabpanel"
                                                aria-labelledby="home-tab">
                                                <div class="card-body pt-0">
                                                    <div class="table-responsive">
                                                        <table id="example" class="display table"
                                                            style="min-width: 845px">
                                                            <thead>
                                                                <tr>
                                                                    <th>Order</th>
                                                                    <th>Image</th>
                                                                    <th>Sort</th>


                                                                    <th>actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse ($partner->portraits as $image)
                                                                    <tr>
                                                                        <td>{{ $image->order }}</td>
                                                                        <td><span><img src="{{ asset($image->image) }}"
                                                                                    width="150"
                                                                                    alt=""></span></td>

                                                                        <td class="align-center">
                                                                            @if ($partner->portraits()->count()>1)
                                                                            <a
                                                                                href="{{ route('admin.portraits.sort', ['id' => $image->id, 'direction' => 'up']) }}">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    width="22" height="22"
                                                                                    viewBox="0 0 24 24" fill="none"
                                                                                    stroke="#000" stroke-width="1"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round">
                                                                                    <path d="M12 19V6M5 12l7-7 7 7" />
                                                                                </svg>
                                                                            </a>
                                                                            <a
                                                                                href="{{ route('admin.portraits.sort', ['id' => $image->id, 'direction' => 'down']) }}">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    width="22" height="22"
                                                                                    viewBox="0 0 24 24" fill="none"
                                                                                    stroke="#000" stroke-width="1"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round">
                                                                                    <path d="M12 5v13M5 12l7 7 7-7" />
                                                                                </svg>
                                                                            </a>
                                                                            @endif
                                                                        </td>

                                                                        <td>
                                                                            <div class="dropdown">
                                                                                <button type="button"
                                                                                    class="btn btn-success light sharp"
                                                                                    data-bs-toggle="dropdown">
                                                                                    <svg width="20px" height="20px"
                                                                                        viewBox="0 0 24 24"
                                                                                        version="1.1">
                                                                                        <g stroke="none"
                                                                                            stroke-width="1"
                                                                                            fill="none"
                                                                                            fill-rule="evenodd">
                                                                                            <rect x="0"
                                                                                                y="0"
                                                                                                width="24"
                                                                                                height="24" />
                                                                                            <circle fill="#000000"
                                                                                                cx="5"
                                                                                                cy="12"
                                                                                                r="2" />
                                                                                            <circle fill="#000000"
                                                                                                cx="12"
                                                                                                cy="12"
                                                                                                r="2" />
                                                                                            <circle fill="#000000"
                                                                                                cx="19"
                                                                                                cy="12"
                                                                                                r="2" />
                                                                                        </g>
                                                                                    </svg>
                                                                                </button>
                                                                                <div class="dropdown-menu">
                                                                                    <a class="dropdown-item"
                                                                                        href="{{ route('admin.portraits.edit', $image->id) }}">Edit</a>                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>

                                                                @empty
                                                                    <tr>
                                                                        <th colspan="5">
                                                                            <h5 class="text-center">There is No data
                                                                            </h5>
                                                                        </th>
                                                                    </tr>
                                                                @endforelse

                                                            </tbody>

                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
              <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="offcanvas-body">
                                <div class="container-fluid">
                                    <div class="table-responsive active-projects manage-client">
                                        <div class="tbl-caption">
                                            <h4 class="heading mb-0"> {{ __('Landscapes Images') }}</h4>
                                        </div>
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="Preview" role="tabpanel"
                                                aria-labelledby="home-tab">
                                                <div class="card-body pt-0">
                                                    <div class="table-responsive">
                                                        <table id="example" class="display table"
                                                            style="min-width: 845px">
                                                            <thead>
                                                                <tr>
                                                                    <th>Order</th>
                                                                    <th>Image</th>
                                                                    <th>Sort</th>


                                                                    <th>actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse ($partner->landscapes as $image)
                                                                    <tr>
                                                                        <td>{{ $image->order }}</td>
                                                                        <td><span><img src="{{ asset($image->image) }}"
                                                                                    width="150"
                                                                                    alt=""></span></td>


                                                                        <td class="align-center">
                                                                            @if ($partner->landscapes()->count()>1)
                                                                            <a
                                                                                href="{{ route('admin.landscapes.sort', ['id' => $image->id, 'direction' => 'up']) }}">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    width="22" height="22"
                                                                                    viewBox="0 0 24 24" fill="none"
                                                                                    stroke="#000" stroke-width="1"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round">
                                                                                    <path d="M12 19V6M5 12l7-7 7 7" />
                                                                                </svg>
                                                                            </a>
                                                                            <a
                                                                                href="{{ route('admin.landscapes.sort', ['id' => $image->id, 'direction' => 'down']) }}">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    width="22" height="22"
                                                                                    viewBox="0 0 24 24" fill="none"
                                                                                    stroke="#000" stroke-width="1"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round">
                                                                                    <path d="M12 5v13M5 12l7 7 7-7" />
                                                                                </svg>
                                                                            </a>
                                                                            @endif
                                                                        </td>

                                                                        <td>
                                                                            <div class="dropdown">
                                                                                <button type="button"
                                                                                    class="btn btn-success light sharp"
                                                                                    data-bs-toggle="dropdown">
                                                                                    <svg width="20px" height="20px"
                                                                                        viewBox="0 0 24 24"
                                                                                        version="1.1">
                                                                                        <g stroke="none"
                                                                                            stroke-width="1"
                                                                                            fill="none"
                                                                                            fill-rule="evenodd">
                                                                                            <rect x="0"
                                                                                                y="0"
                                                                                                width="24"
                                                                                                height="24" />
                                                                                            <circle fill="#000000"
                                                                                                cx="5"
                                                                                                cy="12"
                                                                                                r="2" />
                                                                                            <circle fill="#000000"
                                                                                                cx="12"
                                                                                                cy="12"
                                                                                                r="2" />
                                                                                            <circle fill="#000000"
                                                                                                cx="19"
                                                                                                cy="12"
                                                                                                r="2" />
                                                                                        </g>
                                                                                    </svg>
                                                                                </button>
                                                                                <div class="dropdown-menu">
                                                                                    <a class="dropdown-item"
                                                                                        href="{{ route('admin.portraits.edit', $image->id) }}">Edit</a>

                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>

                                                                @empty
                                                                    <tr>
                                                                        <th colspan="5">
                                                                            <h5 class="text-center">There is No data
                                                                            </h5>
                                                                        </th>
                                                                    </tr>
                                                                @endforelse

                                                            </tbody>

                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="offcanvas-body">
                                <div class="container-fluid">
                                    <x-admin-layouts.alerts />
                                    <div class="table-responsive active-projects manage-client">
                                        <div class="tbl-caption">
                                            <h4 class="heading mb-0"> {{ __('Whatsapp Counter') }}</h4>
                                        </div>
                                        <div class="tab-content" id="myTabContent">
											<div class="tab-pane fade show active" id="Preview" role="tabpanel" aria-labelledby="home-tab">
											 <div class="card-body pt-0">
												<div class="table-responsive">
													<table id="example" class="display table" style="min-width: 845px">
                                                        <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Month</th>
                                                    <th>Year</th>
                                                    <th>Count</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($partner->whatsappCounter as $count)
                                                    <tr>


                                                        <td>
                                                            <span>{{ $count->date }}</span>
                                                        </td>
                                                        <td>
                                                            <span>{{ $count->month }}</span>
                                                        </td>

                                                        <td>
                                                            <span>{{ $count->year }}</span>
                                                        </td>
                                                        <td>
                                                            <span>{{ $count->count }}</span>
                                                        </td>


                                                    </tr>

                                                @empty
                                                    <tr>
                                                        <th colspan="5">
                                                            <h5 class="text-center">There is No data</h5>
                                                        </th>
                                                    </tr>
                                                @endforelse

                                            </tbody>

                                        </table>
                                                </div>
                                             </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="offcanvas-body">
                                <div class="container-fluid">
                                    <x-admin-layouts.alerts />
                                    <div class="table-responsive active-projects manage-client">
                                        <div class="tbl-caption">
                                            <h4 class="heading mb-0"> {{ __('Call Counter') }}</h4>
                                        </div>
                                        <div class="tab-content" id="myTabContent">
											<div class="tab-pane fade show active" id="Preview" role="tabpanel" aria-labelledby="home-tab">
											 <div class="card-body pt-0">
												<div class="table-responsive">
													<table id="example" class="display table" style="min-width: 845px">
                                                        <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Month</th>
                                                    <th>Year</th>
                                                    <th>Count</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($partner->callCounter as $count)
                                                    <tr>


                                                        <td>
                                                            <span>{{ $count->date }}</span>
                                                        </td>
                                                        <td>
                                                            <span>{{ $count->month }}</span>
                                                        </td>

                                                        <td>
                                                            <span>{{ $count->year }}</span>
                                                        </td>
                                                        <td>
                                                            <span>{{ $count->count }}</span>
                                                        </td>


                                                    </tr>

                                                @empty
                                                    <tr>
                                                        <th colspan="5">
                                                            <h5 class="text-center">There is No data</h5>
                                                        </th>
                                                    </tr>
                                                @endforelse

                                            </tbody>

                                        </table>
                                                </div>
                                             </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="offcanvas-body">
                                <div class="container-fluid">
                                    <x-admin-layouts.alerts />
                                    <div class="table-responsive active-projects manage-client">
                                        <div class="tbl-caption">
                                            <h4 class="heading mb-0"> {{ __('View Counter') }}</h4>
                                        </div>
                                        <div class="tab-content" id="myTabContent">
											<div class="tab-pane fade show active" id="Preview" role="tabpanel" aria-labelledby="home-tab">
											 <div class="card-body pt-0">
												<div class="table-responsive">
													<table id="example" class="display table" style="min-width: 845px">
                                                        <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Month</th>
                                                    <th>Year</th>
                                                    <th>Count</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($partner->viewCounter as $count)
                                                    <tr>


                                                        <td>
                                                            <span>{{ $count->date }}</span>
                                                        </td>
                                                        <td>
                                                            <span>{{ $count->month }}</span>
                                                        </td>

                                                        <td>
                                                            <span>{{ $count->year }}</span>
                                                        </td>
                                                        <td>
                                                            <span>{{ $count->count }}</span>
                                                        </td>


                                                    </tr>

                                                @empty
                                                    <tr>
                                                        <th colspan="5">
                                                            <h5 class="text-center">There is No data</h5>
                                                        </th>
                                                    </tr>
                                                @endforelse

                                            </tbody>

                                        </table>
                                                </div>
                                             </div>
                                            </div>
                                        </div>
                                    </div>
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
