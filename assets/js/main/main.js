if (window.location.href.indexOf("mtd") > -1) {
  $(document).ready(function() {
    $('#tmtd tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" class="form-control">' );
    });

    var table = $('#tmtd').DataTable( {
      dom: 'frtip',
      "ajax": '../../content/data/mtddata.php',
      initComplete: function () {
        this.api().columns().every( function () {
          var that = this;
          $( 'input', this.footer() ).on( 'keyup change clear', function () {
            if ( that.search() !== this.value ) {
              that
              .search( this.value )
              .draw();
            }
          });
        });
      }
    });
  });
}

$('#rawdataprocess').on('submit', function (e) {
  $('#btnSubmit').prop("disabled", true);
  $("#btnSubmit").html('Loading ...');
  $('#rawdata').prop('readonly', true);

  e.preventDefault();
    $.ajax({
      type: 'POST',
      url: 'content/action/processrawdata.php',
      data: $('#rawdataprocess').serialize(),
      success: function (data) {
        var rawdata = data.split(',');
        console.log(data);

        $('#datashows').html(data);
        $('#btnSubmit').prop("disabled", false);
        $("select[name='choice']").prop('disabled', false);
        $("#btnSubmit").html('Submit');
        $('#rawdata').prop('readonly', false);
        $('#rawdataprocess')[0].reset();
      }
  });
});

$("select[name ='database']").on( "change", function() {
  var dbname = $("select[name ='database']").val();
  if (dbname == 1) { $("select[name='choice']").prop('disabled', true); }
  else { $("select[name='choice']").prop('disabled', false); }
});

function getMTDdata(type, id) {
  $('#mdlmtddata').modal('show');
  console.log(id);
  $("#putdata").load( "../../content/data/mtdsingledata.php?type=" + type + "&id=" + id );
}