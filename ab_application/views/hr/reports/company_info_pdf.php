<!DOCTYPE html>
<html><title>Company Settings Report</title><body>
        <h2 style='margin-top:0;text-align:center'>Company Settings Report</h2> 

        <p>Company Information:-</p>
        <table style="width:95%;border-collapse: collapse;">
            <tr>
                <th style="width:11%">Name</th>
                <th style="width:11%">Address</th>
                <th style="width:11%">Address2</th>
                <th style="width:11%">City</th>
                <th style="width:11%">State</th>
                <th style="width:11%">Zip</th>
                <th style="width:11%">Contact</th>
                <th style="width:11%">Phone</th>
                <th style="width:12%">Email</th>
            </tr>
            <tr>
                <td><?php echo $company_basic['company_full_name']; ?></td>
                <td><?php echo $company_basic['address_1']; ?></td>
                <td><?php echo $company_basic['address_2']; ?></td>
                <td><?php echo $company_basic['city']; ?></td>
                <td><?php echo $this->Common_model->get_name($this, $company_basic['state'], 'main_state', 'state_name'); ?></td>
                <td><?php echo $company_basic['zip_code']; ?></td>
                <td><?php echo $company_basic['phone_1']; ?></td>
                <td><?php echo $company_basic['phone_2']; ?></td>
                <td><?php echo $company_basic['email']; ?></td>
            </tr>
        </table>

        <p>Location:-</p>
        <?php
        $result = $this->db->get_where('main_location', array('company_id' => $company_settings_id, 'isactive' => 1))->result_array();
        if (!empty($result)):
            $i = 0;
            ?>
            <table style="width:100%; border-collapse: collapse;">
                <tr>
                    <th style="width:1%; white-space:nowrap;">Sl no.</th>
                    <th style="width:1%; white-space:nowrap;">Location Name</th>
                    <th style="width:1%; white-space:nowrap;">Contact Name</th>
                    <th style="width:1%; white-space:nowrap;">Phone</th>
                    <th style="width:1%; white-space:nowrap;">Email</th>
                </tr>
                <?php foreach ($result as $row): ?>
                    <tr>
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo $row['location_name']; ?></td>
                        <td><?php echo $row['contact_person']; ?></td>
                        <td><?php echo $row['contact_number']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

        <p>Department:-</p>
        <?php
        $result = $this->db->get_where('main_department', array('company_id' => $company_settings_id, 'isactive' => 1))->result_array();
        if (!empty($result)):
            $i = 0;
            ?>
            <table style="width:100%;border-collapse: collapse;">
                <tr>
                    <th style="width:1%;white-space:nowrap">Sl no.</th>
                    <th style="width:1%;white-space:nowrap">Department Name</th>
                    <th style="width:1%;white-space:nowrap">Department Code</th>
                    <th style="width:1%;white-space:nowrap">Description</th>
                </tr>
                <?php foreach ($result as $row): ?>
                    <tr>
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo $row['department_name']; ?></td>
                        <td><?php echo $row['department_code']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

        <p>Pay Frequency:-</p>
        <?php
        $billing_cycle_array = $this->Common_model->get_array('billing_cycle');
        $result = $this->db->get_where('main_payfrequency', array('company_id' => $company_settings_id, 'isactive' => 1))->result_array();
        if (!empty($result)):
            $i = 0;
            ?>
            <table style="width:100%;border-collapse: collapse;">
                <tr>
                    <th style="width:1%;white-space:nowrap">Sl no.</th>
                    <th style="width:1%;white-space:nowrap">Frequency Type</th>
                    <th style="width:1%;white-space:nowrap">Description</th>
                </tr>
                <?php foreach ($result as $row): ?>
                    <tr>
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo $this->Common_model->get_name($this, $row['freqtype'], 'main_payfrequency_type', 'freqcode'); ?></td>
                        <td><?php echo $row['freqdescription']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

        <p>Position :-</p>
        <?php
        $result = $this->db->get_where('main_positions', array('company_id' => $company_settings_id, 'isactive' => 1))->result_array();
        
        if (!empty($result)):
            $i = 0;
            ?>
            <table style="width:100%;border-collapse: collapse;">
                <tr>
                    <th style="width:1%;white-space:nowrap">Sl no.</th>
                    <th style="width:1%;white-space:nowrap">Position</th>
                    <th style="width:1%;white-space:nowrap">Description</th>
                </tr>
                <?php foreach ($result as $row): ?>
                    <tr>
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo $this->Common_model->get_name($this, $row['positionname'], 'main_jobtitles', 'job_title'); ?></td>
                        <td><?php echo $row['description']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

        <p>Employee Status :-</p>
        <?php
        $result = $this->db->get_where('main_employmentstatus', array('company_id' => $company_settings_id, 'isactive' => 1))->result_array();
        //pr($result);
        if (!empty($result)):
            $i = 0;
            ?>
            <table style="width:100%;border-collapse: collapse;">
                <tr>
                    <th style="width:1%;white-space:nowrap">Sl no.</th>
                    <th style="width:1%;white-space:nowrap">Work Code</th>
                    <th style="width:1%;white-space:nowrap">Description</th>
                </tr>
                <?php foreach ($result as $row): ?>
                    <tr>
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo $this->Common_model->get_name($this, $row['workcodename'], 'tbl_employmentstatus', 'employemnt_status'); ?></td>
                        <td><?php echo ucwords($row['description']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

        <p>Language :-</p>
        <?php
        $result = $this->db->get_where('main_com_language', array('company_id' => $company_settings_id, 'isactive' => 1))->result_array();
        //pr($result);
        if (!empty($result)):
            $i = 0;
            ?>
            <table style="width:100%;border-collapse: collapse;">
                <tr>
                    <th style="width:1%;white-space:nowrap">Sl no.</th>
                    <th style="width:1%;white-space:nowrap">Language Name</th>
                    <th style="width:1%;white-space:nowrap">Description</th>
                </tr>
                <?php foreach ($result as $row): ?>
                    <tr>
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo $this->Common_model->get_name($this, $row['languagename'], 'main_language', 'languagename'); ?></td>
                        <td><?php echo ucwords($row['description']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

        <p>Leave Type :-</p>
        <?php
        $leavetypeid_array = $this->Common_model->get_array('leavetype');
        $result = $this->db->get_where('main_employeeleavetypes', array('company_id' => $company_settings_id, 'isactive' => 1))->result_array();
        //pr($result);
        if (!empty($result)):
            $i = 0;
            ?>
            <table style="width:100%;border-collapse: collapse;">
                <tr>
                    <th style="width:1%;white-space:nowrap">Sl no.</th>
                    <th style="width:1%;white-space:nowrap">Leave Type</th>
                    <th style="width:1%;white-space:nowrap">Leave Code</th>
                    <th style="width:1%;white-space:nowrap">Description</th>
                </tr>
                <?php foreach ($result as $row): ?>
                    <tr>
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo $leavetypeid_array[$row['leavetype']]; ?></td>
                        <td><?php echo $row['leave_code']; ?></td>
                        <td><?php echo ucwords($row['description']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

        <p>Education:-</p>
        <?php
        $result = $this->db->get_where('main_educationlevelcode', array('company_id' => $company_settings_id, 'isactive' => 1))->result_array();
        //pr($result);
        if (!empty($result)):
            $i = 0;
            ?>
            <table style="width:100%;border-collapse: collapse;">
                <tr>
                    <th style="width:1%;white-space:nowrap">Sl no.</th>
                    <th style="width:1%;white-space:nowrap">Education Level</th>
                    <th style="width:1%;white-space:nowrap">Description</th>
                </tr>
                <?php foreach ($result as $row): ?>
                    <tr>
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo $row['educationlevelcode']; ?></td>
                        <td><?php echo ucwords($row['description']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

        <p>Bank Account Types:-</p>
        <?php
        $result = $this->db->get_where('main_bank_account_types', array('company_id' => $company_settings_id, 'isactive' => 1))->result_array();
        //pr($result);
        if (!empty($result)):
            $i = 0;
            ?>
            <table style="width:100%;border-collapse: collapse;">
                <tr>
                    <th style="width:1%;white-space:nowrap">Sl no.</th>
                    <th style="width:1%;white-space:nowrap">Bank Account Type</th>
                    <th style="width:1%;white-space:nowrap">Description</th>
                </tr>
                <?php foreach ($result as $row): ?>
                    <tr>
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo ucwords($row['bank_account_type']); ?></td>
                        <td><?php echo ucwords($row['description']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>        

        <p>Competency Levels:-</p>
        <?php
        $result = $this->db->get_where('main_competencylevels', array('company_id' => $company_settings_id, 'isactive' => 1))->result_array();
        //pr($result);
        if (!empty($result)):
            $i = 0;
            ?>
            <table style="width:100%;border-collapse: collapse;">
                <tr>
                    <th style="width:1%;white-space:nowrap">Sl no.</th>
                    <th style="width:1%;white-space:nowrap">Competency Levels</th>
                    <th style="width:1%;white-space:nowrap">Description</th>
                </tr>
                <?php foreach ($result as $row): ?>
                    <tr>
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo ucwords($row['competencylevels']); ?></td>
                        <td><?php echo ucwords($row['description']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>        

        <p>Discipline Type :-</p>
        <?php
        $result = $this->db->get_where('main_disciplinetype', array('company_id' => $company_settings_id, 'isactive' => 1))->result_array();
        //pr($result);
        if (!empty($result)):
            $i = 0;
            ?>
            <table style="width:100%;border-collapse: collapse;">
                <tr>
                    <th style="width:1%;white-space:nowrap">Sl no.</th>
                    <th style="width:1%;white-space:nowrap">Discipline Type</th>
                    <th style="width:1%;white-space:nowrap">Description</th>
                </tr>
                <?php foreach ($result as $row): ?>
                    <tr>
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo ucwords($row['discipline_type']); ?></td>
                        <td><?php echo ucwords($row['description']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

        <p>Incident Type:-</p>
        <?php
        $result = $this->db->get_where('main_incidenttype', array('company_id' => $company_settings_id, 'isactive' => 1))->result_array();
        //pr($result);
        if (!empty($result)):
            $i = 0;
            ?>
            <table style="width:100%;border-collapse: collapse;">
                <tr>
                    <th style="width:1%;white-space:nowrap">Sl no.</th>
                    <th style="width:1%;white-space:nowrap">Incident Type</th>
                    <th style="width:1%;white-space:nowrap">Description</th>
                </tr>
                <?php foreach ($result as $row): ?>
                    <tr>
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo ucwords($row['incident_type']); ?></td>
                        <td><?php echo ucwords($row['description']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

        <p>Benefit Type:-</p>
        <?php
        $result = $this->db->get_where('main_benefit_type', array('company_id' => $company_settings_id, 'isactive' => 1))->result_array();
        //pr($result);
        if (!empty($result)):
            $i = 0;
            ?>
            <table style="width:100%;border-collapse: collapse;">
                <tr>
                    <th style="width:1%;white-space:nowrap">Sl no.</th>
                    <th style="width:1%;white-space:nowrap">Benefit Type</th>
                    <th style="width:1%;white-space:nowrap">Description</th>
                </tr>
                <?php foreach ($result as $row): ?>
                    <tr>
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo ucwords($row['benefit_type']); ?></td>
                        <td><?php echo ucwords($row['description']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

        <p>Benefits Provider:-</p>
        <?php
        $result = $this->db->get_where('main_benefits_provider', array('company_id' => $company_settings_id, 'isactive' => 1))->result_array();
        //pr($result);
        if (!empty($result)):
            $i = 0;
            ?>
            <table style="width:100%;border-collapse: collapse;">
                <tr>
                    <th style="width:1%;white-space:nowrap">Sl no.</th>
                    <th style="width:1%;white-space:nowrap">Service Provider Name</th>
                    <th style="width:1%;white-space:nowrap">City</th>
                    <th style="width:1%;white-space:nowrap">States</th>
                    <th style="width:1%;white-space:nowrap">Contact Name</th>
                    <th style="width:1%;white-space:nowrap">Phone</th>
                    <th style="width:1%;white-space:nowrap">Email</th>
                </tr>
                <?php foreach ($result as $row): ?>
                    <tr>
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo ucwords($row['service_provider_name']); ?></td>
                        <td><?php echo ucwords($row['city']); ?></td>
                        <td><?php echo $this->Common_model->get_name($this, $row['states'], 'main_state', 'state_name'); ?></td>
                        <td><?php echo ucwords($row['contact_name']); ?></td>
                        <td><?php echo ucwords($row['phone_no']); ?></td>
                        <td><?php echo ucwords($row['email']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

        <p>Dependant(s):-</p>
        <?php
        $result = $this->db->get_where('main_relationship_status', array('company_id' => $company_settings_id, 'isactive' => 1))->result_array();
        //pr($result);
        if (!empty($result)):
            $i = 0;
            ?>
            <table style="width:100%;border-collapse: collapse;">
                <tr>
                    <th style="width:1%;white-space:nowrap">Sl no.</th>
                    <th style="width:1%;white-space:nowrap">Relationship Status</th>
                    <th style="width:1%;white-space:nowrap">Description</th>
                </tr>
                <?php foreach ($result as $row): ?>
                    <tr>
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo ucwords($row['relationship_status']); ?></td>
                        <td><?php echo ucwords($row['description']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

        <p>Company Policy:-</p>
        <?php
        $result = $this->db->get_where('main_company_policies', array('company_id' => $company_settings_id, 'isactive' => 1))->result_array();
        //pr($result);
        if (!empty($result)):
            $i = 0;
            ?>
            <table style="width:100%;border-collapse: collapse;">
                <tr>
                    <th style="width:1%;white-space:nowrap">Sl no.</th>
                    <th style="width:1%;white-space:nowrap">Policy Name</th>
                    <th style="width:1%;white-space:nowrap">Description</th>
                </tr>
                <?php foreach ($result as $row): ?>
                    <tr>
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo ucwords($row['policy_name']); ?></td>
                        <td><?php echo ucwords($row['description']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

        <p>EEOC:-</p>
        <?php
        $result = $this->db->get_where('main_eeoc_categories', array('company_id' => $company_settings_id, 'isactive' => 1))->result_array();
        //pr($result);
        if (!empty($result)):
            $i = 0;
            ?>
            <table style="width:100%;border-collapse: collapse;">
                <tr>
                    <th style="width:1%;white-space:nowrap">Sl no.</th>
                    <th style="width:1%;white-space:nowrap">EEOC Categories</th>
                    <th style="width:1%;white-space:nowrap">Description</th>
                </tr>
                <?php foreach ($result as $row): ?>
                    <tr>
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo ucwords($row['eeoc_categories']); ?></td>
                        <td><?php echo ucwords($row['description']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

        <p>Assets Type:-</p>
        <?php
        $result = $this->db->get_where('main_assets_type', array('company_id' => $company_settings_id, 'isactive' => 1))->result_array();
        //pr($result);
        if (!empty($result)):
            $i = 0;
            ?>
            <table style="width:100%;border-collapse: collapse;">
                <tr>
                    <th style="width:1%;white-space:nowrap">Sl no.</th>
                    <th style="width:1%;white-space:nowrap">Asset Type</th>
                    <th style="width:1%;white-space:nowrap">Description</th>
                </tr>
                <?php foreach ($result as $row): ?>
                    <tr>
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo ucwords($row['asset_type']); ?></td>
                        <td><?php echo ucwords($row['description']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

        <p>Asset Category:-</p>
        <?php
        $result = $this->db->get_where('main_assets_category', array('company_id' => $company_settings_id, 'isactive' => 1))->result_array();
        if (!empty($result)):
            $i = 0;
            ?>
            <table style="width:100%;border-collapse: collapse;">
                <tr>
                    <th style="width:1%;white-space:nowrap">Sl no.</th>                    
                    <th style="width:1%;white-space:nowrap">Asset Category</th>
                    <th style="width:1%;white-space:nowrap">Asset Type</th>
                    <th style="width:1%;white-space:nowrap">Description</th>
                </tr>
                <?php foreach ($result as $row): ?>
                    <tr>
                        <td><?php echo ++$i; ?></td>                        
                        <td><?php echo ucwords($row['asset_category']); ?></td>
                        <td><?php echo ucwords($this->Common_model->get_name($this, $row['asset_type_id'], 'main_assets_type', 'asset_type')); ?></td>
                        <td><?php echo ucwords($row['description']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>        

        <p>Asset Name:-</p>
        <?php
        $result = $this->db->get_where('main_assets_name', array('company_id' => $company_settings_id, 'isactive' => 1))->result_array();
        if (!empty($result)):
            $i = 0;
            ?>
            <table style="width:100%;border-collapse: collapse;">
                <tr>
                    <th style="width:1%;white-space:nowrap">Sl no.</th>
                    <th style="width:1%;white-space:nowrap">Asset Name</th>
                    <th style="width:1%;white-space:nowrap">Asset Type</th>
                    <th style="width:1%;white-space:nowrap">Asset Category</th>
                    <th style="width:1%;white-space:nowrap">Description</th>
                </tr>
                <?php foreach ($result as $row): ?>
                    <tr>
                        <td><?php echo ++$i; ?></td>                                                
                        <td><?php echo ucwords($row['asset_name']); ?></td>
                        <td><?php echo ucwords($this->Common_model->get_name($this, $row['asset_type_id'], 'main_assets_type', 'asset_type')); ?></td>
                        <td><?php echo ucwords($this->Common_model->get_name($this, $row['asset_category_id'], 'main_assets_category', 'asset_category')); ?></td>
                        <td><?php echo ucwords($row['description']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

        <p>Asset Register:-</p>
        <?php
        $this->db->select('main_asset_master.id,main_asset_master.asset_type_id,main_asset_master.asset_category_id,main_asset_master.asset_name_id,main_asset_master.quantity,'
                . 'main_assets_detail.id as dtls_id,main_assets_detail.mid,main_assets_detail.asset_id,main_assets_detail.model_name,main_assets_detail.serial_no,main_assets_detail.value,main_assets_detail.description,main_assets_detail.IsAssigned');
        $this->db->from('main_asset_master');
        $this->db->join('main_assets_detail', 'main_asset_master.id = main_assets_detail.mid');
        $this->db->where('main_asset_master.company_id', $company_settings_id);
        $this->db->where('main_asset_master.isactive', 1);
        $this->db->order_by('main_asset_master.id ');
        $result = $this->db->get()->result();

        if (!empty($result)):
            $i = 0;
            ?>
            <table style="width:100%;border-collapse: collapse;">
                <tr>
                    <th style="width:1%;white-space:nowrap">Asset Name</th>
                    <th style="width:1%;white-space:nowrap">SL </th>
                    <th style="width:1%;white-space:nowrap">Asset ID</th>                            
                    <th style="width:1%;white-space:nowrap">Asset Type</th>
                    <th style="width:1%;white-space:nowrap">Asset Category</th>
                    <th style="width:1%;white-space:nowrap">Model Name</th>
                    <th style="width:1%;white-space:nowrap">Value</th>
                    <th style="width:1%;white-space:nowrap">Asset Description</th>
                    <th style="width:1%;white-space:nowrap">Status</th>
                </tr>
                <?php
                $i = 0;
                $naua = $this->db->query("SELECT `mid`,count(`mid`) as ttl FROM `main_assets_detail` group by `mid`")->result_array();
                $row_span = array();
                foreach ($naua as $row_num) {
                    $row_span[$row_num['mid']] = $row_num['ttl'];
                }
                $same = '';
                foreach ($result as $row) {
                    $i++;
                    ?>
                    <tr>
                        <?php
                        if ($row->mid != $same) {
                            $same = $row->mid;
                            ?>
                            <td rowspan="<?php echo $row_span[$row->mid]; ?>">
                                <?php echo $this->Common_model->get_name($this, $row->asset_name_id, ' main_assets_name', 'asset_name'); ?>
                            </td>
                            <?php
                        }
                        ?>                              
                        <td rowspan=""><?php echo $i ?> </td>  
                        <td><?php echo $row->asset_id ?></td>
                        <td><?php echo $this->Common_model->get_name($this, $row->asset_type_id, 'main_assets_type', 'asset_type') ?></td>
                        <td><?php echo $this->Common_model->get_name($this, $row->asset_category_id, 'main_assets_category', 'asset_category') ?></td>
                        <td><?php echo $row->model_name ?></td>
                        <td><?php echo $row->value ?></td>
                        <td><?php echo $row->description ?></td>
                        <td>
                            <?php
                            if ($row->IsAssigned == 0) {
                                echo ' Not Assign';
                            } elseif ($row->IsAssigned == 1) {
                                echo 'Assign';
                            } elseif ($row->IsAssigned == 2) {
                                echo 'Return';
                            } elseif ($row->IsAssigned == 2) {
                                echo 'writeoff';
                            };
                            ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        <?php endif; ?>

        <p>Alert Policy:-</p>
        <?php
        $status_array = $this->Common_model->get_array('status');
        $alert_type_array = $this->Common_model->get_array('alert_type');

        $result = $this->db->get_where('main_alert_policy', array('company_id' => $company_settings_id, 'isactive' => 1))->result_array();
        //pr($result);
        if (!empty($result)):
            $i = 0;
            ?>
            <table style="width:100%;border-collapse: collapse;">
                <tr>
                    <th style="width:1%;white-space:nowrap">Sl no.</th>                    
                    <th style="width:1%;white-space:nowrap">Alert Policy</th>
                    <th style="width:1%;white-space:nowrap">Status</th>
                </tr>
                <?php
                foreach ($result as $row):
                    if ($row['alert_item'] == 0) {
                        $al = "";
                    } else {
                        $al = $alert_type_array[$row['alert_item']];
                    }
                    ?>
                    <tr>
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo ucwords($al); ?></td>
                        <td><?php echo ucwords($status_array[$row['alert_status']]); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

        <p>PTO Policy:-</p>
        <?php
        $method_arr = $this->Common_model->get_array('method');
        $result = $this->db->get_where('main_pto_settings', array('company_id' => $company_settings_id, 'isactive' => 1))->result_array();
        //pr($result);
        if (!empty($result)):
            $i = 0;
            ?>
            <table style="width:100%;border-collapse: collapse;">
                <tr>
                    <th style="width:1%;white-space:nowrap">Sl no.</th>
                    <th style="width:1%;white-space:nowrap">Leave Type</th>
                    <th style="width:1%;white-space:nowrap">Description</th>
                    <th style="width:1%;white-space:nowrap">Method</th>
                    <th style="width:1%;white-space:nowrap">Hourly Allowance</th>
                </tr>
                <?php
                foreach ($result as $row):
                    if ($row['method'] == 0) {
                        $method = "";
                    } else {
                        $method = $method_arr[$row['method']];
                    }
                    /*                     * ****************************************** */
                    if ($row['hourly_allowance_option'] == 0) {
                        $hourly_allowance = "";
                    } else if ($row['hourly_allowance_option'] == 1) {
                        $hourly_allowance = "Fixed";
                    } else if ($row['hourly_allowance_option'] == 2) {
                        $hourly_allowance = "Graduated";
                    }
                    ?>
                    <tr>
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo ucwords($this->Common_model->get_name($this, $row['paid_leave_type'], 'main_employeeleavetypes', 'leave_code')); ?></td>
                        <td><?php echo ucwords($row['paid_description']); ?></td>
                        <td><?php echo ucwords($method); ?></td>
                        <td><?php echo $hourly_allowance; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </body>

    <style type="text/css">
        /*tr td:nth-child(even){font-style:italic !important;text-align:center !important}*/
        td, th{border:1px solid #000; font-size:10px}
        table{margin-top:5px}
        p{margin:0;padding-top:15px;}
    </style>

</html>