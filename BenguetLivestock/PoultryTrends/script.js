const toggler = document.querySelector(".btn");
toggler.addEventListener("click", function () {
    document.querySelector("#sidebar").classList.toggle("collapsed");
});

$(document).ready(function () {

    // Function to handle update button click
    $('.btn-update').click(function () {
        // Get data attributes from the clicked button
        var year = $(this).data('year');
        var layers = $(this).data('layers');
        var broiler = $(this).data('broiler');
        var native = $(this).data('native');
        var fighting = $(this).data('fighting');


        // Set the values in the update modal fields
        $('#update_year').val(year);
        $('#update_layers').attr('placeholder', layers);
        $('#update_broiler').attr('placeholder', broiler);
        $('#update_native').attr('placeholder', native);
        $('#update_fighting').attr('placeholder', fighting);

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



