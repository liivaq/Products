$(document).ready(function () {
    const fieldsConfig = {
        Book: {
            fields: [
                { label: 'Weight (KG)', name: 'weight', type: 'text' }
            ],
            description: 'Please provide weight.'
        },
        Dvd: {
            fields: [
                { label: 'Size (MB)', name: 'size', type: 'number' }
            ],
            description: 'Please provide size.'
        },
        Furniture: {
            fields: [
                { label: 'Length (CM)', name: 'length', type: 'number' },
                { label: 'Width (CM)', name: 'width', type: 'number' },
                { label: 'Height (CM)', name: 'height', type: 'number' }
            ],
            description: 'Please provide dimensions.'
        }
    };

    // Function to handle the change event of the productType select element
    $('#productType').change(function () {
        const selectedType = $(this).val(); // Get the selected value

        // Clear the additionalFields div
        $('#additionalFields').empty();
        const typeConfig = fieldsConfig[selectedType];

        // Generate fields based on the selected type
        typeConfig.fields.forEach(function (field) {
            const fieldGroup = $('<div class="form-group"></div>');
            fieldGroup.append(`<label for="${field.name}">${field.label}</label>`);
            fieldGroup.append(`<input id="${field.name}" name="attributes[${field.name}]" type="${field.type}">`);
            $('#additionalFields').append(fieldGroup);
        });

        // Display the description for the selected type
        $('#typeDescription').text(typeConfig.description);
    });
});