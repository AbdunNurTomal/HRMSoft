<style>

    /*.w4border{ border-bottom: 2px solid; }*/  

</style>


<div class="heading">
    <div class="row">        
        <div class="form-group col-sm-3"> 
            <img src="pic_mountain.jpg" alt="" style="width:100px;height:100px;">
        </div>            
        <div class="form-group col-sm-6" > 
            <label class="control-label col-sm-12 pull-left"><b>Employment Eligibility Verification</b></label>
            <label class="control-label col-sm-12 pull-left">Department of Homeland Security </label>
            <label class="control-label col-sm-12 pull-left">U.S. Citizenship and Immigration Services</label>
        </div>
        <div class="form-group col-sm-3" > 
            <label class="control-label col-sm-12 pull-left">USCIS</label>
            <label class="control-label col-sm-12 pull-left">Form I-9</label>
            <label class="control-label col-sm-12 pull-left">OMB No. 1615-0047</label>
            <label class="control-label col-sm-12 pull-left">Expires 08/31/2019</label>
        </div>        
    </div>
</div>
<?php
// if($this->user_group == 11 || $this->user_group == 12) {
//    $self_identification_array = $this->db->get_where('main_eeoc_categories', array('company_id' => $this->company_id,'isactive' => 1));
//} else {
//    $self_identification_array = $this->db->get_where('main_eeoc_categories', array('isactive' => 1));
//}
//$main_eeo_policies_query = $this->Common_model->listItem('main_eeo_policies');


if ($type == 1) {
    ?>


    <form id="onboarding_eeopolicies_form" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Onboarding/save_onboarding_eeopolicies" enctype="multipart/form-data" role="form">
        <input type="hidden" value="" name="ob_eeo_emp_id" id="ob_eeo_emp_id"/>

        <div class="form-group" style="margin-top: 15px;"> 
            <label class="col-sm-1 control-label">A</label>
            <label class="col-sm-9 control-label pull-left" style="text-align: left;">Enter “1” for yourself if no one else can claim you as a dependent . . . . . . . . . . . . . . . . . . </label>
            <label class="col-sm-1 control-label">A</label>
            <div class="col-sm-1">                            
                <input type="text" name="start_date" id="start_date" class="form-control" placeholder="" />                    
            </div>                     
        </div>
        <div class="form-group" style="margin-top: 15px;"> 
            <label class="col-sm-1 control-label">B</label>
            <label class="col-sm-9 control-label" style="text-align: left;">
                Enter “1” if:
                <ul>
                    <li>You are single and have only one job; or</li>
                    <li>You are married, have only one job, and your spouse does not work; or</li>
                    <li>Your wages from a second job or your spouse’s wages (or the total of both) are $1,500 or less.</li>
                </ul>
            </label>
            <label class="col-sm-1 control-label">B</label>
            <div class="col-sm-1">                            
                <input type="text" name="start_date" id="start_date" class="form-control" placeholder="" />                    
            </div>                     
        </div>
        <div class="form-group" style="margin-top: 15px;"> 
            <label class="col-sm-1 control-label">C</label>
            <label class="col-sm-9 control-label" style="text-align: left;">Enter “1” for your spouse. But, you may choose to enter “-0-” if you are married and have either a working spouse or more
                than one job. (Entering “-0-” may help you avoid having too little tax withheld.) . . . . . . . . . . . . . .</label>
            <label class="col-sm-1 control-label">C</label>
            <div class="col-sm-1">                            
                <input type="text" name="start_date" id="start_date" class="form-control" placeholder="" />                    
            </div>                     
        </div>
        <div class="form-group" style="margin-top: 15px;"> 
            <label class="col-sm-1 control-label">D</label>
            <label class="col-sm-9 control-label" style="text-align: left;">Enter number of dependents (other than your spouse or yourself) you will claim on your tax return . . . . . . . . </label>
            <label class="col-sm-1 control-label">D</label>
            <div class="col-sm-1">                            
                <input type="text" name="start_date" id="start_date" class="form-control" placeholder="" />                    
            </div>                     
        </div>
        <div class="form-group" style="margin-top: 15px;"> 
            <label class="col-sm-1 control-label">E</label>
            <label class="col-sm-9 control-label" style="text-align: left;">Enter “1” if you will file as head of household on your tax return (see conditions under Head of household above) . . </label>
            <label class="col-sm-1 control-label">E</label>
            <div class="col-sm-1">                            
                <input type="text" name="start_date" id="start_date" class="form-control" placeholder="" />                    
            </div>                     
        </div>
        <div class="form-group" style="margin-top: 15px;"> 
            <label class="col-sm-1 control-label">F</label>
            <label class="col-sm-9 control-label" style="text-align: left;">Enter “1” if you have at least $2,000 of child or dependent care expenses for which you plan to claim a credit . . . F
                (Note: Do not include child support payments. See Pub. 503, Child and Dependent Care Expenses, for details.) </label>
            <label class="col-sm-1 control-label">F</label>
            <div class="col-sm-1">                            
                <input type="text" name="start_date" id="start_date" class="form-control" placeholder="" />                    
            </div>                     
        </div>
        <div class="form-group" style="margin-top: 15px;"> 
            <label class="col-sm-1 control-label">G</label>
            <label class="col-sm-9 control-label" style="text-align: left;">Child Tax Credit (including additional child tax credit). See Pub. 972, Child Tax Credit, for more information.
                <ul>
                    <li>If your total income will be less than $70,000 ($100,000 if married), enter “2” for each eligible child; then less “1” if you
                        have two to four eligible children or less “2” if you have five or more eligible children.</li>
                    <li>If your total income will be between $70,000 and $84,000 ($100,000 and $119,000 if married), enter “1” for each eligible child . .</li>
                </ul>
            </label>
            <label class="col-sm-1 control-label">G</label>
            <div class="col-sm-1">                            
                <input type="text" name="start_date" id="start_date" class="form-control" placeholder="" />                    
            </div>                     
        </div>
        <div class="form-group" style="margin-top: 15px;"> 
            <label class="col-sm-1 control-label">H</label>
            <label class="col-sm-9 control-label" style="text-align: left;">Add lines A through G and enter total here. (Note: This may be different from the number of exemptions you claim on your tax return.)</label>
            <label class="col-sm-1 control-label">H</label>
            <div class="col-sm-1">                            
                <input type="text" name="start_date" id="start_date" class="form-control" placeholder="" />                    
            </div>                     
        </div>

        <div class="row" >
            <div class="col-sm-12" style="border-bottom:  2px solid;" >
                <div class="form-group col-sm-12"> 
                    <label class="control-label pull-left"><h3>--------Separate here and give Form W-4 to your employer. Keep the top part for your records.--------</h3></label>
                </div>
                <div class="form-group col-sm-2" style="margin: 5px; border-right: 2px solid;"> 
                    <label class="control-label pull-left">Form <b>W-4</b> <br> Department of the Treasury Internal Revenue Service</label>
                </div>
                <div class="form-group col-sm-6" style="margin: 5px;border-right: 2px solid;"> 
                    <label class="control-label pull-left">Employee's Withholding Allowance Certificate<br>
                        ▶ Whether you are entitled to claim a certain number of allowances or exemption from withholding is
                        subject to review by the IRS. Your employer may be required to send a copy of this form to the IRS.
                    </label>
                </div>
                <div class="form-group col-sm-2" style="margin: 5px;"> 
                    <label class="control-label pull-left"> OMB No. 1545-0074 <h1>2016</h1> </label>
                </div>
            </div>        

            <div class="col-sm-12" style="border-bottom:  2px solid;" >

                <div class="form-group col-sm-4" style="margin: 5px; border-right: 2px solid;"> 
                    <label class="control-label col-sm-12 pull-left">1. Your first name and middle initial</label>
                    <div class="col-sm-12">                            
                        <input type="text" name="start_date" id="start_date" class="form-control" placeholder="" />                    
                    </div>
                </div>
                <div class="form-group col-sm-3" style="margin: 5px;border-right: 2px solid;"> 
                    <label class="control-label col-sm-12 pull-left">Last name</label>
                    <div class="col-sm-12">                            
                        <input type="text" name="start_date" id="start_date" class="form-control" placeholder="" />                    
                    </div>
                </div>
                <div class="form-group col-sm-4" style="margin: 5px;"> 
                    <label class="control-label col-sm-12 pull-left">2. Your social security number</label>
                    <div class="col-sm-12">                            
                        <input type="text" name="start_date" id="start_date" class="form-control" placeholder="" />                    
                    </div>
                </div>
            </div>        
            <div class="col-sm-12" style="border-bottom:  2px solid;" >

                <div class="form-group col-sm-5" style="margin: 5px; border-right: 2px solid;"> 
                    <label class="control-label col-sm-12 pull-left">Home address (number and street or rural route)</label>
                    <div class="col-sm-12">                            
                        <input type="text" name="start_date" id="start_date" class="form-control" placeholder="" />                    
                    </div>
                </div>
                <div class="form-group col-sm-7">                         
                    <label class="control-label col-sm-2 pull-left">3</label>
                    <div class="col-sm-10">                            
                        <label class="checkbox-inline col-sm-2"><input type="checkbox" value="">Single</label>
                        <label class="checkbox-inline col-sm-2"><input type="checkbox" value="">Married</label>
                        <label class="checkbox-inline col-sm-6"><input type="checkbox" value="">Married, but withhold at higher Single rate.</label>                    
                    </div>
                    <label class="control-label col-sm-12 pull-left">Note: If married, but legally separated, or spouse is a nonresident alien, check the “Single” box.</label>
                </div>                    
            </div>        
            <div class="col-sm-12" style="border-bottom:  2px solid;" >

                <div class="form-group col-sm-5" style="margin: 5px; border-right: 2px solid;"> 
                    <label class="control-label col-sm-12 pull-left">City or town, state, and ZIP code</label>
                    <div class="col-sm-12">                            
                        <input type="text" name="start_date" id="start_date" class="form-control" placeholder="" />                    
                    </div>
                </div>
                <div class="form-group col-sm-7"> 
                    <label class="control-label col-sm-2 pull-left">4</label>
                    <label class="control-label col-sm-9 pull-left">Note: If married, but legally separated, or spouse is a nonresident alien, check the “Single” box.</label>
                    <div class="col-sm-1">                            
                        <label class="checkbox-inline col-sm-12"><input type="checkbox" value=""></label>                                           
                    </div>

                </div>                    
            </div>        
            <div class="col-sm-12" style="border-bottom:  2px solid;" >

                <div class="form-group col-sm-12" style="margin: 5px;"> 
                    <label class="control-label col-sm-9 pull-left">Total number of allowances you are claiming (from line H above or from the applicable worksheet on page 2)</label>
                    <label class="control-label col-sm-1">5</label>
                    <div class="col-sm-2">                            
                        <input type="text" name="start_date" id="start_date" class="form-control" placeholder="" />                    
                    </div>
                </div>
                <div class="form-group col-sm-12" style="margin: 5px;"> 
                    <label class="control-label col-sm-9 pull-left">Additional amount, if any, you want withheld from each paycheck . . . . . . . . . . . . . .</label>
                    <label class="control-label col-sm-1">6</label>
                    <div class="col-sm-2">                            
                        <input type="text" name="start_date" id="start_date" class="form-control" placeholder="" />                    
                    </div>
                </div>
                <div class="form-group col-sm-12" style="margin: 5px;"> 
                    <label class="control-label col-sm-9 pull-left">
                        <p class="pull-left">I claim exemption from withholding for 2016, and I certify that I meet both of the following conditions for exemption.</p>
                        <ul>
                            <li>Last year I had a right to a refund of all federal income tax withheld because I had no tax liability, and</li>
                            <li>This year I expect a refund of all federal income tax withheld because I expect to have no tax liability.</li>                                
                        </ul>
                        <p class="pull-left">If you meet both conditions, write “Exempt” here . . . . . . . . . . . . . . . </p>
                    </label>
                    <label class="control-label col-sm-1">7</label>
                    <div class="col-sm-2">                            
                        <input type="text" name="start_date" id="start_date" class="form-control" placeholder="" />                    
                    </div>
                </div>                                       
            </div>  

            <div class="col-sm-12" style="border-bottom:  2px solid;" >

                <div class="form-group col-sm-12"> 
                    <label class="control-label col-sm-12 pull-left">Under penalties of perjury, I declare that I have examined this certificate and, to the best of my knowledge and belief, it is true, correct, and complete.</label>                        
                </div>
                <div class="form-group col-sm-12"> 
                    <div class="control-label col-sm-8 pull-left">
                        <label class="control-label col-sm-12 pull-left">Employee’s signature</label>
                        <label class="control-label col-sm-12 pull-left">(This form is not valid unless you sign it.) ▶</label>
                    </div>
                    <label class="control-label col-sm-4 pull-left">Date:</label>

                </div>
            </div>

            <div class="col-sm-12" style="border-bottom:  2px solid;" >

                <div class="form-group col-sm-6" style="margin: 5px; border-right: 2px solid;"> 
                    <label class="control-label col-sm-12 pull-left">8. Employer’s name and address (Employer: Complete lines 8 and 10 only if sending to the IRS.)</label>
                    <div class="col-sm-12">                            
                        <input type="text" name="start_date" id="start_date" class="form-control" placeholder="" />                    
                    </div>
                </div>
                <div class="form-group col-sm-2" style="margin: 5px;border-right: 2px solid;"> 
                    <label class="control-label col-sm-12 pull-left">9. Office code (optional)</label>
                    <div class="col-sm-12">                            
                        <input type="text" name="start_date" id="start_date" class="form-control" placeholder="" />                    
                    </div>
                </div>
                <div class="form-group col-sm-3" style="margin: 5px;"> 
                    <label class="control-label col-sm-12 pull-left">10. Employer identification number (EIN)</label>
                    <div class="col-sm-12">                            
                        <input type="text" name="start_date" id="start_date" class="form-control" placeholder="" />                    
                    </div>
                </div>
            </div>

        </div>

        <div class="modal-footer">
            <!--            <button type="submit" id="submit" class="btn btn-u">Save</button>
                        <a class="btn btn-danger" href="<?php //echo base_url() . "Con_Onboarding"          ?>">Close</a>-->

            <button class="btn btn-danger btn-prev pull-left" type="button" onclick="return showPrev()"><span class="glyphicon glyphicon-arrow-left"></span>Previous </button>
            <button class="btn btn-u btn-next pull-right" type="button" onclick="return showNext(1)"><span class="glyphicon glyphicon-arrow-right"></span>Next </button>

        </div>
    </form>
    <?php
} else if ($type == 2) { //Update 
    //$query = $this->db->get_where('main_ob_eeo_policies', array('onboarding_employee_id' => $ob_emp_id));
    //if ($query->num_rows() > 0) {
    //$action_type = 2;
    //} else {
    $action_type = 1;
    // }

    if ($action_type == 2) {
        ?>
        <div class = "page-header no-margin">

        </div>
        <form id="onboarding_eeopolicies_form" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_onboarding_list/edit_onboarding_eeopolicies" enctype="multipart/form-data" role="form">

            <div class="form-group" style="margin-top: 15px;"> 
                <label class="col-sm-1 control-label">A</label>
                <label class="col-sm-9 control-label pull-left" style="text-align: left;">Enter “1” for yourself if no one else can claim you as a dependent . . . . . . . . . . . . . . . . . . </label>
                <label class="col-sm-1 control-label">A</label>
                <div class="col-sm-1">                            
                    <input type="text" name="start_date" id="start_date" class="form-control" placeholder="" />                    
                </div>                     
            </div>
            <div class="form-group" style="margin-top: 15px;"> 
                <label class="col-sm-1 control-label">B</label>
                <label class="col-sm-9 control-label" style="text-align: left;">
                    Enter “1” if:
                    <ul>
                        <li>You are single and have only one job; or</li>
                        <li>You are married, have only one job, and your spouse does not work; or</li>
                        <li>Your wages from a second job or your spouse’s wages (or the total of both) are $1,500 or less.</li>
                    </ul>
                </label>
                <label class="col-sm-1 control-label">B</label>
                <div class="col-sm-1">                            
                    <input type="text" name="start_date" id="start_date" class="form-control" placeholder="" />                    
                </div>                     
            </div>
            <div class="form-group" style="margin-top: 15px;"> 
                <label class="col-sm-1 control-label">C</label>
                <label class="col-sm-9 control-label" style="text-align: left;">Enter “1” for your spouse. But, you may choose to enter “-0-” if you are married and have either a working spouse or more
                    than one job. (Entering “-0-” may help you avoid having too little tax withheld.) . . . . . . . . . . . . . .</label>
                <label class="col-sm-1 control-label">C</label>
                <div class="col-sm-1">                            
                    <input type="text" name="start_date" id="start_date" class="form-control" placeholder="" />                    
                </div>                     
            </div>
            <div class="form-group" style="margin-top: 15px;"> 
                <label class="col-sm-1 control-label">D</label>
                <label class="col-sm-9 control-label" style="text-align: left;">Enter number of dependents (other than your spouse or yourself) you will claim on your tax return . . . . . . . . </label>
                <label class="col-sm-1 control-label">D</label>
                <div class="col-sm-1">                            
                    <input type="text" name="start_date" id="start_date" class="form-control" placeholder="" />                    
                </div>                     
            </div>
            <div class="form-group" style="margin-top: 15px;"> 
                <label class="col-sm-1 control-label">E</label>
                <label class="col-sm-9 control-label" style="text-align: left;">Enter “1” if you will file as head of household on your tax return (see conditions under Head of household above) . . </label>
                <label class="col-sm-1 control-label">E</label>
                <div class="col-sm-1">                            
                    <input type="text" name="start_date" id="start_date" class="form-control" placeholder="" />                    
                </div>                     
            </div>
            <div class="form-group" style="margin-top: 15px;"> 
                <label class="col-sm-1 control-label">F</label>
                <label class="col-sm-9 control-label" style="text-align: left;">Enter “1” if you have at least $2,000 of child or dependent care expenses for which you plan to claim a credit . . . F
                    (Note: Do not include child support payments. See Pub. 503, Child and Dependent Care Expenses, for details.) </label>
                <label class="col-sm-1 control-label">F</label>
                <div class="col-sm-1">                            
                    <input type="text" name="start_date" id="start_date" class="form-control" placeholder="" />                    
                </div>                     
            </div>
            <div class="form-group" style="margin-top: 15px;"> 
                <label class="col-sm-1 control-label">G</label>
                <label class="col-sm-9 control-label" style="text-align: left;">Child Tax Credit (including additional child tax credit). See Pub. 972, Child Tax Credit, for more information.
                    <ul>
                        <li>If your total income will be less than $70,000 ($100,000 if married), enter “2” for each eligible child; then less “1” if you
                            have two to four eligible children or less “2” if you have five or more eligible children.</li>
                        <li>If your total income will be between $70,000 and $84,000 ($100,000 and $119,000 if married), enter “1” for each eligible child . .</li>
                    </ul>
                </label>
                <label class="col-sm-1 control-label">G</label>
                <div class="col-sm-1">                            
                    <input type="text" name="start_date" id="start_date" class="form-control" placeholder="" />                    
                </div>                     
            </div>
            <div class="form-group" style="margin-top: 15px;"> 
                <label class="col-sm-1 control-label">H</label>
                <label class="col-sm-9 control-label" style="text-align: left;">Add lines A through G and enter total here. (Note: This may be different from the number of exemptions you claim on your tax return.)</label>
                <label class="col-sm-1 control-label">H</label>
                <div class="col-sm-1">                            
                    <input type="text" name="start_date" id="start_date" class="form-control" placeholder="" />                    
                </div>                     
            </div>

            <div class="row" >
                <div class="col-sm-12" style="border-bottom:  2px solid;" >
                    <div class="form-group col-sm-12"> 
                        <label class="control-label pull-left"><h3>--------Separate here and give Form W-4 to your employer. Keep the top part for your records.--------</h3></label>
                    </div>
                    <div class="form-group col-sm-2" style="margin: 5px; border-right: 2px solid;"> 
                        <label class="control-label pull-left">Form <b>W-4</b> <br> Department of the Treasury Internal Revenue Service</label>
                    </div>
                    <div class="form-group col-sm-6" style="margin: 5px;border-right: 2px solid;"> 
                        <label class="control-label pull-left">Employee's Withholding Allowance Certificate<br>
                            ▶ Whether you are entitled to claim a certain number of allowances or exemption from withholding is
                            subject to review by the IRS. Your employer may be required to send a copy of this form to the IRS.
                        </label>
                    </div>
                    <div class="form-group col-sm-2" style="margin: 5px;"> 
                        <label class="control-label pull-left"> OMB No. 1545-0074 <h1>2016</h1> </label>
                    </div>
                </div>        

                <div class="col-sm-12" style="border-bottom:  2px solid;" >

                    <div class="form-group col-sm-4" style="margin: 5px; border-right: 2px solid;"> 
                        <label class="control-label col-sm-12 pull-left">1. Your first name and middle initial</label>
                        <div class="col-sm-12">                            
                            <input type="text" name="start_date" id="start_date" class="form-control" placeholder="" />                    
                        </div>
                    </div>
                    <div class="form-group col-sm-3" style="margin: 5px;border-right: 2px solid;"> 
                        <label class="control-label col-sm-12 pull-left">Last name</label>
                        <div class="col-sm-12">                            
                            <input type="text" name="start_date" id="start_date" class="form-control" placeholder="" />                    
                        </div>
                    </div>
                    <div class="form-group col-sm-4" style="margin: 5px;"> 
                        <label class="control-label col-sm-12 pull-left">2. Your social security number</label>
                        <div class="col-sm-12">                            
                            <input type="text" name="start_date" id="start_date" class="form-control" placeholder="" />                    
                        </div>
                    </div>
                </div>        
                <div class="col-sm-12" style="border-bottom:  2px solid;" >

                    <div class="form-group col-sm-5" style="margin: 5px; border-right: 2px solid;"> 
                        <label class="control-label col-sm-12 pull-left">Home address (number and street or rural route)</label>
                        <div class="col-sm-12">                            
                            <input type="text" name="start_date" id="start_date" class="form-control" placeholder="" />                    
                        </div>
                    </div>
                    <div class="form-group col-sm-7">                         
                        <label class="control-label col-sm-2 pull-left">3</label>
                        <div class="col-sm-10">                            
                            <label class="checkbox-inline col-sm-2"><input type="checkbox" value="">Single</label>
                            <label class="checkbox-inline col-sm-2"><input type="checkbox" value="">Married</label>
                            <label class="checkbox-inline col-sm-6"><input type="checkbox" value="">Married, but withhold at higher Single rate.</label>                    
                        </div>
                        <label class="control-label col-sm-12 pull-left">Note: If married, but legally separated, or spouse is a nonresident alien, check the “Single” box.</label>
                    </div>                    
                </div>        
                <div class="col-sm-12" style="border-bottom:  2px solid;" >

                    <div class="form-group col-sm-5" style="margin: 5px; border-right: 2px solid;"> 
                        <label class="control-label col-sm-12 pull-left">City or town, state, and ZIP code</label>
                        <div class="col-sm-12">                            
                            <input type="text" name="start_date" id="start_date" class="form-control" placeholder="" />                    
                        </div>
                    </div>
                    <div class="form-group col-sm-7"> 
                        <label class="control-label col-sm-2 pull-left">4</label>
                        <label class="control-label col-sm-9 pull-left">Note: If married, but legally separated, or spouse is a nonresident alien, check the “Single” box.</label>
                        <div class="col-sm-1">                            
                            <label class="checkbox-inline col-sm-12"><input type="checkbox" value=""></label>                                           
                        </div>

                    </div>                    
                </div>        
                <div class="col-sm-12" style="border-bottom:  2px solid;" >

                    <div class="form-group col-sm-12" style="margin: 5px;"> 
                        <label class="control-label col-sm-9 pull-left">Total number of allowances you are claiming (from line H above or from the applicable worksheet on page 2)</label>
                        <label class="control-label col-sm-1">5</label>
                        <div class="col-sm-2">                            
                            <input type="text" name="start_date" id="start_date" class="form-control" placeholder="" />                    
                        </div>
                    </div>
                    <div class="form-group col-sm-12" style="margin: 5px;"> 
                        <label class="control-label col-sm-9 pull-left">Additional amount, if any, you want withheld from each paycheck . . . . . . . . . . . . . .</label>
                        <label class="control-label col-sm-1">6</label>
                        <div class="col-sm-2">                            
                            <input type="text" name="start_date" id="start_date" class="form-control" placeholder="" />                    
                        </div>
                    </div>
                    <div class="form-group col-sm-12" style="margin: 5px;"> 
                        <label class="control-label col-sm-9 pull-left">
                            <p class="pull-left">I claim exemption from withholding for 2016, and I certify that I meet both of the following conditions for exemption.</p>
                            <ul>
                                <li>Last year I had a right to a refund of all federal income tax withheld because I had no tax liability, and</li>
                                <li>This year I expect a refund of all federal income tax withheld because I expect to have no tax liability.</li>                                
                            </ul>
                            <p class="pull-left">If you meet both conditions, write “Exempt” here . . . . . . . . . . . . . . . </p>
                        </label>
                        <label class="control-label col-sm-1">7</label>
                        <div class="col-sm-2">                            
                            <input type="text" name="start_date" id="start_date" class="form-control" placeholder="" />                    
                        </div>
                    </div>                                       
                </div>  

                <div class="col-sm-12" style="border-bottom:  2px solid;" >

                    <div class="form-group col-sm-12"> 
                        <label class="control-label col-sm-12 pull-left">Under penalties of perjury, I declare that I have examined this certificate and, to the best of my knowledge and belief, it is true, correct, and complete.</label>                        
                    </div>
                    <div class="form-group col-sm-12"> 
                        <div class="control-label col-sm-8 pull-left">
                            <label class="control-label col-sm-12 pull-left">Employee’s signature</label>
                            <label class="control-label col-sm-12 pull-left">(This form is not valid unless you sign it.) ▶</label>
                        </div>
                        <label class="control-label col-sm-4 pull-left">Date:</label>

                    </div>
                </div>

                <div class="col-sm-12" style="border-bottom:  2px solid;" >

                    <div class="form-group col-sm-6" style="margin: 5px; border-right: 2px solid;"> 
                        <label class="control-label col-sm-12 pull-left">8. Employer’s name and address (Employer: Complete lines 8 and 10 only if sending to the IRS.)</label>
                        <div class="col-sm-12">                            
                            <input type="text" name="start_date" id="start_date" class="form-control" placeholder="" />                    
                        </div>
                    </div>
                    <div class="form-group col-sm-2" style="margin: 5px;border-right: 2px solid;"> 
                        <label class="control-label col-sm-12 pull-left">9. Office code (optional)</label>
                        <div class="col-sm-12">                            
                            <input type="text" name="start_date" id="start_date" class="form-control" placeholder="" />                    
                        </div>
                    </div>
                    <div class="form-group col-sm-3" style="margin: 5px;"> 
                        <label class="control-label col-sm-12 pull-left">10. Employer identification number (EIN)</label>
                        <div class="col-sm-12">                            
                            <input type="text" name="start_date" id="start_date" class="form-control" placeholder="" />                    
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <!--                <button type="submit" id="submit" class="btn btn-u">Save</button>
                                <a class="btn btn-danger" href="<?php //echo base_url() . "Con_onboarding_list"          ?>">Close</a>-->

                <button class="btn btn-danger btn-prev pull-left" type="button" onclick="return showPrev()"><span class="glyphicon glyphicon-arrow-left"></span>Previous </button>
                <button class="btn btn-u btn-next pull-right" type="button" onclick="return showNext(1)"><span class="glyphicon glyphicon-arrow-right"></span>Next </button>

            </div>
        </form>
        <?php
    } else {
        ?>
        <div class="page-header no-margin">

        </div>
        <form id="onboarding_eeopolicies_form" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_onboarding_list/save_onboarding_eeopolicies" enctype="multipart/form-data" role="form">
            <input type="hidden" value="" name="ob_eeo_emp_id" id="ob_eeo_emp_id"/>
            <div class="form-group" style="margin-top: 15px; border-top:  2px solid; border-bottom:  2px solid;"> 
                <label class="col-sm-12 control-label" style="text-align: left;">►START HERE: Read instructions carefully before completing this form. The instructions must be available, either in paper or electronically,
                    during completion of this form. Employers are liable for errors in the completion of this form.</label>
                <label class="col-sm-12 control-label pull-left" style="text-align: left;"><b>ANTI-DISCRIMINATION NOTICE:</b> It is illegal to discriminate against work-authorized individuals. Employers CANNOT specify which
                    document(s) an employee may present to establish employment authorization and identity. The refusal to hire or continue to employ
                    an individual because the documentation presented has a future expiration date may also constitute illegal discrimination.</label>

            </div>
            <div class="form-group" style="margin-top: 5px; border-bottom:  2px solid;"> 
                <table class="table table-bordered" style="margin-top: 5px;">
                    <thead>
                        <tr>
                            <th colspan="9">Section 1. Employee Information and Attestation (Employees must complete and sign Section 1 of Form I-9 no later
                                than the first day of employment, but not before accepting a job offer.)</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="3">
                                <div class="form-group col-sm-12" style="margin: 5px;"> 
                                    <label class="control-label col-sm-12 pull-left">Last Name (Family Name)</label>
                                    <div class="col-sm-12">                            
                                        <input type="text" name="" id="" class="form-control" placeholder="" />                    
                                    </div>
                                </div>
                            </td>                            
                            <td colspan="2">
                                <div class="form-group col-sm-12" style="margin: 5px;"> 
                                    <label class="control-label col-sm-12 pull-left">First Name (Given Name)</label>                                    
                                    <div class="col-sm-12">                            
                                        <input type="text" name="" id="" class="form-control" placeholder="" />                    
                                    </div>
                                </div>
                            </td> 
                            <td colspan="1">
                                <div class="form-group col-sm-12" style="margin: 5px;"> 
                                    <label class="control-label col-sm-12 pull-left">Middle Initial</label>
                                    <div class="col-sm-12">                            
                                        <input type="text" name="" id="" class="form-control" placeholder="" />                    
                                    </div>
                                </div>
                            </td>
                            <td colspan="3">
                                <div class="form-group col-sm-12" style="margin: 5px;"> 
                                    <label class="control-label col-sm-12 pull-left">Other Last Names Used (if any)</label>
                                    <div class="col-sm-12">                            
                                        <input type="text" name="" id="" class="form-control" placeholder="" />                    
                                    </div>
                                </div>
                            </td>                            
                        </tr>
                        <tr>
                            <td colspan="4">
                                <div class="form-group col-sm-12" style="margin: 5px;"> 
                                    <label class="control-label col-sm-12 pull-left">Address (Street Number and Name)</label>
                                    <div class="col-sm-12">                            
                                        <input type="text" name="" id="" class="form-control" placeholder="" />                    
                                    </div>
                                </div>
                            </td>                            
                            <td>
                                <div class="form-group col-sm-12" style="margin: 5px;"> 
                                    <label class="control-label col-sm-12 pull-left">Apt. Number</label>
                                    <div class="col-sm-12">                            
                                        <input type="text" name="" id="" class="form-control" placeholder="" />                    
                                    </div>
                                </div>
                            </td>
                            <td colspan="2">
                                <div class="form-group col-sm-12" style="margin: 5px;"> 
                                    <label class="control-label col-sm-12 pull-left">City or Town</label>
                                    <div class="col-sm-12">                            
                                        <input type="text" name="" id="" class="form-control" placeholder="" />                    
                                    </div>
                                </div>
                            </td>                            
                            <td>
                                <div class="form-group col-sm-12" style="margin: 5px;"> 
                                    <label class="control-label col-sm-12 pull-left">State</label>
                                    <div class="col-sm-12">                            
                                        <select name="" id="" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                            <option>Dhaka</option>
                                            <option>Khulna</option>
                                            <option>Magura</option>
                                        </select>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group col-sm-12" style="margin: 5px;"> 
                                    <label class="control-label col-sm-12 pull-left">ZIP Code</label>
                                    <div class="col-sm-12">                            
                                        <input type="text" name="" id="" class="form-control" placeholder="" />                    
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="form-group col-sm-12" style="margin: 5px;"> 
                                    <label class="control-label col-sm-12 pull-left">Date of Birth</label>
                                    <div class="col-sm-12">                            
                                        <input type="text" name="" id="" class="form-control dt_pick" placeholder="" />                    
                                    </div>
                                </div>
                            </td>                            
                            <td colspan="2">
                                <div class="form-group col-sm-12" style="margin: 5px;"> 
                                    <label class="control-label col-sm-12 pull-left">U.S. Social Security Number</label>
                                    <div class="col-sm-12">                            
                                        <input type="text" name="" id="" class="form-control" placeholder="" />                    
                                    </div>
                                </div>
                            </td>                            
                            <td colspan="3">
                                <div class="form-group col-sm-12" style="margin: 5px;"> 
                                    <label class="control-label col-sm-12 pull-left"> Employee's E-mail Address</label>
                                    <div class="col-sm-12">                            
                                        <input type="text" name="" id="" class="form-control" placeholder="" />                    
                                    </div>
                                </div>
                            </td>
                            <td colspan="2">
                                <div class="form-group col-sm-12" style="margin: 5px;"> 
                                    <label class="control-label col-sm-12 pull-left">Employee's Telephone Number</label>
                                    <div class="col-sm-12">                            
                                        <input type="text" name="" id="" class="form-control" placeholder="" />                    
                                    </div>
                                </div>
                            </td>                            
                        </tr>

                    </tbody>
                </table> 
            </div>
            <div class="form-group" style="margin-top: 15px; border-top:  2px solid;"> 
                <label class="col-sm-12 control-label" style="text-align: left;">
                    <b>I am aware that federal law provides for imprisonment and/or fines for false statements or use of false documents in
                        connection with the completion of this form.</b>
                </label>
            </div>

            <div class="form-group" style="margin-top: 15px;border-bottom: 2px solid;"> 
                <label class="col-sm-12 control-label" style="text-align: left;">
                    <b>I attest, under penalty of perjury, that I am (check one of the following boxes):</b>
                </label>

                <table>                    
                    <tbody>
                        <tr>
                            <td colspan="8">
                                <div class="form-group col-sm-12" style="margin: 5px;">                                    
                                    <div class="col-sm-12">                            
                                        <label class="checkbox col-sm-12"><input type="checkbox" value="">1. A citizen of the United States</label>
                                    </div>
                                </div>
                            </td>                    
                        </tr>
                        <tr>
                            <td colspan="8">
                                <div class="form-group col-sm-12" style="margin: 5px;">                                    
                                    <div class="col-sm-12">                            
                                        <label class="checkbox col-sm-12"><input type="checkbox" value="">2. A noncitizen national of the United States (See instructions)</label>
                                    </div>
                                </div>
                            </td>                    
                        </tr>
                        <tr>
                            <td colspan="8">
                                <div class="form-group col-sm-12" style="margin: 5px;">                                    
                                    <div class="col-sm-8">                            
                                        <label class="checkbox col-sm-12"><input type="checkbox" value="">3. A lawful permanent resident  (Alien Registration Number/USCIS Number):</label>
                                    </div>
                                    <div class="col-sm-4">                            
                                        <input type="text" name="" id="" class="form-control" placeholder="" />                    
                                    </div>
                                </div>
                            </td>                    
                        </tr>
                        <tr>
                            <td colspan="6">
                                <div class="form-group col-sm-12" style="margin: 5px;">                                    
                                    <div class="col-sm-8">                            
                                        <label class="checkbox col-sm-12"><input type="checkbox" value="">3. A lawful permanent resident  (Alien Registration Number/USCIS Number):</label>
                                    </div>
                                    <div class="col-sm-4">                            
                                        <input type="text" name="" id="" class="form-control" placeholder="" />                    
                                    </div>
                                </div>
                                <div class="form-group col-sm-12" style="margin: 5px;">                                    
                                    <div class="col-sm-8">                            
                                        <label class="checkbox col-sm-12"><input type="checkbox" value="">4. An alien authorized to work until (See instructions) (expiration date, if applicable, mm/dd/yyyy): Some aliens may write "N/A" in the expiration date fiel</label>
                                    </div>
                                    <div class="col-sm-4">                            
                                        <input type="text" name="" id="" class="form-control dt_pick" placeholder="" />                    
                                    </div>
                                </div>
                                <div class="form-group col-sm-12" style="margin: 5px;">                                    
                                    <div class="col-sm-12">                            
                                        <label class="checkbox col-sm-12">
                                            Aliens authorized to work must provide only one of the following document numbers to complete Form I-9:
                                            An Ali                                      en Registration Number/USCIS Number OR Form I-94 Admission Number OR Foreign Passport Number
                                        </label>
                                    </div>                                    
                                </div>
                                <div class="form-group col-sm-12" style="margin: 5px;">                                    
                                    <div class="col-sm-8">                            
                                        <label class="checkbox col-sm-12">
                                            1. Alien Registration Number/USCIS Number:
                                        </label>                                        
                                    </div> 
                                    <div class="col-sm-4">                            
                                        <input type="text" name="" id="" class="form-control" placeholder="" />                    
                                    </div>
                                </div>
                                <div class="form-group col-sm-12" style="margin: 5px;">                                    
                                    <div class="col-sm-8">                            
                                        <label class="checkbox col-sm-12">
                                            2. Form I-94 Admission Number:
                                        </label>                                        
                                    </div> 
                                    <div class="col-sm-4">                            
                                        <input type="text" name="" id="" class="form-control" placeholder="" />                    
                                    </div>
                                </div>
                                <div class="form-group col-sm-12" style="margin: 5px;">                                    
                                    <div class="col-sm-8">                            
                                        <label class="checkbox col-sm-12">
                                            3. Foreign Passport Number:
                                        </label>                                        
                                    </div> 
                                    <div class="col-sm-4">                            
                                        <input type="text" name="" id="" class="form-control" placeholder="" />                    
                                    </div>
                                </div>
                                <div class="form-group col-sm-12" style="margin: 5px;">                                    
                                    <div class="col-sm-8">                            
                                        <label class="checkbox col-sm-12">
                                            Country of Issuance:
                                        </label>                                        
                                    </div> 
                                    <div class="col-sm-4">                            
                                        <input type="text" name="" id="" class="form-control" placeholder="" />                    
                                    </div>
                                </div>
                            </td>                    
                            <td colspan="2">

                            </td>                    
                        </tr
                    </tbody>
                </table> 
            </div>

            <div class="modal-footer">
                <button class="btn btn-danger btn-prev pull-left" type="button" onclick="return showPrev()"><span class="glyphicon glyphicon-arrow-left"></span>Previous </button>
                <button class="btn btn-u btn-next pull-right" type="button" onclick="return showNext(1)"><span class="glyphicon glyphicon-arrow-right"></span>Next </button>
            </div>
        </form>
        <?php
    }
}
?>

