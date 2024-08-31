import './bootstrap';
// jQuery
import $ from 'jquery';
window.$ = window.jQuery = $;

// DataTables JS
import 'datatables.net';
import 'datatables.net-bs4';

// DataTables Buttons JS
import 'datatables.net-buttons/js/buttons.html5.js';
import 'datatables.net-buttons/js/buttons.print.js';
import 'datatables.net-buttons/js/buttons.colVis.js';

// JSZip for Excel export
import JSZip from 'jszip';

// PDFMake for PDF export
import pdfMake from 'pdfmake';
import vfsFonts from 'pdfmake/build/vfs_fonts';

// Configure DataTables globally
$(document).ready(function() {
    $('#transactionsTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel', 'pdf'
        ]
    });
});
