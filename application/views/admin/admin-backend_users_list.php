 
        <!-- page content -->
        <div class="right_col" role="main">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  <?php $this->load->view('common/common-msg'); ?>
                    <h2>Users List <small>Users</small></h2>
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
                          
                          <th>Name</th>
                          <th>Email</th>
                          <th>User Name</th>
                          <th>Password</th>
                         
                          <th>Type</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php foreach($backend_users as $val)
                           {
                                  echo '<tr>
                              <td>'.$val->insta_admin_name.'</td>
                              <td>'.$val->insta_admin_email.'</td>
                              <td>'.$val->insta_admin_username.'</td>
                              <td>'.$val->insta_admin_password.'</td>
                             
                               <td>'.$val->insta_admin_type.'</td>';
                             
                               if($val->insta_admin_status==1)

                                echo '<td>Enable</td>';

                              else

                                echo '<td>Disable</td>';


                                echo '               
                             
                             <td><a href="'.base_url().'admin/update/'.$val->insta_admin_id.'/admin_users"><button type="button"  class="btn btn-primary btn-sm">Edit</button></a>
                          <a href="'.base_url().'admin/delete/'.$val->insta_admin_id.'/admin_users" onClick="return doconfirm();"><button type="button" class="btn btn-danger btn-sm">Delete</button></a></td>
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
</script>