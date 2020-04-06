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
                }
            }]
        };

        var popup = modal(options, $('#quick_order_form'));
        $("#quick_order_button").on('click',function(){
            $("#quick_order_form").modal("openModal");
        });
    }
);
