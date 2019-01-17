   
        <!-- page content -->
        <div class="right_col" role="main">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  <?php $this->load->view('common/common-msg'); ?>
                    <h2>Contact us List <small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Email</th>
                       
                          <th>Message</th>
                         <th>Action</th>
                          
                        </tr>
                      </thead>
                       <tbody>
                       <?php foreach($contact_us_list as $val)
                           {
                                  echo '<tr>
                              <td>'.$val->insta_contact_us_name.'</td>
                              <td>'.$val->insta_contact_us_email.'</td>
                            
                              <td>'.$val->insta_contact_us_message.'</td>';
                              echo '<td><a href="'.base_url().'admin/delete/'.$val->insta_contact_us_id.'/contact_us" onClick="return doconfirm();"><button type="button" class="btn btn-danger btn-sm">Delete</button></a></td>
                              </tr>';
                           }
                           
                            ?>
                        
                                           
                      </tbody>
                    </table>

                  </div>
                </div>
              </div>
        </div>
        <!-- /page content -->
        <script type="text/javascript">
          function doconfirm()
          {
              job=confirm("Are you sure to delete permanently?");
              if(job!=true)
              {
                  return false;
              }
          }
          $(document).ready(function() {
              $('#datatable-responsive').DataTable( {
                  dom: 'Bfrtip',
                  buttons: [
                      'copy', 'csv', 'excel', 'pdf', 'print'
                  ]
              } );
          } );
        </script>
    