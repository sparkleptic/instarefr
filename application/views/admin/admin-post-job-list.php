     <!-- page content -->
        <div class="right_col" role="main">
        <?php //echo "<pre>"; print_r($job_list); die; ?>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  <?php $this->load->view('common/common-msg'); ?>
                    <h2>Job List <small>Jobs</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <!-- <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li> -->
                      <!-- <li><a class="close-link"><i class="fa fa-close"></i></a> -->
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <!-- <p class="text-muted font-13 m-b-30">
                      Responsive is an extension for DataTables that resolves that problem by optimising the table's layout for different screen sizes through the dynamic insertion and removal of columns from the table.
                    </p> -->
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          
                          <th>Title</th>
                          <th>Application Email</th>
                          <th>User</th>
                          <th>Company</th>
                         
                         <th>Status</th>
                          <th>Closing Date</th>
                          <th>Category</th>
                          <th>Tags</th>
                          <th>Location</th>
                          
                          <th>Minimum Experience</th>
                          <th>Maximum Experience</th>
                          
                          
                           <th>Description</th>
                          <th>Posted On</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php if(!empty($job_list)) {
                       foreach($job_list as $val)
                           {
                                  echo '<tr>
                              <td>'.$val->insta_job_title.'</td>
                              <td>'.$val->insta_job_application_email.'</td>
                              <td>'.$val->user.'</td>
                              <td>'.$val->company.'</td>';
                              $enable = ''; $disable = '';

                               if($val->insta_job_status==1){
                                $enable = 'selected="selected"';
                               }
                               else if($val->insta_job_status==0){
                                $disable = 'selected="selected"';
                               }

                              echo '<td>
                              <form action="'.base_url().'admin/update_job_status/" id="job_status_form_'.$val->insta_job_id.'" method="post">
                              <select name="insta_job_status" onchange="doconfirm('.$val->insta_job_id.')">
                              <option value="1" '.$enable.'>Enable</option>
                              <option value="0" '.$disable.'>Disable</option>
                              </select>
                              <input type="hidden" name="insta_job_spotlight" value="'.$val->insta_job_spotlight.'">
                              <input type="hidden" name="insta_job_updated_round" value="'.$val->insta_job_updated_round.'">';
                              if(!empty($val->insta_user_id))
                              {
                                echo '<input type="hidden" name="insta_user_id" value="'.$val->insta_user_id.'">';
                              }
                              echo '<input type="hidden" name="insta_job_id" value="'.$val->insta_job_id.'">
                              <input type="submit" name="submit" class="job_status_form_'.$val->insta_job_id.'" value="Submit" style="display:none;">
                              </form></td>';
                             


                                echo '                              
                                <td>'.$val->insta_job_closing_date.'</td>
                              <td>'.$val->insta_job_category.'</td>
                              <td>'.$val->insta_job_tags.'</td>
                             <td>'.$val->insta_job_location.'</td>
                              <td>'.$val->insta_job_min_experience.'</td>
                               <td>'.$val->insta_job_max_experience.'</td>
                               <td>'.$val->insta_job_description.'</td>';

                                                     
                             
                             echo '<td>'.$val->insta_job_created_on.'</td>
                              <td><a href="'.base_url().'admin/update/'.$val->insta_job_id.'/job"><button type="button"  class="btn btn-primary btn-sm">Edit</button></a>
                          </td>
                              </tr>';
                           }
                           }
                            ?>
                        
                                           
                      </tbody>
                    </table>

                  </div>
                </div>
              </div>
        </div>
        <!-- /page content <a href="'.base_url().'admin/delete/'.$val->insta_job_id.'/job" onClick="return doconfirm();"><button type="button" class="btn btn-danger btn-sm">Delete</button></a>-->

<script>
function doconfirm(id)
{
    job=confirm("Are you sure to update status?");
    if(job!=true)
    {
        return false;
    }else{
      //console.log( $( "#job_status_form_"+id ).serialize() );
      $( ".job_status_form_"+id ).trigger( "click" );
    }
}
$(document).ready(function() {
    $('#datatable-responsive').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "ordering": false,
        "bSortClasses": false
    } );
} );
</script>    