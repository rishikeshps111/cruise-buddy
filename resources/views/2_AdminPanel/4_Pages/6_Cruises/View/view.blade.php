<x-app-layout>

    <!-- Breadcrumb -->
    @component('2_AdminPanel.5_Components.breadcrumb', [
        'title' => 'Cruise Details',
        'activePage' => 'Cruise Details',
    ])
    @endcomponent

    <div class="container-fluid mh-auto">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-3 col-lg-6 col-md-6">
                                <div class="bootstrap-carousel">
                                    @if ($cruise_details->cruisesImages->isNotEmpty())
                                        <div id="carouselExampleIndicators2" class="carousel slide"
                                            data-bs-ride="carousel">
                                            <div class="carousel-indicators">
                                                @foreach ($cruise_details->cruisesImages as $index => $image)
                                                    <button type="button" data-bs-target="#carouselExampleIndicators2"
                                                        data-bs-slide-to="{{ $index }}"
                                                        class="{{ $index === 0 ? 'active' : '' }}"
                                                        aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                                                        aria-label="Slide {{ $index + 1 }}"></button>
                                                @endforeach
                                            </div>

                                            <div class="carousel-inner rounded">
                                                @foreach ($cruise_details->cruisesImages as $index => $image)
                                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                        <img class="d-block w-100" src="{{ asset($image->cruise_img) }}"
                                                            alt="Slide {{ $index + 1 }}" style="height: 300px;">
                                                    </div>
                                                @endforeach
                                            </div>

                                            <button class="carousel-control-prev" type="button"
                                                data-bs-target="#carouselExampleIndicators2" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button"
                                                data-bs-target="#carouselExampleIndicators2" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>
                                    @else
                                        <div class="no-images-available text-center">
                                            <p>No images available</p>
                                        </div>
                                    @endif
                                </div>
                            </div>


                            <!--Tab slider End-->
                            <div class="col-xl-9 col-lg-6 col-md-6 col-sm-12">
                                <div class="product-detail-content">
                                    <!--Product details-->
                                    <div class="new-arrival-content pr">
                                        <h4>{{ $cruise_details->name }}</h4>
                                        <p class="mb-0">Owner Info</p>
                                        <div class="d-flex justify-content-between mb-2">
                                            <div class="d-flex align-items-center py-2">
                                                <div class="d-inline-block position-relative">
                                                    <img src="{{ asset('/storage/' . $cruise_details->owner_image) }}"
                                                        alt="" class="rounded avatar avatar-md">
                                                </div>
                                                <div class="clearfix ms-2">
                                                    <h6 class="fs-14 mb-0 fw-semibold">
                                                        {{ $cruise_details->owner_name }}
                                                    </h6>
                                                    <p>ID: <span class="fs-13">{{ $cruise_details->owner_id }}</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <p>Cruise Model: <span
                                                class="item">{{ formatDocumentName($cruise_details->model_name) }}</span>
                                        </p>
                                        <p>Cruise Type: <span
                                                class="item">{{ formatDocumentName($cruise_details->type) }}</span>
                                        </p>
                                        <p>Rooms: <span class="item">{{ $cruise_details->rooms }}</span></p>
                                        <p>Max Capacity: <span
                                                class="item">{{ $cruise_details->max_capacity }}</span></p>
                                        <p>Location: <span class="item">{{ $cruise_details->district }},
                                                {{ $cruise_details->state }}, {{ $cruise_details->country }}</span>
                                        </p>

                                        <p>Status:&nbsp;&nbsp;
                                            @if ($cruise_details->is_active == 1)
                                                <span class="badge badge-success light">Active</span>
                                            @else
                                                <span class="badge badge-danger light">Inactive</span>
                                            @endif
                                        </p>
                                        <p class="text-content">{{ $cruise_details->description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- row -->
        <div class="row">
            <div class="col-xl-12">
                <div class="container-fluid pt-0 ps-0 pe-lg-0 pe-0">
                    <!-- Column starts -->
                    <div class="col-xl-12">
                        <div class="card dz-card" id="accordion-three">
                            <div class="card-header flex-wrap d-flex justify-content-between">
                                <div>
                                    <h4 class="card-title">{{ $cruise_details->name }} - Packages</h4>
                                </div>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="offcanvas" role="button"
                                    aria-controls="offcanvasExample" id="addCruiseButton">+ Add
                                    Packages</button>
                            </div>
                            <!-- tab-content -->
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="withoutSpace" role="tabpanel"
                                    aria-labelledby="home-tab-2">
                                    <div class="card-body pt-0">
                                        <div class="table-responsive">
                                            <table id="CommonTable" class="display table" style="min-width: 845px">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Images</th>
                                                        <th>Packages Name</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr class="filter-row">
                                                        <th><input class="form-control" type="text" disabled></th>
                                                        <th><input class="form-control" type="text" disabled></th>
                                                        <th><input class="form-control" type="text"
                                                                placeholder="Filter by Name" name="name">
                                                        </th>
                                                        <th>
                                                            <select class="form-control-sm mb-2" name="is_active">
                                                                <option value="">All</option>
                                                                <option value="1">Active</option>
                                                                <option value="0">Inactive</option>
                                                            </select>
                                                        </th>
                                                        <th><button id="resetButton" class="btn btn-danger"><i
                                                                    class="fa-solid fa-filter me-2"></i></button></th>
                                                    </tr>
                                                </thead>
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


    <x-modal id="commonModal" />
</x-app-layout>
