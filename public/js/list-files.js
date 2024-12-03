(function($) {
    "use strict"

    $('#example').DataTable({
        "dom": '<"top"f>rt<"bottom"lip><"clear">',
        "paging": true,
        "order": [[3, 'asc']],
        columnDefs: [{ orderable: false, targets: [0,1] }],
        "searching": true,
        "select" : false,
        "info": true,
        "scrollX": false, // Disable horizontal scrolling
        "scrollY": false,
         // Disable vertical scrolling
    });
})(jQuery);