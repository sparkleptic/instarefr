<style type="text/css">
  .applied-lists , .applied-list-head{
    color:gray;
  }
  
</style>
        <!-- page content -->
        <div class="right_col" role="main">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  <?php $this->load->view('common/common-msg'); ?>
                  
                    <h2>Applied Job List <small>Jobs</small></h2>
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
                          <th>Applied</th>
                         
                          
                        </tr>
                      </thead>
                      
                       <?php if(!empty($job_list))
                       {


                        foreach($job_list as $val)
                           { 
                                   echo '<tr style="background-color:grey;color:white;">
                               <td>'.$val['insta_job_title'].'</td>
                               <td>'.$val['insta_company_name'].'</td>
                               <td>'.$val['insta_job_post_by'].'</td>
                               <td>'.$val['insta_job_created_on'].'</td>                              

                               <td><a href="#"><button type="button" class="btn btn-primary btn-sm pm-push-status" data-btn="'.$val['insta_job_id'].'" data-toggle="modal" data-target=".pm-statistics-modal-lg'.$val['insta_job_id'].'">'.count($val['apply_list']).' </button></a>
                               <div class="modal fade pm-statistics-modal-lg'.$val['insta_job_id'].'" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                              <h4 class="modal-title applied-list-head" id="myModalLabel2">'.$val['insta_job_title'].' ('.$val['insta_company_name'].')</h4>
                                            </div>
                                            <div class="modal-body applied-lists">
                                              <div class="row">
                                                <div class="col-md-4 col-sm-4 col-xs-12 text-center">
                                                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                                <thead>
                                                  <tr> <th>Applied By</th>
                                                    <th>Applied On</th>
                                                    <th>Message</th>
                                                    <th>Referred</th>
                                                    
                                                 
                                                   </tr></thead><tbody>';
                                                         foreach($val['apply_list'] as $apply)
                                                         {  
                                                            
                                                            echo '
                                                <tr>
                                                         <td>'.$apply->apply_user_name.'</td>
                                                         <td>'.$apply->insta_job_apply_date.'</td>
                                                         <td>'.wordwrap($apply->insta_job_apply_why_get_refer, 80, "<br />\n").'</td>';
                                                         if($apply->insta_job_apply_status==1)
                                                         {
                                                           echo '<td>Yes</td>';
                                                         }else{
                                                            echo '<td>No</td>';
                                                         }
                                                         
                                                        echo ' </tr>';

                                                         }

                                                          echo '</tbody></table>
                                                </div>
                                                
                                              </div>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      </td>
                               </tr>';
                               } } ?>            
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
// $(document).ready(function() {
//     $('#datatable-responsive').DataTable( {
//         dom: 'Bfrtip',
//         buttons: [
//             'copy', 'csv', 'excel', 'pdf', 'print'
//         ]
//     } );
// } );
</script>
<script>
      $(document).ready(function() {
        $('#datatable-buttons').on('click',  function(){
          var href = $(this).data('href');
         
        });
        
      });
    </script>