<?php
  $all_div = array('Root','Opera','Opera+','HRD','Finan','Perf','Marketing','Feedback Service');
  $this->db->where('id',$this->session->userdata('id'));
  $ax = $this->db->get('data_user');
  $ax = $ax->row_array();
?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $this->session->userdata('picture');?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('nama');?></p>
          <a id="status_" style="border:1px solid white;padding:1px 5px 1px;border-radius:10px;" onclick="showstatus()" href="#"><i class="fa fa-circle text-<?php echo ($ax['status']=="Online")?"success":"error";?>"></i> <?php echo $ax['status'];?> </a>
        </div>
      </div>
      <!-- search form -->
      <!--form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form-->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">NAVIGATION</li>
        <li class="treeview">
          <a href="<?php echo base_url();?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <?php
        if(in_array($this->session->userdata('divisi'), array('Root'))){
        ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-shield"></i>
            <span>Root</span>
            <?php
            $this->db->like('tanggal',date("Y-m-d"));
            $c = $this->db->get('logdata')->num_rows();
            if($c>0){
            ?>
            <span class="label label-success pull-right">
            <?php
            echo $c." activity";
            ?>
            </span>
            <?php } ?>
          </a>
          <ul class="treeview-menu">
            <li class="treeview">
              <a href="#">
                <i class="fa fa-plane"></i>
                <span>Airline Info</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url('operational/airline_status_all');?>"><i class="fa fa-th-list"></i> All Airline Status</a></li>
                <li><a href="<?php echo base_url('operational/airline_add');?>"><i class="fa fa-pencil"></i> Add New</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-paper-plane-o"></i>
                <span>Change Transaction</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url('operational/issued_manual_add');?>"><i class="fa fa-pencil"></i> Issued Manual</a></li>
                <li><a href="<?php echo base_url('operational/rebook_add');?>"><i class="fa fa-book"></i> Rebook</a></li>
              </ul>
            </li>
              <li class="treeview">
              <a href="#">
                <i class="fa fa-envelope-o"></i>
                <span>E-mail Templates</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url('root/email_templates');?>"><i class="fa fa-navicon"></i> All Templates</a></li>
                <li><a href="<?php echo base_url('root/email_templates_add');?>"><i class="fa fa-plus"></i> Add New</a></li>
              </ul>
            </li>

            <li>
              <a href="#">
                <i class="fa fa-gears"></i>
                <span>Service Desk System</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">   
                <li>
                  <a href="#">
                    <i class="fa fa-info"></i>
                    <span>Infosys</span>
                    <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('servicedesk/infosys');?>"><i class="fa fa-navicon"></i> All Infosys</a></li>
                    <li><a href="<?php echo base_url('servicedesk/infosys_add');?>"><i class="fa fa-plus"></i> Add New</a></li>
                  </ul>
                </li>
                <li>
                  <a href="#">
                    <i class="fa fa-sort-numeric-asc"></i>
                    <span>Flowsys</span>
                    <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('servicedesk/flowsys');?>"><i class="fa fa-navicon"></i> All Flowsys</a></li>
                    <li><a href="<?php echo base_url('servicedesk/flowsys_add');?>"><i class="fa fa-plus"></i> Add New</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li><a href="<?php echo base_url('root/logdata');?>"><i class="fa fa-map-signs"></i> Logdata</a></li>
            <li><a href="<?php echo base_url('root/help/all');?>"><i class="fa fa-support"></i> Office Help</a></li>
            <li><a href="<?php echo base_url('root/get_cron');?>"><i class="fa fa-bolt"></i> Trx Cron</a></li>
            <li><a href="<?php echo base_url('root/get_cron_member');?>"><i class="fa fa-bolt"></i> Member Cron</a></li>
            <li><a href="<?php echo base_url('root/get_fetch_trx');?>"><i class="fa fa-bolt"></i> Fetch Trx Cron</a></li>
            <li><a href="<?php echo base_url('root/send_automail');?>"><i class="fa fa-bolt"></i> Send AutoMail</a></li>
          </ul>
        </li>
        <?php } ?>
        <?php
        if(in_array($this->session->userdata('divisi'), $all_div)){
        ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-chain"></i>
            <span>Marketing</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <!--li class="treeview">
              <a href="#">
                <i class="fa fa-diamond"></i>
                <span>Leads</span>
                <?php
                $this->db->like('create_at',date("Y-m-d"));
                $c = $this->db->get('data_leads')->num_rows();
                if($c>0){
                ?>
                <span class="label label-success pull-right">
                <?php
                echo $c." today";
                ?></span>
                <?php } ?>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url('marketing/leads/all');?>"><i class="fa fa-navicon"></i> All Leads</a></li>
                <li><a href="<?php echo base_url('marketing/leads/add');?>"><i class="fa fa-plus"></i> Add Leads</a></li>

                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-phone"></i>
                    <span>Follow Up</span>
                    <?php
                $this->db->like('create_at',date("Y-m-d"));
                $c = $this->db->get('data_activity_leads')->num_rows();
                if($c>0){
                ?>
                <span class="label label-success pull-right">
                <?php
                echo $c." today";
                ?></span>
                <?php } ?>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('marketing/leads/followup/all');?>"><i class="fa fa-navicon"></i> All Activity</a></li>
                    <li><a href="<?php echo base_url('marketing/leads/followup/add');?>"><i class="fa fa-plus"></i> Add New</a></li>
                  </ul>
                </li>
              </ul>
            </li-->
            <li class="treeview">
              <a href="#">
                <i class="fa fa-group"></i>
                <span>Member</span>
             <?php
              $this->db->where('join_date',date("Y-m-d"));
              //$this->db->where('status','active');
              $c = $this->db->get('data_mitra')->num_rows();
              if($c>0){
              ?>
              <span class="label label-success pull-right">
              <?php
              echo $c." new member";
              ?></span>
              <?php }else{
                  echo '
                <i class="fa fa-angle-left pull-right"></i>';
                  } ?>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url('marketing/member/all');?>"><i class="fa fa-navicon"></i> All Member</a></li>
                <li><a href="<?php echo base_url('marketing/member/new');?>"><i class="fa fa-user"></i> Last 3 days</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-phone"></i>
                <span>Follow Up</span>
                <?php
                $this->db->like('create_at',date("Y-m-d"));
                $c = $this->db->get('data_activity')->num_rows();
                if($c>0){
                ?>
                <span class="label label-success pull-right">
                <?php
                echo $c." today";
                ?></span>
                <?php }else{
                  echo '
                <i class="fa fa-angle-left pull-right"></i>';
                  } ?>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url('marketing/followup_all');?>"><i class="fa fa-navicon"></i> All Activity</a></li>
                <li><a href="<?php echo base_url('marketing/followup_add');?>"><i class="fa fa-plus"></i> Add New</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-line-chart"></i>
                <span>Sales Report</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url('marketing/member_summary');?>"><i class="fa fa-th-list"></i> Member Summary</a></li>
                <li><a href="<?php echo base_url('marketing/member_statistic');?>"><i class="fa fa-pie-chart"></i> Statistic Member</a></li>
                <li><a href="<?php echo base_url('marketing/member_transaction');?>"><i class="fa fa-tag"></i> Transaction</a></li>
                <li><a href="<?php echo base_url('marketing/member_graph');?>"><i class="fa fa-group"></i> Member Graph</a></li>
                <li><a href="<?php echo base_url('marketing/airline_graph');?>"><i class="fa fa-plane"></i> Vendor Graph</a></li>
                <li><a href="<?php echo base_url('marketing/member_week');?>"><i class="fa fa-bar-chart"></i> Weekly Member Graph</a></li>
                <li><a href="<?php echo base_url('marketing/member_monthly');?>"><i class="fa fa-group"></i> Member Monthly</a></li>
              </ul>
            </li>

            <!-- under construction -->
            <li class="treeview">
              <a href="#">
                <i class="fa fa-tags"></i>
                <span>Preferences</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>

              <ul class="treeview-menu">
                <li> <a href="#">
                        <i class="fa fa-check-circle"></i>
                        <span>Master Responses</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                  <ul class="treeview-menu">
                    <li><a href=" <?= base_url('marketing/responseall'); ?> "> <i class="fa fa-bars"></i> All Responses</a></li>
                    <li><a href=" <?= base_url('marketing/responseadd'); ?> "> <i class="fa fa-plus"></i> Add Responses</a></li>
                  </ul>

                </li>

                <li> <a href="#">
                        <i class="fa fa-check-circle-o"></i>
                        <span>Master Classification</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                  <ul class="treeview-menu">
                    <li><a href="<?= base_url('marketing/classificationall'); ?>"> <i class="fa fa-bars"></i> All Classification</a></li>
                    <li><a href="<?= base_url('marketing/classificationadd'); ?>"> <i class="fa fa-plus"></i> Add Classification</a></li>
                  </ul>

                </li>
              </ul>

            </li>
            <!--li class="treeview">
              <a href="#">
                <i class="fa fa-bar-chart"></i>
                <span>Sales Force</span>
              </a>
              <ul class="treeview-menu">
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-gear"></i>
                    <span>Preferences</span>
                  </a>
                  <ul class="treeview-menu">
                    <li class="treeview">
                      <a href="#">
                        <i class="fa fa-bolt"></i>
                        <span>RFM Settings</span>
                      </a>
                      <ul class="treeview-menu">
                        <li class="treeview">
                          <a href="#">
                            <i class="fa fa-bolt"></i>
                            <span>Recency</span>
                          </a>
                          <ul class="treeview-menu">
                            <li><a href="<?php echo base_url('marketing/force/preferences/customer/trigger/all');?>"><i class="fa fa-th-list"></i> All Trigger</a></li>
                            <li><a href="<?php echo base_url('marketing/force/preferences/customer/trigger/add');?>"><i class="fa fa-plus"></i> Add New</a></li>
                          </ul>
                        </li>
                      </ul>
                    </li>
                    <li class="treeview">
                      <a href="#">
                        <i class="fa fa-bolt"></i>
                        <span>Trigger</span>
                      </a>
                      <ul class="treeview-menu">
                        <li><a href="<?php echo base_url('marketing/force/preferences/customer/trigger/all');?>"><i class="fa fa-th-list"></i> All Trigger</a></li>
                        <li><a href="<?php echo base_url('marketing/force/preferences/customer/trigger/add');?>"><i class="fa fa-plus"></i> Add New</a></li>
                      </ul>
                    </li>
                    <li class="treeview">
                      <a href="#">
                        <i class="fa fa-location-arrow"></i>
                        <span>Scoring</span>
                      </a>
                      <ul class="treeview-menu">
                        <li><a href="<?php echo base_url('marketing/force/preferences/customer/scoring/all');?>"><i class="fa fa-th-list"></i> All Templates</a></li>
                        <li><a href="<?php echo base_url('marketing/force/preferences/customer/scoring/add');?>"><i class="fa fa-plus"></i> Add New</a></li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-envelope"></i>
                    <span>E-Mail Templates</span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('marketing/force/template/all');?>"><i class="fa fa-th-list"></i> All Templates</a></li>
                    <li><a href="<?php echo base_url('marketing/force/template/add');?>"><i class="fa fa-plus"></i> Add New</a></li>
                  </ul>
                </li>
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-user-plus"></i>
                    <span>Leads</span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('marketing/force/leads/all');?>"><i class="fa fa-th-list"></i> All Leads</a></li>
                    <li><a href="<?php echo base_url('marketing/force/leads/add');?>"><i class="fa fa-plus"></i> Add New</a></li>
                  </ul>
                </li>
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-user-plus"></i>
                    <span>Leads</span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('marketing/force/leads/all');?>"><i class="fa fa-th-list"></i> All Leads</a></li>
                    <li><a href="<?php echo base_url('marketing/force/leads/add');?>"><i class="fa fa-plus"></i> Add New</a></li>
                  </ul>
                </li>
                <li><a href="<?php echo base_url('marketing/sales/summary');?>"><i class="fa fa-th-list"></i> Member Summary</a></li>
              </ul>
            </li>
            <li><a href="<?php echo base_url('marketing/berita');?>"><i class="fa fa-info-circle"></i> Berita Marketing</a></li>
            <li><a href="<?php echo base_url('marketing/admin');?>"><i class="fa fa-user-secret"></i> Administrator</a></li-->
          </ul>
        </li>
        <?php
        }
        ?>
        <?php
        if(in_array($this->session->userdata('divisi'), $all_div)){
        ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-television"></i>
            <span>Performance Monitor</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <!--li><a href="<?php echo base_url('perf/daily_report');?>"><i class="fa fa-list"></i> Daily Report</a></li>
            <li><a href="<?php echo base_url('perf/target_rkap');?>"><i class="glyphicon glyphicon-screenshot"></i> Target RKAP</a></li-->
            <li><a href="<?php echo base_url('perf/curl_image');?>"><i class="fa fa-line-chart"></i> cURL Image GD System</a></li>
            <li><a href="<?php echo base_url('perf/debug_mail');?>"><i class="fa fa-at"></i> Debug Mail</a></li>
          </ul>
        </li>
        <?php
        }
        ?>
        <?php
        if(in_array($this->session->userdata('divisi'), $all_div)){
        ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-tty"></i>
            <span>Operational</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <?php
            $this->db->where('utama',1);
            $forms = $this->db->get('forms');
            $form = $forms->result_array();
            foreach ($form as $key) {
            ?>
            <li><a href="<?php echo base_url('operational/form/'.$key['id']);?>"><i class="fa fa-pencil"></i> <?php echo $key['judul'];?></a></li>
            <?php } ?> 
            
            <!--li><a href="<?php echo base_url('operational/forms');?>"><i class="fa fa-copy"></i> Forms</a></li-->
            <li><a href="<?php echo base_url('operational/all_error');?>"><i class="fa fa-book"></i> Data All Error</a></li>
            <li><a href="<?php echo base_url('servicedesk/my_tasks');?>"><i class="fa fa-tasks"></i> My Tasks</a></li>
            

            <li class="treeview">
              <a href="#">
                <i class="fa fa-suitcase"></i>
                <span>FinOps Tools</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a> 
              <ul class="treeview-menu"> 
              <li><a href="<?php echo base_url('operational/request_potong_saldo');?>"><i class="fa fa-usd"></i> Request Potong Saldo</a></li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Rekon Tiket</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url('operational/rekonlion');?>"><i class="fa fa-plane"></i> Lion Air</a></li>
                <li><a href="<?php echo base_url('operational/rekonsj');?>"><i class="fa fa-plane"></i> Sriwijaya Air</a></li>
              </ul>
            </li>
            </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-h-square"></i>
                <span>Helpdesk Tools</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url('pengaturan/appsview');?>"><i class="fa fa-desktop"></i> Apps</a></li>
                <li><a href="<?php echo base_url('operational/adminkoran');?>"><i class="fa fa-user-secret"></i> Administrator</a></li>
                <li><a href="<?php echo base_url('operational/funnyname');?>"><i class="fa fa-check-square-o"></i> Funnyname List</a></li>
                <li><a href="<?php echo base_url('operational/koran_helpdesk');?>"><i class="fa fa-newspaper-o"></i> Koran Helpdesk</a></li>
              <li class="treeview">
              <a href="#">
                <i class="fa fa-cog"></i>
                <span>Preferences</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a> 
              <ul class="treeview-menu"> 
              <li class="treeview">
              <a href="#">
                <i class="fa fa-medium"></i>
                <span>Master Mandatory</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url('pengaturan/mandatoryviewall');?>"><i class="fa fa-navicon"></i>  All Data</a></li>
                <li><a href="<?php echo base_url('pengaturan/mandatoryviewadd');?>"><i class="fa fa-plus"></i> Add New</a></li>          
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-maxcdn"></i>
                <span>Master Class Garuda</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url('pengaturan/classgarudaviewall');?>"><i class="fa fa-navicon"></i>  All Data</a></li>
                <li><a href="<?php echo base_url('pengaturan/classgarudaviewadd');?>"><i class="fa fa-plus"></i> Add New</a></li>          
              </ul>
            </li> 
              </ul>
            </li>  
          </ul>
        </li>
        </ul>
        </li>

        <?php
        }
        if(in_array($this->session->userdata('divisi'), $all_div)){
        ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cogs"></i>
            <span>Settings</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
          <?php if(in_array($this->session->userdata('divisi'), array('Root'))){ ?>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-group"></i>
                <span>Manage Users</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="treeview">
              <a href="#">
                <i class="fa fa-th-list"></i>
                <span>User Data</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url('pengaturan/add_new_user');?>"><i class="fa fa-user-plus"></i> Add New User</a></li>
                <li><a href="<?php echo base_url('pengaturan/user_manage');?>"><i class="fa fa-users"></i> All User</a></li>
                </ul>
                </li>
                <li><a href="<?php echo base_url('pengaturan/division_data');?>"><i class="fa fa-th-list"></i> Division Data</a></li>
                <li><a href="<?php echo base_url('pengaturan/level_data');?>"><i class="fa fa-th-list"></i> Level Data</a></li>
              </ul>
            </li>
          <?php } ?>
            <li><a href="<?php echo base_url('pengaturan/edit_profile');?>"><i class="fa fa-key"></i> Edit Profile</a></li>
            <li><a href="<?php echo base_url('pengaturan/office_manual');?>"><i class="fa fa-life-ring"></i> Office Help</a></li>
          </ul>
        </li>
        </ul>
        <?php
        }
        ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
