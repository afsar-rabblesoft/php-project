@extends('admin.master')
@section('title', 'User Data')
@section('content')

    <div class="main">
        @if (Session::has('success'))
            <div class="alert alert-success" id="msg">{{ Session::get('success') }}</div>
            {{ Session::forget('success') }}
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger" id="msg">{{ Session::get('error') }}</div>
            {{ Session::forget('error') }}
        @endif
        <nav class="navbar navbar-expand navbar-light navbar-bg">
            <a class="sidebar-toggle js-sidebar-toggle">
                <i class="hamburger align-self-center"></i>
            </a>

            <div class="navbar-collapse collapse">
                <ul class="navbar-nav navbar-align">
                    <li class="nav-item dropdown">
                        <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#"
                            data-bs-toggle="dropdown">
                            <i class="align-middle" data-feather="settings"></i>
                        </a>
                        <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#"
                            data-bs-toggle="dropdown">
                            <img src="{{ asset('img/avatars/avatar.jpg') }}" class="avatar img-fluid rounded me-1"
                                alt="Charles Hall" /> <span class="text-dark">Charles Hall</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="pages-profile.html"><i class="align-middle me-1"
                                    data-feather="user"></i> Profile</a>
                            <a class="dropdown-item" href="#"><i class="align-middle me-1"
                                    data-feather="pie-chart"></i> Analytics</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="index.html"><i class="align-middle me-1"
                                    data-feather="settings"></i> Settings & Privacy</a>
                            <a class="dropdown-item" href="#"><i class="align-middle me-1"
                                    data-feather="help-circle"></i> Help Center</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Log out</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <main class="content ">

            <div class="container-fluid p-0">

                <div class="row justify-content-center">
                    <div class="col-3">
                        <div class="card">
                            <div class="card-body">
                                <img src="{{ asset($result->image) }}" class="img-fluid" />
                            </div>
                        </div>

                    </div>
                    <div class="col-6 ">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row-reverse">
                                    <div class="p-2"> <a href="{{ url()->previous() }}" class="btn btn-dark"
                                            style="background-color: #343a41 ;">Back</a></div>


                                </div>
                                <div class="row mt-2">
                                    <div class="col-6">
                                        <label for="name" class="blockquote">Name</label>
                                        <h4 class="mt-2 blockquote ">{{ $result->name ?? '' }}</h4>
                                    </div>
                                    <div class="col-6">
                                        <label for="email" class="blockquote">Email</label>
                                        <h4 class="mt-2 blockquote">{{ $result->email ?? '' }}</h4>
                                    </div>
                                </div>
                                <div class="row mt-2 ">

                                    <div class="col-6">
                                        <label for="state" class="blockquote">state</label>
                                        <h4 class="mt-2 blockquote">{{ $result->state ?? '' }}</h4>
                                    </div>
                                    <div class="col-6">
                                        <label for="country" class="blockquote">country</label>
                                        <h4 class="mt-2 blockquote">{{ $result->country ?? '' }}</h4>
                                    </div>
                                    <div class="col-6" class="blockquote">
                                        <label for="city">city</label>
                                        <h4 class="mt-2 blockquote">{{ $result->city ?? '' }}</h4>
                                    </div>
                                    <div class="col-6" class="blockquote">
                                        <label for="zip">zip</label>
                                        <h4 class="mt-2 blockquote">{{ $result->zipcode ?? '' }}</h4>
                                    </div>
                                    <div class="col-12 ">
                                        <label for="address" class="blockquote ">Address</label>
                                        <h4 class="mt-2 blockquote">{{ $result->address }}</h4>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    @if (isset($result['surveyinfo']['status']) && $result['surveyinfo']['status'] == 'Completed')

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mt-2 text-center">
                                            <label for="address" class="blockquote ">Survey Details</label>

                                            <div class="col-6 ">
                                                <label for="survey" class="blockquote ">Survey Status</label>

                                                <h4 class="mt-2 blockquote">{{ $result['surveyinfo']['status'] }}</h4>
                                            </div>
                                            <div class="col-6 ">
                                                <label for="survey" class="blockquote ">Completed On</label>

                                                <h4 class="mt-2 blockquote">
                                                    {{ date('l jS  F Y', strtotime($result['surveyinfo']['created_at'])) }}
                                                </h4>
                                            </div>
                                        </div>
                                        @if (count($result['answers']) > 0)

                                            @foreach ($result['answers'] as $key => $value)
                                                <div class="row mt-2 text-center">
                                                    <div class="col-12 ">
                                                        <label for="address" class="blockquote ">
                                                            {{ $value['question']['question'] }}</label>
                                                        <h4 class="mt-2 blockquote">{{  $value['answer'] }}</h4>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mt-2 text-center">
                                            <label for="address" class="blockquote ">Survey Details</label>

                                            <div class="col-6 ">
                                                <label for="survey" class="blockquote ">Survey Status</label>

                                                <h4 class="mt-2 blockquote">Not Completed</h4>
                                            </div>
                                            <div class="col-6 ">
                                                <label for="survey" class="blockquote ">Completed On</label>

                                                <h4 class="mt-2 blockquote">Not Completed</h4>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </main>

        <footer class="footer">
            <div class="container-fluid">
                <div class="row text-muted">
                    <div class="col-6 text-start">
                        <p class="mb-0">
                            <a class="text-muted" href="https://adminkit.io/"
                                target="_blank"><strong>AdminKit</strong></a>
                            - <a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>Bootstrap Admin
                                    Template</strong></a> &copy;
                        </p>
                    </div>
                    <div class="col-6 text-end">
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a class="text-muted" href="https://adminkit.io/" target="_blank">Support</a>
                            </li>
                            <li class="list-inline-item">
                                <a class="text-muted" href="https://adminkit.io/" target="_blank">Help Center</a>
                            </li>
                            <li class="list-inline-item">
                                <a class="text-muted" href="https://adminkit.io/" target="_blank">Privacy</a>
                            </li>
                            <li class="list-inline-item">
                                <a class="text-muted" href="https://adminkit.io/" target="_blank">Terms</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

        <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
            crossorigin="anonymous"></script>

    @endsection
