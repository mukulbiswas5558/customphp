<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <h3 id="formTitle"></h3>
    <form id="dynamicForm"></form>
    <button type="submit" class="btn btn-primary" id="submitBtn">Submit</button>
</div>

<script>
    $(document).ready(function() {
        const formId = 6; // Change to your desired form ID
        fetch(`http://localhost/page_maker/avenger/responseCreate`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Set the form title
                    $('#formTitle').text(data.form.title);

                    // Loop through fields to create form elements
                    data.fields.forEach(field => {
                        let fieldHTML = '';

                        switch (field.field_type) {
                            case 'text':
                                fieldHTML = `<div class="mb-3">
                                                <label class="form-label">${field.field_name}</label>
                                                <input type="text" class="form-control" name="${field.field_name}" required>
                                             </div>`;
                                break;
                            case 'checkbox':
                                fieldHTML = `<div class="mb-3 form-check">
                                                <input type="checkbox" class="form-check-input" name="${field.field_name}">
                                                <label class="form-check-label">${field.field_name}</label>
                                             </div>`;
                                break;
                            case 'radio':
                                fieldHTML = `<div class="mb-3">
                                                <label class="form-label">${field.field_name}</label>
                                                <input type="radio" class="form-check-input" name="${field.field_name}">
                                             </div>`;
                                break;
                            case 'file':
                                fieldHTML = `<div class="mb-3">
                                                <label class="form-label">${field.field_name}</label>
                                                <input type="file" class="form-control" name="${field.field_name}">
                                             </div>`;
                                break;
                            case 'select':
                                fieldHTML = `<div class="mb-3">
                                                <label class="form-label">${field.field_name}</label>
                                                <select class="form-select" name="${field.field_name}">
                                                    <option value="">Select an option</option>
                                                    <option value="option1">Option 1</option>
                                                    <option value="option2">Option 2</option>
                                                </select>
                                             </div>`;
                                break;
                        }

                        $('#dynamicForm').append(fieldHTML);
                    });
                } else {
                    alert('Error fetching form: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        
        // Handle form submission
        $('#dynamicForm').on('submit', function(event) {
            event.preventDefault();
            const formData = $(this).serialize(); // Serialize form data

            // Send form data to the server
            fetch('http://localhost/path_to_your_controller/submitForm', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error during submission:', error);
            });
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
