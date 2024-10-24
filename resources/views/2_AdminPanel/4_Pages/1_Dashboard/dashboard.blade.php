<x-app-layout>

    <!-- Breadcrumb -->
    @component('2_AdminPanel.5_Components.breadcrumb', ['title' => 'Dashboard', 'activePage' => 'Dashboard'])
    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-9 wid-100">
                <div class="row">
                    <div class="col-xl-3 col-sm-6">
                        <div class="card chart-grd same-card">
                            <div class="card-body depostit-card p-0">
                                <div class="depostit-card-media d-flex justify-content-between pb-0">
                                    <div>
                                        <h6>Total Deposit</h6>
                                        <h3>$1200.00</h3>
                                    </div>
                                    <div class="icon-box bg-primary-light">
                                        <svg width="12" height="20" viewBox="0 0 12 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.4642 13.7074C11.4759 12.1252 10.8504 10.8738 9.60279 9.99009C8.6392 9.30968 7.46984 8.95476 6.33882 8.6137C3.98274 7.89943 3.29927 7.52321 3.29927 6.3965C3.29927 5.14147 4.93028 4.69493 6.32655 4.69493C7.34341 4.69493 8.51331 5.01109 9.23985 5.47964L10.6802 3.24887C9.73069 2.6333 8.43112 2.21342 7.14783 2.0831V0H4.49076V2.22918C2.12884 2.74876 0.640949 4.29246 0.640949 6.3965C0.640949 7.87005 1.25327 9.03865 2.45745 9.86289C3.37331 10.4921 4.49028 10.83 5.56927 11.1572C7.88027 11.8557 8.81873 12.2813 8.80805 13.691L8.80799 13.7014C8.80799 14.8845 7.24005 15.3051 5.89676 15.3051C4.62786 15.3051 3.248 14.749 2.46582 13.9222L0.535522 15.7481C1.52607 16.7957 2.96523 17.5364 4.4907 17.8267V20.0001H7.14783V17.8735C9.7724 17.4978 11.4616 15.9177 11.4642 13.7074Z"
                                                fill="var(--primary)" />
                                        </svg>
                                    </div>
                                </div>
                                <div id="NewCustomers"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                        <div class="card same-card">
                            <div class="card-body d-flex align-items-center  py-2">
                                <div id="AllProject"></div>
                                <ul class="project-list">
                                    <li>
                                        <h6>All Projects</h6>
                                    </li>
                                    <li>
                                        <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect width="10" height="10" rx="3" fill="#3AC977" />
                                        </svg>
                                        Compete
                                    </li>
                                    <li>
                                        <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect width="10" height="10" rx="3" fill="var(--primary)" />
                                        </svg>
                                        Pending
                                    </li>
                                    <li>
                                        <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect width="10" height="10" rx="3"
                                                fill="var(--secondary)" />
                                        </svg>
                                        Not Start
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                        <div class="card chart-grd same-card">
                            <div class="card-body depostit-card p-0">
                                <div class="depostit-card-media d-flex justify-content-between pb-0">
                                    <div>
                                        <h6>Total Expenses</h6>
                                        <h3>$1200.00</h3>
                                    </div>
                                    <div class="icon-box bg-danger-light">
                                        <svg width="12" height="20" viewBox="0 0 12 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.4642 13.7074C11.4759 12.1252 10.8504 10.8738 9.60279 9.99009C8.6392 9.30968 7.46984 8.95476 6.33882 8.6137C3.98274 7.89943 3.29927 7.52321 3.29927 6.3965C3.29927 5.14147 4.93028 4.69493 6.32655 4.69493C7.34341 4.69493 8.51331 5.01109 9.23985 5.47964L10.6802 3.24887C9.73069 2.6333 8.43112 2.21342 7.14783 2.0831V0H4.49076V2.22918C2.12884 2.74876 0.640949 4.29246 0.640949 6.3965C0.640949 7.87005 1.25327 9.03865 2.45745 9.86289C3.37331 10.4921 4.49028 10.83 5.56927 11.1572C7.88027 11.8557 8.81873 12.2813 8.80805 13.691L8.80799 13.7014C8.80799 14.8845 7.24005 15.3051 5.89676 15.3051C4.62786 15.3051 3.248 14.749 2.46582 13.9222L0.535522 15.7481C1.52607 16.7957 2.96523 17.5364 4.4907 17.8267V20.0001H7.14783V17.8735C9.7724 17.4978 11.4616 15.9177 11.4642 13.7074Z"
                                                fill="#FF5E5E" />
                                        </svg>
                                    </div>
                                </div>
                                <div id="NewExperience"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 same-card">
                        <div class="card">
                            <div class="card-body depostit-card">
                                <div class="depostit-card-media d-flex justify-content-between style-1">
                                    <div>
                                        <h6>Total Deposit</h6>
                                        <h3>20</h3>
                                    </div>
                                    <div class="icon-box bg-primary-light">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M16.3787 1.875H15.625V1.25C15.625 1.08424 15.5592 0.925268 15.4419 0.808058C15.3247 0.690848 15.1658 0.625 15 0.625C14.8342 0.625 14.6753 0.690848 14.5581 0.808058C14.4408 0.925268 14.375 1.08424 14.375 1.25V1.875H10.625V1.25C10.625 1.08424 10.5592 0.925268 10.4419 0.808058C10.3247 0.690848 10.1658 0.625 10 0.625C9.83424 0.625 9.67527 0.690848 9.55806 0.808058C9.44085 0.925268 9.375 1.08424 9.375 1.25V1.875H5.625V1.25C5.625 1.08424 5.55915 0.925268 5.44194 0.808058C5.32473 0.690848 5.16576 0.625 5 0.625C4.83424 0.625 4.67527 0.690848 4.55806 0.808058C4.44085 0.925268 4.375 1.08424 4.375 1.25V1.875H3.62125C2.99266 1.87599 2.3901 2.12614 1.94562 2.57062C1.50114 3.0151 1.25099 3.61766 1.25 4.24625V17.0037C1.25099 17.6323 1.50114 18.2349 1.94562 18.6794C2.3901 19.1239 2.99266 19.374 3.62125 19.375H16.3787C17.0073 19.374 17.6099 19.1239 18.0544 18.6794C18.4989 18.2349 18.749 17.6323 18.75 17.0037V4.24625C18.749 3.61766 18.4989 3.0151 18.0544 2.57062C17.6099 2.12614 17.0073 1.87599 16.3787 1.875ZM17.5 17.0037C17.499 17.3008 17.3806 17.5854 17.1705 17.7955C16.9604 18.0056 16.6758 18.124 16.3787 18.125H3.62125C3.32418 18.124 3.03956 18.0056 2.8295 17.7955C2.61944 17.5854 2.50099 17.3008 2.5 17.0037V4.24625C2.50099 3.94918 2.61944 3.66456 2.8295 3.4545C3.03956 3.24444 3.32418 3.12599 3.62125 3.125H4.375V3.75C4.375 3.91576 4.44085 4.07473 4.55806 4.19194C4.67527 4.30915 4.83424 4.375 5 4.375C5.16576 4.375 5.32473 4.30915 5.44194 4.19194C5.55915 4.07473 5.625 3.91576 5.625 3.75V3.125H9.375V3.75C9.375 3.91576 9.44085 4.07473 9.55806 4.19194C9.67527 4.30915 9.83424 4.375 10 4.375C10.1658 4.375 10.3247 4.30915 10.4419 4.19194C10.5592 4.07473 10.625 3.91576 10.625 3.75V3.125H14.375V3.75C14.375 3.91576 14.4408 4.07473 14.5581 4.19194C14.6753 4.30915 14.8342 4.375 15 4.375C15.1658 4.375 15.3247 4.30915 15.4419 4.19194C15.5592 4.07473 15.625 3.91576 15.625 3.75V3.125H16.3787C16.6758 3.12599 16.9604 3.24444 17.1705 3.4545C17.3806 3.66456 17.499 3.94918 17.5 4.24625V17.0037Z"
                                                fill="var(--primary)" />
                                            <path
                                                d="M7.68311 7.05812L6.24999 8.49125L5.44186 7.68312C5.38421 7.62343 5.31524 7.57581 5.23899 7.54306C5.16274 7.5103 5.08073 7.49306 4.99774 7.49234C4.91475 7.49162 4.83245 7.50743 4.75564 7.53886C4.67883 7.57028 4.60905 7.61669 4.55037 7.67537C4.49168 7.73406 4.44528 7.80384 4.41385 7.88065C4.38243 7.95746 4.36661 8.03976 4.36733 8.12275C4.36805 8.20573 4.3853 8.28775 4.41805 8.364C4.45081 8.44025 4.49842 8.50922 4.55811 8.56687L5.80811 9.81687C5.92532 9.93404 6.08426 9.99986 6.24999 9.99986C6.41572 9.99986 6.57466 9.93404 6.69186 9.81687L8.56686 7.94187C8.68071 7.82399 8.74371 7.66612 8.74229 7.50224C8.74086 7.33837 8.67513 7.18161 8.55925 7.06573C8.44337 6.94985 8.28661 6.88412 8.12274 6.8827C7.95887 6.88127 7.80099 6.94427 7.68311 7.05812Z"
                                                fill="var(--primary)" />
                                            <path
                                                d="M15 8.125H10.625C10.4592 8.125 10.3003 8.19085 10.1831 8.30806C10.0658 8.42527 10 8.58424 10 8.75C10 8.91576 10.0658 9.07473 10.1831 9.19194C10.3003 9.30915 10.4592 9.375 10.625 9.375H15C15.1658 9.375 15.3247 9.30915 15.4419 9.19194C15.5592 9.07473 15.625 8.91576 15.625 8.75C15.625 8.58424 15.5592 8.42527 15.4419 8.30806C15.3247 8.19085 15.1658 8.125 15 8.125Z"
                                                fill="var(--primary)" />
                                            <path
                                                d="M7.68311 12.6831L6.24999 14.1162L5.44186 13.3081C5.38421 13.2484 5.31524 13.2008 5.23899 13.1681C5.16274 13.1353 5.08073 13.1181 4.99774 13.1173C4.91475 13.1166 4.83245 13.1324 4.75564 13.1639C4.67883 13.1953 4.60905 13.2417 4.55037 13.3004C4.49168 13.3591 4.44528 13.4288 4.41385 13.5056C4.38243 13.5825 4.36661 13.6648 4.36733 13.7477C4.36805 13.8307 4.3853 13.9127 4.41805 13.989C4.45081 14.0653 4.49842 14.1342 4.55811 14.1919L5.80811 15.4419C5.92532 15.559 6.08426 15.6249 6.24999 15.6249C6.41572 15.6249 6.57466 15.559 6.69186 15.4419L8.56686 13.5669C8.68071 13.449 8.74371 13.2911 8.74229 13.1272C8.74086 12.9634 8.67513 12.8066 8.55925 12.6907C8.44337 12.5749 8.28661 12.5091 8.12274 12.5077C7.95887 12.5063 7.80099 12.5693 7.68311 12.6831Z"
                                                fill="var(--primary)" />
                                            <path
                                                d="M15 13.75H10.625C10.4592 13.75 10.3003 13.8158 10.1831 13.9331C10.0658 14.0503 10 14.2092 10 14.375C10 14.5408 10.0658 14.6997 10.1831 14.8169C10.3003 14.9342 10.4592 15 10.625 15H15C15.1658 15 15.3247 14.9342 15.4419 14.8169C15.5592 14.6997 15.625 14.5408 15.625 14.375C15.625 14.2092 15.5592 14.0503 15.4419 13.9331C15.3247 13.8158 15.1658 13.75 15 13.75Z"
                                                fill="var(--primary)" />
                                        </svg>

                                    </div>
                                </div>
                                <div class="progress-box mt-0">
                                    <div class="d-flex justify-content-between">
                                        <p class="mb-0">Tasks Not Finished</p>
                                        <p class="mb-0">20/28</p>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar bg-primary"
                                            style="width:50%; height:5px; border-radius:4px;" role="progressbar">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 active-p">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="table-responsive active-projects shorting">

                                    <div class="tbl-caption">
                                        <h4 class="heading mb-0">Active Projects</h4>
                                    </div>
                                    <table id="projects-tbl" class="table ItemsCheckboxSec">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <div class="form-check custom-checkbox ms-0">
                                                        <input type="checkbox" class="form-check-input checkAllInput"
                                                            id="checkAll" required="">
                                                        <label class="form-check-label" for="checkAll"></label>
                                                    </div>
                                                </th>
                                                <th>Project Name</th>
                                                <th>Project Lead</th>
                                                <th>Progress</th>
                                                <th>Assignee</th>
                                                <th>Status</th>
                                                <th>Due Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="form-check custom-checkbox">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="customCheckBox2" required="">
                                                        <label class="form-check-label" for="customCheckBox2"></label>
                                                    </div>
                                                </td>
                                                <td>Batman</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic1.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                        <p class="mb-0 ms-2">Liam Risher</p>
                                                    </div>
                                                </td>
                                                <td class="pe-0">
                                                    <div class="tbl-progress-box">
                                                        <div class="progress">
                                                            <div class="progress-bar bg-primary"
                                                                style="width:53%; height:5px; border-radius:4px;"
                                                                role="progressbar"></div>
                                                        </div>
                                                        <span class="text-primary">53%</span>
                                                    </div>
                                                </td>
                                                <td class="pe-0">
                                                    <div class="avatar-list avatar-list-stacked">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic1.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic555.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic666.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                    </div>
                                                </td>
                                                <td class="pe-0">
                                                    <span class="badge badge-primary light border-0">Inprogress</span>
                                                </td>
                                                <td>
                                                    <span>08 Sep 2023</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check custom-checkbox">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="customCheckBox3" required="">
                                                        <label class="form-check-label" for="customCheckBox3"></label>
                                                    </div>
                                                </td>
                                                <td>Mivy App</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic1.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                        <p class="mb-0 ms-2">Honey Risher</p>
                                                    </div>
                                                </td>
                                                <td class="pe-0">
                                                    <div class="tbl-progress-box">
                                                        <div class="progress">
                                                            <div class="progress-bar bg-primary"
                                                                style="width:53%; height:5px; border-radius:4px;"
                                                                role="progressbar"></div>
                                                        </div>
                                                        <span class="text-primary">52%</span>
                                                    </div>
                                                </td>
                                                <td class="pe-0">
                                                    <div class="avatar-list avatar-list-stacked">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic1.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic777.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic666.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                    </div>
                                                </td>
                                                <td class="pe-0">
                                                    <span class="badge badge-danger light border-0">Inprogress</span>
                                                </td>
                                                <td>
                                                    <span>06 Sep 2021</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check custom-checkbox">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="customCheckBox22" required="">
                                                        <label class="form-check-label"
                                                            for="customCheckBox22"></label>
                                                    </div>
                                                </td>
                                                <td>Crypto App</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic2.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                        <p class="mb-0 ms-2">Ankites Risher</p>
                                                    </div>
                                                </td>
                                                <td class="pe-0">
                                                    <div class="tbl-progress-box">
                                                        <div class="progress">
                                                            <div class="progress-bar bg-danger"
                                                                style="width:53%; height:5px; border-radius:4px;"
                                                                role="progressbar"></div>
                                                        </div>
                                                        <span class="text-primary">58%</span>
                                                    </div>
                                                </td>
                                                <td class="pe-0">
                                                    <div class="avatar-list avatar-list-stacked">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic1.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic777.jpg') }}"
                                                            class="avatar rounded-circle" alt="">

                                                    </div>
                                                </td>
                                                <td class="pe-0">
                                                    <span class="badge badge-danger light border-0">Pending</span>
                                                </td>
                                                <td>
                                                    <span>06 Sep 2021</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check custom-checkbox">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="customCheckBox33" required="">
                                                        <label class="form-check-label"
                                                            for="customCheckBox33"></label>
                                                    </div>
                                                </td>
                                                <td>Bender Project</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic2.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                        <p class="mb-0 ms-2">Oliver Noah</p>
                                                    </div>
                                                </td>
                                                <td class="pe-0">
                                                    <div class="tbl-progress-box">
                                                        <div class="progress">
                                                            <div class="progress-bar bg-danger"
                                                                style="width:30%; height:5px; border-radius:4px;"
                                                                role="progressbar"></div>
                                                        </div>
                                                        <span class="text-danger">30%</span>
                                                    </div>
                                                </td>
                                                <td class="pe-0">
                                                    <div class="avatar-list avatar-list-stacked">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic1.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic555.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic666.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                    </div>
                                                </td>
                                                <td class="pe-0">
                                                    <span class="badge badge-danger light border-0">Pending</span>
                                                </td>
                                                <td>
                                                    <span>06 Sep 2021</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check custom-checkbox">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="customCheckBox044" required="">
                                                        <label class="form-check-label"
                                                            for="customCheckBox044"></label>
                                                    </div>
                                                </td>
                                                <td>Canary</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic888.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                        <p class="mb-0 ms-2">Elijah James</p>
                                                    </div>
                                                </td>
                                                <td class="pe-0">
                                                    <div class="tbl-progress-box">
                                                        <div class="progress">
                                                            <div class="progress-bar bg-success"
                                                                style="width:40%; height:5px; border-radius:4px;"
                                                                role="progressbar"></div>
                                                        </div>
                                                        <span class="text-success">40%</span>
                                                    </div>
                                                </td>
                                                <td class="pe-0">
                                                    <div class="avatar-list avatar-list-stacked">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic666.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic555.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic1.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic666.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                    </div>
                                                </td>
                                                <td class="pe-0">
                                                    <span class="badge badge-success light border-0">Completed</span>
                                                </td>
                                                <td>
                                                    <span>06 Sep 2021</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check custom-checkbox">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="customCheckBox055" required="">
                                                        <label class="form-check-label"
                                                            for="customCheckBox055"></label>
                                                    </div>
                                                </td>
                                                <td>Casanova</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic1.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                        <p class="mb-0 ms-2">William Risher</p>
                                                    </div>
                                                </td>
                                                <td class="pe-0">
                                                    <div class="tbl-progress-box">
                                                        <div class="progress">
                                                            <div class="progress-bar bg-primary"
                                                                style="width:53%; height:5px; border-radius:4px;"
                                                                role="progressbar"></div>
                                                        </div>
                                                        <span class="text-primary">53%</span>
                                                    </div>
                                                </td>
                                                <td class="pe-0">
                                                    <div class="avatar-list avatar-list-stacked">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic1.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic555.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic666.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                    </div>
                                                </td>
                                                <td class="pe-0">
                                                    <span class="badge badge-primary light border-0">Inprogress</span>
                                                </td>
                                                <td>
                                                    <span>06 Sep 2021</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check custom-checkbox">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="customCheckBox23" required="">
                                                        <label class="form-check-label"
                                                            for="customCheckBox23"></label>
                                                    </div>
                                                </td>
                                                <td>Bender Project</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic2.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                        <p class="mb-0 ms-2">Oliver Noah</p>
                                                    </div>
                                                </td>
                                                <td class="pe-0">
                                                    <div class="tbl-progress-box">
                                                        <div class="progress">
                                                            <div class="progress-bar bg-danger"
                                                                style="width:30%; height:5px; border-radius:4px;"
                                                                role="progressbar"></div>
                                                        </div>
                                                        <span class="text-danger">30%</span>
                                                    </div>
                                                </td>
                                                <td class="pe-0">
                                                    <div class="avatar-list avatar-list-stacked">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic1.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic555.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic666.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                    </div>
                                                </td>
                                                <td class="pe-0">
                                                    <span class="badge badge-danger light border-0">Pending</span>
                                                </td>
                                                <td>
                                                    <span>06 Sep 2021</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check custom-checkbox">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="customCheckBox44" required="">
                                                        <label class="form-check-label"
                                                            for="customCheckBox44"></label>
                                                    </div>
                                                </td>
                                                <td>Canary</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic888.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                        <p class="mb-0 ms-2">Elijah James</p>
                                                    </div>
                                                </td>
                                                <td class="pe-0">
                                                    <div class="tbl-progress-box">
                                                        <div class="progress">
                                                            <div class="progress-bar bg-success"
                                                                style="width:40%; height:5px; border-radius:4px;"
                                                                role="progressbar"></div>
                                                        </div>
                                                        <span class="text-success">40%</span>
                                                    </div>
                                                </td>
                                                <td class="pe-0">
                                                    <div class="avatar-list avatar-list-stacked">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic666.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic555.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic1.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic666.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                    </div>
                                                </td>
                                                <td class="pe-0">
                                                    <span class="badge badge-success light border-0">Completed</span>
                                                </td>
                                                <td>
                                                    <span>06 Sep 2021</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check custom-checkbox">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="customCheckBox55" required="">
                                                        <label class="form-check-label"
                                                            for="customCheckBox55"></label>
                                                    </div>
                                                </td>
                                                <td>Casanova</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic1.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                        <p class="mb-0 ms-2">William Risher</p>
                                                    </div>
                                                </td>
                                                <td class="pe-0">
                                                    <div class="tbl-progress-box">
                                                        <div class="progress">
                                                            <div class="progress-bar bg-primary"
                                                                style="width:53%; height:5px; border-radius:4px;"
                                                                role="progressbar"></div>
                                                        </div>
                                                        <span class="text-primary">53%</span>
                                                    </div>
                                                </td>
                                                <td class="pe-0">
                                                    <div class="avatar-list avatar-list-stacked">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic1.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic555.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic666.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                    </div>
                                                </td>
                                                <td class="pe-0">
                                                    <span class="badge badge-primary light border-0">Inprogress</span>
                                                </td>
                                                <td>
                                                    <span>06 Sep 2021</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check custom-checkbox">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="customCheckBox66" required="">
                                                        <label class="form-check-label"
                                                            for="customCheckBox66"></label>
                                                    </div>
                                                </td>
                                                <td>Bigfish</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic777.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                        <p class="mb-0 ms-2">Donald Benjamin</p>
                                                    </div>
                                                </td>
                                                <td class="pe-0">
                                                    <div class="tbl-progress-box">
                                                        <div class="progress">
                                                            <div class="progress-bar bg-danger"
                                                                style="width:30%; height:5px; border-radius:4px;"
                                                                role="progressbar"></div>
                                                        </div>
                                                        <span class="text-danger">30%</span>
                                                    </div>
                                                </td>
                                                <td class="pe-0">
                                                    <div class="avatar-list avatar-list-stacked">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic1.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic777.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic666.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                    </div>
                                                </td>
                                                <td class="pe-0">
                                                    <span class="badge badge-danger light border-0">Inprogress</span>
                                                </td>
                                                <td>
                                                    <span>06 Sep 2021</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check custom-checkbox">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="customCheckBox7" required="">
                                                        <label class="form-check-label" for="customCheckBox7"></label>
                                                    </div>
                                                </td>
                                                <td>Matadors</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic888.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                        <p class="mb-0 ms-2">Liam Risher</p>
                                                    </div>
                                                </td>
                                                <td class="pe-0">
                                                    <div class="tbl-progress-box">
                                                        <div class="progress">
                                                            <div class="progress-bar bg-primary"
                                                                style="width:53%; height:5px; border-radius:4px;"
                                                                role="progressbar"></div>
                                                        </div>
                                                        <span class="text-primary">53%</span>
                                                    </div>
                                                </td>
                                                <td class="pe-0">
                                                    <div class="avatar-list avatar-list-stacked">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic777.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic555.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic666.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                    </div>
                                                </td>
                                                <td class="pe-0">
                                                    <span class="badge badge-primary light border-0">Inprogress</span>
                                                </td>
                                                <td>
                                                    <span>06 Sep 2021</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check custom-checkbox">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="customCheckBox88" required="">
                                                        <label class="form-check-label"
                                                            for="customCheckBox88"></label>
                                                    </div>
                                                </td>
                                                <td>Mercury</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic2.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                        <p class="mb-0 ms-2">Oliver Noah</p>
                                                    </div>
                                                </td>
                                                <td class="pe-0">
                                                    <div class="tbl-progress-box">
                                                        <div class="progress">
                                                            <div class="progress-bar bg-danger"
                                                                style="width:30%; height:5px; border-radius:4px;"
                                                                role="progressbar"></div>
                                                        </div>
                                                        <span class="text-danger">30%</span>
                                                    </div>
                                                </td>
                                                <td class="pe-0">
                                                    <div class="avatar-list avatar-list-stacked">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic1.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic777.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic666.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                    </div>
                                                </td>
                                                <td class="pe-0">
                                                    <span class="badge badge-danger light border-0">Pending</span>
                                                </td>
                                                <td>
                                                    <span>06 Sep 2021</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check custom-checkbox">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="customCheckBox99" required="">
                                                        <label class="form-check-label"
                                                            for="customCheckBox99"></label>
                                                    </div>
                                                </td>
                                                <td>Whistler</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic999.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                        <p class="mb-0 ms-2">Elijah James</p>
                                                    </div>
                                                </td>
                                                <td class="pe-0">
                                                    <div class="tbl-progress-box">
                                                        <div class="progress">
                                                            <div class="progress-bar bg-success"
                                                                style="width:40%; height:5px; border-radius:4px;"
                                                                role="progressbar"></div>
                                                        </div>
                                                        <span class="text-success">40%</span>
                                                    </div>
                                                </td>
                                                <td class="pe-0">
                                                    <div class="avatar-list avatar-list-stacked">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic666.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic555.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic1.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic666.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                    </div>
                                                </td>
                                                <td class="pe-0">
                                                    <span class="badge badge-success light border-0">Completed</span>
                                                </td>
                                                <td>
                                                    <span>06 Sep 2021</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check custom-checkbox">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="customCheckBox0102" required="">
                                                        <label class="form-check-label"
                                                            for="customCheckBox0102"></label>
                                                    </div>
                                                </td>
                                                <td>Time Projects</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic2.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                        <p class="mb-0 ms-2">Lucas</p>
                                                    </div>
                                                </td>
                                                <td class="pe-0">
                                                    <div class="tbl-progress-box">
                                                        <div class="progress">
                                                            <div class="progress-bar bg-danger"
                                                                style="width:33%; height:5px; border-radius:4px;"
                                                                role="progressbar"></div>
                                                        </div>
                                                        <span class="text-primary">33%</span>
                                                    </div>
                                                </td>
                                                <td class="pe-0">
                                                    <div class="avatar-list avatar-list-stacked">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic1.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic555.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic999.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                    </div>
                                                </td>
                                                <td class="pe-0">
                                                    <span class="badge badge-primary light border-0">Inprogress</span>
                                                </td>
                                                <td>
                                                    <span>06 Sep 2021</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check custom-checkbox">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="customCheckBox110" required="">
                                                        <label class="form-check-label"
                                                            for="customCheckBox110"></label>
                                                    </div>
                                                </td>
                                                <td>Fast Ball</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic1.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                        <p class="mb-0 ms-2">William Risher</p>
                                                    </div>
                                                </td>
                                                <td class="pe-0">
                                                    <div class="tbl-progress-box">
                                                        <div class="progress">
                                                            <div class="progress-bar bg-primary"
                                                                style="width:53%; height:5px; border-radius:4px;"
                                                                role="progressbar"></div>
                                                        </div>
                                                        <span class="text-primary">53%</span>
                                                    </div>
                                                </td>
                                                <td class="pe-0">
                                                    <div class="avatar-list avatar-list-stacked">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic1.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic555.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                        <img src="{{ asset('2_AdminPanel/assets/images/contacts/pic999.jpg') }}"
                                                            class="avatar rounded-circle" alt="">
                                                    </div>
                                                </td>
                                                <td class="pe-0">
                                                    <span class="badge badge-primary light border-0">Inprogress</span>
                                                </td>
                                                <td>
                                                    <span>06 Sep 2021</span>
                                                </td>
                                            </tr>

                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-header border-0">
                                <h4 class="heading mb-0">My To Do Items</h4>
                                <div>
                                    <a href="javascript:void(0);" class="text-primary me-2">View All</a>
                                    <a href="javascript:void(0);" class="text-black"> + Add To Do</a>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="dt-do-bx">
                                    <div class="draggable-zone dropzoneContainer to-dodroup dz-scroll">
                                        <div class="sub-card draggable-handle draggable">
                                            <div class="d-items">
                                                <span class="text-warning dang d-block mb-2">
                                                    <svg class="me-1" width="18" height="18"
                                                        viewBox="0 0 18 18" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M3.61051 15.3276H14.3978C15.5843 15.3276 16.329 14.0451 15.7395 13.0146L10.35 3.59085C9.75676 2.5536 8.26126 2.55285 7.66726 3.5901L2.26876 13.0139C1.67926 14.0444 2.42326 15.3276 3.61051 15.3276Z"
                                                            stroke="#FF9F00" stroke-width="1.5"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M9.00189 10.0611V7.7361" stroke="#FF9F00"
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path d="M8.99625 12.375H9.00375" stroke="#FF9F00"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                    Latest to do's
                                                </span>
                                                <div class="d-flex justify-content-between flex-wrap">
                                                    <div class="d-items-2">
                                                        <div>
                                                            <svg width="9" height="16" viewBox="0 0 9 16"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect width="1" height="1" fill="#888888" />
                                                                <rect y="3" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect y="6" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect y="9" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect y="12" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect y="15" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="4" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="4" y="3" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="4" y="6" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="4" y="9" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="4" y="12" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="4" y="15" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="8" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="8" y="3" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="8" y="6" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="8" y="9" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="8" y="12" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="8" y="15" width="1" height="1"
                                                                    fill="#888888" />
                                                            </svg>
                                                        </div>
                                                        <div>
                                                            <div class="form-check custom-checkbox">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="customCheckBox1" required>
                                                                <label class="form-check-label"
                                                                    for="customCheckBox1">Compete this projects
                                                                    Monday</label>
                                                            </div>
                                                            <span>2023-12-26 07:15:00</span>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="icon-box icon-box-md bg-danger-light me-1">
                                                            <svg width="16" height="16" viewBox="0 0 16 16"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M12.8833 6.31213C12.8833 6.31213 12.5213 10.8021 12.3113 12.6935C12.2113 13.5968 11.6533 14.1261 10.7393 14.1428C8.99994 14.1741 7.25861 14.1761 5.51994 14.1395C4.64061 14.1215 4.09194 13.5855 3.99394 12.6981C3.78261 10.7901 3.42261 6.31213 3.42261 6.31213"
                                                                    stroke="#FF5E5E" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path d="M13.8055 4.1598H2.50012" stroke="#FF5E5E"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path
                                                                    d="M11.6271 4.1598C11.1037 4.1598 10.6531 3.7898 10.5504 3.27713L10.3884 2.46647C10.2884 2.09247 9.94974 1.8338 9.56374 1.8338H6.74174C6.35574 1.8338 6.01707 2.09247 5.91707 2.46647L5.75507 3.27713C5.65241 3.7898 5.20174 4.1598 4.67841 4.1598"
                                                                    stroke="#FF5E5E" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                            </svg>
                                                        </div>
                                                        <div class="icon-box icon-box-md bg-primary-light">
                                                            <svg width="16" height="16" viewBox="0 0 16 16"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M9.16492 13.6286H14" stroke="#0D99FF"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M8.52001 2.52986C9.0371 1.91186 9.96666 1.82124 10.5975 2.32782C10.6324 2.35531 11.753 3.22586 11.753 3.22586C12.446 3.64479 12.6613 4.5354 12.2329 5.21506C12.2102 5.25146 5.87463 13.1763 5.87463 13.1763C5.66385 13.4393 5.34389 13.5945 5.00194 13.5982L2.57569 13.6287L2.02902 11.3149C1.95244 10.9895 2.02902 10.6478 2.2398 10.3849L8.52001 2.52986Z"
                                                                    stroke="#0D99FF" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path d="M7.34723 4.00059L10.9821 6.79201"
                                                                    stroke="#0D99FF" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                            </svg>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sub-card draggable-handle draggable">
                                            <div class="d-items">
                                                <span class="text-success dang d-block mb-2">
                                                    <svg class="me-1" width="18" height="18"
                                                        viewBox="0 0 18 18" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M15 4.5L6.75 12.75L3 9" stroke="#3AC977"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                    Latest finished to do's
                                                </span>
                                                <div class="d-flex justify-content-between flex-wrap">
                                                    <div class="d-items-2">
                                                        <div>
                                                            <svg width="9" height="16" viewBox="0 0 9 16"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect width="1" height="1" fill="#888888" />
                                                                <rect y="3" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect y="6" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect y="9" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect y="12" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect y="15" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="4" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="4" y="3" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="4" y="6" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="4" y="9" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="4" y="12" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="4" y="15" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="8" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="8" y="3" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="8" y="6" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="8" y="9" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="8" y="12" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="8" y="15" width="1" height="1"
                                                                    fill="#888888" />
                                                            </svg>
                                                        </div>
                                                        <div>
                                                            <div class="form-check custom-checkbox">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="customCheckBox02" required>
                                                                <label class="form-check-label"
                                                                    for="customCheckBox02">Compete this projects
                                                                    Monday</label>
                                                            </div>
                                                            <span>2023-12-26 07:15:00</span>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="icon-box icon-box-md bg-danger-light me-1">
                                                            <svg width="16" height="16" viewBox="0 0 16 16"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M12.8833 6.31213C12.8833 6.31213 12.5213 10.8021 12.3113 12.6935C12.2113 13.5968 11.6533 14.1261 10.7393 14.1428C8.99994 14.1741 7.25861 14.1761 5.51994 14.1395C4.64061 14.1215 4.09194 13.5855 3.99394 12.6981C3.78261 10.7901 3.42261 6.31213 3.42261 6.31213"
                                                                    stroke="#FF5E5E" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path d="M13.8055 4.1598H2.50012" stroke="#FF5E5E"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path
                                                                    d="M11.6271 4.1598C11.1037 4.1598 10.6531 3.7898 10.5504 3.27713L10.3884 2.46647C10.2884 2.09247 9.94974 1.8338 9.56374 1.8338H6.74174C6.35574 1.8338 6.01707 2.09247 5.91707 2.46647L5.75507 3.27713C5.65241 3.7898 5.20174 4.1598 4.67841 4.1598"
                                                                    stroke="#FF5E5E" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                            </svg>
                                                        </div>
                                                        <div class="icon-box icon-box-md bg-primary-light">
                                                            <svg width="16" height="16" viewBox="0 0 16 16"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M9.16492 13.6286H14" stroke="#0D99FF"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M8.52001 2.52986C9.0371 1.91186 9.96666 1.82124 10.5975 2.32782C10.6324 2.35531 11.753 3.22586 11.753 3.22586C12.446 3.64479 12.6613 4.5354 12.2329 5.21506C12.2102 5.25146 5.87463 13.1763 5.87463 13.1763C5.66385 13.4393 5.34389 13.5945 5.00194 13.5982L2.57569 13.6287L2.02902 11.3149C1.95244 10.9895 2.02902 10.6478 2.2398 10.3849L8.52001 2.52986Z"
                                                                    stroke="#0D99FF" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path d="M7.34723 4.00059L10.9821 6.79201"
                                                                    stroke="#0D99FF" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                            </svg>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sub-card draggable-handle draggable">
                                            <div class="d-items">
                                                <div class="d-flex justify-content-between flex-wrap">
                                                    <div class="d-items-2">
                                                        <div>
                                                            <svg width="9" height="16" viewBox="0 0 9 16"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect width="1" height="1" fill="#888888" />
                                                                <rect y="3" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect y="6" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect y="9" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect y="12" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect y="15" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="4" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="4" y="3" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="4" y="6" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="4" y="9" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="4" y="12" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="4" y="15" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="8" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="8" y="3" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="8" y="6" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="8" y="9" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="8" y="12" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="8" y="15" width="1" height="1"
                                                                    fill="#888888" />
                                                            </svg>
                                                        </div>
                                                        <div>
                                                            <div class="form-check custom-checkbox">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="customCheckBox03" required>
                                                                <label class="form-check-label"
                                                                    for="customCheckBox03">Compete this projects
                                                                    Monday</label>
                                                            </div>
                                                            <span>2023-12-26 07:15:00</span>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="icon-box icon-box-md bg-danger-light me-1">
                                                            <svg width="16" height="16" viewBox="0 0 16 16"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M12.8833 6.31213C12.8833 6.31213 12.5213 10.8021 12.3113 12.6935C12.2113 13.5968 11.6533 14.1261 10.7393 14.1428C8.99994 14.1741 7.25861 14.1761 5.51994 14.1395C4.64061 14.1215 4.09194 13.5855 3.99394 12.6981C3.78261 10.7901 3.42261 6.31213 3.42261 6.31213"
                                                                    stroke="#FF5E5E" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path d="M13.8055 4.1598H2.50012" stroke="#FF5E5E"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path
                                                                    d="M11.6271 4.1598C11.1037 4.1598 10.6531 3.7898 10.5504 3.27713L10.3884 2.46647C10.2884 2.09247 9.94974 1.8338 9.56374 1.8338H6.74174C6.35574 1.8338 6.01707 2.09247 5.91707 2.46647L5.75507 3.27713C5.65241 3.7898 5.20174 4.1598 4.67841 4.1598"
                                                                    stroke="#FF5E5E" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                            </svg>
                                                        </div>
                                                        <div class="icon-box icon-box-md bg-primary-light">
                                                            <svg width="16" height="16" viewBox="0 0 16 16"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M9.16492 13.6286H14" stroke="#0D99FF"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M8.52001 2.52986C9.0371 1.91186 9.96666 1.82124 10.5975 2.32782C10.6324 2.35531 11.753 3.22586 11.753 3.22586C12.446 3.64479 12.6613 4.5354 12.2329 5.21506C12.2102 5.25146 5.87463 13.1763 5.87463 13.1763C5.66385 13.4393 5.34389 13.5945 5.00194 13.5982L2.57569 13.6287L2.02902 11.3149C1.95244 10.9895 2.02902 10.6478 2.2398 10.3849L8.52001 2.52986Z"
                                                                    stroke="#0D99FF" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path d="M7.34723 4.00059L10.9821 6.79201"
                                                                    stroke="#0D99FF" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                            </svg>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sub-card draggable-handle draggable">
                                            <div class="d-items">
                                                <div class="d-flex justify-content-between flex-wrap">
                                                    <div class="d-items-2">
                                                        <div>
                                                            <svg width="9" height="16" viewBox="0 0 9 16"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect width="1" height="1" fill="#888888" />
                                                                <rect y="3" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect y="6" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect y="9" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect y="12" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect y="15" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="4" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="4" y="3" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="4" y="6" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="4" y="9" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="4" y="12" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="4" y="15" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="8" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="8" y="3" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="8" y="6" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="8" y="9" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="8" y="12" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="8" y="15" width="1" height="1"
                                                                    fill="#888888" />
                                                            </svg>
                                                        </div>
                                                        <div>
                                                            <div class="form-check custom-checkbox">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="customCheckBox4" required>
                                                                <label class="form-check-label"
                                                                    for="customCheckBox4">Compete this projects
                                                                    Monday</label>
                                                            </div>
                                                            <span>2023-12-26 07:15:00</span>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="icon-box icon-box-md bg-danger-light me-1">
                                                            <svg width="16" height="16" viewBox="0 0 16 16"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M12.8833 6.31213C12.8833 6.31213 12.5213 10.8021 12.3113 12.6935C12.2113 13.5968 11.6533 14.1261 10.7393 14.1428C8.99994 14.1741 7.25861 14.1761 5.51994 14.1395C4.64061 14.1215 4.09194 13.5855 3.99394 12.6981C3.78261 10.7901 3.42261 6.31213 3.42261 6.31213"
                                                                    stroke="#FF5E5E" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path d="M13.8055 4.1598H2.50012" stroke="#FF5E5E"
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path
                                                                    d="M11.6271 4.1598C11.1037 4.1598 10.6531 3.7898 10.5504 3.27713L10.3884 2.46647C10.2884 2.09247 9.94974 1.8338 9.56374 1.8338H6.74174C6.35574 1.8338 6.01707 2.09247 5.91707 2.46647L5.75507 3.27713C5.65241 3.7898 5.20174 4.1598 4.67841 4.1598"
                                                                    stroke="#FF5E5E" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                            </svg>
                                                        </div>
                                                        <div class="icon-box icon-box-md bg-primary-light">
                                                            <svg width="16" height="16" viewBox="0 0 16 16"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M9.16492 13.6286H14" stroke="#0D99FF"
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M8.52001 2.52986C9.0371 1.91186 9.96666 1.82124 10.5975 2.32782C10.6324 2.35531 11.753 3.22586 11.753 3.22586C12.446 3.64479 12.6613 4.5354 12.2329 5.21506C12.2102 5.25146 5.87463 13.1763 5.87463 13.1763C5.66385 13.4393 5.34389 13.5945 5.00194 13.5982L2.57569 13.6287L2.02902 11.3149C1.95244 10.9895 2.02902 10.6478 2.2398 10.3849L8.52001 2.52986Z"
                                                                    stroke="#0D99FF" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path d="M7.34723 4.00059L10.9821 6.79201"
                                                                    stroke="#0D99FF" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                            </svg>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sub-card draggable-handle draggable">
                                            <div class="d-items">
                                                <div class="d-flex justify-content-between flex-wrap">
                                                    <div class="d-items-2">
                                                        <div>
                                                            <svg width="9" height="16" viewBox="0 0 9 16"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect y="3" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect y="6" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect y="9" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect y="12" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect y="15" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="4" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="4" y="3" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="4" y="6" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="4" y="9" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="4" y="12" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="4" y="15" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="8" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="8" y="3" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="8" y="6" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="8" y="9" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="8" y="12" width="1" height="1"
                                                                    fill="#888888" />
                                                                <rect x="8" y="15" width="1" height="1"
                                                                    fill="#888888" />
                                                            </svg>
                                                        </div>
                                                        <div>
                                                            <div class="form-check custom-checkbox">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="customCheckBox5" required>
                                                                <label class="form-check-label"
                                                                    for="customCheckBox5">Compete this projects
                                                                    Monday</label>
                                                            </div>
                                                            <span>2023-12-26 07:15:00</span>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="icon-box icon-box-md bg-danger-light me-1">
                                                            <svg width="16" height="16" viewBox="0 0 16 16"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M12.8833 6.31213C12.8833 6.31213 12.5213 10.8021 12.3113 12.6935C12.2113 13.5968 11.6533 14.1261 10.7393 14.1428C8.99994 14.1741 7.25861 14.1761 5.51994 14.1395C4.64061 14.1215 4.09194 13.5855 3.99394 12.6981C3.78261 10.7901 3.42261 6.31213 3.42261 6.31213"
                                                                    stroke="#FF5E5E" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path d="M13.8055 4.1598H2.50012" stroke="#FF5E5E"
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path
                                                                    d="M11.6271 4.1598C11.1037 4.1598 10.6531 3.7898 10.5504 3.27713L10.3884 2.46647C10.2884 2.09247 9.94974 1.8338 9.56374 1.8338H6.74174C6.35574 1.8338 6.01707 2.09247 5.91707 2.46647L5.75507 3.27713C5.65241 3.7898 5.20174 4.1598 4.67841 4.1598"
                                                                    stroke="#FF5E5E" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                            </svg>
                                                        </div>
                                                        <div class="icon-box icon-box-md bg-primary-light">
                                                            <svg width="16" height="16" viewBox="0 0 16 16"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M9.16492 13.6286H14" stroke="#0D99FF"
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M8.52001 2.52986C9.0371 1.91186 9.96666 1.82124 10.5975 2.32782C10.6324 2.35531 11.753 3.22586 11.753 3.22586C12.446 3.64479 12.6613 4.5354 12.2329 5.21506C12.2102 5.25146 5.87463 13.1763 5.87463 13.1763C5.66385 13.4393 5.34389 13.5945 5.00194 13.5982L2.57569 13.6287L2.02902 11.3149C1.95244 10.9895 2.02902 10.6478 2.2398 10.3849L8.52001 2.52986Z"
                                                                    stroke="#0D99FF" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path d="M7.34723 4.00059L10.9821 6.79201"
                                                                    stroke="#0D99FF" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                            </svg>
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
                </div>
            </div>
            <div class="col-xl-3 t-earn">
                <div class="card">
                    <div class="card-header border-0 pb-0">
                        <h4 class="heading mb-0">Total Earning</h4>
                    </div>
                    <div class="card-body px-0 overflow-hidden">
                        <div class="total-earning">
                            <h2>$6,743.00</h2>
                            <ul class="nav nav-underline mb-3 earning-tab earning-chart" id="pills-tab1"
                                role="tablist">
                                <li class="nav-item px-2" role="presentation">
                                    <button class="nav-link py-2 px-0 border-3 m-0 active" data-series="day"
                                        id="pills-day-tab1" data-bs-toggle="pill" data-bs-target="#pills-day1"
                                        type="button" role="tab" aria-selected="true">Day</button>
                                </li>
                                <li class="nav-item px-2" role="presentation">
                                    <button class="nav-link py-2 px-0 border-3 m-0" id="pills-week-tab1"
                                        data-series="week" data-bs-toggle="pill" data-bs-target="#pills-week1"
                                        type="button" role="tab" aria-selected="false">Week</button>
                                </li>
                                <li class="nav-item px-2" role="presentation">
                                    <button class="nav-link py-2 px-0 border-3 m-0" id="pills-month-tab1"
                                        data-series="month" data-bs-toggle="pill" data-bs-target="#pills-month1"
                                        type="button" role="tab" aria-selected="false">Month</button>
                                </li>
                                <li class="nav-item px-2" role="presentation">
                                    <button class="nav-link py-2 px-0 border-3 m-0" id="pills-year-tab1"
                                        data-series="year" data-bs-toggle="pill" data-bs-target="#pills-year1"
                                        type="button" role="tab" aria-selected="false">Year</button>
                                </li>
                            </ul>
                            <div id="earningChart"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</x-app-layout>
