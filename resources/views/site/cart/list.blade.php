@extends('layouts.site')

@section('site_content')
<div class="card">
    <form action="{{ url('user/cart') }}" method="POST">
        <div class="card-body cart">

        </div>

        <div class="card-footer align-right">
            <input type="submit" class="btn btn-success createCart" value="Finalizar Compra"> </input>
            <input type="button" class="btn btn-danger clearCart" value="Limpar Carrinho"> </input>
        </div>
    </form>
</div>
@endsection

@section('page_js')
<script>
    $('.clearCart').on('click', function() {

        Swal.fire({
            title: '{{ __("basic.alert.attention") }}!',
            text: '{{ __("basic.alert.about_to_delete_cart") }}',
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '{{ __("basic.alert.yes_continue") }}'
        }).then((result) => {
            if (result.value) {
                localStorage.removeItem('products');
                Swal.fire({
                        title: '{{ __("basic.ready") }}',
                        text: '{{ __("basic.cart.cleared") }}',
                        icon: 'success',
                        buttons: true,
                    })
                    .then((buttonClick) => {
                        if (buttonClick) {
                            location.reload();
                        }
                    });
            } else if (result.dismiss === 'cancel') {
                Swal.fire(
                    '{{ __("basic.canceled_operation") }}',
                    '{{ __("basic.no_alteration_has_been_made") }}',
                    'error'
                )
            }
        });
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
        } else {
            let html = "";
            html += "<div class='alert alert-danger'> {{ __('basic.cart.no_products') }} </div>";
            
            $(".cart").append(html);
        }
    });
</script>
@endsection