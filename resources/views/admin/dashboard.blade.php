@extends('layouts.adminlte')

@section('adminlte_content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-lg-4 col-md-4 mb-3">
            <div id="categoriesBox" class="small-box bg-info">
                <div id="overlayCategoriesBox" class="overlay dark">
                    <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                </div>
                <div class="inner">
                    <h3 id="countCategories">0</h3>
                    <p> {{ __('category.commons.name_plural') }} </p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-sm-12 col-lg-4 col-md-4 mb-3">
            <div id="subCategoriesBox" class="small-box bg-gradient-success">
                <div id="overlaySubCategoriesBox" class="overlay dark">
                    <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                </div>

                <div class="inner">
                    <h3 id="countSubCategories">0</h3>
                    <p>{{ __('subcategory.commons.name_plural') }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-sm-12 col-lg-4 col-md-4 mb-3">
            <div id="productsBox" class="small-box bg-gradient-secondary">
                <div id="overlayProductsBox" class="overlay dark">
                    <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                </div>

                <div class="inner">
                    <h3 id="countProducts">0</h3>
                    <p>{{ __('product.commons.name_plural') }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_js')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{ url('api/categories/count') }}",
            method: "GET",
            dataType: "json"
        }).done(function(data) {
            $('#countCategories').html(data.countCategories);
            $("#overlayCategoriesBox").remove();
        });

        $.ajax({
            url: "{{ url('api/subcategories/count') }}",
            method: "GET",
            dataType: "json"
        }).done(function(data) {
            $('#countSubCategories').html(data.countSubCategories);
            $("#overlaySubCategoriesBox").remove();
        });

        var request = $.ajax({
            url: "{{ url('api/products/count') }}",
            method: "GET",
            dataType: "json"
        }).done(function(data) {
            $('#countProducts').html(data.countProducts);
            $("#overlayProductsBox").remove();
        });
    });
</script>
@endsection