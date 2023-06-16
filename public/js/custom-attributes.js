$(document).ready(function () {
    const fieldsConfig = {
        Book: {
            fields: [
                { label: 'Weight (KG)', name: 'weight', type: 'number' }
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

    $('#productType').change(function () {
        const selectedType = $(this).val();

        $('#additionalFields').empty();
        const typeConfig = fieldsConfig[selectedType];

        typeConfig.fields.forEach(function (field) {
            const fieldGroup = $('<div class="form-group"></div>');
            fieldGroup.append(`<label for="${field.name}">${field.label}</label>`);
            fieldGroup.append(`<input id="${field.name}" name="${field.name}" class="digits" type="${field.type}">`);
            $('#additionalFields').append(fieldGroup);
        });

        $('#typeDescription').text(typeConfig.description);
    });
});