<x-app-layout>

    <!-- Breadcrumb -->
    @component('2_AdminPanel.5_Components.breadcrumb', ['title' => 'Owners', 'activePage' => 'Owners'])
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
                                    <h4 class="card-title">Owners Table</h4>
                                </div>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="offcanvas" role="button"
                                    aria-controls="offcanvasExample" id="addOwnerButton">+ Add
                                    Owner</button>
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
                                                        <th>Image</th>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Phone</th>
                                                        <th>Proof</th>
                                                        <th>Proof ID</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr class="filter-row">
                                                        <th><input class="form-control" type="text" disabled></th>
                                                        <th><input class="form-control" type="text" disabled></th>
                                                        <th><input class="form-control" type="text"
                                                                placeholder="Filter by Name"></th>
                                                        <th><input class="form-control" type="text"
                                                                placeholder="Filter by Email"></th>
                                                        <th><input class="form-control" type="text"
                                                                placeholder="Filter by Phone"></th>
                                                        <th><input class="form-control" type="text" disabled></th>
                                                        <th><input class="form-control" type="text"
                                                                placeholder="Filter by Proof ID"></th>
                                                        <th>
                                                            <select id="statusFilter" class="form-control-sm mb-2">
                                                                <option value="">All</option>
                                                                <option value="1">Active</option>
                                                                <option value="0">Inactive</option>
                                                            </select>
                                                        </th>
                                                        <th><button id="resetButton" class="btn btn-danger"><i
                                                                    class="fa-solid fa-filter me-2"></i></button></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($owners as $index => $owner)
                                                        <tr>
                                                            <td>
                                                                {{ $loop->index + 1 }}
                                                            </td>
                                                            <td><img class="rounded-circle" width="35"
                                                                    src="{{ asset('2_AdminPanel/assets/images/profile/small/pic1.jpg') }}"
                                                                    alt=""></td>
                                                            <td>{{ $owner->user->name }}</td>
                                                            <td>{{ $owner->user->email }}</td>
                                                            <td>{{ $owner->user->country_code }}
                                                                {{ $owner->user->phone }}</td>
                                                            <td><img class="rounded-circle" width="35"
                                                                    src="{{ asset('2_AdminPanel/assets/images/profile/small/pic1.jpg') }}"
                                                                    alt=""></td>

                                                            <td>{{ $owner->proof_id }}</td>
                                                            <td data-status="{{ $owner->user->is_active }}">
                                                                @if ($owner->user->is_active == 1)
                                                                    <span
                                                                        class="badge badge-success light border-0">Active</span>
                                                                @else
                                                                    <span
                                                                        class="badge badge-danger light border-0">Inactive</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <div class="d-flex">
                                                                    <a href="#"
                                                                        class="btn btn-info shadow btn-xs sharp me-1"><i
                                                                            class="fa fa-eye"></i></a>
                                                                    <a class="btn btn-primary shadow btn-xs sharp me-1 EditOwner"
                                                                        data-id="{{ $owner->id }}"><i
                                                                            class="fas fa-pencil-alt"></i></a>
                                                                    <a href="#"
                                                                        class="btn btn-danger shadow btn-xs sharp"><i
                                                                            class="fa fa-trash"></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
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
    <x-modal id="commonModal" />
</x-app-layout>
