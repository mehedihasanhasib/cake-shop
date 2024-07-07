<div class="shop__option">
    <div class="row">
        <div class="col-lg-7 col-md-7">
            <div class="shop__option__search">
                <form id="search-form">
                    <select id="search-by-category">
                        @if (!isset($selected_variant))
                            <option value="">{{ $selected_variant ?? 'Search by category' }}</option>
                        @endif
                        @foreach ($variants as $key => $variant)
                            @if (isset($selected_variant))
                                <option {{ $selected_variant == $variant->variant_name ? 'selected' : null }} value="{{ $variant->slug }}">{{ $variant->variant_name }}</option>                
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
                    <option value="">Latest</option>
                    <option value="">Ratings</option>
                    <option value="">Low to High</option>
                    <option value="">High to Low</option>
                    <option value="">Name</option>
                </select>
            </div>
        </div>
    </div>
</div>