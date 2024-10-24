<x-app-layout>
    <!-- Breadcrumb -->
    @component('2_AdminPanel.5_Components.breadcrumb', ['title' => 'Profile', 'activePage' => 'Profile'])
    @endcomponent

    <div class="container-fluid">
        <div class="tab-content" id="tabContentMyProfileBottom">
            <div class="row">
                @include('2_AdminPanel.3_Profile.partials.update-profile-information-form')
                <div class="col-xl-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="clearfix">
                                        <h4 class="card-title mb-0">Connected Accounts</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div
                                        class="alert alert-primary border-primary outline-dashed py-3 px-3 mt-1 mb-3 mb-0 text-dark d-flex">
                                        <div class="clearfix">
                                            <svg width="36" height="36" viewBox="0 0 36 36" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M27.75 12C29.8211 12 31.5 10.3211 31.5 8.25C31.5 6.17893 29.8211 4.5 27.75 4.5C25.6789 4.5 24 6.17893 24 8.25C24 10.3211 25.6789 12 27.75 12ZM27.75 31.5C29.8211 31.5 31.5 29.8211 31.5 27.75C31.5 25.6789 29.8211 24 27.75 24C25.6789 24 24 25.6789 24 27.75C24 29.8211 25.6789 31.5 27.75 31.5ZM12 27.75C12 29.8211 10.3211 31.5 8.25 31.5C6.17893 31.5 4.5 29.8211 4.5 27.75C4.5 25.6789 6.17893 24 8.25 24C10.3211 24 12 25.6789 12 27.75Z"
                                                    fill="#0D99FF" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M8.25 12C10.3211 12 12 10.3211 12 8.25C12 6.17893 10.3211 4.5 8.25 4.5C6.17893 4.5 4.5 6.17893 4.5 8.25C4.5 10.3211 6.17893 12 8.25 12ZM15 7C15 6.44772 15.4477 6 16 6H20C20.5523 6 21 6.44772 21 7V8C21 8.55229 20.5523 9 20 9H16C15.4477 9 15 8.55229 15 8V7ZM16 27C15.4477 27 15 27.4477 15 28V29C15 29.5523 15.4477 30 16 30H20C20.5523 30 21 29.5523 21 29V28C21 27.4477 20.5523 27 20 27H16ZM6 16C6 15.4477 6.44772 15 7 15H8C8.55229 15 9 15.4477 9 16V20C9 20.5523 8.55229 21 8 21H7C6.44772 21 6 20.5523 6 20V16ZM28 15C27.4477 15 27 15.4477 27 16V20C27 20.5523 27.4477 21 28 21H29C29.5523 21 30 20.5523 30 20V16C30 15.4477 29.5523 15 29 15H28Z"
                                                    fill="#0D99FF" />
                                            </svg>
                                        </div>
                                        <div class="mx-3">
                                            Two-factor authentication adds an extra layer of security to your account.
                                            To log in, in you'll need to provide a 4 digit amazing code <a
                                                href="javascript:void(0);" class="text-primary">Learn More</a>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center border-bottom border-light py-3">
                                        <div
                                            class="avatar avatar-md rounded d-flex align-items-center justify-content-center bg-white">
                                            <img src="../../..//images/logo/google.png" alt="">
                                        </div>
                                        <div class="clearfix ms-2">
                                            <h6 class="fs-14 mb-0 fw-semibold">Google</h6>
                                            <span class="fs-13">Plan properly your workflow</span>
                                        </div>
                                        <div class="clearfix ms-auto">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    id="flexSwitchGoogle" checked="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center border-bottom border-light py-3">
                                        <div
                                            class="avatar avatar-md rounded d-flex align-items-center justify-content-center bg-white">
                                            <img src="../../..//images/logo/github.png" alt="">
                                        </div>
                                        <div class="clearfix ms-2">
                                            <h6 class="fs-14 mb-0 fw-semibold">Github</h6>
                                            <span class="fs-13">Keep eye on on your Repositories</span>
                                        </div>
                                        <div class="clearfix ms-auto">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    id="flexSwitchGithub" checked="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center py-3">
                                        <div
                                            class="avatar avatar-md d-flex align-items-center justify-content-center bg-white">
                                            <img src="../../..//images/logo/slack.png" alt="">
                                        </div>
                                        <div class="clearfix ms-2">
                                            <h6 class="fs-14 mb-0 fw-semibold">Slack</h6>
                                            <span class="fs-13">Integrate Projects Discussions</span>
                                        </div>
                                        <div class="clearfix ms-auto">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    id="flexSwitchSlack">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <a href="javascript:void(0);" class="btn btn-white">Discard</a>
                                    <a href="javascript:void(0);" class="btn btn-primary ms-2">Save Changes</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="heading mb-0">Notifications</h4>
                                </div>
                                <div class="card-body">
                                    <form action="#" class="mt-2">
                                        <div class="clearfix border-bottom border-light py-3">
                                            <div class="row align-items-center">
                                                <div class="col-sm-6">
                                                    <label class="form-label mb-md-0">Notifications</label>
                                                </div>
                                                <div class="col-sm-3 col-6">
                                                    <div class="form-check custom-checkbox me-4 mb-0 d-inline-block">
                                                        <input type="checkbox" class="form-check-input mb-0"
                                                            id="checkboxNotEmail" required="">
                                                        <label class="form-check-label mb-0"
                                                            for="checkboxNotEmail">Email</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 col-6">
                                                    <div class="form-check custom-checkbox me-4 mb-0 d-inline-block">
                                                        <input type="checkbox" class="form-check-input mb-0"
                                                            id="checkboxNotPhone" required="">
                                                        <label class="form-check-label mb-0"
                                                            for="checkboxNotPhone">Phone</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix border-bottom border-light py-3">
                                            <div class="row align-items-center">
                                                <div class="col-sm-6">
                                                    <label class="form-label mb-md-0">Billing Updates</label>
                                                </div>
                                                <div class="col-sm-3 col-6">
                                                    <div class="form-check custom-checkbox me-4 mb-0 d-inline-block">
                                                        <input type="checkbox" class="form-check-input mb-0"
                                                            id="checkboxBillEmail" required="">
                                                        <label class="form-check-label mb-0"
                                                            for="checkboxBillEmail">Email</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 col-6">
                                                    <div class="form-check custom-checkbox me-4 mb-0 d-inline-block">
                                                        <input type="checkbox" class="form-check-input mb-0"
                                                            id="checkboxBillPhone" required="">
                                                        <label class="form-check-label mb-0"
                                                            for="checkboxBillPhone">Phone</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix border-bottom border-light py-3">
                                            <div class="row align-items-center">
                                                <div class="col-sm-6">
                                                    <label class="form-label mb-md-0">New Team Members</label>
                                                </div>
                                                <div class="col-sm-3 col-6">
                                                    <div class="form-check custom-checkbox me-4 mb-0 d-inline-block">
                                                        <input type="checkbox" class="form-check-input mb-0"
                                                            id="checkboxTeamEmail" required="">
                                                        <label class="form-check-label mb-0"
                                                            for="checkboxTeamEmail">Email</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 col-6">
                                                    <div class="form-check custom-checkbox me-4 mb-0 d-inline-block">
                                                        <input type="checkbox" class="form-check-input mb-0"
                                                            id="checkboxTeamPhone" required="">
                                                        <label class="form-check-label mb-0"
                                                            for="checkboxTeamPhone">Phone</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix border-bottom border-light py-3">
                                            <div class="row align-items-center">
                                                <div class="col-sm-6">
                                                    <label class="form-label mb-md-0">Completed Projects</label>
                                                </div>
                                                <div class="col-sm-3 col-6">
                                                    <div class="form-check custom-checkbox me-4 mb-0 d-inline-block">
                                                        <input type="checkbox" class="form-check-input mb-0"
                                                            id="checkboxProEmail" required="">
                                                        <label class="form-check-label mb-0"
                                                            for="checkboxProEmail">Email</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 col-6">
                                                    <div class="form-check custom-checkbox me-4 mb-0 d-inline-block">
                                                        <input type="checkbox" class="form-check-input mb-0"
                                                            id="checkboxProPhone" required="">
                                                        <label class="form-check-label mb-0"
                                                            for="checkboxProPhone">Phone</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix py-3">
                                            <div class="row align-items-center">
                                                <div class="col-sm-6">
                                                    <label class="form-label mb-md-0">Newsletters</label>
                                                </div>
                                                <div class="col-sm-3 col-6">
                                                    <div class="form-check custom-checkbox me-4 mb-0 d-inline-block">
                                                        <input type="checkbox" class="form-check-input mb-0"
                                                            id="checkboxNewsEmail" required="">
                                                        <label class="form-check-label mb-0"
                                                            for="checkboxNewsEmail">Email</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 col-6">
                                                    <div class="form-check custom-checkbox me-4 mb-0 d-inline-block">
                                                        <input type="checkbox" class="form-check-input mb-0"
                                                            id="checkboxNewsPhone" required="">
                                                        <label class="form-check-label mb-0"
                                                            for="checkboxNewsPhone">Phone</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-end">
                                    <a href="javascript:void(0);" class="btn btn-white">Discard</a>
                                    <a href="javascript:void(0);" class="btn btn-primary ms-2">Save Changes</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="heading mb-0">Deactivate Account</h4>
                        </div>
                        <div class="card-body">
                            <div
                                class="alert alert-warning border-warning outline-dashed py-3 px-3 mt-1 mb-4 mb-0 text-dark d-flex align-items-center">
                                <div class="clearfix">
                                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M15 30C18.9782 30 22.7936 28.4196 25.6066 25.6066C28.4196 22.7936 30 18.9782 30 15C30 11.0218 28.4196 7.20644 25.6066 4.3934C22.7936 1.58035 18.9782 0 15 0C11.0218 0 7.20644 1.58035 4.3934 4.3934C1.58035 7.20644 0 11.0218 0 15C0 18.9782 1.58035 22.7936 4.3934 25.6066C7.20644 28.4196 11.0218 30 15 30ZM12.6562 19.6875H14.0625V15.9375H12.6562C11.877 15.9375 11.25 15.3105 11.25 14.5312C11.25 13.752 11.877 13.125 12.6562 13.125H15.4688C16.248 13.125 16.875 13.752 16.875 14.5312V19.6875H17.3438C18.123 19.6875 18.75 20.3145 18.75 21.0938C18.75 21.873 18.123 22.5 17.3438 22.5H12.6562C11.877 22.5 11.25 21.873 11.25 21.0938C11.25 20.3145 11.877 19.6875 12.6562 19.6875ZM15 7.5C15.4973 7.5 15.9742 7.69754 16.3258 8.04918C16.6775 8.40081 16.875 8.87772 16.875 9.375C16.875 9.87228 16.6775 10.3492 16.3258 10.7008C15.9742 11.0525 15.4973 11.25 15 11.25C14.5027 11.25 14.0258 11.0525 13.6742 10.7008C13.3225 10.3492 13.125 9.87228 13.125 9.375C13.125 8.87772 13.3225 8.40081 13.6742 8.04918C14.0258 7.69754 14.5027 7.5 15 7.5Z"
                                            fill="#FF8A11" />
                                    </svg>
                                </div>
                                <div class="mx-3">
                                    <h6 class="mb-0 fw-semibold">You are deactivatiing your account</h6>
                                    <p class="mb-0">For extra security, this requires you to confirm your email or
                                        phone number when you reset your password. <a href="javascript:void(0);"
                                            class="text-warning">Learn More</a></p>
                                </div>
                            </div>
                            <div class="form-check custom-checkbox me-4 my-3 d-inline-block">
                                <input type="checkbox" class="form-check-input mb-0" id="checkboxDeactivation"
                                    required="">
                                <label class="form-check-label mb-0 text-secondary" for="checkboxDeactivation">Confirm
                                    Account Deactivation</label>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <a href="javascript:void(0);" class="btn btn-danger ms-2">Deactivate Account</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('2_AdminPanel.3_Profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('2_AdminPanel.3_Profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('2_AdminPanel.3_Profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
