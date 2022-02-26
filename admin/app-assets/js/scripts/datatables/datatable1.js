/*=========================================================================================
    File Name: datatables-basic.js
    Description: Basic Datatable
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

$(document).ready(function() {

    /****************************************
     *       js of zero configuration        *
     ****************************************/

    $('.zero-configuration').DataTable();

    /********************************************
     *        js of Order by the grouping        *
     ********************************************/

    var groupingTable = $('.row-grouping').DataTable({
        "columnDefs": [{
            "visible": false,
            "targets": 2
        }],
        "order": [
            [2, 'asc']
        ],
        "displayLength": 10,
        "drawCallback": function(settings) {
            var api = this.api();
            var rows = api.rows({
                page: 'current'
            }).nodes();
            var last = null;

            api.column(2, {
                page: 'current'
            }).data().each(function(group, i) {
                if (last !== group) {
                    $(rows).eq(i).before(
                        '<tr class="group"><td colspan="5">' + group + '</td></tr>'
                    );

                    last = group;
                }
            });
        }
    });

    $('.row-grouping tbody').on('click', 'tr.group', function() {
        var currentOrder = groupingTable.order()[0];
        if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
            groupingTable.order([2, 'desc']).draw();
        } else {
            groupingTable.order([2, 'asc']).draw();
        }
    });

    /*************************************
     *       js of complex headers        *
     *************************************/

    $('.complex-headers').DataTable();


    /*****************************
     *       js of Add Row        *
     ******************************/

    var t = $('.add-rows').DataTable();
    var counter = 2;

    $('#addRow').on('click', function() {
        t.row.add([
            counter + '.1',
            counter + '.2',
            counter + '.3',
            counter + '.4',
            counter + '.5'
        ]).draw(false);

        counter++;
    });


    /**************************************************************
     * js of Tab for COLUMN SELECTORS WITH EXPORT AND PRINT OPTIONS *
     ***************************************************************/

    $('.dataex-html5-selectors').DataTable({
        "language": {
            "sProcessing": "Traitement en cours ...",
            "sLengthMenu": "Afficher _MENU_ lignes",
            "sZeroRecords": "Aucun résultat trouvé",
            "sEmptyTable": "Aucune donnée disponible",
            "sInfo": "Lignes _START_ à _END_ sur _TOTAL_",
            "sInfoEmpty": "Aucune ligne affichée",
            "sInfoFiltered": "(Filtrer un maximum de _MAX_)",
            "sInfoPostFix": "",
            "sSearch": "Chercher:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Chargement...",
            "oPaginate": {
                "sFirst": "Premier",
                "sLast": "Dernier",
                "sNext": "Suivant",
                "sPrevious": "Précédent"
            },
            "oAria": {
                "sSortAscending": ": Trier par ordre croissant",
                "sSortDescending": ": Trier par ordre décroissant"
            },
            buttons: {
                pageLength: {
                    _: "Afficher %d lignes",
                    "-1": "Afficher tout"
                }
            }
        },
        dom: 'Bfrtip',
        lengthMenu: [
            [10, 25, 50, -1],
            ['10 Lignes', '25 Lignes', '50 Lignes', 'Afficher tout']
        ],
        buttons: ['pageLength']

    });


    /**************************************************
     *       js of scroll horizontal & vertical        *
     **************************************************/

    $('.scroll-horizontal-vertical').DataTable({
        "scrollY": 200,
        "scrollX": true
    });




});