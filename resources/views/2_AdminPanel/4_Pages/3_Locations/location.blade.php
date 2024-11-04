<x-app-layout>

    <!-- Breadcrumb -->
    @component('2_AdminPanel.5_Components.breadcrumb', ['title' => 'Locations', 'activePage' => 'Locations'])
    @endcomponent

    <!-- container starts -->
    <div class="container-fluid">
        <!-- row -->
        <div class="row">
            <div class="col-xl-12">
                <div class="container-fluid pt-0 ps-0 pe-lg-4 pe-0">
                    <!-- Column starts -->
                    <div class="col-xl-12">
                        <div class="card dz-card" id="accordion-three">
                            <div class="card-header flex-wrap d-flex justify-content-between">
                                <div>
                                    <h4 class="card-title">Locations Table</h4>
                                </div>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="offcanvas" role="button"
                                    aria-controls="offcanvasExample" id="addLocationButton">+ Add
                                    Location</button>
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
                                                        <th>Thumbnail</th>
                                                        <th>Location</th>
                                                        <th>District</th>
                                                        <th>State</th>
                                                        <th>Country</th>
                                                        <th>Map URL</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr class="filter-row">
                                                        <th><input class="form-control" type="text" disabled></th>
                                                        <th><input class="form-control" type="text" disabled></th>
                                                        <th><input class="form-control" type="text"
                                                                placeholder="Filter by Location"></th>
                                                        <th><input class="form-control" type="text"
                                                                placeholder="Filter by District"></th>
                                                        <th><input class="form-control" type="text"
                                                                placeholder="Filter by State"></th>
                                                        <th><input class="form-control" type="text"
                                                                placeholder="Filter by Country"></th>
                                                        <th><input class="form-control" type="text" disabled></th>
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
