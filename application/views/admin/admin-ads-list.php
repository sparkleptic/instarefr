   
        <!-- page content -->
        <div class="right_col" role="main">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  <?php $this->load->view('common/common-msg'); ?>
                    <h2>Ads List <small></small></h2>
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
                          <th>Ads</th>
                         <th>Status</th>
                         <th>Action</th>
                          
                        </tr>
                      </thead>
                       <tbody>

                       <?php foreach($googleAds_list as $val)
                           { $ads = urldecode($val->insta_google_ads);

                                  echo '<tr>
                              <td>'.$ads.'</td>';
                               if($val->insta_google_ads_status==1)

                                echo '<td>Enable</td>';

                              else

                                echo '<td>Disable</td>';


                                echo '<td><a href="'.base_url().'admin/update/'.$val->insta_google_ads_id.'/Google_Ads"><button type="button"  class="btn btn-primary btn-sm">Edit</button></a><a href="'.base_url().'admin/delete/'.$val->insta_google_ads_id.'/Google_Ads" onClick="return doconfirm();"><button type="button" class="btn btn-danger btn-sm">Delete</button></a></td>
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
    