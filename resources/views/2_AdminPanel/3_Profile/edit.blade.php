<x-app-layout>
    <!-- Breadcrumb -->
    @component('2_AdminPanel.5_Components.breadcrumb', ['title' => 'Profile', 'activePage' => 'Profile'])
    @endcomponent

    <div class="container-fluid">
        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="profile card card-body px-3 pt-3 pb-0">
                    <div class="profile-head">
                        <div class="photo-content">
                            <div class="cover-photo rounded"></div>
                        </div>
                        <div class="profile-info">
                            <div class="profile-photo">
                                <img src="{{ Auth::user()->image_path ? asset('storage/' . Auth::user()->image_path) : asset('2_AdminPanel/assets/images/dummy-avatar.jpg') }}"
                                    class="img-fluid rounded-circle" alt="">
                            </div>
                            <div class="profile-details">
                                <div class="profile-name px-3 pt-2">
                                    <h4 class="text-primary mb-0">{{ Auth::user()->name }}</h4>
                                    <p>{{ ucfirst(Auth::user()->getRoleNames()->first()) }}</p>
                                </div>
                                <div class="profile-email px-2 pt-2">
                                    <h4 class="text-muted mb-0">{{ Auth::user()->email }}</h4>
                                    <p>Email</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card h-auto">
                    <div class="card-body">
                        <div class="profile-tab">
                            <div class="custom-tab-1">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item"><a href="#edit-profile" data-bs-toggle="tab"
                                            class="nav-link profile-nav active show">Edit Profile</a>
                                    </li>
                                    <li class="nav-item"><a href="#change-password" data-bs-toggle="tab"
                                            class="nav-link profile-nav">Change Password</a>
                                    </li>
                                    <!-- <li class="nav-item"><a href="#delete-account" data-bs-toggle="tab"
                                            class="nav-link profile-nav">Delete Account</a>
                                    </li> -->
                                </ul>
                                <div class="tab-content">
                                    <div id="edit-profile" class="tab-pane fade active show">
                                        <div class="card mt-3">
                                            @include('2_AdminPanel.3_Profile.partials.update-profile-information-form')
                                        </div>
                                    </div>
                                    <div id="change-password" class="tab-pane fade">
                                        <div class="profile-about-me">
                                            <div class="card mt-3">
                                                @include('2_AdminPanel.3_Profile.partials.update-password-form')
                                            </div>
                                        </div>
                                    </div>
                                    <div id="delete-account" class="tab-pane fade">
                                        <div class="card mt-3">
                                            @include('2_AdminPanel.3_Profile.partials.delete-user-form')
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
</x-app-layout>