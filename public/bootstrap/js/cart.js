
function activateCart()
{
    if (localStorage.hasOwnProperty('products')) {
        products = JSON.parse(localStorage.getItem('products'));
    
        console.log("product lenght");
        console.log(products.lenght);

        if(products.lenght >= 1)
        {
            alert('tem carrinho com produtos');
        } 
    }

}