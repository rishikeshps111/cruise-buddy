<x-app-layout>

    <!-- Breadcrumb -->
    @component('2_AdminPanel.5_Components.breadcrumb', ['title' => 'Cruise Type', 'activePage' => 'Cruise Type'])
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
                                    <h4 class="card-title">Cruise Type Table</h4>
                                </div>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="offcanvas" role="button"
                                    aria-controls="offcanvasExample" id="addCruiseTypeButton">+ Add
                                    Cruise Type</button>
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
                                                        <th>Model Name</th>
                                                        <th>Type</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr class="filter-row">
                                                        <th><input class="form-control" type="text" disabled></th>
                                                        <th>
                                                            <select id="statusFilter" class="form-control-sm mb-2"
                                                                name="model_name">
                                                                <option value="">All Model Name</option>
                                                                <option value="normal">Normal</option>
                                                                <option value="full_upper_deck">FullUpperDeck</option>
                                                                <option value="semi_upper_deck">SemiUpperDeck</option>
                                                            </select>
                                                        </th>
                                                        <th>
                                                            <select id="statusFilter" class="form-control-sm mb-2"
                                                                name="type">
                                                                <option value="">All Type</option>
                                                                <option value="open">Open</option>
                                                                <option value="closed">Closed</option>
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
