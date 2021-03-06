function verify_purchase_code($this){
    $($this).css('display','none');
    var purchase_code = $.trim($('#purchase_code').val());
    var cust_domain = $.trim($('#cust_domain').val());

    if( purchase_code != '' && cust_domain != '' ) {
        var dataArr = {};
        dataArr [ 'purchase_code' ] = $('#purchase_code').val();
        dataArr [ 'cust_domain' ] = $('#cust_domain').val();

        $.post("https://webdigitalshop.com/tp_check/tp.php",dataArr,function(response, status) {
            var dataArray = response.split('@#');
            var data = dataArray[0];
            $($this).css('display','inline-block');
            if( data == '101' ) {
                // Success
                $('#domaincheck').css('display','none');
                document.cookie = "chkJS=yes;";
                $('#errText').html('<span style="color:green;">Now Please complete installation process.</span>');
                $('#installerform').html(dataArray[1]);
            }
            else if( data == '399' ) {
                // Wrong Product
                $('#errText').html('<span style="color:red;">This purchase code is for another product.</span>');
            }
            else if( data == '402' ) {
                 // Invalid Purchase Code
                $('#errText').html('<span style="color:red;">Purchase code is incorrect.</span>');
            }
            else if( data == '401' ) {
                // Invalid access
                $('#errText').html('<span style="color:red;">Invalid access.</span>');
            }
            else if( data == '404' ) {
                // Empty
                $('#errText').html('<span style="color:red;">You missed purchase code.</span>');
            }
            return false;
        });
    }
    else {
        $('#errText').html('<span style="color:red;">You missed purchase code.</span>');
    }
}
