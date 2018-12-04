$(document).ready(function() {
    $('.timesheet-edit').on('click', function() {
        var edit_row_id = '.edit_' + $(this).data('rowid');

        $(edit_row_id).removeClass('d-none');
        // $(edit_row_id).addClass('d-block');
    });
});
