<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Form Builder</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <h2>Dynamic Form Builder</h2>
    <form method="POST" id="form-builder" action="/page_maker/avenger/submit">
        <div class="form-group">
            <label for="table_name">Table Name</label>
            <input type="text" class="form-control" name="table_name" required>
        </div>

        <div id="fields-container"></div>

        <button type="button" class="btn btn-success" id="add-field">Add Field</button>
        <button type="submit" class="btn btn-primary" name="create_table">Create Table</button>
    </form>
</div>

<script>
    $(document).ready(function () {
        $('#add-field').click(function () {
            $('#fields-container').append(`
                <div class="field-group mb-3">
                    <input type="text" class="form-control mb-2" name="fields[][name]" placeholder="Field Name" required>
                    <select class="form-control mb-2" name="fields[][type]" required>
                        <option value="VARCHAR">VARCHAR</option>
                        <option value="INT">INT</option>
                        <option value="TEXT">TEXT</option>
                    </select>
                    <input type="number" class="form-control" name="fields[][size]" placeholder="Field Size" required>
                    <button type="button" class="btn btn-danger remove-field">Remove</button>
                </div>
            `);
        });

        $(document).on('click', '.remove-field', function () {
            $(this).closest('.field-group').remove();
        });
    });
</script>
</body>
</html>