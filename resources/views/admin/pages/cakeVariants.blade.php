@extends('admin.layouts.app', ['title' => 'Cakes'])

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Cakes</h4>
                                <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                                    data-bs-target="#addRowModal">
                                    <i class="fa fa-plus"></i>
                                    Add Variant
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Modal -->
                            <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header border-0">
                                            <h5 class="modal-title">
                                                <span class="fw-mediumbold"> New</span>
                                                <span class="fw-light"> Row </span>
                                            </h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="small">
                                                Create a new row using this form, make sure you
                                                fill them all
                                            </p>
                                            {{-- add variant form --}}
                                            <form id="createCake" action="{{ route('variants.store') }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <input class="form-control form-control-lg" type="text"
                                                            placeholder="Variant Name" aria-label="Variant Name"
                                                            name="variant_name">
                                                    </div>
                                                </div>
                                            </form>
                                            {{-- ******** --}}
                                        </div>
                                        <div class="modal-footer border-0">
                                            <button type="button" id="addRowButton" class="btn btn-primary">
                                                Add
                                            </button>
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                                Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th style="width: 3vw">SL</th>
                                            <th style="text-align: center">Name</th>
                                            <th style="width: 10%; text-align: center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($variants as $key => $variant)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td style="text-align: center">{{ $variant->variant_name }}</td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <button type="button" data-bs-toggle="tooltip" title=""
                                                            class="btn btn-link btn-primary btn-lg"
                                                            data-original-title="Edit Task">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button type="button" data-bs-toggle="tooltip" title=""
                                                            class="btn btn-link btn-danger" data-original-title="Remove">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!--   Core JS Files   -->
    <script src="../assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <!-- Datatables -->
    <script src="../assets/js/plugin/datatables/datatables.min.js"></script>
    <!-- Kaiadmin JS -->
    <script src="../assets/js/kaiadmin.min.js"></script>
    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="../assets/js/setting-demo2.js"></script>
    <script>
        $(document).ready(function() {
            // Add Row
            //$("#add-row").DataTable({
            //  pageLength: 5,
            //});

            $("#addRowButton").click(function() {
                $('#createCake').submit();
            });
        });
    </script>

    @error('variant_name')
        <script>
            $.notify({
                icon: 'fa fa-times-circle',
                title: 'Failed',
                message: `{{ $message }}`,
            }, {
                type: 'danger',
                placement: {
                    from: "top",
                    align: "right"
                },
                time: 5000,
            });
        </script>
    @enderror
    @if (@session('success'))
        <script>
            $.notify({
                icon: 'fa fa-check-circle',
                title: 'Success',
                message: `{{ Session::get('success') }}`,
            }, {
                type: 'success',
                placement: {
                    from: "top",
                    align: "right"
                },
                time: 5000,
            });
        </script>
    @endif
@endsection
