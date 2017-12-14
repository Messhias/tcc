
<!-- Jquery DataTable Plugin Js -->
<script src="{{ asset( 'js/jquery-datatable/jquery.dataTables.js' ) }}" ></script>
<script src="{{ asset( 'js/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js' ) }}" ></script>
<script src="{{ asset( 'js/jquery-datatable/extensions/export/dataTables.buttons.min.js' ) }}" ></script>
<script src="{{ asset( 'js/jquery-datatable/extensions/export/buttons.flash.min.js' ) }}" ></script>
<script src="{{ asset( 'js/jquery-datatable/extensions/export/jszip.min.js' ) }}" ></script>
<script src="{{ asset( 'js/jquery-datatable/extensions/export/pdfmake.min.js' ) }}" ></script>
<script src="{{ asset( 'js/jquery-datatable/extensions/export/vfs_fonts.js' ) }}" ></script>
<script src="{{ asset( 'js/jquery-datatable/extensions/export/buttons.html5.min.js' ) }}" ></script>
<script src="{{ asset( 'js/jquery-datatable/extensions/export/buttons.print.min.js' ) }}" ></script>

<script>
    $(function () {
        $('.js-basic-example').DataTable();

        //Exportable table
        $('.js-exportable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                //'copy', 'csv', 'excel', 'pdf', 'print'
                'csv', 'excel', 'pdf'
            ],
            "language":{
                'url':"//cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
            }
        });
    });
</script>
