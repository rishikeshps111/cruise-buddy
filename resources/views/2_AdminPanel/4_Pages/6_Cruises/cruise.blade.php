<x-app-layout>

    <!-- Breadcrumb -->
    @component('2_AdminPanel.5_Components.breadcrumb', ['title' => 'Cruises', 'activePage' => 'Cruises'])
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
                                    <h4 class="card-title">Cruises Table</h4>
                                </div>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="offcanvas" role="button"
                                    aria-controls="offcanvasExample" id="addCruiseButton">+ Add
                                    Cruise</button>
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
                                                        <th>Cruise Name</th>
                                                        <th>Owner ID</th>
                                                        <th>Owner Name</th>
                                                        <th>Deck Type</th>
                                                        <th>Rooms</th>
                                                        <th>Max Capacity</th>
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
                                                        <th><input class="form-control" type="number"
                                                                placeholder="Filter by ID" name="owner_id">
                                                        </th>
                                                        <th><input class="form-control" type="text"
                                                                placeholder="Filter by Owner" name="owner_name">
                                                        </th>
                                                        <th>
                                                            <select class="form-control-sm mb-2" name="type">
                                                                <option value="">All Cruise Type</option>
                                                                @foreach ($cruise_types as $cruise_type)
                                                                <option value="{{ $cruise_type->id }}">{{ toCamelCase($cruise_type->model_name) }} - {{ $cruise_type->type }}</option>
                                                                @endforeach
                                                            </select>
                                                        </th>

                                                        <th><input class="form-control" type="number"
                                                                placeholder="Filter by Rooms" name="rooms">
                                                        </th>
                                                        <th><input class="form-control" type="number"
                                                                placeholder="Filter by Capacity" name="max_capacity">
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
