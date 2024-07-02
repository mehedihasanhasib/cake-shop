@extends('admin.layouts.app', ['title' => 'Cakes'])

@section('style')
    {{-- create cake style --}}
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

        #image-preview,
        #image-preview-edit {
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
    </style>


    {{-- edit cake style --}}
    <style>
        .image-container2 img {
            max-width: 150px;
            max-height: 150px;
            border: 2px solid #ddd;
            border-radius: 4px;
            padding: 1px;
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


    {{-- popup cake show --}}
    <style>
        #cake_image_show {
            position: absolute;
            top: 0;
            left: 0;
            height: 100vh;
            width: 99.1vw;
            background: hsla(0, 0%, 0%, 0.500);
            z-index: 9999;
            display: none;
        }

        #popup_close_button {
            position: absolute;
            right: 12px;
            top: 9px;
            color: red;
            font-size: 24px;
            cursor: pointer;
        }

        #popup_close_button:hover {
            color: darkred;
        }
    </style>
@endsection



@section('popup_div')
    <div id="cake_image_show">
        <div>
            <i id="popup_close_button" class="fa fa-times-circle da-2x"></i>
        </div>
        <img src="" alt="">
    </div>
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
                            <!-- {{-- cake create Modal --}} -->
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
                                            <form id="createCakeForm" action="{{ route('cakes.store') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-lg"
                                                        placeholder="Cake Name" name="name"
                                                        value="{{ old('name') ?? null }}">
                                                    @error('name')
                                                        <span style="color: red">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <select name="cake_variant_id" class="form-select form-select-lg">
                                                        <option value="{{ null }}">Select Variant</option>
                                                        @foreach ($variants as $variant)
                                                            @php
                                                                $hasOld = old('cake_variant_id') != null ? true : false;
                                                                $selected = $hasOld
                                                                    ? ($variant->id == old('cake_variant_id')
                                                                        ? 'selected'
                                                                        : null)
                                                                    : null;
                                                            @endphp
                                                            <option {{ $selected }} value="{{ $variant->id }}">
                                                                {{ $variant->variant_name }}
                                                            </option>
                                                        @endforeach

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


                            <!-- {{-- edit modal --}} -->
                            <div class="modal fade modal-lg" id="updateCakeModal" tabindex="-1" role="dialog"
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
                                            <form id="updateCakeForm" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('put')

                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-lg"
                                                        id="name" placeholder="Cake Name" name="name"
                                                        value="{{ old('name') ?? null }}">
                                                    @error('name')
                                                        <span style="color: red">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <select id="variant" name="cake_variant_id"
                                                        class="form-select form-select-lg">
                                                        <option value="{{ null }}">Select Variant</option>
                                                        @foreach ($variants as $variant)
                                                            <option value="{{ $variant->id }}">
                                                                {{ $variant->variant_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('cake_variant_id')
                                                        <span style="color: red">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div id="image-preview-edit"></div>
                                                <div class="form-group">
                                                    <input id="image-input-edit" type="file"
                                                        class="form-control form-control-lg" name="updated_images[]"
                                                        accept="image/jpg, image/jpeg, image/png" multiple>
                                                    @error('updated_images*')
                                                        <span style="color: red">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <input id="price" type="number"
                                                        class="form-control form-control-lg" name="price"
                                                        placeholder="Price" value="{{ old('price') ?? null }}">
                                                    @error('price')
                                                        <span style="color: red">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer border-0">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                                Close
                                            </button>
                                            <button type="button" id="updateCakeSubmit" class="btn btn-primary">
                                                Update
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div> {{-- edit modal ends --}}

                            {{-- delete form --}}
                            <form id="deleteCakeForm" method="post">
                                @csrf
                                @method('delete')
                            </form>


                            {{-- table --}}
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center; width: 3vw">SL</th>
                                            <th style="text-align: center; width: 12vw;">Name</th>
                                            <th style="text-align: center">Picture</th>
                                            <th style="text-align: center; width: 4vw;">Variant</th>
                                            <th style="text-align: center; width: 3vw;">Price</th>
                                            <th style="width: 10%; text-align: center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cakes as $key => $cake)
                                            <tr style="height: 5vh">
                                                <td style="text-align: center;">{{ $key + 1 }}</td>
                                                <td style="text-align: center;">
                                                    {{ $cake->name }}
                                                </td>
                                                <td
                                                    style="text-align: center; display: flex; justify-content: center; align-items: center;min-height: 12vh;">
                                                    @foreach ($cake->images as $image)
                                                        <div class="image-container2">
                                                            <img class="cake-image" data-path="{{ asset($image->path) }}"
                                                                src="{{ asset($image->path) }}" alt="image"
                                                                width="55" height="55" style="cursor: pointer">
                                                        </div>
                                                    @endforeach
                                                </td>
                                                <td style="text-align: center;">
                                                    {{ $cake->cake_variant->variant_name }}
                                                </td>
                                                <td style="text-align: center;">
                                                    {{ $cake->price }}
                                                </td>

                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <button type="button" style="padding: 8px !important;" class="btn btn-sm btn-primary m-1" data-bs-toggle="modal" data-bs-target="#updateCakeModal" data-cake="{{ $cake }}">
                                                            <i class="fa fa-edit fa-lg"></i>
                                                            {{-- Edit --}}
                                                        </button>

                                                        <button data-id="{{ $cake->id }}" type="button" style="padding: 8px !important;" class="btn btn-sm btn-danger m-1 delete-button">
                                                            <i class="fa fa-trash fa-lg"></i>
                                                            {{-- Delete --}}
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div> {{-- table ends --}}
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
            $("#add-row").DataTable({
                pageLength: 7,
            });

            $("#createCakeSubmit").click(function() {
                $("#createCakeForm").submit();
            })

            $("#updateCakeSubmit").click(function() {
                $("#updateCakeForm").submit();
            })
        })
    </script>

    <!-- {{-- image preview --}} -->
    <script>
        // create modal
        let imageInput = document.getElementById('image-input')
        let images = new DataTransfer()

        imageInput.addEventListener('change', function(event) {
            const imagePreviewContainer = document.getElementById('image-preview');
            const files = event.target.files;
            const currentSelectedImages = new DataTransfer();
            
            const array = Array.from(files);
            array.forEach((file, index) => {

                currentSelectedImages.items.add(file);

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

            // console.log(currentSelectedImages.files);

            for (let i = 0; i < currentSelectedImages.files.length; i++) {
                images.items.add(currentSelectedImages.files[i])
            }

            function removeFile(index) {
                const updatedImages = new DataTransfer();
                const  files  = imageInput.files;
                const selectedToRemoveFileName = files[index].name;


                for (let i = 0; i < images.files.length; i++) {
                    if (selectedToRemoveFileName != images.files[i].name) {
                        updatedImages.items.add(files[i]);
                    }
                }

                images = updatedImages;
                imageInput.files = images.files
                console.log(imageInput.files);
            }
            
            imageInput.files = images.files
        });

        // edit modal
        document.getElementById('image-input-edit').addEventListener('change', function(event) {
            const imagePreviewContainer = document.getElementById('image-preview-edit');
            const files = event.target.files;

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
                const input = document.getElementById('image-input-edit');
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

    <!-- {{-- update --}} -->
    <script>
        $(document).ready(function() {
            $("#updateCakeModal").on("show.bs.modal", function(event) {
                const form = document.getElementById("updateCakeForm")
                const input = document.createElement('input')
                const inputs = form.elements
                input.name = "imagesToRemove"
                input.type = "hidden"
                let ids = [];

                for (let i = 0; i < inputs.length; i++) {
                    
                    if (inputs[i].name == "imagesToRemove") {
                       ids = []
                    }
                    
                }

                const cake = $(event.relatedTarget).data('cake');

                const {
                    id: cakeId,
                    name: cakeName,
                    variantName,
                    cake_variant_id: variantId,
                    price: price,
                    images: images
                } = cake;

                // name field
                $("#name").val(cakeName);
                $("#name").attr('value', cakeName);

                // variant select
                const select = document.getElementById("variant");
                Array.from(select).forEach(function(element, index) {
                    if (element.value == variantId) {
                        element.setAttribute('selected', true)
                    }
                })

                // image
                const imagePreviewContainer = document.getElementById('image-preview-edit');
                imagePreviewContainer.innerHTML = '';

                images.forEach(function(image, index) {
                    const imageContainer = document.createElement('div');
                    imageContainer.classList.add('image-container');
                    const img = document.createElement('img');
                    img.src = image.path;
                    img.alt = "image";

                    const closeButton = document.createElement('button');
                    closeButton.innerHTML = '&times;';
                    closeButton.classList.add('close-button');
                    
                    closeButton.addEventListener('click', function() {
                        imageContainer.remove();
                        ids.push(image.id)
                        input.value = JSON.stringify(ids);
                    });
                    
                    form.appendChild(input)

                    imageContainer.appendChild(img);
                    imageContainer.appendChild(closeButton);

                    imagePreviewContainer.appendChild(imageContainer);
                })

                // price field
                $("#price").val(price);
                $("#price").attr('value', price);

                // submit update from
                const route = `/admin/cakes/${cakeId}`;
                $("#updateCakeForm").attr('action', route);
            });
        });


        // delete
        $('.delete-button').click(function(event){
            console.log(event);
            swal({
                    title: "Are you sure?",
                    text: "You want to delete the cake?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        const cakeId = $(this).data('id');
                        const route = `/admin/cakes/${cakeId}`
                        $('#deleteCakeForm').attr('action', route);
                        $('#deleteCakeForm').submit();
                    }
                });
        });
    </script>

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


    {{-- image popup script --}}
    <script>
        $(document).ready(function() {

            $('.cake-image').click(function(event) {
                console.log(event);
                $("#cake_image_show").css('display', 'block');
            })

            $("#popup_close_button").click(function() {
                $("#cake_image_show").css('display', 'none');
            })
        })
    </script>
@endsection
