<div class="container-fluid p-0">
    <div class="row">
        <div class="col-xl-12">
            <div class="card h-auto">
                <div class="card-body">
                    <div class="c-profile text-center">
                        <img src="{{ $data->user->image_path }}" class="img-fluid rounded-circle w-25 mb-2" alt="">
                        <h4 class="mb-0">{{ $data->user->name }}</h4>
                        <p class="mb-0">{{ $data->user->email }}</p>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="c-details">
                                <ul>
                                    <li>
                                        <span>Phone</span>
                                        <p>{{ formatPhone($data->user->phone) }}</p>
                                    </li>
                                    <li>
                                        <span>Type: </span>
                                        <p>{{ formatDocumentName($data->proof_type) }}</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="c-details">
                                <ul>
                                    <li>
                                        <span>Secondary Phone:</span>
                                        <p>{{ formatPhone($data->additional_phone) }}</p>
                                    </li>
                                    <li>
                                        <span>Proof ID:</span>
                                        <p>{{ $data->proof_id }}</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="c-details">
                                <ul>
                                    <li>
                                        <span>Proof: </span>
                                        <img src="{{ $data->proof_image }}" alt="" class="w-100 proof-image">
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="c-details">
                        <ul>
                            <li>
                                <span>Email</span>
                                <p>{{ $data->user->email }}</p>
                            </li>
                            <li>
                                <span>Phone</span>
                                <p>{{ formatPhone($data->user->phone) }}</p>
                            </li>
                            <li>
                                <span>Secondary Phone:</span>
                                <p>{{ formatPhone($data->additional_phone) }}</p>
                            </li>
                            <li>
                                <span>Type: </span>
                                <p>{{ formatDocumentName($data->proof_type) }}</p>
                            </li>
                            <li>
                                <span>Proof ID:</span>
                                <p>{{ $data->proof_id }}</p>
                            </li>
                            <li>
                                <span>Proof: </span>
                                <img src="{{ $data->proof_image }}" alt="" class="w-100 proof-image">
                            </li>

                        </ul>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

</div>
