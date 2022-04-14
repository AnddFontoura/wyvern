@extends('layouts.site')

@section('site_content')
    <div class="cart">

    </div>
@endsection

@section('page_js')
    <script>
        $(document).ready( function() {
            if (localStorage.hasOwnProperty('products')) {
                let productsArray = JSON.parse(localStorage.getItem('products'));

                /*
                 *  Separa array com os IDs e 
                 *  consulta via api e popula 
                 *  um espaço com os dados de 
                 *  cada produto
                 */

                $.each(productsArray, function() {
                    $(".cart").append("<div class='card mb-3'> <div class='card-body'> Produto </div> </div>");
                });
            }
        });
    </script>
@endsection