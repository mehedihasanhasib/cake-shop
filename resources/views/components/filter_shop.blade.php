<div class="shop__option">
    <div class="row">
        <div class="col-lg-7 col-md-7">
            <div class="shop__option__search">
                <form id="search-form">
                    <select id="search-by-category">
                        <option value="">All</option>
                        @foreach ($variants as $key => $variant)
                            @if (isset($selected_variant))
                                <option data-category="true" {{ $selected_variant == $variant->variant_name ? 'selected' : null }} value="{{ $variant->slug }}">{{ $variant->variant_name }}</option>                
                            @else
                                <option value="{{ $variant->slug }}">{{ $variant->variant_name }}</option>
                            @endif
                        @endforeach
                    </select>
                    <input type="text" placeholder="Search by name" id="search-by-name">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
        <div class="col-lg-5 col-md-5">
            <div class="shop__option__right">
                <select>
                    <option value="">Sort By</option>
                    <option value="latest">Latest</option>
                    <option value="ratings">Ratings</option>
                    <option value="low_to_high">Low to High</option>
                    <option value="high_to_low">High to Low</option>
                    <option value="name">Name</option>
                </select>
            </div>
        </div>
    </div>
</div>

@section('script')
    <script src="{{ URL::asset('admin/assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script>
        $(document).on('click', '.nice-select .list .option', function(event) {
            console.log($(this));
            // return false;
            
                const slug = $(this).data('value');
                const searchForm = $('#search-form')
                const route = `/shop/${slug}`;
                searchForm.attr('action', route)
                searchForm.submit(); 
          
        });
    </script>
@endsection