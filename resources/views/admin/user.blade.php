@extends('admin.master')
@section('title', 'User')
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
                    <div class="col align-self-start">
                        <button type="button" class="btn btn-primary m-2" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Add User
                        </button>
                    </div>

                </div>




                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header ">

                                <form action="{{ url('admin/user/') }}">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="search" name="q" class="form-control my-search-box"
                                            placeholder="Search" value="{{ $data['q'] ?? '' }}">

                                        <div class="input-group-append ">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-search" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                </form>
                            </div>

                            <div class="table-responsive">

                                <div class="card-body">
                                    <table class="table">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Address</th>
                                                <th scope="col">Zip Code</th>
                                                <th scope="col">Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($result) > 0)

                                                <?php $firstItemIndex = $result->firstItem(); ?>

                                                @foreach ($result as $key => $value)
                                                    <tr>
                                                        @if ($value->is_admin == 0)
                                                            <td>{{ $firstItemIndex++ }}</td>
                                                            <td>{{ $value->name }}</td>
                                                            <td>{{ $value->email }}</td>
                                                            <td style="word-wrap: break-word ; max-width:2px;">
                                                                {{ $value->address }}</td>
                                                            <td>{{ $value->zipcode }}</td>
                                                            <td>


                                                                <!-- Modal -->
                                                                <div class="modal fade"
                                                                    id="staticBackdrop{{ $value->id }}"
                                                                    data-bs-backdrop="static" data-bs-keyboard="false"
                                                                    tabindex="-1"
                                                                    aria-labelledby="staticBackdropLabel{{ $value->id }}"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="exampleModalLabel">Update User</h5>
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body ">
                                                                                <form
                                                                                    action="{{ url('/admin/user/' . $value->id) }}"
                                                                                    class="forms-sample" method="POST"
                                                                                    enctype="multipart/form-data"
                                                                                    autocomplete="off">
                                                                                    @method('put')
                                                                                    @csrf
                                                                                    <div class="row">
                                                                                        <div class="col-6">
                                                                                            <div class="mb-3">
                                                                                                <label
                                                                                                    for="exampleInputName2"
                                                                                                    class="form-label">Name</label>
                                                                                                <input type="text"
                                                                                                    class="form-control"
                                                                                                    id="name2"
                                                                                                    name="name"
                                                                                                    value="{{ $value->name }}">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-6">
                                                                                            <div class="mb-3">
                                                                                                <label
                                                                                                    for="exampleInputEmail2"
                                                                                                    class="form-label">Email
                                                                                                    address</label>
                                                                                                <input type="email"
                                                                                                    class="form-control"
                                                                                                    id="email2"
                                                                                                    name="email"
                                                                                                    aria-describedby="emailHelp"
                                                                                                    value="{{ $value->email }}">

                                                                                            </div>
                                                                                        </div>
                                                                                        {{-- <div class="col-6">
                                                                                            <div class="mb-3">
                                                                                                <label
                                                                                                    for="exampleInputPassword2"
                                                                                                    class="form-label">Password</label>
                                                                                                <input type="password"
                                                                                                    class="form-control"
                                                                                                    id="password2"
                                                                                                    name="password" >
                                                                                            </div>
                                                                                        </div> --}}
                                                                                        <div class="col-6">
                                                                                            <div class="mb-3">
                                                                                                <label
                                                                                                    for="exampleInputAddress2"
                                                                                                    class="form-label">Address</label>
                                                                                                <input type="text"
                                                                                                    class="form-control"
                                                                                                    id="Address2"
                                                                                                    name="address"
                                                                                                    value="{{ $value->address }}">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-6">
                                                                                            <div class="mb-3">
                                                                                                <label
                                                                                                    for="exampleInputCity2"
                                                                                                    class="form-label">City</label>
                                                                                                <input type="text"
                                                                                                    class="form-control"
                                                                                                    id="city2"
                                                                                                    name="city"
                                                                                                    value="{{ $value->city }}">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-6">

                                                                                            <div class="mb-3">
                                                                                                <label
                                                                                                    for="exampleInputState2"
                                                                                                    class="form-label">State</label>
                                                                                                <input type="text"
                                                                                                    class="form-control"
                                                                                                    id="state2"
                                                                                                    name="state"
                                                                                                    value="{{ $value->state }}">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-6">
                                                                                            <div class="mb-3">
                                                                                                <label
                                                                                                    for="exampleInputCountry2"
                                                                                                    class="form-label">Country</label>
                                                                                                <input type="text"
                                                                                                    class="form-control"
                                                                                                    id="country2"
                                                                                                    name="country"
                                                                                                    value="{{ $value->country }}">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-6">
                                                                                            <div class="mb-3">
                                                                                                <label
                                                                                                    for="exampleInputZip2"
                                                                                                    class="form-label">Zip
                                                                                                    Code</label>
                                                                                                <input type="text"
                                                                                                    class="form-control"
                                                                                                    id="zip2"
                                                                                                    name="zip"
                                                                                                    value="{{ $value->zipcode }}">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="mb-3">
                                                                                        <label for="exampleInputFile2"
                                                                                            class="form-label">Image</label>
                                                                                        <input type="hidden"
                                                                                            class="form-control"
                                                                                            id="image3" name="image2" value="{{ $value->image }}">
                                                                                            <input type="file"
                                                                                            class="form-control"
                                                                                            id="image2" name="image" value="{{ $value->image }}">
                                                                                    </div>
                                                                                    <img id="imgPreview2"
                                                                                        src="
                                                                                    {{ asset($value->image) }}"
                                                                                        height="50px" width="50px"
                                                                                        class="img-fluid" />

                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal">Close</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-primary">Submit</button>
                                                                            </div>
                                                                            </form>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <a href="{{ url('admin/user/' . $value->id) }}"
                                                                    class="btn btn-info btn-sm" title="view"><i
                                                                        class="fa fa-eye" style="font-size:20px"></i></a>
                                                                <!-- Button trigger modal -->
                                                                <button type="button" class="btn btn-primary"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#staticBackdrop{{ $value->id }}">
                                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                                </button>
                                                              
                                                                <form id="myFormId{{$value['id']}}" action="{{ url('admin/user/'.$value->id) }}" method="POST" style="display:inline-block">
                                                                    @method('delete')
                                                                    @csrf
                                                                    <button type="button" class="btn btn-danger"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#staticDelete{{ $value->id }}">
                                                                    <i class="fa fa-trash" aria-hidden="true"
                                                                        style="font-size:20px"></i>
                                                                </button>

                                                                </form>
                                                                <!-- Modal -->
                                                                <div class="modal fade"
                                                                    id="staticDelete{{ $value->id }}"
                                                                    data-bs-backdrop="static" data-bs-keyboard="false"
                                                                    tabindex="-1"
                                                                    aria-labelledby="staticDeleteLabelstaticDelete{{ $value->id }}"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="staticDeleteLabelstaticDelete{{ $value->id }}">
                                                                                    Delete User</h5>
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <h5>Are you sure to delete {{ $value->name ?? ''}} </h5>

                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal">Close</button>
                                                                                    <button type="button" class="btn btn-danger" onclick="$('#myFormId{{$value['id']}}').submit()">Delete</button>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                {{-- <a href="{{ url('admin/user/' . $value->id) }}"
                                                                    title="delete" class="btn btn-danger btn-sm"><i
                                                                        class="fa fa-trash" aria-hidden="true"
                                                                        style="font-size:20px"></i></a> --}}

                                                            </td>
                                                        @endif


                                                    </tr>
                                                @endforeach

                                        <tfoot class="datatable">
                                            <tr>
                                                <td class="text" colspan="8">
                                                    <?php echo 'Showing ' . $result->firstItem() . ' to ' . $result->lastItem() - 1 . ' out of ' . $result->total() - 1 . ' entries'; ?>
                                                    <div style="float: right;">
                                                        {{ $result->withQueryString()->links() }}
                                                    </div>
                                                </td>
                                            </tr>

                                        </tfoot>
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="8">No Record Found</td>
                                        </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
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


        <!-- Modal -->
        <div class="modal fade mt-5 " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog mt-5">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body ">
                        <form action="{{ url('/admin/user') }}" class="forms-sample" method="POST"
                            enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="exampleInputName1" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            aria-describedby="emailHelp" required>

                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="exampleInputAddress1" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="Address" name="address" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="exampleInputCity1" class="form-label">City</label>
                                        <input type="text" class="form-control" id="city" name="city">
                                    </div>
                                </div>
                                <div class="col-6">

                                    <div class="mb-3">
                                        <label for="exampleInputState1" class="form-label">State</label>
                                        <input type="text" class="form-control" id="state" name="state">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="exampleInputCountry1" class="form-label">Country</label>
                                        <input type="text" class="form-control" id="country" name="country">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="exampleInputZip1" class="form-label">Zip Code</label>
                                        <input type="text" class="form-control" id="zip" name="zip">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputFile1" class="form-label">Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                            <img id="imgPreview" src="#" height="50px" width="50px" class="img-fluid"
                                style="display:none" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                </div>

            </div>
        </div>



        <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
            crossorigin="anonymous"></script>
        <script>
            document.getElementById("image").addEventListener('click', function() {
                document.getElementById("imgPreview").style.display = "block";
            })
            $(document).ready(() => {

                $('#image').change(function() {
                    const file = this.files[0];
                    if (file) {
                        let reader = new FileReader();
                        reader.onload = function(event) {
                            $('#imgPreview').attr('src', event.target.result);
                        }
                        reader.readAsDataURL(file);
                    }
                });
            });
            document.getElementById("image").addEventListener('click', function() {
                document.getElementById("imgPreview2").style.display = "block";
            })
            $(document).ready(() => {

                $('#image').change(function() {
                    const file = this.files[0];
                    if (file) {
                        let reader = new FileReader();
                        reader.onload = function(event) {
                            $('#imgPreview2').attr('src', event.target.result);
                        }
                        reader.readAsDataURL(file);
                    }
                });
            });
        </script>

    @endsection
