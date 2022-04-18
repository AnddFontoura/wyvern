@extends('layouts.site')

@section('site_content')
<div class="card">
    <div class="card-body cart">

    </div>

    <div class="card-footer align-right">
        <input type="submit" class="btn btn-success" value="Finalizar Compra"> </input>
    </div>
</div>
@endsection

@section('page_js')
<script>
    $('.productQuantity').on('blur', function() {
        alert('change');
        let price = $(this).data('price');
        let quantity = $(this).value;

        alert(price * quantity);

    });

    $(document).ready(function() {
        if (localStorage.hasOwnProperty('products')) {
            let productsArray = JSON.parse(localStorage.getItem('products'));

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var request = $.ajax({
                url: "{{ url('api/products/get-by-multiple-id') }}",
                method: "GET",
                data: {
                    productsId: productsArray
                },
                dataType: "json"
            }).done(function(data) {
                $.each(data, function(key, productValue) {
                    let html = "";
                    html += "<div class='card mb-3'>";
                    html += "<div class='card-body'>";
                    html += "<div class='row'>";
                    html += "<div class='col-md-4 col-sm-4 col-sm-12'>";
                    html += productValue.name;
                    html += "</div>";
                    html += "<div class='col-md-4 col-sm-4 col-sm-12'>";
                    html += productValue.description;
                    html += "</div>";
                    html += "<div class='col-md-4 col-sm-4 col-sm-12 text-center'>";
                    html += "<span class='productPrice-" + productValue.id + "'> {{ __('basic.numerals.currency_symbol') }} " + productValue.price_formatted + " </span>";
                    html += "<input type='number' value='1' class='form-control productQuantity' name='productQuantity[]' data-id='" + productValue.id + "' data-value='" + productValue.price + "'> </input>";
                    html += "<input type='hidden' value='" + productValue.id + "' class='form-control' name='productId[]'> </input>";
                    html += "</div>";
                    html += "</div>";
                    html += "</div>";
                    html += "</div>";

                    $(".cart").append(html);
                });
            });
        }
    });
</script>
@endsection