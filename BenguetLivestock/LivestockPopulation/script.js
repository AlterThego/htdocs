const toggler = document.querySelector(".btn");
toggler.addEventListener("click", function () {
    document.querySelector("#sidebar").classList.toggle("collapsed");
});

$(document).ready(function () {

    // Function to handle update button click
    $('.btn-update').click(function () {
        // Get data attributes from the clicked button
        var id = $(this).data('zip');
        var name = $(this).data('zip') + ' - ' + $(this).data('name');
        var carabao_count = $(this).data('carabao');
        var cattle_count = $(this).data('cattle');
        var swine_count = $(this).data('swine');
        var goat_count = $(this).data('goat');
        var dog_count = $(this).data('dog');
        var sheep_count = $(this).data('sheep');
        var horse_count = $(this).data('horse');

        // Set the values in the update modal fields
        $('#update_id').attr('placeholder', id);
        $('#update_name').attr('placeholder',name);
        $('#update_carabao_count').attr('placeholder', carabao_count);
        $('#update_cattle_count').attr('placeholder', cattle_count);
        $('#update_swine_count').attr('placeholder', swine_count);
        $('#update_goat_count').attr('placeholder', goat_count);
        $('#update_dog_count').attr('placeholder', dog_count);
        $('#update_sheep_count').attr('placeholder', sheep_count);
        $('#update_horse_count').attr('placeholder', horse_count);

        // Get today's date in the format YYYY-MM-DD
        var today = new Date().toISOString().split('T')[0];

        // Set the value of the "Date Updated" input field to today's date
        $('#update_date').val(today);

        // Show the update modal
        $('#updateModal').modal('show');
        $('.modal-backdrop').remove();
    });


    $(document).ready(function () {
        $('.btn-delete').click(function () {
            var id = $(this).closest('form').find('input[name="id"]').val();
            $('#confirmDelete').data('id', id);
            $('#deleteConfirmationModal').modal('show');
            $('.modal-backdrop').remove();
        });

        $('#confirmDelete').click(function () {
            var id = $(this).data('id');
            // Call the function to handle deletion in code.php
            deleteData(id);
        });
    });

    // Function to handle deletion
    function deleteData(id) {
        $.ajax({
            type: 'POST',
            url: 'code.php',
            data: { deleteData: true, id: id },
            success: function (response) {
                // Redirect to index.php after successful deletion
                window.location.href = 'index.php';
            },
            error: function (error) {
                console.error('Error during deletion:', error);
            }
        });
    }



});



