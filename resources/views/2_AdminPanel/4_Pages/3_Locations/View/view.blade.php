<div class="container-fluid p-0">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6">
                            <img src="{{ $location->thumbnail }}" alt="" class="w-100 mt-4 rounded-4">
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="c-card-details mt-4 pt-3">
                                        <ul>
                                            <li>
                                                <h6 class="me-1 mb-0">Name:</h6>
                                                <span class="fs-13">{{ formatDocumentName($location->name) }}</span>
                                            </li>
                                            <li>
                                                <h6 class="me-1 mb-0">District:</h6>
                                                <span
                                                    class="fs-13">{{ formatDocumentName($location->district) }}</span>
                                            </li>
                                            <li>
                                                <h6 class="me-1 mb-0">State:</h6>
                                                <span class="fs-13">{{ formatDocumentName($location->state) }}</span>
                                            </li>
                                            <li>
                                                <h6 class="me-1 mb-0">Country:</h6>
                                                <span class="fs-13">{{ formatDocumentName($location->country) }}</span>
                                            </li>
                                            <li>
                                                <h6 class="me-1 mb-0">Map URL:</h6>
                                                <span class="fs-13"><a href="{{ $location->map_url }}"
                                                        class="text-primary">URL</a></span>
                                            </li>
                                        </ul>
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
