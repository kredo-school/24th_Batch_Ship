function setSortValue(sortValue) {
    document.getElementById('sortValue').value = sortValue;

    // Send the form via AJAX
    $.ajax({
        url: $("#sortForm").attr('action'),
        type: 'GET',
        data: $("#sortForm").serialize(),
        success: function(response) {
            $("#modal-body").html($(response).find('#modal-body').html());

            // Reinitialize the modal
            $('#community-members-{{ $community->id }}').modal('show');
        }
    });
}