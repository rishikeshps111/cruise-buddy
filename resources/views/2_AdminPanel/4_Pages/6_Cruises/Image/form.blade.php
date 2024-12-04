<form id="commonModalImagesForm" action="{{ route('cruises-image.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if ($data)
        <input type="hidden" name="cruise_id" value="{{ $data->id }}">
    @endif
    <div class="row">
        <div class="mb-3 col-md-9" style="max-height: 550px; overflow-y: auto;">
            <div class="row image-area">
                @if ($data->cruisesImages->isEmpty())
                    <div class="col-12">
                        <p class="text-center">No Images Available</p>
                    </div>
                @else
                    @foreach ($data->cruisesImages as $image)
                        <div class="col-md-3 mb-3 image-section">
                            <div class="image-container position-relative">
                                <img src="{{ asset($image->cruise_img) }}" class="img-fluid rounded" alt="Cruise Image">
                                <button type="button"
                                    class="delete-btn position-absolute top-1 end-1 btn btn-danger shadow btn-xs sharp DeleteImage"
                                    data-id="{{ $image->id }}"><i class="fa fa-trash"></i></button>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="mb-3 col-md-3" style="max-height: 500px; overflow-y: auto;">
            <div class="row">
                <div class="mb-3 col-md-12">
                    {{-- <x-input-label for="cruise_images" :value="__('Cruise Images')" /> --}}
                    <input type="file" name="cruise_images" id="cruise_images" multiple credits="false" />
                    <x-input-error :messages="$errors->get('cruise_images')" />
                </div>
                <div class="mb-3 col-md-12 d-flex justify-content-end mt-2">
                    <button type="submit" class="btn btn-primary w-100" id="commonModalSubmitButton">Save</button>
                </div>
            </div>
        </div>
        {{-- <div class="mb-3 col-md-12 d-flex justify-content-end mt-2">
            <button type="button" class="btn btn-danger light me-2" data-bs-dismiss="modal">Close</button>
        </div> --}}

    </div>
</form>
