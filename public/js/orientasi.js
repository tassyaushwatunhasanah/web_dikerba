$(document).ready(function(){
    var table=$('#dataTabel').DataTable({
        "columnDefs": [
            { "searchable": false,
              "orderable": false, 
              "targets": [0,4] 
            } //disable first and last column sorting
        ],
        dom: 'Blfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                exportOptions: {
                  columns: [ 0, 2, 3, 4, 5, 6]
                },
              },
              {
                extend: 'pdfHtml5',
                exportOptions: {
                  columns: [ 0, 2, 3, 4, 5, 6]
                },
              },
        ]
        
    });
    
    //script for datepicker
    $("#startdate").datepicker({    
        "dateFormat":"yy/mm/dd",
        "onSelect": function(date) {  // This handler kicks off the filtering.
          minDateFilter = new Date(date).getTime();
          table.draw(); // Redraw the table with the filtered data.
        }
    }).keyup(function() {
        minDateFilter = new Date(this.value).getTime();
        table.draw();
    });
      
    $("#enddate").datepicker({
        "dateFormat":"yy/mm/dd",
        "onSelect": function(date) {
          maxDateFilter = new Date(date).getTime();
          table.draw();
        }
    }).keyup(function() {
        maxDateFilter = new Date(this.value).getTime();
        table.draw();
    });

    // The below code actually does the date filtering.
    minDateFilter = "";
    maxDateFilter = "";
    $.fn.dataTableExt.afnFiltering.push(
        function(oSettings, aData, iDataIndex) {
          if (typeof aData._date == 'undefined') {
            aData._date = new Date(aData[4]).getTime(); // Your date column is 3, hence aData[3].
          }
      
          if (minDateFilter && !isNaN(minDateFilter)) {
            if (aData._date < minDateFilter) {
              return false;
            }
          }
      
          if (maxDateFilter && !isNaN(maxDateFilter)) {
            if (aData._date > maxDateFilter) {
              return false;
            }
          }
          return true;
        }
    );
});   

                