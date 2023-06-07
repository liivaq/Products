$(document).ready(function () {
    const fieldsConfig = {
        Book: {
            fields: [
                {label: 'Weight', name: 'weight', type: 'text'}
            ],
            description: 'Please provide weight.'
        },
        Dvd: {
            fields: [
                {label: 'Size', name: 'size', type: 'text'}
            ],
            description: 'Please provide size.'
        },
        Furniture: {
            fields: [
                {label: 'Length', name: 'length', type: 'text'},
                {label: 'Width', name: 'width', type: 'text'},
                {label: 'Height', name: 'height', type: 'text'}
            ],
            description: 'Please provide dimensions.'
        }
    };

    // Function to handle the change event of the productType select element
    $('#productType').change(function () {
        const selectedType = $(this).val(); // Get the selected value

        // Clear the additionalFields div
        $('#additionalFields, #typeDescription').empty();
        const typeConfig = fieldsConfig[selectedType];

        // Generate fields based on the selected type
        typeConfig.fields.forEach(function (field) {
            const fieldContainer = $('<div class="attributes required"></div>');
            fieldContainer.append(`<label for="${field.name}">${field.label}</label>`);
            fieldContainer.append(`<input id="${field.name}" name="${field.name}" type="${field.type}">`);
            $('#additionalFields').append(fieldContainer);
        });

        // Display the description for the selected type
        $('#typeDescription').text(typeConfig.description);

    });
});