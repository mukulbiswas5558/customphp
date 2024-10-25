<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Form Builder</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        .form-builder { margin: 20px; }
        .form-element { margin-bottom: 10px; }
    </style>
</head>
<body>

<div class="container">
    <h3 class="my-4">Google-like Form Builder</h3>

    <!-- Form Title -->
    <div class="mb-3">
        <label for="formTitle" class="form-label">Form Title</label>
        <input type="text" class="form-control" id="formTitle" placeholder="Enter Form Title" required>
    </div>

    <!-- Dynamic Form Fields will be appended here -->
    <div id="formFields"></div>

    <!-- Buttons to add fields -->
    <div class="my-3">
        <button class="btn btn-primary" onclick="addTextField()">Add Text Field</button>
        <button class="btn btn-primary" onclick="addCheckbox()">Add Checkbox</button>
        <button class="btn btn-primary" onclick="addRadio()">Add Radio Button</button>
        <button class="btn btn-primary" onclick="addFileField()">Add File Upload</button>
        <button class="btn btn-primary" onclick="addSelect()">Add Dropdown</button>
    </div>

    <!-- Save Form -->
    <button class="btn btn-success mt-4" onclick="saveForm()">Save Form</button>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<script>

    let fieldCounter = 0;

    function addTextField() {
        addField('Text', 'text');
    }

    function addCheckbox() {
        addField('Checkbox', 'checkbox');
    }

    function addRadio() {
        addField('Radio Button', 'radio');
    }

    function addFileField() {
        addField('File Upload', 'file');
    }

    function addSelect() {
        addField('Dropdown', 'select');
    }

    // Function to add dynamic fields
    
    function addField(label, type) {
        fieldCounter++;
        const formFields = document.getElementById('formFields');
        const div = document.createElement('div');
        div.className = 'form-element row';
        div.id = `field_${fieldCounter}`; // Use backticks for template literals

        div.innerHTML = `
            <div class="col-md-6">
                <label for="field_name_${fieldCounter}" class="form-label">${label} Field Name</label>
                <input type="text" class="form-control" id="field_name_${fieldCounter}" placeholder="Field Name">
            </div>
            <div class="col-md-4">
                <label for="field_type_${fieldCounter}" class="form-label">Field Type</label>
                <input type="text" class="form-control" id="field_type_${fieldCounter}" value="${type}" readonly>
            </div>
            <div class="col-md-2 mt-4">
                <button class="btn btn-danger" onclick="removeField(${fieldCounter})">Delete</button>
            </div>
        `; // Use backticks here as well

        formFields.appendChild(div);
    }


    // Function to remove a field
    function removeField(id) {
        const fieldDiv = document.getElementById(`field_${id}`);
        if (fieldDiv) {
            fieldDiv.remove();
            fieldCounter--; // Decrement the field counter when a field is removed
            console.log(`Removed field with ID: ${id}`);
        }
    }

    // Save form data and send to server
    // Save form data and send to server
function saveForm() {
    const formTitle = document.getElementById('formTitle').value.trim();
    const formFields = [];

    // Validate form title
    if (!formTitle) {
        Swal.fire('Error', 'Form title is required!', 'error');
        return;
    }

    // Loop through each field and add it to formFields array
    for (let i = 1; i <= fieldCounter; i++) {
        const fieldNameElement = document.getElementById(`field_name_${i}`);
        const fieldTypeElement = document.getElementById(`field_type_${i}`);

        // Only push field data if the element exists (was not deleted)
        if (fieldNameElement && fieldTypeElement) {
            const fieldName = fieldNameElement.value.trim();
            const fieldType = fieldTypeElement.value.trim();

            if (fieldName === '') {
                Swal.fire('Error', 'All fields must have a name!', 'error');
                return;
            }

            formFields.push({
                name: fieldName,
                type: fieldType
            });
            console.log(`Field added: ${fieldName}, Type: ${fieldType}`);
        }
    }

    // Ensure formFields array has at least one entry
    if (formFields.length === 0) {
        Swal.fire('Error', 'Please add at least one form field!', 'error');
        return;
    }

    const data = {
        title: formTitle,
        fields: formFields
    };

    console.log('Data to be sent to server:', JSON.stringify(data));

    // Send form data to the server via fetch
    fetch('http://localhost/page_maker/avenger/formSubmit', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        // Check if the response is OK
        if (!response.ok) {
            return response.text().then(text => {
                console.error('Server response:', text); // Log the actual response for debugging
                throw new Error('Network response was not ok. Server responded with: ' + text);
            });
        }
        return response.json(); // Parse as JSON if the response is OK
    })
    .then(data => {
        if (data.success) {
            Swal.fire('Success', 'Form saved successfully!', 'success');
            console.log('Form saved successfully:', data);
            // Optionally, reset the form builder here
            document.getElementById('formTitle').value = '';
            document.getElementById('formFields').innerHTML = '';
            fieldCounter = 0; // Reset field counter
        } else {
            Swal.fire('Error', 'Error saving form: ' + (data.message || 'Unknown error'), 'error');
            console.error('Error saving form:', data);
        }
    })
    .catch(error => {
        Swal.fire('Error', 'Error: ' + error.message, 'error');
        console.error('Error during fetch:', error);
    });
}

</script>

</body>
</html>
