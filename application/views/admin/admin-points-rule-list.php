 
        <!-- page content -->
        <div class="right_col" role="main">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  <?php $this->load->view('common/common-msg'); ?>
                    <h2>Points Rule <small>Points</small></h2>
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
                          
                          <th>Rule name</th>
                          <th>Amount</th>
                          <th>Type</th>
                          <th>status</th>
                          <th>Created On</th>
                          <th>Updated On</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php foreach($points_list as $val)
                           {
                                  echo '<tr>
                              <td>'.$val->insta_points_rule_name.'</td>
                              <td>'.$val->insta_points_rule_amount.'</td>
                               <td>'.$val->insta_points_rule_type.'</td>';
                               if($val->insta_points_rule_status==1)

                                echo '<td>Enable</td>';

                              else

                                echo '<td>Disable</td>';


                                echo '<td>'.$val->insta_points_rule_created_date.'</td>
                                  <td>'.$val->insta_points_rule_updated_date.'</td>
                             <td><a href="'.base_url().'admin/update/'.$val->insta_points_rule_id.'/points/"><button type="button"  class="btn btn-primary btn-sm">Edit</button></a>
                         
                              
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

<script>
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

    