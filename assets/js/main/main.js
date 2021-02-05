if (window.location.href.indexOf("mtd") > -1) {
  $(document).ready(function() {
    var d = new Date();
    var gettime = d.getHours() + ':' + d.getMinutes() + ':' + d.getSeconds();
    console.log('%c Starts @ ' + gettime, 'background: #222; color: #bada55');
    $('#tmtd tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" class="form-control">' );
    });

    var table = $('#tmtd').DataTable( {
      dom: 'Bfrtip',
      "ajax": '../../content/data/mtddata.php',
      initComplete: function (settings, json) {
        $( "#overlay" ).fadeOut(500, function() {
        $( "#overlay" ).remove();
        $(".spinner-grow").addClass('hidden');
        var nd = new Date();
        var ngettime = nd.getHours() + ':' + nd.getMinutes() + ':' + nd.getSeconds();
        console.log('Finish @ ' + ngettime);
        var diff = Math.abs(d - nd),
        min = Math.floor((diff/1000/60) << 0),
        sec = Math.floor((diff/1000) % 60);
        console.log('Duration ' + min + ':' + sec);

        $('.buttons-csv').click();
        });
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
      },
      buttons: [
        {
          extend: "csv",
          className: "btn btn-sm btn-primary",
          text: 'Export',
          filename: 'Sales Report',
          init: function(api, node, config) { $(node).removeClass('dt-button') }
        },
        {
          extend: "copy",
          className: "btn btn-sm btn-primary",
          text: 'Copy',
          init: function(api, node, config) { $(node).removeClass('dt-button') }
        },
        {
          extend: "print",
          className: "btn btn-sm btn-primary",
          text: 'Print',
          title: function(){
            var printTitle = 'Sales Report';
            return printTitle
          },
          init: function(api, node, config) { $(node).removeClass('dt-button') }
        },
        {
          className: "btn btn-sm btn-primary",
          text: 'Backup Database',
          action: function ( e, dt, node, config ) {
            //$('#mdlAddsalesorder').modal('show');
            backupdb();
          }
        },
      ]
    });
  });
}

$('#rawdataprocess').on('submit', function (e) {
  $('#btnSubmit').prop("disabled", true);
  $("#btnSubmit").html('Loading ...');
  $('#rawdata').prop('readonly', true);
  var raw = $('#rawdata').val();
  var countme = '';
  var d = new Date();
  var gettime = d.getHours() + ':' + d.getMinutes() + ':' + d.getSeconds();
  console.log('%c Starts @ ' + gettime, 'background: #222; color: #bada55');
  if (raw.includes('oelinhst')) { countme = 'oelinhst'; }
  else if (raw.includes('oehdrhst')) { countme = 'oehdrhst'; }
  else if (raw.includes('product')) { countme = 'product'; }
  else if (raw.includes('customerz')) { countme = 'customerz'; }
  var checker = new RegExp(countme, 'g');

  var count = (raw.match(checker));
  //console.log(count);

  e.preventDefault();
  $.ajax({
    type: 'POST',
    url: 'content/action/processrawdata.php',
    data: $('#rawdataprocess').serialize(),
    success: function (data) {
      var rawdata = data.split(',');
      console.log(data);
      //$('#datashows').html(data);
      $('#btnSubmit').prop("disabled", false);
      $("select[name='choice']").prop('disabled', false);
      $("#btnSubmit").html('Submit');
      $('#rawdata').prop('readonly', false);
      //$('#rawdataprocess')[0].reset();
      $('#rawdata').val('');
      var nd = new Date();
      var ngettime = nd.getHours() + ':' + nd.getMinutes() + ':' + nd.getSeconds();
      console.log('Finish @ ' + ngettime);
      var diff = Math.abs(d - nd),
      min = Math.floor((diff/1000/60) << 0),
      sec = Math.floor((diff/1000) % 60);
      console.log('Duration ' + min + ':' + sec);

      $.notify({
        message: data 
      },
      {
        type: 'info',
        allow_dismiss: false,
      });
    }
  });
});

$("select[name ='choice']").on( "change", function() {
  console.clear();
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

function backupdb() {
  $.ajax({
    url: '../../content/action/backup.php',
    success: function (data) { console.log(data); }
  });
}