$(document).ready(function () {
    const tanda_jadi = $('#tbl_tanda_jadi').DataTable ({
        "processing": true,
        "responsive": true,
        "scrollX": true,
        "fixColumns": false,
        "autoWidth": false,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: 'pembayaran/datatj',
            type: "POST"
        },
        "columnDefs": [{
            "orderable": false,
            "targets": '_all'
        }],
        "bDestroy": true
    });
});