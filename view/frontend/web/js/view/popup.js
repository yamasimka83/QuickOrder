require(
    [
        'jquery',
        'Magento_Ui/js/modal/modal'
    ],
    function(
        $,
        modal
    ) {
        var options = {
            type: 'popup',
            responsive: true,
            innerScroll: true,
            buttons: [{
                text: $.mage.__('Continue'),
                class: 'mymodal1',
                click: function () {

                    this.closeModal();



                    return $.ajax({
                        url: "http://magento24.loc/quick/post",
                        type: 'POST',
                        data: {
                            'name': $('#name').val(),
                            'email': $('#email').val(),
                            'sku': $('#sku').val(),
                            'phone': $('#phone').val(),
                            'qty': $('#qty').val(),
                            'comment': $('#comment').val(),
                        },
                        dataType: 'json',
                        success: function(data) {

                            console.log(data);
                        },
                        error: function(result) {
                            console.log('no response !');
                        }
                    });

                }
            }]
        };

        var popup = modal(options, $('#quick_order_form'));
        $("#quick_order_button").on('click',function(){
            $("#quick_order_form").modal("openModal");
        });
    }
);
