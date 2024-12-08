<x-app-layout>

    @section('styles')
        <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
        <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
            rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('2_AdminPanel/assets/css/filepondcustom.css') }}">
        <link rel="stylesheet" href="{{ asset('2_AdminPanel/assets/vendor/select2/css/select2.min.css') }}">
    @endsection

    <!-- Breadcrumb -->
    @component('2_AdminPanel.5_Components.breadcrumb', [
        'title' => isset($data) ? 'Edit Package' : 'Add Package',
        'activePage' => isset($data) ? 'Edit Package' : 'Add Package',
    ])
    @endcomponent

    <form class="container-fluid" id="PackageForm"
        action="{{ isset($data) ? route('packages.update', $data->id) : route('packages.store') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <!-- Row -->
        @if (isset($data))
            <input name="_method" type="hidden" value="PUT">
            <input type="hidden" name="id" value="{{ $data->id }}">
        @endif

        <div class="row">
            <div class="col-xl-12">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="filter cm-content-box box-primary">
                            <div class="card-header flex-wrap border-0">
                                <div>
                                    <h4 class="card-title">{{ $cruise->name }}</h4>
                                    <p class="m-0 subtitle">
                                        @if (isset($data))
                                            Update {{ $cruise->name }} {{ toCamelCase($data->name) }} Package
                                        @else
                                            Add Package For {{ $cruise->name }}
                                        @endif
                                    </p>
                                </div>
                                <ul class="nav nav-tabs dzm-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a href="{{ route('cruises.show', ['slug' => $cruise->slug]) }}" class="nav-link"
                                            id="home-tab">Back</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="filter cm-content-box box-primary">
                            <div class="content-title">
                                <div class="cpa"> Category
                                </div>
                            </div>
                            <div class="cm-content-body publish-content form excerpt">
                                <div class="card-body">
                                    <div class="mb-3 form-field">
                                        <select class="default-select style-1 form-control" id="category"
                                            name="category">
                                            <option value="" data-display="Select"
                                                {{ empty($data->name) ? 'selected' : '' }}>Please select Category
                                            </option>
                                            <option value="premium" data-display="Select"
                                                {{ ($data->name ?? '') == 'premium' ? 'selected' : '' }}>
                                                Premium
                                            </option>
                                            <option value="dulex" data-display="Select"
                                                {{ ($data->name ?? '') == 'dulex' ? 'selected' : '' }}>
                                                Dulex
                                            </option>
                                        </select>
                                        <div class="validate-category"></div>
                                        <x-input-error :messages="$errors->get('category')" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="filter cm-content-box box-primary">
                            <div class="content-title">
                                <div class="cpa"> Description
                                </div>
                            </div>
                            <div class="cm-content-body publish-content form excerpt">
                                <div class="card-body">
                                    <div class="mb-3 form-field">
                                        {{-- <div class="form-text">Descriptions are optional hand-crafted summaries of your
                                            packages that can be displayed in your theme.</div> --}}
                                        <textarea class="form-control" rows="3" name="description" placeholder="Enter the Description" id="description">{{ $data->description ?? '' }}</textarea>
                                        <x-input-error :messages="$errors->get('description')" />

                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="filter cm-content-box box-primary">
                            <div class="content-title">
                                <div class="cpa">
                                    Pricing
                                </div>
                            </div>
                            <div class="cm-content-body form excerpt">
                                <div class="card-body">
                                    <h6>Add New Custom Field:</h6>
                                    <div class="row">
                                        <div class="col-xl-6 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Title</label>
                                                <input type="text" class="form-control" placeholder="Title">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-sm-6">
                                            <label class="form-label">Value</label>
                                            <textarea class="form-control" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary btn-sm mt-3 mt-sm-0">Add Custom
                                        Field</button>
                                    <span class="mt-3 d-block">Custom fields can be used to extra metadata to a post
                                        that you can use in your theme.</span>
                                </div>
                            </div>
                        </div> --}}
                        <div class="filter cm-content-box box-primary">
                            <div class="content-title">
                                <div class="cpa"> Slug
                                </div>
                            </div>
                            <div class="cm-content-body form excerpt">
                                <div class="card-body form-field">
                                    <input type="text" name="cruise_slug" id="cruise_slug"
                                        value="{{ $slug }}" hidden>
                                    <input type="text" class="form-control" name="slug" id="slug"
                                        value="{{ $data->slug ?? '' }}" placeholder="Enter the Slug">
                                    <x-input-error :messages="$errors->get('slug')" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="right-sidebar-sticky">
                            <div class="filter cm-content-box box-primary">
                                <div class="content-title">
                                    <div class="cpa">
                                        Status
                                    </div>
                                </div>
                                <div class="cm-content-body publish-content form excerpt">
                                    <div class="card-body pb-0">
                                        <div class="mt-1">
                                            <div class="form-check custom-checkbox form-check-inline">
                                                <input type="radio" class="form-check-input" name="is_active"
                                                    value="1"
                                                    {{ old('is_active', $data->is_active ?? 1) == 1 ? 'checked' : '' }}>
                                                <x-input-label :value="__('Active')" />
                                            </div>
                                            <div class="form-check custom-checkbox form-check-inline">
                                                <input type="radio" class="form-check-input" name="is_active"
                                                    value="0"
                                                    {{ old('is_active', $data->is_active ?? '') == 0 ? 'checked' : '' }}>
                                                <x-input-label :value="__('Inactive')" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer border-0 pt-0 text-end">
                                        {{-- <a href=""
                                            class="btn btn-danger light btn-sm">Back</a> --}}
                                        <button type="submit"
                                            class="btn btn-primary btn-sm">{{ isset($data) ? 'Update' : 'Save' }}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="filter cm-content-box box-primary">
                                <div class="content-title">
                                    <div class="cpa">
                                        Amenities
                                    </div>
                                </div>
                                <div class="cm-content-body  form excerpt">
                                    <div class="card-body">
                                        <select id="multi-value-select" multiple="multiple"
                                            data-placeholder="Select options" name="amenities[]">
                                            @foreach ($amenities as $amenity)
                                                <option value="{{ $amenity->id }}"
                                                    @if (isset($data)) @foreach ($data->amenities as $selectedAmenity)
                                                            {{ $selectedAmenity->id == $amenity->id ? 'selected' : '' }} 
                                                        @endforeach @endif>
                                                    {{ $amenity->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="validate-amenity"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="filter cm-content-box box-primary">
                                <div class="content-title">
                                    <div class="cpa">
                                        Images
                                    </div>
                                </div>
                                <div class="cm-content-body publish-content form excerpt">
                                    <div class="card-body form-field">
                                        @if (isset($data))
                                            <div class="row image-area m-2"
                                                style="max-height: 180px; overflow-y: auto;">
                                                @if ($data->packageImages->isEmpty())
                                                    <div class="col-12">
                                                        <p class="text-center">No Images Available</p>
                                                    </div>
                                                @else
                                                    @foreach ($data->packageImages as $image)
                                                        <div class="col-3 mb-3 image-section">
                                                            <div class="image-container position-relative">
                                                                <img src="{{ asset($image->package_img) }}"
                                                                    class="img-fluid rounded" alt="Cruise Image">
                                                                <button type="button"
                                                                    class="delete-btn position-absolute top-1 end-1 btn btn-danger shadow btn-xs sharp DeleteImage"
                                                                    data-id="{{ $image->id }}"><i
                                                                        class="fa fa-trash"></i></button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        @endif
                                        <input type="file" name="images" id="package_images" multiple
                                            credits="false" />
                                        <x-input-error :messages="$errors->get('package_images')" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <x-modal id="commonModal" />

    @section('scripts')
        <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
        <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
        <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
        <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

        <!--select plugins-file-->
        <script src="{{ asset('2_AdminPanel/assets/vendor/select2/js/select2.full.min.js') }}"></script>
        <script src="{{ asset('2_AdminPanel/assets/js/plugins-init/select2-init.js') }}"></script>

        <script src="{{ asset('2_AdminPanel/PageConfigs/cruise.form.js') }}"></script>
    @endsection
</x-app-layout>
