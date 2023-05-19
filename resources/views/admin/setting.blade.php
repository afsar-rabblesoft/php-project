@extends('admin.master')
@section('title', 'Setting')
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
        <main class="content">
            <div class="container-fluid p-0">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="text-center">Setting</h3>
                            </div>

                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="text-center">Survey Title</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ url('/admin/addsurvey') }}" class="forms-sample" method="POST"
                                    enctype="multipart/form-data" autocomplete="off">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleInput1" class="form-label ">Survey Title</label>

                                        <input type="text" class="form-control  mt-1 mb-1" id="exampleInput1"
                                            aria-describedby="emailHelp" required name="title"
                                            @if (!empty($result) && isset($result[0]['title'])) value="{{ $result[0]['title'] }}  " @endif>
                                        @if (!empty($result) && isset($result[0]['title']))
                                            <input type="hidden" class="form-control" aria-describedby="emailHelp"
                                                value="{{ $result[0]['id'] }} " name="survey_id">
                                        @endif
                                    </div>


                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="text-center">Survey Questions</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ url('/admin/questions') }}" class="forms-sample" method="POST"
                                    enctype="multipart/form-data" autocomplete="off">
                                    @csrf
                                    <input type="hidden"  value="{{ $result[0]['id'] }}" name="survey_id">
                                    <select class="form-select mt-1 mb-1" aria-label="Default select example" name="category">
                                        <option value="1">Category 1</option>
                                        <option value="2">Category 2</option>
                                        <option value="3">Category 3</option>
                                        <option value="4">Category 4</option>
                                      </select>
                                    <div class="input-form">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="name_1" name="name_1"
                                                aria-describedby="emailHelp" class='txt'>
                                        </div>
                                        {{-- <div class="mb-3">
                                            <input type="text" class="form-control" id="name_2" class='txt'>
                                        </div> --}}
                                    </div>
                                    <input type='button' id='but_add' class="btn btn-primary" value='Add Questions'>
                                    <button type="submit" class="btn btn-primary">Submit</button>

                                </form>
                            </div>
                        </div>

                    </div>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>


        <script>
            $(document).ready(function() {

                $('#but_add').click(function() {

                    // Selecting last id 
                    var lastname_id = $('.input-form input[type=text]:nth-child(1)').last().attr('id');
                    var split_id = lastname_id.split('_');

                    // New index
                    var index = Number(split_id[1]) + 1;

                    // Create clone
                    var newel = $('.input-form:last').clone(true);

                    // Set id of new element
                    $(newel).find('input[type=text]:nth-child(1)').attr("id", "name_" + index);

                    // Set name of new element
                    $(newel).find('input[type=text]:nth-child(1)').attr("name", "name_" + index);
         

                    // Insert element
                    $(newel).insertAfter(".input-form:last");
                });

            });
        </script>

    @endsection
