$(document).ready(function() {
product();











    function product() {
        $.ajax({
            url: "controlador/action.php",
            method: "POST",
            data: { getProduct: 1 },
            success: function(data) {
                $("#get_product").html(data);
            }
        })
    }



}