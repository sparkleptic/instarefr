 
        <!-- page content -->
        <div class="right_col" role="main">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  <?php $this->load->view('common/common-msg'); ?>
                    <h2>Referred Job List <small></small></h2>
                   
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
                  <?php //echo "<pre>"; print_r($job_list); ?>
                    <!-- <p class="text-muted font-13 m-b-30">
                      Responsive is an extension for DataTables that resolves that problem by optimising the table's layout for different screen sizes through the dynamic insertion and removal of columns from the table.
                    </p> -->
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          
                          <th>Title</th>
                          <th>Company</th>
                          <th>Posted By</th>
                           <th>Posted On</th>
                          <th>Apply By</th>
                         
                          <th>Applied on</th>
                          <th>Referred by</th>
                          <th>Referred on</th>
                         
                          
                        </tr>
                      </thead>
                      <tbody>
                       <?php 
                       if(!empty($job_list))
                       {
                          foreach($job_list as $val)
                           { 
                                   echo '<tr>
                               <td>'.$val['insta_job_title'].'</td>
                               <td>'.$val['insta_company_name'].'</td>
                               <td>'.$val['job_posted_by'].'</td>
                                <td>'.$val['insta_job_created_on'].'</td>
                                <td>'.$val['applied_user_name'].'</td>
                               <td>'.$val['insta_job_apply_date'].'</td>
                               <td>'.$val['referred_user_name'].'</td>
                               <td>'.$val['insta_job_refer_date'].'</td>
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
function doconfirm()
{
    job=confirm("Are you sure to delete permanently?");
    if(job!=true)
    {
        return false;
    }
}
</script>   
<script>
function show_applied_jobs_row(id) {
  $('#'+id).toggle();
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

</script>    

    