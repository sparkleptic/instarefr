 
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
                          
                          <th>Candidate Name</th>
                          <th>Current Points</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php foreach($candidate_points as $val)
                           {
                                  echo '<tr>
                              <td>'.$val->candidate_name.'</td>
                              <td>'.$val->current_point.'</td>
                               
                             <td><a href="'.base_url().'admin/update/'.$val->insta_user_id.'/candidate-points/"><button type="button"  class="btn btn-primary btn-sm">Edit</button></a>
                         
                              
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

    