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
                                            <h5 class="modal-title" style="margin-left:6px">
                                                <span class="fw-mediumbold">Add</span>
                                                <span class="fw-mediumbold"> Variant </span>
                                            </h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            {{-- create variant form --}}
                                            <form id="createVariant" action="{{ route('variants.store') }}" method="POST">
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
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                                Close
                                            </button>
                                            <button type="button" id="addRowButton" class="btn btn-primary">
                                                Add
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            {{-- edit modal --}}
                            <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header border-0">
                                            <h5 class="modal-title" style="margin-left:6px">
                                                <span class="fw-mediumbold"> Edit</span>
                                                <span class="fw-mediumbold"> Variant </span>
                                            </h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        {{-- edit form --}}
                                        <div class="modal-body">
                                            <form id="updateVariant" method="POST">
                                                @csrf
                                                @method('put')
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <input id="variantName" class="form-control form-control-lg"
                                                            type="text" placeholder="Variant Name"
                                                            aria-label="Variant Name" name="variant_name">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="modal-footer border-0">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                                Close
                                            </button>
                                            <button type="button" id="updateButton" class="btn btn-primary">
                                                Update
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div> {{-- edit modal ends --}}

                            {{-- delete form --}}
                            <form id="deleteVariant" method="post">
                                @csrf
                                @method('delete')
                            </form>

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
                                                <td style="text-align: center">{{ $key + 1 }}</td>
                                                <td style="text-align: center">
                                                    {{ ucfirst(trans(strtolower($variant->variant_name))) }}
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">

                                                        <button data-id="{{ $variant->id }}"
                                                            data-variantName="{{ ucfirst(trans(strtolower($variant->variant_name))) }}"
                                                            type="button" style="padding: 8px !important;" class="btn btn-sm btn-primary m-1" data-bs-toggle="modal"
                                                            data-bs-target="#updateModal">
                                                            <i class="fa fa-edit"></i>
                                                        </button>

                                                        <button data-id="{{ $variant->id }}" type="button"
                                                            data-bs-toggle="tooltip" style="padding: 8px !important;" class="btn btn-sm btn-danger m-1 deleteButton"
                                                        >
                                                            <i class="fa fa-trash"></i>
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
    <script>
        $(document).ready(function() {
            // Add Row
            $("#add-row").DataTable({
                pageLength: 5,
            });

            // submit create variant form
            $("#addRowButton").click(function() {
                $('#createVariant').submit();
            });

            // submit update form
            $("#updateButton").click(function() {
                $('#updateVariant').submit();
            });

            // delete
            $(".deleteButton").click(function() {
                swal({
                    title: "Are you sure?",
                    text: "You want to delete the variant?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        const id = $(this).data('id');
                        const route = `/admin/variants/${id}`
                        $("#deleteVariant").attr("action", route)
                        $("#deleteVariant").submit()
                    }
                });
            })

            $("#updateModal").on("show.bs.modal", function(event) {
                const id = $(event.relatedTarget).data('id');
                const variantName = $(event.relatedTarget).data("variantname")
                const route = `/admin/variants/${id}`

                $("#variantName").val(variantName);
                $("#variantName").attr('value', variantName);

                $("#updateButton").prop("disabled", true);

                $("#variantName").on('input', function() {
                    $("#updateButton").prop("disabled", false);
                })

                $("#updateVariant").attr("action", route)
            })

            $("#updateModal").on("hidden.bs.modal", function(event) {
                $("#variantName").attr('value', '')
            })
        });
    </script>

    {{-- error messages --}}
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
                time: 10000,
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
    @if (@session('error'))
        <script>
            $.notify({
                icon: 'fa fa-times-circle',
                title: 'Failed',
                message: `{{ Session::get('error') }}`,
            }, {
                type: 'danger',
                placement: {
                    from: "top",
                    align: "right"
                },
                time: 5000,
            });
        </script>
    @endif

    @if (@session('info'))
        <script>
            $.notify({
                icon: 'fa fa-info-circle',
                title: 'Failed',
                message: `{{ Session::get('info') }}`,
            }, {
                type: 'warning',
                placement: {
                    from: "top",
                    align: "right"
                },
                time: 5000,
            });
        </script>
    @endif
@endsection
