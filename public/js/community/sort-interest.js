function setSortValue(sortValue) {
    document.getElementById('sortValue').value = sortValue;

    // Send the form via AJAX
    $.ajax({
        url: $("#sortForm").attr('action'),
        type: 'GET',
        data: $("#sortForm").serialize(),
        success: function(response) {
            console.log(response)
            $("#modal-body").html($(response).find('#modal-body').html());

            // Reinitialize the modal
            $('#community-members').modal('show');
        },
        error: function(xhr, status, error) { console.error("An error occurred: " + status + " " + error); console.log(xhr.responseText); // To log the server's response 
        }
    });

}