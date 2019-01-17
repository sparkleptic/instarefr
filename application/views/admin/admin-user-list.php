 
        <!-- page content -->
        <div class="right_col" role="main">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  <?php $this->load->view('common/common-msg'); ?>
                    <h2>User List <small>Users</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <?php if($this->session->flashdata('flsh_msg') != null) { echo "<h2>".$this->session->flashdata('flsh_msg')."</h2>"; } ?>
                  <div class="x_content">
                    
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>First name</th>
                          <th>Last name</th>
                          <th>E-mail</th>
                          <th>Company</th>
                          <th>Gender</th>
                          <th>Phone</th>
                          <th>Experience</th>
                          <th>Skills</th>
                          <th>Resume</th>
                          <!-- <th>Profile-pic</th> -->
                          <th>Location</th>
                          <th>Action</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        <?php for($i=0;$i<count($user_list['user']);$i++)
                       { 
                        if(!empty($user_list['user_meta'][$i]))
                       {
                            $user_list['user_meta'][$i] = json_decode($user_list['user_meta'][$i]);
                        
                            echo '<tr>
                              <td>'.$user_list['user_meta'][$i]->first_name.'</td>
                              <td>'.$user_list['user_meta'][$i]->last_name.'</td>
                              <td>'.$user_list['user_meta'][$i]->email.'</td>';
                              if(!empty($user_list['user_meta'][$i]->company))
                              {
                                echo '<td>'.$user_list['user_meta'][$i]->company.'</td>';
                              }else if(!empty($user_list['user_meta'][$i]->company_name)){
                                echo '<td>'.$user_list['user_meta'][$i]->company_name.'</td>';
                              }else{
                                echo '<td></td>';
                              }
                              echo '<td>'.$user_list['user_meta'][$i]->gender.'</td>
                              <td>'.$user_list['user_meta'][$i]->phone.'</td>';
                              if(!empty($user_list['user_meta'][$i]->experience))
                              {
                              echo '<td>'.$user_list['user_meta'][$i]->experience.'</td>';
                              }else{
                                echo '<td></td>';
                              }
                              if(!empty($user_list['user_meta'][$i]->skills))
                              {
                              echo '<td>'.$user_list['user_meta'][$i]->skills.'</td>';
                              }else{
                                echo '<td></td>';
                              }
                              echo '<td>';
                              if(!empty($user_list['user_meta'][$i]->resume)){
                              echo '<a target="_blank" href="'.USER_UPLOAD_PATH.$user_list['user_meta'][$i]->resume.'">Resume</a>';
                              }
                              echo '</td>';
                              // <td>';
                              // if(!empty($user_list['user_meta'][$i]->resume)){
                              // echo '<img height="100" width="100" alt="" src="'. USER_UPLOAD_PATH.$user_list['user_meta'][$i]->profile_pic.'">';
                              // }
                              // echo '</td>
                             
                              echo '<td>'.$user_list['user_meta'][$i]->location.'</td>
                              <td><a href="'.base_url().'admin/update/'.$user_list['user'][$i]->insta_user_id.'/user"><button type="button"  class="btn btn-primary btn-sm">Edit</button></a>';
                              if($user_list['user_meta'][$i]->user_can_delete == 'Yes')
                              {
                                echo '<a href="'.base_url().'admin/delete/'.$user_list['user'][$i]->insta_user_id.'/user" onClick="return doconfirm();"><button type="button" class="btn btn-danger btn-sm">Delete</button></a>';
                              }
                           echo  '</td>                          
                             
                            </tr>';         
                       }
                        
                        } ?>
                                           
                      </tbody>
                    </table>

                  </div>
                </div>
              </div>
        </div>
        <!-- /page content <a href="'.base_url().'admin/delete/'.$user_list['user'][$i]->insta_user_id.'/user" onClick="return doconfirm();"><button type="button" class="btn btn-danger btn-sm">Delete</button></a>-->

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
        ],
         "ordering": false
    } );
} );
</script>

        

    