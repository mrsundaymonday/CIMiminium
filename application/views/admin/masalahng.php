
<!-- start: Content -->
            <div id="content">
               <div class="panel box-shadow-none content-header">
                  <div class="panel-body">
                    <div class="col-md-12">
                        <h3 class="animated fadeInLeft">Data Tables</h3>
                        <p class="animated fadeInDown">
                          Table <span class="fa-angle-right fa"></span> Data Tables
                        </p>
                    </div>
                  </div>
              </div>
              <!-- modal -->
              
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="exampleModalLabel">User Data</h4>
                    </div>
                    <div class="modal-body">
                      <form id="myform">
                        <div class="form-group">
                          <label for="nama" class="control-label" data-error="wrong" data-success="right" >Name:</label>
                          <input type="text" class="form-control validate" id="nama" name="nama">
                        </div>
                        <div class="form-group">
                          <label for="alamat" class="control-label" data-error="wrong" data-success="right" >Address:</label>
                          <textarea class="form-control validate" id="alamat" name="alamat"></textarea>
                        </div>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary" id="btnSave" onclick="save()">Save Data</button>
                    </div>
                  </div>
                </div>
              </div>
          
              <!-- end modal -->

              
              <script type="text/javascript">
                function add_data(){
                  /*$('#myModal').modal({
                    keyboard: false
                  });*/

                    save_method = 'add';
                    $('#myform')[0].reset(); // reset form on modals
                    $('.form-group').removeClass('has-error'); // clear error class
                    $('.help-block').empty(); // clear error string
                    $('#myModal').modal('show'); // show bootstrap modal
                    $('.modal-title').text('Add Data'); // Set Title to Bootstrap modal title  
                }
                

                function save()
                {
                    $('#btnSave').text('saving...'); //change button text
                    $('#btnSave').attr('disabled',true); //set button disable 
                    var url = "<?php echo site_url('mainmenu/test_save')?>";                    
                 
                    // ajax adding data to database
                    var formData = new FormData($('#myform')[0]);
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
                                url: "<?php echo site_url('ng/ajax_bulk_delete')?>",
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

              <div class="col-md-12 top-20 padding-0">
                <div class="col-md-12">
                  <div class="panel">
                    <div class="panel-heading">
                      <h3>Data Tables</h3>
                      <h3>
                       <button type="button" style="float: right; margin-top: -35px; margin-right: 10px;" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" onclick="add_data()">Tambah Data</button>
                       <button type="button" style="float: right; margin-top: -35px; margin-right: 140px;" class="btn btn-danger" onclick="bulk_delete()">Hapus Data</button>
                     </h3>
                    </div>
                    <div class="panel-body">

                      <div class="responsive-table">
                      <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>
                            <span class="input-group-sm">
                                            <input type="checkbox" id="check-all" class="filled-in" onclick="return selectall();">
                                            <label for="check-all"> Check All</label>
                            </span>
                        <!--   <input type="checkbox" id="check-all"> -->

                        </th>
                          <th>Name</th>
                          <th>Address</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($query as $value) { ;?>
                        <tr>
                          <td><input type="checkbox" class="data-check" value="<?=$value->id;?>"></td>
                          <td><?=$value->nama;?></td>
                          <td><?=$value->alamat;?></td>
                          <td> 
                            <a href="#" class="btn btn-md btn-danger">Hapus</a>
                            <a href="#" class="btn btn-md btn-info">Ubah</a>
                          </td>
                        </tr>
                      <?php } ?>
                       
                      </tbody>
                        </table>
                      </div>
                  </div>
                </div>
              </div>  
              </div>
            </div>
          <!-- end: content -->

    </div>
     
<script type="text/javascript">
     //check all
               /* $("#check-all").click(function () {
                    $(".data-check").prop('checked', $(this).prop('checked'));
                });*/
                function selectall(){
                  // $('input[type="checkbox"]:enabled' ).prop('checked', this.checked); 
                   //$(".data-check").prop('checked', $(this).prop('checked'));
                   alert('testing');
                }
  </script>

