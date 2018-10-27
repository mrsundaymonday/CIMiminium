      
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  
<link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet">
<!--         <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>     
<!-- <script type="text/javascript">
    function add_gmc(){
        alert('testing ');
        return false;
    }
</script> -->

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title"></h4>

                                <!-- <button style="float: right !important;" type="button" class="btn btn-primary btn-md" data-toggle="modal" onclick="add_gmc()">ADD MODEL</button> -->
                                <!-- Trigger the modal with a button -->
<!-- <button style="float: right; margin-right: 10px;" class="btn btn-primary btn-md" data-toggle="modal" onclick="add_gmc();">Add Model</button>
<button style="float: right; margin-right: 10px;" class="btn btn-danger btn-md" data-toggle="modal" onclick="add_gmc();">Delete</button> -->

        <button class="btn btn-success" onclick="add_akses()"><i class="glyphicon glyphicon-plus"></i> Hak Akses</button>
        <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <button class="btn btn-danger" onclick="bulk_delete()"><i class="glyphicon glyphicon-trash"></i> Bulk Delete</button>
        <br />

                            </div>
                            <div class="content table-responsive table-full-width">
                             <!--    <input type="checkbox" name="checkbox" id="mycheckbox" style="margin-left: 10px;"> Select All -->
                                <table class="table table-hover" id="table">
                                    <thead>
                                        <th><input type="checkbox" id="check-all"></th>
                                    	<th>Username</th>
                                    	<th>Level</th>
                                    	<th>Nama</th>
                                        <th>Nama Menu</th>
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
                                   
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- end row -->

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="exampleModalLabel">Hak Akses</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="padding: 50px;">
            <form action="#" id="form" class="form-horizontal">
                <input type="hidden" name="id">
              <div class="form-group">
                <label for="user" data-error="wrong" data-success="right" >Select user</label>   
                <select class="form-control validate" id="id_user" name="id_user" >
                                        <option value=""></option>
                                        <?php 
                                            foreach($user as $value) {
                                                echo "<option value='". $value->id_user . "'>" . $value->username. "</option>";
                                            }
                                        ;?>
                </select>
              </div>
              <?php 
                   $no=0;
                   foreach($menu as $value) {?> 
                    <label class="form-check-label" data-error="wrong" data-success="right"><?=$value->nama;?></label>
                      <div class="form-check form-check-inline">
                          <input class="form-check-input validate" type="checkbox" name="kode_menu[]" value="<?=$value->kode_menu;?>">
                      </div>                         
                        <?php
                          $no++;
                          }
                    ;?>
            </form>
      </div>
      <div class="modal-footer">

        <button type="button" class="btn btn-primary" id="btnSave" onclick="save()" >Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- End Bootstrap modal -->

 

            </div>
        </div>

        <style type="text/css">
            #table_filter{ margin-right: 50px !important; }
       
            .modal-backdrop { z-index: -1 !important; }/*untuk popup modal agar tidak blur*/
            #table_wrapper{ padding: 5px; }
            .card { font-size: 12px !important; color: #6b4804 !important; } 
        </style>




<script type="text/javascript">
 
var save_method; //for save method string
var table;
var base_url = '<?php echo base_url();?>';
 
$(document).ready(function() {
 
    //datatables
    table = $('#table').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('hakakses/ajax_list')?>",
            "type": "POST"
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
            { 
                "targets": [ 0 ], //first column
                "orderable": false, //set not orderable
            },
            { 
                "targets": [ -1 ], //last column
                "orderable": false, //set not orderable
            },
 
        ],
 
    });
 
    
    //set input/textarea/select event when change value, remove class error and remove text help block 
    $("input").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("textarea").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("select").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
 
 
    //check all
    $("#check-all").click(function () {
        $(".data-check").prop('checked', $(this).prop('checked'));
    });
 
});
 
 
 
function add_akses()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    //$('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Hak akses'); // Set Title to Bootstrap modal title
 

/* alert('add form');
 return false;*/

}
 
function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}
 
function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    
    var url = "<?php echo site_url('hakakses/ajax_add')?>";
    // ajax adding data to database
    var formData = new FormData($('#form')[0]);
    $.ajax({
        url : url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {
 
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                reload_table();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
 
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
 
        }
    });
}
 
function delete_value(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('hakakses/ajax_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
 
    }
}
 
function bulk_delete()
{
    var list_id = [];
    $(".data-check:checked").each(function() {
            list_id.push(this.value);
    });
    if(list_id.length > 0)
    {
        if(confirm('Are you sure delete this '+list_id.length+' data?'))
        {
            $.ajax({
                type: "POST",
                data: {id:list_id},
                url: "<?php echo site_url('hakakses/ajax_bulk_delete')?>",
                dataType: "JSON",
                success: function(data)
                {
                    if(data.status)
                    {
                        reload_table();
                    }
                    else
                    {
                        alert('Failed.');
                    }
                     
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error deleting data');
                }
            });
        }
    }
    else
    {
        alert('no data selected');
    }
}
 
</script>
 

