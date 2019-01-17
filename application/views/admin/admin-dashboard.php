
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="row top_tiles">
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-users"></i></div>
                  <div class="count"><?php echo $candidate_count; ?></div>
                  <h3>Candidate</h3>
                  <!-- <p>Lorem ipsum psdea itgum rixt.</p> -->
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-book"></i></div>
                  <div class="count"><?php echo $job_count; ?></div>
                  <h3>Job</h3>
                  <!-- <p>Lorem ipsum psdea itgum rixt.</p> -->
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-building"></i></div>
                  <div class="count"><?php echo $company_count; ?></div>
                  <h3>Company</h3>
                  <!-- <p>Lorem ipsum psdea itgum rixt.</p> -->
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-phone"></i></div>
                  <div class="count"><?php echo $contact_us_count; ?></div>
                  <h3>Contact us</h3>
                  <!-- <p>Lorem ipsum psdea itgum rixt.</p> -->
                </div>
              </div>
            </div>

            <div class="row">
            <h1>welcome <?php echo $this->session->userdata['logged_in']['username']; ?></h1>
            </div>

            
          </div>
        </div>
        <!-- /page content -->

        

    