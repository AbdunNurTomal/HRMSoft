<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb" >
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li> 
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3"> <!-- container well div -->
            <?php
            if ($type == 1) {//entry
                ?>
                <form id="sky-form11" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url() . 'Con_obw4/save_obw4'; ?>" enctype="multipart/form-data" role="form">
                    <div class="offset2 span8">

                        <div class="form-group margin-top-15">
                            <label class="col-sm-2 control-label">Select Type <span class="req"></span> :</label>
                            <div class="col-sm-4 no-padding">
                                <select name="ob_eeo_type" id="ob_eeo_type" onchange="set_ob_emp(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                    <option></option>
                                    <?php
                                    $ob_eeo_type = array(1 => 'Onboard', 2 => 'Employee');
                                    foreach ($ob_eeo_type as $key => $val) {
                                        print"<option value='" . $key . "'>" . $val . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>    
                            <label class="col-sm-2 control-label">Select Candidate <span class="req"></span> :</label>
                            <div class="col-sm-4 no-padding">
                                <select name="ob_eeo_emp_id" id="ob_eeo_emp_id" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                    <option></option>
                                    <?php
//                                    $ob_candidate = $this->db->get_where('main_ob_personal_information', array('company_id' => $this->company_id));
//                                    if ($ob_candidate && ($ob_candidate->num_rows() > 0)) {
//                                        foreach ($ob_candidate->result() as $key => $row) {
//                                            print"<option value='" . $row->onboarding_employee_id . "'>" . $row->onboarding_firstname . ' ' . $row->onboarding_middlename . ' ' . $row->onboarding_lastname . "</option>";
//                                        }
//                                    }
                                    ?>
                                </select>
                            </div>    
                        </div>
                        
                        <!--<input type="hidden" value="" name="ob_eeo_emp_id" id="ob_eeo_emp_id"/>-->


                        <div class="form-group" >
                            <div class="col-sm-12 no-padding" style="border-bottom:2px solid #000;" >
<!--                                <div class="form-group col-sm-12 center-align"> 
                                    <label class="control-label"><h4>--------------------- Separate here and give Form W-4 to your employer. Keep the top part for your records ---------------------</h4></label>
                                </div>-->
                                <div class="form-group col-sm-3" style="margin:5px; border-right:2px solid #000;"> 
                                    <label class="control-label col-xs-12 left-align no-padding" style="padding-left:15px !important">Form <h1 style="display:inline-block">W-4</h1> <br/>Department of the Treasury<br/>Internal Revenue Service</label>
                                </div>
                                <div class="form-group col-sm-7" style="border-right: 2px solid;"> 
                                    <label class="control-label center-align"><h3 class="no-margin">Employee's Withholding Allowance Certificate</h3>
                                        ▶ Whether you are entitled to claim a certain number of allowances or exemption from withholding is
                                        subject to review by the IRS. Your employer may be required to send a copy of this form to the IRS.
                                    </label>
                                </div>
                                <div class="form-group col-sm-2" style="margin: 5px;"> 
                                    <label class="control-label pull-left"> OMB No. 1545-0074 <h1>2018</h1> </label>
                                </div>
                            </div>        

                            <div class="col-sm-12 no-padding" style="border-bottom:2px solid;">
                                <div class="form-group col-sm-4" style="margin: 5px; border-right: 2px solid;"> 
                                    <label class="control-label col-sm-12 pull-left">1. Your first name and middle initial</label>
                                    <div class="col-sm-12">                            
                                        <input type="text" name="first_middle_name" id="first_middle_name" class="form-control" placeholder="" />                    
                                    </div>
                                </div>
                                <div class="form-group col-sm-4" style="margin: 5px;border-right: 2px solid;"> 
                                    <label class="control-label col-sm-12 pull-left">Last name</label>
                                    <div class="col-sm-12">                            
                                        <input type="text" name="last_name" id="last_name" class="form-control" placeholder="" />                    
                                    </div>
                                </div>
                                <div class="form-group col-sm-4" style="margin: 5px;"> 
                                    <label class="control-label col-sm-12 pull-left">2. Your social security number</label>
                                    <div class="col-sm-12">                            
                                        <input type="text" name="ssn" id="ssn" class="form-control" placeholder="" />                    
                                    </div>
                                </div>
                            </div>        
                            <div class="col-sm-12 no-padding" style="border-bottom:2px solid;">

                                <div class="form-group col-sm-5" style="margin: 5px; border-right: 2px solid;"> 
                                    <label class="control-label col-sm-12 pull-left">Home address (number and street or rural route)</label>
                                    <div class="col-sm-12">                            
                                        <input type="text" name="home_address" id="home_address" class="form-control" placeholder="" />                    
                                    </div>
                                </div>
                                <div class="form-group col-sm-7">                         
                                    <label class="control-label col-sm-1 pull-left">3</label>
                                    <div class="col-sm-11">                            
                                        <label class="radio-inline col-sm-2 no-margin-left"><input type="radio" name="marital_status" class="marital_status" value="1" /> Single</label>
                                        <label class="radio-inline col-sm-2 no-margin-left"><input type="radio" name="marital_status" class="marital_status" value="2" /> Married</label>
                                        <label class="radio-inline col-sm-8 no-margin-left"><input type="radio" name="marital_status" class="marital_status" value="3" /> Married, but withhold at higher Single rate.</label>                    
                                    </div>
                                    <label class="control-label col-sm-12 left-align">Note: If married, but legally separated, or spouse is a nonresident alien, check the “Single” box.</label>
                                </div>                    
                            </div>        
                            <div class="col-sm-12 no-padding" style="border-bottom:2px solid;">
                                <div class="form-group col-sm-5" style="margin:5px; border-right:2px solid #000;"> 
                                    <label class="control-label col-sm-12 pull-left">City or town, state, and ZIP code</label>
                                    <div class="col-sm-12">                            
                                        <input type="text" name="city_state_zip" id="city_state_zip" class="form-control" placeholder="" />                    
                                    </div>
                                </div>
                                <div class="form-group col-sm-7"> 
                                    <label class="control-label col-sm-1 pull-left">4</label>
                                    <label class="control-label col-sm-10 left-align no-margin-left">
                                        If your last name differs from that shown on your social security card, check here. You must call 1-800-772-1213 for a replacement card. ▶
                                    </label>
                                    <div class="col-sm-1">                            
                                        <label class="checkbox-inline col-sm-12"><input type="checkbox" name="replacement_card" id="replacement_card" value="1"></label>                                           
                                    </div>
                                </div>                    
                            </div>        
                            <div class="col-sm-12 no-padding" style="border-bottom:2px solid;">

                                <div class="form-group col-sm-12" style="margin: 5px;"> 
                                    <label class="control-label col-sm-9 left-align">5 &nbsp;&nbsp; Total number of allowances you are claiming (from line H above or from the applicable worksheet on page 2)</label>
                                    <label class="control-label col-sm-1">5</label>
                                    <div class="col-sm-2">                            
                                        <input type="text" name="total_num_allowance" id="total_num_allowance" class="form-control" placeholder="" />                    
                                    </div>
                                </div>
                                <div class="form-group col-sm-12" style="margin: 5px;"> 
                                    <label class="control-label col-sm-9 left-align">6 &nbsp;&nbsp; Additional amount, if any, you want withheld from each paycheck . . . . . . . . . . . . . .</label>
                                    <label class="control-label col-sm-1">6</label>
                                    <div class="col-sm-2">                            
                                        <input type="text" name="additional_amount" id="additional_amount" class="form-control" placeholder="Dollar( &dollar; )" />                    
                                    </div>
                                </div>
                                <div class="form-group col-sm-12" style="margin:5px;">
                                    <div class="col-sm-9">
                                        <label class="control-label col-xs-12 no-padding left-align"><p style="white-space:nowrap">7 &nbsp;&nbsp; I claim exemption from withholding for 2016, and I certify that I meet both of the following conditions for exemption.</p></label>
                                        <label class="control-label col-xs-12 no-padding left-align">
                                            <ul class="no-margin">
                                                <li>Last year I had a right to a refund of all federal income tax withheld because I had no tax liability, and</li>
                                                <li>This year I expect a refund of all federal income tax withheld because I expect to have no tax liability.</li>                                
                                            </ul>
                                        </label>
                                        <label class="control-label col-xs-12 no-padding left-align">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; If you meet both conditions, write “Exempt” here . . . . . . . . . . . . . . .</label>
                                    </div>
                                    <label class="control-label col-sm-1">7</label>
                                    <div class="col-sm-2">                            
                                        <input type="text" name="claim_exemption" id="claim_exemption" class="form-control" placeholder="" />                    
                                    </div>
                                </div>                                       
                            </div>  

                            <div class="col-sm-12 no-padding" style="border-bottom:2px solid;">
                                <div class="form-group col-sm-12"> 
                                    <label class="control-label col-sm-12 pull-left">Under penalties of perjury, I declare that I have examined this certificate and, to the best of my knowledge and belief, it is true, correct, and complete.</label>                        
                                </div>
                                <div class="form-group col-sm-12"> 
                                    <div class="control-label col-sm-8">
                                        <label class="control-label col-sm-12 left-align">Employee’s signature</label>
                                        <label class="control-label col-sm-12 left-align">(This form is not valid unless you sign it.) ▶</label>
                                    </div>
                                    <div class="control-label col-sm-4">
                                        <label class="control-label col-sm-12 left-align">Date ▶</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 no-padding" style="border-bottom:2px solid;">

                                <div class="form-group col-sm-6" style="margin: 5px; border-right: 2px solid;"> 
                                    <label class="control-label col-sm-12 pull-left">8. Employer’s name and address (Employer: Complete lines 8 and 10 only if sending to the IRS.)</label>
                                    <div class="col-sm-12">                            
                                        <input type="text" name="name_and_address" id="name_and_address" class="form-control" placeholder="" />                    
                                    </div>
                                </div>
                                <div class="form-group col-sm-3" style="margin: 5px;border-right: 2px solid;"> 
                                    <label class="control-label col-sm-12 pull-left">9. Office code<br/>(optional)</label>                                    
                                    <div class="col-sm-12">                            
                                        <input type="text" name="office_code" id="office_code" class="form-control" placeholder="" />                    
                                    </div>
                                </div>
                                <div class="form-group col-sm-3" style="margin: 5px;"> 
                                    <label class="control-label col-sm-12 pull-left">10. Employer identification number (EIN)</label>
                                    <div class="col-sm-12">                            
                                        <input type="text" name="ein" id="ein" class="form-control" placeholder="" />                    
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group" >

                            <div class="form-group">
                                <div class="col-sm-12 no-padding" style="border-bottom:2px solid #000;" >
                                    <div class="form-group col-sm-12 center-align margin-top-15" style="font-weight:bold;font-size:14px">
                                        Personal Allowances Worksheet (Keep for your records.)
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" style="margin-top: 15px;"> 
                                <label class="col-sm-1 control-label">A</label>
                                <label class="col-sm-9 control-label pull-left" style="text-align: left;">Enter “1” for yourself if no one else can claim you as a dependent . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . </label>
                                <label class="col-sm-1 control-label">A</label>
                                <div class="col-sm-1">                            
                                    <input type="text" name="term_A" id="term_A" class="form-control" placeholder="" />                    
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
                                    <input type="text" name="term_B" id="term_B" class="form-control" placeholder="" />                    
                                </div>                     
                            </div>
                            <div class="form-group" style="margin-top: 15px;"> 
                                <label class="col-sm-1 control-label">C</label>
                                <label class="col-sm-9 control-label" style="text-align: left;">Enter “1” for your spouse. But, you may choose to enter “-0-” if you are married and have either a working spouse or more
                                    than one job. (Entering “-0-” may help you avoid having too little tax withheld.) . . . . . . . . . . . . . . . . . . . . . . . . . . . . .</label>
                                <label class="col-sm-1 control-label">C</label>
                                <div class="col-sm-1">                            
                                    <input type="text" name="term_C" id="term_C" class="form-control" placeholder="" />                    
                                </div>                     
                            </div>
                            <div class="form-group" style="margin-top: 15px;"> 
                                <label class="col-sm-1 control-label">D</label>
                                <label class="col-sm-9 control-label" style="text-align: left;">Enter number of dependents (other than your spouse or yourself) you will claim on your tax return . . . . . . . . . . . . . . . . . .</label>
                                <label class="col-sm-1 control-label">D</label>
                                <div class="col-sm-1">                            
                                    <input type="text" name="term_D" id="term_D" class="form-control" placeholder="" />                    
                                </div>                     
                            </div>
                            <div class="form-group" style="margin-top: 15px;"> 
                                <label class="col-sm-1 control-label">E</label>
                                <label class="col-sm-9 control-label" style="text-align: left;">Enter “1” if you will file as head of household on your tax return (see conditions under Head of household above) . . . . . .</label>
                                <label class="col-sm-1 control-label">E</label>
                                <div class="col-sm-1">                            
                                    <input type="text" name="term_E" id="term_E" class="form-control" placeholder="" />                    
                                </div>                     
                            </div>
                            <div class="form-group" style="margin-top: 15px;"> 
                                <label class="col-sm-1 control-label">F</label>
                                <label class="col-sm-9 control-label" style="text-align: left;">Enter “1” if you have at least $2,000 of child or dependent care expenses for which you plan to claim a credit . . . F
                                    (Note: Do not include child support payments. See Pub. 503, Child and Dependent Care Expenses, for details.) . . . . . . . . . . . . . .</label>
                                <label class="col-sm-1 control-label">F</label>
                                <div class="col-sm-1">                            
                                    <input type="text" name="term_F" id="term_F" class="form-control" placeholder="" />                    
                                </div>                     
                            </div>
                            <div class="form-group" style="margin-top: 15px;"> 
                                <label class="col-sm-1 control-label">G</label>
                                <label class="col-sm-9 control-label" style="text-align: left;">Child Tax Credit (including additional child tax credit). See Pub. 972, Child Tax Credit, for more information.
                                    <ul>
                                        <li>If your total income will be less than $70,000 ($100,000 if married), enter “2” for each eligible child; then less “1” if you
                                            have two to four eligible children or less “2” if you have five or more eligible children.</li>
                                        <li>If your total income will be between $70,000 and $84,000 ($100,000 and $119,000 if married), enter “1” for each eligible child.</li>
                                    </ul>
                                </label>
                                <label class="col-sm-1 control-label">G</label>
                                <div class="col-sm-1">                            
                                    <input type="text" name="term_G" id="term_G" class="form-control" placeholder="" />                    
                                </div>                     
                            </div>
                            <div class="form-group" style="margin-top: 15px;"> 
                                <label class="col-sm-1 control-label">H</label>
                                <label class="col-sm-9 control-label" style="text-align: left;">Add lines A through G and enter total here. (Note: This may be different from the number of exemptions you claim on your tax return.)</label>
                                <label class="col-sm-1 control-label">H</label>
                                <div class="col-sm-1">                            
                                    <input type="text" name="term_H" id="term_H" class="form-control" placeholder="" />                    
                                </div>                     
                            </div>
                            
                        </div>
                        <!--------------- Page-2 ------------------>

                        <div class="form-group">
                            <div class="col-sm-12 no-padding" style="border-bottom:2px solid #000;" >
                                <div class="form-group col-sm-12 center-align" style="font-weight:bold;font-size:14px">
                                    Deductions and Adjustments Worksheet
                                </div>
                            </div>
                        </div>

                        <div class="form-group" style="margin-top: 15px;">
                            <label class="col-sm-12">Note: Use this worksheet only if you plan to itemize deductions or claim certain credits or adjustments to income.</label>
                            <label class="col-sm-1 control-label">1</label>
                            <label class="col-sm-8 control-label" style="text-align:justify">
                                Enter an estimate of your 2016 itemized deductions. These include qualifying home mortgage 
                                interest, charitable contributions, state and local taxes, medical expenses in excess of 10% 
                                (7.5% if either you or your spouse was born before January 2, 1952) of your income, and 
                                miscellaneous deductions. For 2016, you may have to reduce your itemized deductions if 
                                your income is over $311,300 and you are married filing jointly or are a qualifying 
                                widow(er); $285,350 if you are head of household; $259,400 if you are single and not 
                                head of household or a qualifying widow(er); or $155,650 if you are married filing 
                                separately. See Pub. 505 for details
                            </label>
                            <label class="col-sm-1 control-label">1</label>
                            <div class="col-sm-2">                            
                                <input type="text" name="deduc_1" id="deduc_1" class="form-control" placeholder="Dollar( &dollar; )" />                    
                            </div>                     
                        </div>

                        <div class="form-group" style="margin-top: 15px;"> 
                            <label class="col-sm-1 control-label">2</label>
                            <label class="col-sm-8 control-label" style="text-align: left;">
                                Enter:
                                <ul>
                                    <li>$12,600 if married filing jointly or qualifying widow(er)</li>
                                    <li>$9,300 if head of household</li>
                                    <li>$6,300 if single or married filing separately</li>
                                </ul>
                            </label>
                            <label class="col-sm-1 control-label">2</label>
                            <div class="col-sm-2">                            
                                <input type="text" name="deduc_2" id="deduc_2" class="form-control" placeholder="Dollar( &dollar; )" />                    
                            </div>                     
                        </div>

                        <div class="form-group" style="margin-top: 15px;"> 
                            <label class="col-sm-1 control-label">3</label>
                            <label class="col-sm-8 control-label" style="text-align: left;">
                                Subtract line 2 from line 1. If zero or less, enter “-0-”
                            </label>
                            <label class="col-sm-1 control-label">3</label>
                            <div class="col-sm-2">                            
                                <input type="text" name="deduc_3" id="deduc_3" class="form-control" placeholder="Dollar( &dollar; )" />                    
                            </div>                     
                        </div>

                        <div class="form-group" style="margin-top: 15px;"> 
                            <label class="col-sm-1 control-label">4</label>
                            <label class="col-sm-8 control-label" style="text-align: left;">
                                Enter an estimate of your 2016 adjustments to income and any additional standard deduction (see Pub. 505)
                            </label>
                            <label class="col-sm-1 control-label">4</label>
                            <div class="col-sm-2">                            
                                <input type="text" name="deduc_4" id="deduc_4" class="form-control" placeholder="Dollar( &dollar; )" />                    
                            </div>                     
                        </div>

                        <div class="form-group" style="margin-top: 15px;"> 
                            <label class="col-sm-1 control-label">5</label>
                            <label class="col-sm-8 control-label" style="text-align: left;">
                                Add lines 3 and 4 and enter the total. (Include any amount for credits 
                                from the Converting Credits to Withholding Allowances for 2016 Form W-4 worksheet in Pub. 505.)
                            </label>
                            <label class="col-sm-1 control-label">5</label>
                            <div class="col-sm-2">                            
                                <input type="text" name="deduc_5" id="deduc_5" class="form-control" placeholder="Dollar( &dollar; )" />                    
                            </div>                     
                        </div>

                        <div class="form-group" style="margin-top: 15px;"> 
                            <label class="col-sm-1 control-label">6</label>
                            <label class="col-sm-8 control-label" style="text-align: left;">
                                Enter an estimate of your 2016 nonwage income (such as dividends or interest)
                            </label>
                            <label class="col-sm-1 control-label">6</label>
                            <div class="col-sm-2">                            
                                <input type="text" name="deduc_6" id="deduc_6" class="form-control" placeholder="Dollar( &dollar; )" />                    
                            </div>                     
                        </div>

                        <div class="form-group" style="margin-top: 15px;"> 
                            <label class="col-sm-1 control-label">7</label>
                            <label class="col-sm-8 control-label" style="text-align: left;">
                                Subtract line 6 from line 5. If zero or less, enter “-0-”
                            </label>
                            <label class="col-sm-1 control-label">7</label>
                            <div class="col-sm-2">                            
                                <input type="text" name="deduc_7" id="deduc_7" class="form-control" placeholder="Dollar( &dollar; )" />                    
                            </div>                     
                        </div>

                        <div class="form-group" style="margin-top: 15px;"> 
                            <label class="col-sm-1 control-label">8</label>
                            <label class="col-sm-8 control-label" style="text-align: left;">
                                Divide the amount on line 7 by $4,050 and enter the result here. Drop any fraction
                            </label>
                            <label class="col-sm-1 control-label">8</label>
                            <div class="col-sm-2">                            
                                <input type="text" name="deduc_8" id="deduc_8" class="form-control" placeholder="" />                    
                            </div>                     
                        </div>

                        <div class="form-group" style="margin-top: 15px;"> 
                            <label class="col-sm-1 control-label">9</label>
                            <label class="col-sm-8 control-label" style="text-align: left;">
                                Enter the number from the Personal Allowances Worksheet, line H, page 1
                            </label>
                            <label class="col-sm-1 control-label">9</label>
                            <div class="col-sm-2">                            
                                <input type="text" name="deduc_9" id="deduc_9" class="form-control" placeholder="" />                    
                            </div>                     
                        </div>

                        <div class="form-group" style="margin-top: 15px;"> 
                            <label class="col-sm-1 control-label">10</label>
                            <label class="col-sm-8 control-label" style="text-align: left;">
                                Add lines 8 and 9 and enter the total here. If you plan to use the Two-Earners/Multiple 
                                Jobs Worksheet, also enter this total on line 1 below. Otherwise, stop here and enter 
                                this total on Form W-4, line 5, page 1
                            </label>
                            <label class="col-sm-1 control-label">10</label>
                            <div class="col-sm-2">                            
                                <input type="text" name="deduc_10" id="deduc_10" class="form-control" placeholder="" />                    
                            </div>                     
                        </div>                        

                        <div class="form-group">
                            <div class="col-sm-12 no-padding" style="border-bottom:2px solid #000;border-top:2px solid #000;">
                                <div class="form-group col-sm-12 center-align margin-top-15" style="font-weight:bold;font-size:14px">
                                    Two-Earners/Multiple Jobs Worksheet (See Two earners or multiple jobs on page 1.)
                                </div>
                            </div>
                        </div>

                        <div class="form-group" style="margin-top: 15px;">
                            <label class="col-sm-12">Note: Use this worksheet only if the instructions under line H on page 1 direct you here.</label>
                            <label class="col-sm-1 control-label">1</label>
                            <label class="col-sm-8 control-label" style="text-align:justify">
                                Enter the number from line H, page 1 (or from line 10 above if you used the Deductions and Adjustments Worksheet)
                            </label>
                            <label class="col-sm-1 control-label">1</label>
                            <div class="col-sm-2">                            
                                <input type="text" name="multijob_1" id="multijob_1" class="form-control" placeholder="" />                    
                            </div>                     
                        </div>

                        <div class="form-group" style="margin-top: 15px;">
                            <label class="col-sm-1 control-label">2</label>
                            <label class="col-sm-8 control-label" style="text-align:justify">
                                Find the number in Table 1 below that applies to the LOWEST paying job and enter it here. However, if you are 
                                married filing jointly and wages from the highest paying job are $65,000 or less, do not enter more than “3”
                            </label>
                            <label class="col-sm-1 control-label">2</label>
                            <div class="col-sm-2">                            
                                <input type="text" name="multijob_2" id="multijob_2" class="form-control" placeholder="" />                    
                            </div>                     
                        </div>

                        <div class="form-group" style="margin-top: 15px;">
                            <label class="col-sm-1 control-label">3</label>
                            <label class="col-sm-8 control-label" style="text-align:justify">
                                If line 1 is more than or equal to line 2, subtract line 2 from line 1. Enter the result here 
                                (if zero, enter “-0-”) and on Form W-4, line 5, page 1. Do not use the rest of this worksheet
                            </label>
                            <label class="col-sm-1 control-label">3</label>
                            <div class="col-sm-2">                            
                                <input type="text" name="multijob_3" id="multijob_3" class="form-control" placeholder="" />                    
                            </div>                     
                        </div>

                        <div class="form-group" style="margin-top: 15px;">
                            <label class="col-sm-12">Note: If line 1 is less than line 2, enter “-0-” on Form W-4, line 5, page 1. Complete lines 4 
                                through 9 below to figure the additional withholding amount necessary to avoid a year-end tax bill.</label>
                            <label class="col-sm-1 control-label">4</label>
                            <label class="col-sm-8 control-label" style="text-align:justify">
                                Enter the number from line 2 of this worksheet
                            </label>
                            <label class="col-sm-1 control-label">4</label>
                            <div class="col-sm-2">                            
                                <input type="text" name="multijob_4" id="multijob_4" class="form-control" placeholder="" />                    
                            </div>                     
                        </div>

                        <div class="form-group" style="margin-top: 15px;">
                            <label class="col-sm-1 control-label">5</label>
                            <label class="col-sm-8 control-label" style="text-align:justify">
                                Enter the number from line 1 of this worksheet
                            </label>
                            <label class="col-sm-1 control-label">5</label>
                            <div class="col-sm-2">                            
                                <input type="text" name="multijob_5" id="multijob_5" class="form-control" placeholder="" />                    
                            </div>                     
                        </div>

                        <div class="form-group" style="margin-top: 15px;">
                            <label class="col-sm-1 control-label">6</label>
                            <label class="col-sm-8 control-label" style="text-align:justify">
                                Subtract line 5 from line 4
                            </label>
                            <label class="col-sm-1 control-label">6</label>
                            <div class="col-sm-2">                            
                                <input type="text" name="multijob_6" id="multijob_6" class="form-control" placeholder="" />                    
                            </div>                     
                        </div>

                        <div class="form-group" style="margin-top: 15px;">
                            <label class="col-sm-1 control-label">7</label>
                            <label class="col-sm-8 control-label" style="text-align:justify">
                                Find the amount in Table 2 below that applies to the HIGHEST paying job and enter it here
                            </label>
                            <label class="col-sm-1 control-label">7</label>
                            <div class="col-sm-2">                            
                                <input type="text" name="multijob_7" id="multijob_7" class="form-control" placeholder="Dollar( &dollar; )" />                    
                            </div>                     
                        </div>

                        <div class="form-group" style="margin-top: 15px;">
                            <label class="col-sm-1 control-label">8</label>
                            <label class="col-sm-8 control-label" style="text-align:justify">
                                Multiply line 7 by line 6 and enter the result here. This is the additional annual withholding needed
                            </label>
                            <label class="col-sm-1 control-label">8</label>
                            <div class="col-sm-2">                            
                                <input type="text" name="multijob_8" id="multijob_8" class="form-control" placeholder="Dollar( &dollar; )" />                    
                            </div>                     
                        </div>

                        <div class="form-group" style="margin-top: 15px;">
                            <label class="col-sm-1 control-label">9</label>
                            <label class="col-sm-8 control-label" style="text-align:justify">
                                Divide line 8 by the number of pay periods remaining in 2016. For example, divide by 25 if you are 
                                paid every two weeks and you complete this form on a date in January when there are 25 pay periods 
                                remaining in 2016. Enter the result here and on Form W-4, line 6, page 1. This is the additional 
                                amount to be withheld from each paycheck
                            </label>
                            <label class="col-sm-1 control-label">9</label>
                            <div class="col-sm-2">                            
                                <input type="text" name="multijob_9" id="multijob_9" class="form-control" placeholder="Dollar( &dollar; )" />                    
                            </div>                     
                        </div>

                        <div class="modal-footer">
                            <button type="submit" id="submit" class="btn btn-u"> Prepare W-4</button>
                            <a class="btn btn-danger" href="<?php echo base_url() . "Con_obw4" ?>">Close</a>
                        </div>
                    </div>
                </form>
                <?php
            } else if ($type == 2) {//edit
                $obw4_data = $query->row();
                ?>
                <form id="sky-form11" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url() . 'Con_obw4/update_obw4/' . $obw4_data->id; ?>" enctype="multipart/form-data" role="form">

                    <div class="offset2 span8">
                        <div class="form-group margin-top-15">
                            <label class="col-sm-2 control-label">Select Type <span class="req"></span> :</label>
                            <div class="col-sm-4 no-padding">
                                <select name="ob_eeo_type" id="ob_eeo_type" onchange="set_ob_emp(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm" disabled >
                                    <option></option>
                                    <?php
                                    $ob_eeo_type = array(1 => 'Onboard', 2 => 'Employee');
                                    foreach ($ob_eeo_type as $key => $val) {
                                        $slct = ($obw4_data->ob_eeo_type == $key) ? 'selected' : '';
                                        print"<option value='" . $key . "'" . $slct . ">" . $val . "</option>";
                                    }
                                    ?>
                                </select>
                            </div> 
                            <label class="col-sm-2 control-label">Select Candidate <span class="req"></span> :</label>
                            <div class="col-sm-4 no-padding">
                                <select name="ob_eeo_emp_id" id="ob_eeo_emp_id" class="col-sm-12 col-xs-12 myselect2 input-sm" disabled>
                                    <option></option>
                                    <?php
                                    if($obw4_data->ob_eeo_type==1)
                                    {
                                        $query = $this->db->get_where('main_ob_personal_information', array('company_id' => $this->company_id));
                                        if ($query->num_rows() > 0) {
                                            print"<option></option>";
                                            foreach ($query->result() as $row) {
                                                $slct = ($obw4_data->ob_eeo_emp_id == $row->onboarding_employee_id) ? 'selected' : '';
                                                print"<option value='" . $row->onboarding_employee_id . "' " . $slct . ">" . $row->onboarding_firstname . ' ' . $row->onboarding_middlename . ' ' . $row->onboarding_lastname . "</option>";
                                            }
                                        } else {
                                            echo"<option> No Onboard added </option>";
                                        }
                                    }
                                    else if($obw4_data->ob_eeo_type==2)
                                    {
                                        $query = $this->db->get_where('main_employees', array('company_id' => $this->company_id));
                                        if ($query->num_rows() > 0) {
                                            print"<option></option>";
                                            foreach ($query->result() as $row) {
                                                $slct = ($obw4_data->ob_eeo_emp_id == $row->employee_id) ? 'selected' : '';
                                                print"<option value='" . $row->employee_id . "' " . $slct . ">" . $row->first_name . ' ' . $row->middle_name . ' ' . $row->last_name . "</option>";
                                            }
                                        } else {
                                            echo"<option> No Employee added </option>";
                                        }
                                    }
//                                    $ob_candidate = $this->db->get_where('main_ob_personal_information', array('company_id' => $this->company_id));
//                                    if ($ob_candidate && ($ob_candidate->num_rows() > 0)) {
//                                        foreach ($ob_candidate->result() as $key => $row) {
//                                            $slct = ($obw4_data->ob_eeo_emp_id == $row->onboarding_employee_id) ? 'selected' : '';
//                                            print"<option value='" . $row->onboarding_employee_id . "' " . $slct . ">" . $row->onboarding_firstname . ' ' . $row->onboarding_middlename . ' ' . $row->onboarding_lastname . "</option>";
//                                        }
//                                    }
                                    ?>
                                </select>
                            </div>    
                        </div>
                        <!--<input type="hidden" value="" name="ob_eeo_emp_id" id="ob_eeo_emp_id"/>-->

                        

                        <div class="form-group" >
                            <div class="col-sm-12 no-padding" style="border-bottom:2px solid #000;" >
<!--                                <div class="form-group col-sm-12 center-align"> 
                                    <label class="control-label"><h4>--------------------- Separate here and give Form W-4 to your employer. Keep the top part for your records ---------------------</h4></label>
                                </div>-->
                                <div class="form-group col-sm-3" style="margin:5px; border-right:2px solid #000;"> 
                                    <label class="control-label col-xs-12 left-align no-padding" style="padding-left:15px !important">Form <h1 style="display:inline-block">W-4</h1> <br/>Department of the Treasury<br/>Internal Revenue Service</label>
                                </div>
                                <div class="form-group col-sm-7" style="border-right: 2px solid;"> 
                                    <label class="control-label center-align"><h3 class="no-margin">Employee's Withholding Allowance Certificate</h3>
                                        ▶ Whether you are entitled to claim a certain number of allowances or exemption from withholding is
                                        subject to review by the IRS. Your employer may be required to send a copy of this form to the IRS.
                                    </label>
                                </div>
                                <div class="form-group col-sm-2" style="margin: 5px;"> 
                                    <label class="control-label pull-left"> OMB No. 1545-0074 <h1>2018</h1> </label>
                                </div>
                            </div>        

                            <div class="col-sm-12 no-padding" style="border-bottom:2px solid;">
                                <div class="form-group col-sm-4" style="margin: 5px; border-right: 2px solid;"> 
                                    <label class="control-label col-sm-12 pull-left">1. Your first name and middle initial</label>
                                    <div class="col-sm-12">                            
                                        <input type="text" name="first_middle_name" id="first_middle_name" value="<?php echo $obw4_data->first_middle_name; ?>" class="form-control" placeholder="" />                    
                                    </div>
                                </div>
                                <div class="form-group col-sm-4" style="margin: 5px;border-right: 2px solid;"> 
                                    <label class="control-label col-sm-12 pull-left">Last name</label>
                                    <div class="col-sm-12">                            
                                        <input type="text" name="last_name" id="last_name" value="<?php echo $obw4_data->last_name; ?>" class="form-control" placeholder="" />                    
                                    </div>
                                </div>
                                <div class="form-group col-sm-4" style="margin: 5px;"> 
                                    <label class="control-label col-sm-12 pull-left">2. Your social security number</label>
                                    <div class="col-sm-12">                            
                                        <input type="text" name="ssn" id="ssn" value="<?php echo $obw4_data->ssn; ?>" class="form-control" placeholder="" />                    
                                    </div>
                                </div>
                            </div>        
                            <div class="col-sm-12 no-padding" style="border-bottom:2px solid;">

                                <div class="form-group col-sm-5" style="margin: 5px; border-right: 2px solid;"> 
                                    <label class="control-label col-sm-12 pull-left">Home address (number and street or rural route)</label>
                                    <div class="col-sm-12">                            
                                        <input type="text" name="home_address" id="home_address" value="<?php echo $obw4_data->home_address; ?>" class="form-control" placeholder="" />                    
                                    </div>
                                </div>
                                <div class="form-group col-sm-7">                         
                                    <label class="control-label col-sm-1 pull-left">3</label>
                                    <div class="col-sm-11">                            
                                        <label class="radio-inline col-sm-2 no-margin-left"><input type="radio" name="marital_status" class="marital_status" value="1" <?php echo ($obw4_data->marital_status == 1) ? 'checked' : ''; ?> /> Single</label>
                                        <label class="radio-inline col-sm-2 no-margin-left"><input type="radio" name="marital_status" class="marital_status" value="2" <?php echo ($obw4_data->marital_status == 2) ? 'checked' : ''; ?> /> Married</label>
                                        <label class="radio-inline col-sm-8 no-margin-left"><input type="radio" name="marital_status" class="marital_status" value="3" <?php echo ($obw4_data->marital_status == 3) ? 'checked' : ''; ?> /> Married, but withhold at higher Single rate.</label>                    
                                    </div>
                                    <label class="control-label col-sm-12 left-align">Note: If married, but legally separated, or spouse is a nonresident alien, check the “Single” box.</label>
                                </div>                    
                            </div>        
                            <div class="col-sm-12 no-padding" style="border-bottom:2px solid;">
                                <div class="form-group col-sm-5" style="margin:5px; border-right:2px solid #000;"> 
                                    <label class="control-label col-sm-12 pull-left">City or town, state, and ZIP code</label>
                                    <div class="col-sm-12">                            
                                        <input type="text" name="city_state_zip" id="city_state_zip" value="<?php echo $obw4_data->city_state_zip; ?>" class="form-control" placeholder="" />                    
                                    </div>
                                </div>
                                <div class="form-group col-sm-7"> 
                                    <label class="control-label col-sm-1 pull-left">4</label>
                                    <label class="control-label col-sm-10 left-align no-margin-left">
                                        If your last name differs from that shown on your social security card, check here. You must call 1-800-772-1213 for a replacement card. ▶
                                    </label>
                                    <div class="col-sm-1">                            
                                        <label class="checkbox-inline col-sm-12"><input type="checkbox" name="replacement_card" id="replacement_card" value="1" <?php echo (($obw4_data->replacement_card == 1) ? 'checked' : ''); ?> /></label>                                           
                                    </div>
                                </div>                    
                            </div>        
                            <div class="col-sm-12 no-padding" style="border-bottom:2px solid;">

                                <div class="form-group col-sm-12" style="margin: 5px;"> 
                                    <label class="control-label col-sm-9 left-align">5 &nbsp;&nbsp; Total number of allowances you are claiming (from line H above or from the applicable worksheet on page 2)</label>
                                    <label class="control-label col-sm-1">5</label>
                                    <div class="col-sm-2">                            
                                        <input type="text" name="total_num_allowance" id="total_num_allowance" value="<?php echo $obw4_data->total_num_allowance; ?>" class="form-control" placeholder="" />                    
                                    </div>
                                </div>
                                <div class="form-group col-sm-12" style="margin: 5px;"> 
                                    <label class="control-label col-sm-9 left-align">6 &nbsp;&nbsp; Additional amount, if any, you want withheld from each paycheck . . . . . . . . . . . . . .</label>
                                    <label class="control-label col-sm-1">6</label>
                                    <div class="col-sm-2">                            
                                        <input type="text" name="additional_amount" id="additional_amount" value="<?php echo $obw4_data->additional_amount; ?>" class="form-control" placeholder="Dollar( &dollar; )" />                    
                                    </div>
                                </div>
                                <div class="form-group col-sm-12" style="margin:5px;">
                                    <div class="col-sm-9">
                                        <label class="control-label col-xs-12 no-padding left-align"><p style="white-space:nowrap">7 &nbsp;&nbsp; I claim exemption from withholding for 2016, and I certify that I meet both of the following conditions for exemption.</p></label>
                                        <label class="control-label col-xs-12 no-padding left-align">
                                            <ul class="no-margin">
                                                <li>Last year I had a right to a refund of all federal income tax withheld because I had no tax liability, and</li>
                                                <li>This year I expect a refund of all federal income tax withheld because I expect to have no tax liability.</li>                                
                                            </ul>
                                        </label>
                                        <label class="control-label col-xs-12 no-padding left-align">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; If you meet both conditions, write “Exempt” here . . . . . . . . . . . . . . .</label>
                                    </div>
                                    <label class="control-label col-sm-1">7</label>
                                    <div class="col-sm-2">                            
                                        <input type="text" name="claim_exemption" id="claim_exemption" value="<?php echo $obw4_data->claim_exemption; ?>" class="form-control" placeholder="" />                    
                                    </div>
                                </div>                                       
                            </div>  

                            <div class="col-sm-12 no-padding" style="border-bottom:2px solid;">
                                <div class="form-group col-sm-12"> 
                                    <label class="control-label col-sm-12 pull-left">Under penalties of perjury, I declare that I have examined this certificate and, to the best of my knowledge and belief, it is true, correct, and complete.</label>                        
                                </div>
                                <div class="form-group col-sm-12"> 
                                    <div class="control-label col-sm-8">
                                        <label class="control-label col-sm-12 left-align">Employee’s signature</label>
                                        <label class="control-label col-sm-12 left-align">(This form is not valid unless you sign it.) ▶</label>
                                    </div>
                                    <div class="control-label col-sm-4">
                                        <label class="control-label col-sm-12 left-align">Date ▶</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 no-padding" style="border-bottom:2px solid;">

                                <div class="form-group col-sm-6" style="margin: 5px; border-right: 2px solid;"> 
                                    <label class="control-label col-sm-12 pull-left">8. Employer’s name and address (Employer: Complete lines 8 and 10 only if sending to the IRS.)</label>
                                    <div class="col-sm-12">                            
                                        <input type="text" name="name_and_address" id="name_and_address" value="<?php echo $obw4_data->name_and_address; ?>" class="form-control" placeholder="" />                    
                                    </div>
                                </div>
                                <div class="form-group col-sm-3" style="margin: 5px;border-right: 2px solid;"> 
                                    <label class="control-label col-sm-12 pull-left">9. Office code<br/>(optional)</label>                                    
                                    <div class="col-sm-12">                            
                                        <input type="text" name="office_code" id="office_code" value="<?php echo $obw4_data->office_code; ?>" class="form-control" placeholder="" />                    
                                    </div>
                                </div>
                                <div class="form-group col-sm-3" style="margin: 5px;"> 
                                    <label class="control-label col-sm-12 pull-left">10. Employer identification number (EIN)</label>
                                    <div class="col-sm-12">                            
                                        <input type="text" name="ein" id="ein" class="form-control" value="<?php echo $obw4_data->ein; ?>" placeholder="" />                    
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            
                            <div class="form-group">
                                <div class="col-sm-12 no-padding" style="border-bottom:2px solid #000; " >
                                    <div class="form-group col-sm-12 center-align margin-top-15" style="font-weight:bold;font-size:14px">
                                        Personal Allowances Worksheet (Keep for your records.)
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" style="margin-top: 15px;"> 
                                <label class="col-sm-1 control-label">A</label>
                                <label class="col-sm-9 control-label pull-left" style="text-align: left;">Enter “1” for yourself if no one else can claim you as a dependent . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . </label>
                                <label class="col-sm-1 control-label">A</label>
                                <div class="col-sm-1">                            
                                    <input type="text" name="term_A" id="term_A" value="<?php echo $obw4_data->term_A; ?>" class="form-control" placeholder="" />                    
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
                                    <input type="text" name="term_B" id="term_B" value="<?php echo $obw4_data->term_B; ?>" class="form-control" placeholder="" />                    
                                </div>                     
                            </div>
                            <div class="form-group" style="margin-top: 15px;"> 
                                <label class="col-sm-1 control-label">C</label>
                                <label class="col-sm-9 control-label" style="text-align: left;">Enter “1” for your spouse. But, you may choose to enter “-0-” if you are married and have either a working spouse or more
                                    than one job. (Entering “-0-” may help you avoid having too little tax withheld.) . . . . . . . . . . . . . . . . . . . . . . . . . . . . .</label>
                                <label class="col-sm-1 control-label">C</label>
                                <div class="col-sm-1">                            
                                    <input type="text" name="term_C" id="term_C" value="<?php echo $obw4_data->term_C; ?>" class="form-control" placeholder="" />                    
                                </div>                     
                            </div>
                            <div class="form-group" style="margin-top: 15px;"> 
                                <label class="col-sm-1 control-label">D</label>
                                <label class="col-sm-9 control-label" style="text-align: left;">Enter number of dependents (other than your spouse or yourself) you will claim on your tax return . . . . . . . . . . . . . . . . . .</label>
                                <label class="col-sm-1 control-label">D</label>
                                <div class="col-sm-1">                            
                                    <input type="text" name="term_D" id="term_D" value="<?php echo $obw4_data->term_D; ?>" class="form-control" placeholder="" />                    
                                </div>                     
                            </div>
                            <div class="form-group" style="margin-top: 15px;"> 
                                <label class="col-sm-1 control-label">E</label>
                                <label class="col-sm-9 control-label" style="text-align: left;">Enter “1” if you will file as head of household on your tax return (see conditions under Head of household above) . . . . . .</label>
                                <label class="col-sm-1 control-label">E</label>
                                <div class="col-sm-1">                            
                                    <input type="text" name="term_E" id="term_E" value="<?php echo $obw4_data->term_E; ?>" class="form-control" placeholder="" />                    
                                </div>                     
                            </div>
                            <div class="form-group" style="margin-top: 15px;"> 
                                <label class="col-sm-1 control-label">F</label>
                                <label class="col-sm-9 control-label" style="text-align: left;">Enter “1” if you have at least $2,000 of child or dependent care expenses for which you plan to claim a credit . . . F
                                    (Note: Do not include child support payments. See Pub. 503, Child and Dependent Care Expenses, for details.) . . . . . . . . . . . . . .</label>
                                <label class="col-sm-1 control-label">F</label>
                                <div class="col-sm-1">                            
                                    <input type="text" name="term_F" id="term_F" value="<?php echo $obw4_data->term_F; ?>" class="form-control" placeholder="" />                    
                                </div>                     
                            </div>
                            <div class="form-group" style="margin-top: 15px;"> 
                                <label class="col-sm-1 control-label">G</label>
                                <label class="col-sm-9 control-label" style="text-align: left;">Child Tax Credit (including additional child tax credit). See Pub. 972, Child Tax Credit, for more information.
                                    <ul>
                                        <li>If your total income will be less than $70,000 ($100,000 if married), enter “2” for each eligible child; then less “1” if you
                                            have two to four eligible children or less “2” if you have five or more eligible children.</li>
                                        <li>If your total income will be between $70,000 and $84,000 ($100,000 and $119,000 if married), enter “1” for each eligible child.</li>
                                    </ul>
                                </label>
                                <label class="col-sm-1 control-label">G</label>
                                <div class="col-sm-1">                            
                                    <input type="text" name="term_G" id="term_G" value="<?php echo $obw4_data->term_G; ?>" class="form-control" placeholder="" />                    
                                </div>                     
                            </div>
                            <div class="form-group" style="margin-top: 15px;"> 
                                <label class="col-sm-1 control-label">H</label>
                                <label class="col-sm-9 control-label" style="text-align: left;">Add lines A through G and enter total here. (Note: This may be different from the number of exemptions you claim on your tax return.)</label>
                                <label class="col-sm-1 control-label">H</label>
                                <div class="col-sm-1">                            
                                    <input type="text" name="term_H" id="term_H" value="<?php echo $obw4_data->term_H; ?>" class="form-control" placeholder="" />                    
                                </div>                     
                            </div>
                            
                        </div>
                        <!--------------- Page-2 ------------------>

                        <div class="form-group">
                            <div class="col-sm-12 no-padding" style="border-bottom:2px solid #000;" >
                                <div class="form-group col-sm-12 center-align" style="font-weight:bold;font-size:14px">
                                    Deductions and Adjustments Worksheet
                                </div>
                            </div>
                        </div>

                        <div class="form-group" style="margin-top: 15px;">
                            <label class="col-sm-12">Note: Use this worksheet only if you plan to itemize deductions or claim certain credits or adjustments to income.</label>
                            <label class="col-sm-1 control-label">1</label>
                            <label class="col-sm-8 control-label" style="text-align:justify">
                                Enter an estimate of your 2016 itemized deductions. These include qualifying home mortgage 
                                interest, charitable contributions, state and local taxes, medical expenses in excess of 10% 
                                (7.5% if either you or your spouse was born before January 2, 1952) of your income, and 
                                miscellaneous deductions. For 2016, you may have to reduce your itemized deductions if 
                                your income is over $311,300 and you are married filing jointly or are a qualifying 
                                widow(er); $285,350 if you are head of household; $259,400 if you are single and not 
                                head of household or a qualifying widow(er); or $155,650 if you are married filing 
                                separately. See Pub. 505 for details
                            </label>
                            <label class="col-sm-1 control-label">1</label>
                            <div class="col-sm-2">                            
                                <input type="text" name="deduc_1" id="deduc_1" value="<?php echo $obw4_data->deduc_1; ?>" class="form-control" placeholder="Dollar( &dollar; )" />                    
                            </div>                     
                        </div>

                        <div class="form-group" style="margin-top: 15px;"> 
                            <label class="col-sm-1 control-label">2</label>
                            <label class="col-sm-8 control-label" style="text-align: left;">
                                Enter:
                                <ul>
                                    <li>$12,600 if married filing jointly or qualifying widow(er)</li>
                                    <li>$9,300 if head of household</li>
                                    <li>$6,300 if single or married filing separately</li>
                                </ul>
                            </label>
                            <label class="col-sm-1 control-label">2</label>
                            <div class="col-sm-2">                            
                                <input type="text" name="deduc_2" id="deduc_2" value="<?php echo $obw4_data->deduc_2; ?>" class="form-control" placeholder="Dollar( &dollar; )" />                    
                            </div>                     
                        </div>

                        <div class="form-group" style="margin-top: 15px;"> 
                            <label class="col-sm-1 control-label">3</label>
                            <label class="col-sm-8 control-label" style="text-align: left;">
                                Subtract line 2 from line 1. If zero or less, enter “-0-”
                            </label>
                            <label class="col-sm-1 control-label">3</label>
                            <div class="col-sm-2">                            
                                <input type="text" name="deduc_3" id="deduc_3" value="<?php echo $obw4_data->deduc_3; ?>" class="form-control" placeholder="Dollar( &dollar; )" />                    
                            </div>                     
                        </div>

                        <div class="form-group" style="margin-top: 15px;"> 
                            <label class="col-sm-1 control-label">4</label>
                            <label class="col-sm-8 control-label" style="text-align: left;">
                                Enter an estimate of your 2016 adjustments to income and any additional standard deduction (see Pub. 505)
                            </label>
                            <label class="col-sm-1 control-label">4</label>
                            <div class="col-sm-2">                            
                                <input type="text" name="deduc_4" id="deduc_4" value="<?php echo $obw4_data->deduc_4; ?>" class="form-control" placeholder="Dollar( &dollar; )" />                    
                            </div>                     
                        </div>

                        <div class="form-group" style="margin-top: 15px;"> 
                            <label class="col-sm-1 control-label">5</label>
                            <label class="col-sm-8 control-label" style="text-align: left;">
                                Add lines 3 and 4 and enter the total. (Include any amount for credits 
                                from the Converting Credits to Withholding Allowances for 2016 Form W-4 worksheet in Pub. 505.)
                            </label>
                            <label class="col-sm-1 control-label">5</label>
                            <div class="col-sm-2">                            
                                <input type="text" name="deduc_5" id="deduc_5" value="<?php echo $obw4_data->deduc_5; ?>" class="form-control" placeholder="Dollar( &dollar; )" />                    
                            </div>                     
                        </div>

                        <div class="form-group" style="margin-top: 15px;"> 
                            <label class="col-sm-1 control-label">6</label>
                            <label class="col-sm-8 control-label" style="text-align: left;">
                                Enter an estimate of your 2016 nonwage income (such as dividends or interest)
                            </label>
                            <label class="col-sm-1 control-label">6</label>
                            <div class="col-sm-2">                            
                                <input type="text" name="deduc_6" id="deduc_6" value="<?php echo $obw4_data->deduc_6; ?>" class="form-control" placeholder="Dollar( &dollar; )" />                    
                            </div>                     
                        </div>

                        <div class="form-group" style="margin-top: 15px;"> 
                            <label class="col-sm-1 control-label">7</label>
                            <label class="col-sm-8 control-label" style="text-align: left;">
                                Subtract line 6 from line 5. If zero or less, enter “-0-”
                            </label>
                            <label class="col-sm-1 control-label">7</label>
                            <div class="col-sm-2">                            
                                <input type="text" name="deduc_7" id="deduc_7" value="<?php echo $obw4_data->deduc_7; ?>" class="form-control" placeholder="Dollar( &dollar; )" />                    
                            </div>                     
                        </div>

                        <div class="form-group" style="margin-top: 15px;"> 
                            <label class="col-sm-1 control-label">8</label>
                            <label class="col-sm-8 control-label" style="text-align: left;">
                                Divide the amount on line 7 by $4,050 and enter the result here. Drop any fraction
                            </label>
                            <label class="col-sm-1 control-label">8</label>
                            <div class="col-sm-2">                            
                                <input type="text" name="deduc_8" id="deduc_8" value="<?php echo $obw4_data->deduc_8; ?>" class="form-control" placeholder="" />                    
                            </div>                     
                        </div>

                        <div class="form-group" style="margin-top: 15px;"> 
                            <label class="col-sm-1 control-label">9</label>
                            <label class="col-sm-8 control-label" style="text-align: left;">
                                Enter the number from the Personal Allowances Worksheet, line H, page 1
                            </label>
                            <label class="col-sm-1 control-label">9</label>
                            <div class="col-sm-2">                            
                                <input type="text" name="deduc_9" id="deduc_9" value="<?php echo $obw4_data->deduc_9; ?>" class="form-control" placeholder="" />                    
                            </div>                     
                        </div>

                        <div class="form-group" style="margin-top: 15px;"> 
                            <label class="col-sm-1 control-label">10</label>
                            <label class="col-sm-8 control-label" style="text-align: left;">
                                Add lines 8 and 9 and enter the total here. If you plan to use the Two-Earners/Multiple 
                                Jobs Worksheet, also enter this total on line 1 below. Otherwise, stop here and enter 
                                this total on Form W-4, line 5, page 1
                            </label>
                            <label class="col-sm-1 control-label">10</label>
                            <div class="col-sm-2">                            
                                <input type="text" name="deduc_10" id="deduc_10" value="<?php echo $obw4_data->deduc_10; ?>" class="form-control" placeholder="" />                    
                            </div>                     
                        </div>                        

                        <div class="form-group">
                            <div class="col-sm-12 no-padding" style="border-bottom:2px solid #000;border-top:2px solid #000;">
                                <div class="form-group col-sm-12 center-align margin-top-15" style="font-weight:bold;font-size:14px">
                                    Two-Earners/Multiple Jobs Worksheet (See Two earners or multiple jobs on page 1.)
                                </div>
                            </div>
                        </div>

                        <div class="form-group" style="margin-top: 15px;">
                            <label class="col-sm-12">Note: Use this worksheet only if the instructions under line H on page 1 direct you here.</label>
                            <label class="col-sm-1 control-label">1</label>
                            <label class="col-sm-8 control-label" style="text-align:justify">
                                Enter the number from line H, page 1 (or from line 10 above if you used the Deductions and Adjustments Worksheet)
                            </label>
                            <label class="col-sm-1 control-label">1</label>
                            <div class="col-sm-2">                            
                                <input type="text" name="multijob_1" id="multijob_1" value="<?php echo $obw4_data->multijob_1; ?>" class="form-control" placeholder="" />                    
                            </div>                     
                        </div>

                        <div class="form-group" style="margin-top: 15px;">
                            <label class="col-sm-1 control-label">2</label>
                            <label class="col-sm-8 control-label" style="text-align:justify">
                                Find the number in Table 1 below that applies to the LOWEST paying job and enter it here. However, if you are 
                                married filing jointly and wages from the highest paying job are $65,000 or less, do not enter more than “3”
                            </label>
                            <label class="col-sm-1 control-label">2</label>
                            <div class="col-sm-2">                            
                                <input type="text" name="multijob_2" id="multijob_2" value="<?php echo $obw4_data->multijob_2; ?>" class="form-control" placeholder="" />                    
                            </div>                     
                        </div>

                        <div class="form-group" style="margin-top: 15px;">
                            <label class="col-sm-1 control-label">3</label>
                            <label class="col-sm-8 control-label" style="text-align:justify">
                                If line 1 is more than or equal to line 2, subtract line 2 from line 1. Enter the result here 
                                (if zero, enter “-0-”) and on Form W-4, line 5, page 1. Do not use the rest of this worksheet
                            </label>
                            <label class="col-sm-1 control-label">3</label>
                            <div class="col-sm-2">                            
                                <input type="text" name="multijob_3" id="multijob_3" value="<?php echo $obw4_data->multijob_3; ?>" class="form-control" placeholder="" />                    
                            </div>                     
                        </div>

                        <div class="form-group" style="margin-top: 15px;">
                            <label class="col-sm-12">Note: If line 1 is less than line 2, enter “-0-” on Form W-4, line 5, page 1. Complete lines 4 
                                through 9 below to figure the additional withholding amount necessary to avoid a year-end tax bill.</label>
                            <label class="col-sm-1 control-label">4</label>
                            <label class="col-sm-8 control-label" style="text-align:justify">
                                Enter the number from line 2 of this worksheet
                            </label>
                            <label class="col-sm-1 control-label">4</label>
                            <div class="col-sm-2">                            
                                <input type="text" name="multijob_4" id="multijob_4" value="<?php echo $obw4_data->multijob_4; ?>" class="form-control" placeholder="" />                    
                            </div>                     
                        </div>

                        <div class="form-group" style="margin-top: 15px;">
                            <label class="col-sm-1 control-label">5</label>
                            <label class="col-sm-8 control-label" style="text-align:justify">
                                Enter the number from line 1 of this worksheet
                            </label>
                            <label class="col-sm-1 control-label">5</label>
                            <div class="col-sm-2">                            
                                <input type="text" name="multijob_5" id="multijob_5" value="<?php echo $obw4_data->multijob_5; ?>" class="form-control" placeholder="" />                    
                            </div>                     
                        </div>

                        <div class="form-group" style="margin-top: 15px;">
                            <label class="col-sm-1 control-label">6</label>
                            <label class="col-sm-8 control-label" style="text-align:justify">
                                Subtract line 5 from line 4
                            </label>
                            <label class="col-sm-1 control-label">6</label>
                            <div class="col-sm-2">                            
                                <input type="text" name="multijob_6" id="multijob_6" value="<?php echo $obw4_data->multijob_6; ?>" class="form-control" placeholder="" />                    
                            </div>                     
                        </div>

                        <div class="form-group" style="margin-top: 15px;">
                            <label class="col-sm-1 control-label">7</label>
                            <label class="col-sm-8 control-label" style="text-align:justify">
                                Find the amount in Table 2 below that applies to the HIGHEST paying job and enter it here
                            </label>
                            <label class="col-sm-1 control-label">7</label>
                            <div class="col-sm-2">                            
                                <input type="text" name="multijob_7" id="multijob_7" value="<?php echo $obw4_data->multijob_7; ?>" class="form-control" placeholder="Dollar( &dollar; )" />                    
                            </div>                     
                        </div>

                        <div class="form-group" style="margin-top: 15px;">
                            <label class="col-sm-1 control-label">8</label>
                            <label class="col-sm-8 control-label" style="text-align:justify">
                                Multiply line 7 by line 6 and enter the result here. This is the additional annual withholding needed
                            </label>
                            <label class="col-sm-1 control-label">8</label>
                            <div class="col-sm-2">                            
                                <input type="text" name="multijob_8" id="multijob_8" value="<?php echo $obw4_data->multijob_8; ?>" class="form-control" placeholder="Dollar( &dollar; )" />                    
                            </div>                     
                        </div>

                        <div class="form-group" style="margin-top: 15px;">
                            <label class="col-sm-1 control-label">9</label>
                            <label class="col-sm-8 control-label" style="text-align:justify">
                                Divide line 8 by the number of pay periods remaining in 2016. For example, divide by 25 if you are 
                                paid every two weeks and you complete this form on a date in January when there are 25 pay periods 
                                remaining in 2016. Enter the result here and on Form W-4, line 6, page 1. This is the additional 
                                amount to be withheld from each paycheck
                            </label>
                            <label class="col-sm-1 control-label">9</label>
                            <div class="col-sm-2">                            
                                <input type="text" name="multijob_9" id="multijob_9" value="<?php echo $obw4_data->multijob_9; ?>" class="form-control" placeholder="Dollar( &dollar; )" />                    
                            </div>                     
                        </div>

                        <div class="modal-footer">
                            <button type="submit" id="submit" class="btn btn-u"> Prepare W-4 </button>
                            <a class="btn btn-danger" href="<?php echo base_url() . "Con_obw4" ?>">Close</a>
                        </div>
                    </div>
                </form>
                <?php
            }
            ?>
        </div>

    </div>
</div>

</div><!--/row-->
</div><!--/container-->

<style type="text/css">
    .form-horizontal .form-group{margin-left:0 !important; margin-right:0 !important}
</style>

<!--Add item script-->       
<script type="text/javascript">
    
    function set_ob_emp(id){
        
        $.ajax({
            url: "<?php echo site_url('Con_obw4/set_ob_emp/') ?>/" + id,
            async: false,
            type: "POST",
            success: function (data) {
                //alert (data);
                $('#ob_eeo_emp_id').html('');
                $('#ob_eeo_emp_id').empty();
                
                $('#ob_eeo_emp_id').html(data);
                
                $("#ob_eeo_emp_id").select2({
                    placeholder: "Select Candidate",
                    allowClear: true,
                });
            }
        });
    }

    $(function () {
        $("#sky-form11").submit(function (event) {
            loading_box(base_url);
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var url = '<?php echo base_url() ?>Con_obw4';
                view_message(data, url);

            });
            event.preventDefault();
        });
    });

    $('#ob_eeo_emp_id').on('change', function () {
    
        var ftype=$('#ob_eeo_type').val();
        
        if(ftype==1)
        {
            var ob_employee_id = $(this).val();
            $.ajax({
                url: "<?php echo site_url('Con_obw4/ajax_get_candidate_data/') ?>/" + ob_employee_id,
                type: "GET",
                dataType: "JSON",
                success: function (data)
                {
                    $('[name="first_middle_name"]').val(data.onboarding_firstname + ' ' + data.onboarding_middlename);
                    $('[name="last_name"]').val(data.onboarding_lastname);
                    $('[name="ssn"]').val(data.onboarding_socialsecuritynumber);
                    $('[name="home_address"]').val(data.street_address1);

                    if (data.marital_status == 0) {
                        $('.marital_status[value="1"]').prop('checked', 'checked');
                    } else if (data.marital_status == 1) {
                        $('.marital_status[value="2"]').prop('checked', 'checked');
                    } else {
                        $('.marital_status[value="3"]').prop('checked', 'checked');
                    }

                    var Loc = [data.city, data.state_name, data.zipcode];
                    $('[name="city_state_zip"]').val(Loc.join(', '));
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Ajax Error: ' + textStatus);
                }
            });
        }
        else{
            var ob_employee_id = $(this).val();
            $.ajax({
                url: "<?php echo site_url('Con_obw4/ajax_get_emp_candidate_data/') ?>/" + ob_employee_id,
                type: "GET",
                dataType: "JSON",
                success: function (data)
                {

                    $('[name="first_middle_name"]').val(data.first_name + ' ' + data.middle_name);
                    $('[name="last_name"]').val(data.last_name);
                    $('[name="ssn"]').val(data.ssn_code);
                    $('[name="home_address"]').val(data.first_address);

                    if (data.marital_status == 0) {
                        $('.marital_status[value="1"]').prop('checked', 'checked');
                    } else if (data.marital_status == 1) {
                        $('.marital_status[value="2"]').prop('checked', 'checked');
                    } else {
                        $('.marital_status[value="3"]').prop('checked', 'checked');
                    }

                    var Loc = [data.city, data.state_name, data.zipcode];
                    $('[name="city_state_zip"]').val(Loc.join(', '));
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Ajax Error: ' + textStatus);
                }
            });
        }
    });

    $("#ob_eeo_type").select2({
        placeholder: "Select Type",
        allowClear: true,
    });
    $("#ob_eeo_emp_id").select2({
        placeholder: "Select Candidate",
        allowClear: true,
    });

</script>
<!--=== End Script ===-->
