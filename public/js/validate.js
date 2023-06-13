$(document).ready(function () {
    jQuery.validator.addClassRules("required", {
        required: true,
        normalizer: function (value) {
            return $.trim(value);
        }
    });

    $('#product_form').validate({
        rules: {
            'attributes[sku]': {
                required: true,
                minlength: 5,
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
            'attributes[name]': {
                required: true,
                minlength: 2
            },
            'attributes[price]': {
                required: true,
                step: 0.01
            },
            'attributes[size]': {
                required: true,
                digits: true
            },
            'attributes[weight]': {
                required: true,
                digits: true
            },
            'attributes[height]': {
                required: true,
                digits: true
            },
            'attributes[width]': {
                required: true,
                digits: true
            },
            'attributes[length]': {
                required: true,
                digits: true
            },
            type: {
                required: true
            }
        },

        messages: {
            'attributes[sku]': {
                required: "Please, submit required data",
                minlength: "Please, provide the data of indicated type",
                remote: "Product with this SKU already exists"
            },
            'attributes[name]': {
                required: "Please, submit required data",
                minlength: "Please, provide the data of indicated type"
            },
            'attributes[price]': {
                required: "Please, submit required data",
                digits: "Please, provide the data of indicated type"
            },
            'attributes[size]': {
                required: "Please, submit required data",
                digits: "Please, provide the data of indicated type"
            },
            'attributes[weight]': {
                required: "Please, submit required data",
                digits: "Please, provide the data of indicated type"
            },
            'attributes[length]': {
                required: "Please, submit required data",
                digits: "Please, provide the data of indicated type"
            },
            'attributes[width]': {
                required: "Please, submit required data",
                digits: "Please, provide the data of indicated type"
            },
            'attributes[height]': {
                required: "Please, submit required data",
                digits: "Please, provide the data of indicated type"
            },
            type: {
                required: "",
            }
        }
    });
});