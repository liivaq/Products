$(document).ready(function () {
    jQuery.validator.addClassRules("required", {
        required: true,
        minlength: 2,
        normalizer: function (value) {
            return $.trim(value);
        }
    });

    jQuery.validator.addClassRules("digits", {
        required: true,
        digits: true,
        step: 0.01,
        normalizer: function (value) {
            return $.trim(value);
        }
    });

    $('#product_form').validate({
        rules: {
            sku: {
                remote: {
                    url: "/validate",
                    type: "post",
                    data: {
                        sku: function() {
                            return $( "#sku" ).val();
                        }
                    }
                }
            },
        },

        messages: {
            sku: {
                required: "Please, submit required data",
                minlength: "Please, provide the data of indicated type",
                remote: "Product with this SKU already exists"
            },
           name: {
                required: "Please, submit required data",
                minlength: "Please, provide the data of indicated type"
            },
            price: {
                required: "Please, submit required data",
                digits: "Please, provide the data of indicated type"
            },
            size: {
                required: "Please, submit required data",
                digits: "Please, provide the data of indicated type"
            },
            weight: {
                required: "Please, submit required data",
                digits: "Please, provide the data of indicated type"
            },
            length: {
                required: "Please, submit required data",
                digits: "Please, provide the data of indicated type"
            },
            width: {
                required: "Please, submit required data",
                digits: "Please, provide the data of indicated type"
            },
            height: {
                required: "Please, submit required data",
                digits: "Please, provide the data of indicated type"
            },
            type: {
                required: "",
            }
        }
    });
});
