$(document).ready(function () {
    jQuery.validator.addClassRules("required", {
        required: true,
        normalizer: function (value) {
            return $.trim(value);
        }
    });

    $('#product_form').validate({
        rules: {
            sku: {
                required: true,
                minlength: 5,
                remote: {
                    url: "/sku",
                    type: "post"
                }
            },
            name: {
                required: true,
                minlength: 2
            },
            price: {
                required: true,
                step: 0.01
            },
            size: {
                required: true,
                digits: true
            },
            weight: {
                required: true,
                digits: true
            },
            height: {
                required: true,
                digits: true
            },
            width: {
                required: true,
                digits: true
            },
            length: {
                required: true,
                digits: true
            },
            type: {
                required: true
            }
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