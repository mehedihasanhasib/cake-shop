@extends('admin.layouts.app', ['title' => 'Cakes'])

@section('style')
    <style>
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Remove spinner buttons for Firefox */
        input[type="number"] {
            -moz-appearance: textfield;
        }

        #image-preview {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .image-container {
            position: relative;
            display: inline-block;
            left: 0.7vw;
        }

        .image-container img {
            max-width: 150px;
            max-height: 150px;
            border: 2px solid #ddd;
            border-radius: 4px;
            padding: 5px;
            background: #fff;
        }

        .close-button {
            position: absolute;
            top: 5px;
            right: 5px;
            background: rgba(255, 0, 0, 0.7);
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            font-size: 12px;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
@endsection

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
                                    data-bs-target="#createCakeModal">
                                    <i class="fa fa-plus"></i>
                                    Add Cake
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Modal -->
                            <div class="modal fade modal-lg" id="createCakeModal" tabindex="-1" role="dialog"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header border-0">
                                            <h5 class="modal-title" style="margin-left:6px">
                                                <span class="fw-mediumbold">Add</span>
                                                <span class="fw-mediumbold"> Cake </span>
                                            </h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            {{-- create cake form --}}
                                            <form id="createCakeForm" action="{{ route('cakes.store') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-lg"
                                                        id="name" placeholder="Cake Name" name="name"
                                                        value="{{ old('name') ?? null }}">
                                                    @error('name')
                                                        <span style="color: red">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <select name="cake_variant_id" id=""
                                                        class="form-select form-select-lg">
                                                        <option value="{{ null }}">Select Variant</option>
                                                        @foreach ($variants as $variant)
                                                            <option value="{{ $variant->id }}">{{ $variant->variant_name }}
                                                            </option>
                                                        @endforeach
                                                        @if (old('cake_variant_id') != null)
                                                            @foreach ($variants as $variant)
                                                                @if ($variant->id == old('cake_variant_id'))
                                                                    <option selected value="{{ $variant->id }}">
                                                                        {{ $variant->variant_name }}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    @error('cake_variant_id')
                                                        <span style="color: red">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div id="image-preview"></div>
                                                <div class="form-group">
                                                    <input id="image-input" type="file"
                                                        class="form-control form-control-lg" name="images[]"
                                                        accept="image/jpg, image/jpeg, image/png" multiple>
                                                    @error('images*')
                                                        <span style="color: red">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <input type="number" class="form-control form-control-lg"
                                                        name="price" placeholder="Price"
                                                        value="{{ old('price') ?? null }}">
                                                    @error('price')
                                                        <span style="color: red">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </form>
                                            {{-- ******** --}}
                                        </div>
                                        <div class="modal-footer border-0">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                                Close
                                            </button>
                                            <button type="button" id="createCakeSubmit" class="btn btn-primary">
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
                                            <th style="text-align: center">Variant</th>
                                            <th style="text-align: center">Picture</th>
                                            <th style="text-align: center">Price</th>
                                            <th style="width: 10%; text-align: center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td style="text-align: center">
                                                {{-- {{ ucfirst(trans(strtolower($variant->variant_name))) }} --}}
                                            </td>
                                            <td style="text-align: center">
                                                {{-- {{ ucfirst(trans(strtolower($variant->variant_name))) }} --}}
                                            </td>
                                            <td style="text-align: center">
                                                {{-- {{ ucfirst(trans(strtolower($variant->variant_name))) }} --}}
                                            </td>
                                            <td style="text-align: center">
                                                {{-- {{ ucfirst(trans(strtolower($variant->variant_name))) }} --}}
                                            </td>
                                            <td>
                                                <div class="form-button-action">
                                                    <button data-id="" data-variantName="" type="button"
                                                        class="btn btn-link btn-primary btn-lg"
                                                        data-original-title="Edit Task" data-bs-toggle="modal"
                                                        data-bs-target="#updateModal">
                                                        <i class="fa fa-edit"></i>
                                                    </button>

                                                    <button data-id="" type="button" data-bs-toggle="tooltip"
                                                        title="" class="btn btn-link btn-danger deleteButton"
                                                        data-original-title="Remove">
                                                        <i class="fa fa-times"></i>
                                                    </button>

                                                </div>
                                            </td>
                                        </tr>
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
            $("#createCakeSubmit").click(function() {
                $("#createCakeForm").submit();
            })
        })
    </script>


    <script>
        document.getElementById('image-input').addEventListener('change', function(event) {
            const imagePreviewContainer = document.getElementById('image-preview');
            const files = event.target.files;

            // imagePreviewContainer.innerHTML = ''; // Clear previous previews

            const array = Array.from(files);

            array.forEach((file, index) => {
                const reader = new FileReader(file);

                reader.onload = function(e) {

                    const imageContainer = document.createElement('div');
                    imageContainer.classList.add('image-container');

                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.alt = file.name;

                    const closeButton = document.createElement('button');
                    closeButton.innerHTML = '&times;';
                    closeButton.classList.add('close-button');
                    closeButton.addEventListener('click', function() {
                        imageContainer.remove();
                        removeFile(index);
                    });

                    imageContainer.appendChild(img);
                    imageContainer.appendChild(closeButton);

                    imagePreviewContainer.appendChild(imageContainer);
                };
                reader.readAsDataURL(file);
            });

            function removeFile(index) {
                const dt = new DataTransfer();
                const input = document.getElementById('image-input');
                const {
                    files
                } = input;
                for (let i = 0; i < files.length; i++) {
                    if (i !== index) {
                        dt.items.add(files[i]);
                    }
                }
                input.files = dt.files;
            }
        });
    </script>

    {{-- error messages --}}
    {{-- @error('name')
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
    @error('variant')
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
    @error('images')
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
    @enderror --}}

    @if ($errors->any())
        <script>
            $(document).ready(function() {
                $('#createCakeModal').modal('show');
            })
        </script>
    @endif


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
