
        <!-- page content -->
        <div class="right_col" role="main">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  <?php $this->load->view('common/common-msg'); ?>
                    <h2>Company List <small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                     
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <?php //echo "<pre>"; print_r($company_list); ?>
                   
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          
                          <th>Company name</th>
                          <th>Status</th>
                          <th>Tagline</th>
                          <th>Video</th>
                          <th>Website</th>
                          <th>Google</th>
                          <th>Facebook</th>
                          <th>Linkedin</th>
                          <th>Twitter</th>
                          <th>Description</th>                          
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php foreach($company_list as $val)
                           {

                            
                                  echo '<tr>
                              <td>'.$val->insta_company_name.'</td>';
                               if($val->insta_company_status==1)
                                {
                                echo '<td>Enable</td>';

                              }else{

                                echo '<td>Disable</td>'; 
                              }

                                $comp_alias = json_decode($val->insta_company_alias);

                                echo '<td>'.$comp_alias->insta_company_tagline.'</td>
                                <td>'.$comp_alias->insta_company_video.'</td>
                                <td>'.$comp_alias->insta_company_website.'</td>
                                <td>'.$comp_alias->insta_company_google.'</td>
                                <td>'.$comp_alias->insta_company_facebook.'</td>
                                <td>'.$comp_alias->insta_company_linkedin.'</td>
                                <td>'.$comp_alias->insta_company_twitter.'</td>
                                <td>'.$comp_alias->insta_company_description.'</td>
                             <td><a href="'.base_url().'admin/update/'.$val->insta_company_id.'/company"><button type="button"  class="btn btn-primary btn-sm">Edit</button></a></td>
                              
                              </tr>';
                           }
                           
                            ?>
                        
                                           
                      </tbody>
                    </table>

                  </div>
                </div>
              </div>
        </div>
        <!-- /page content  <a href="'.base_url().'admin/delete/'.$val->insta_company_id.'/company" onClick="return doconfirm();"><button type="button" class="btn btn-danger btn-sm">Delete</button></a></td>-->

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

    