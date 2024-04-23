<?php

function img_root($PATH = '') {
    //echo site_url($PATH);
    echo Get_File_Directory($PATH);
}
?>

<!DOCTYPE html>
<html><body>

        <table style="width:100%;">
            <tr>
                <td style="width:32%;padding-right:2%;">
                    <h1 style="margin:0">Form W-4 (2016)</h1>
                    <hr style="height:5px;background:#000"/>
                    Purpose. Complete Form W-4 so that your employer can withhold the correct federal income tax from your pay. 
                    Consider completing a new Form W-4 each year and when your personal or financial situation changes.
                    Exemption from withholding. If you are exempt, complete only lines 1, 2, 3, 4, and 7 and sign the form to 
                    validate it. Your exemption for 2016 expires February 15, 2017. See Pub. 505, Tax Withholding and Estimated Tax.
                    Note: If another person can claim you as a dependent on his or her tax return, you cannot claim exemption 
                    from withholding if your income exceeds $1,050 and includes more than $350 of unearned income (for example, 
                    interest and dividends). Exceptions. An employee may be able to claim exemption from withholding even if the 
                    employee is a dependent, if the employee:<br/>
                    • Is age 65 or older,<br/>
                    • Is blind, or<br/>
                    • Will claim adjustments to income; tax credits; or itemized deductions, on his or her tax return.<br/>
                </td>
                <td style="width:32%;padding-right:2%">
                    The exceptions do not apply to supplemental wages greater than $1,000,000. Basic instructions. If you 
                    are not exempt, complete the Personal Allowances Worksheet below. The worksheets on page 2 further adjust 
                    your withholding allowances based on itemized deductions, certain credits, adjustments to income, or 
                    two-earners/multiple jobs situations. Complete all worksheets that apply. However, you may claim fewer 
                    (or zero) allowances. For regular wages, withholding must be based on allowances you claimed and may not 
                    be a flat amount or percentage of wages. Head of household. Generally, you can claim head of household 
                    filing status on your tax return only if you are unmarried and pay more than 50% of the costs of keeping 
                    up a home for yourself and your dependent(s) or other qualifying individuals. See Pub. 501, Exemptions, 
                    Standard Deduction, and Filing Information, for information. Tax credits. You can take projected tax 
                    credits into account in figuring your allowable number of withholding allowances. Credits for child or 
                    dependent care expenses and the child tax credit may be claimed using the Personal Allowances Worksheet 
                    below. See Pub. 505 for information on converting your other credits into withholding allowances.
                </td>
                <td style="width:32%;">
                    Nonwage income. If you have a large amount of nonwage income, such as interest or dividends, consider 
                    making estimated tax payments using Form 1040-ES, Estimated Tax for Individuals. Otherwise, you may owe 
                    additional tax. If you have pension or annuity income, see Pub. 505 to find out if you should adjust 
                    your withholding on Form W-4 or W-4P. Two earners or multiple jobs. If you have a working spouse or more 
                    than one job, figure the total number of allowances you are entitled to claim on all jobs using worksheets 
                    from only one Form W-4. Your withholding usually will be most accurate when all allowances are claimed on 
                    the Form W-4 for the highest paying job and zero allowances are claimed on the others. See Pub. 505 for details.
                    Nonresident alien. If you are a nonresident alien, see Notice 1392, Supplemental Form W-4 Instructions for 
                    Nonresident Aliens, before completing this form. Check your withholding. After your Form W-4 takes effect, 
                    use Pub. 505 to see how the amount you are having withheld compares to your projected total tax for 2016. 
                    See Pub. 505, especially if your earnings exceed $130,000 (Single) or $180,000 (Married).Future developments. 
                    Information about any future developments affecting Form W-4 (such as legislation enacted after we release it) 
                    will be posted at www.irs.gov/w4.
                </td>
            </tr>
        </table>

        <table style="width:100%;border-top:3px solid #000;border-bottom:1px solid #000">
            <tr>
                <td style="text-align:center">Personal Allowances Worksheet (Keep for your records.)</td>
            </tr>
        </table>

        <table style="width:100%;">
            <tr>
                <td style="width:5%">A</td>
                <td style="width:1%;white-space:nowrap">Enter “1” for yourself if no one else can claim you as a dependent</td>
                <td style="border-bottom:1px dashed #000"></td>
                <td style="width:2%;text-align:right">A</td>
                <td style="width:5%;text-align:right">1</td>
            </tr>
        </table>

        <table style="width:100%;">
            <tr>
                <td style="width:5%">B</td>
                <td style="width:9%">Enter “1” if:</td>
                <td style="width:1%;white-space:nowrap;font-size:60px">&#123</td>
                <td style="width:1%;white-space:nowrap">
                    • You are single and have only one job; or<br/>
                    • You are married, have only one job, and your spouse does not work; or<br/>
                    • Your wages from a second job or your spouse’s wages (or the total of both) are $1,500 or less.<br/>
                </td>
                <td style="width:1%;white-space:nowrap;font-size:60px">&#125</td>
                <td>
                    <hr style="border:none; border-top:1px dashed #000;height:1px;width:100%;"/>
                </td>
                <td style="width:2%;text-align:right">B</td>
                <td style="width:5%;text-align:right">2</td>
            </tr>
        </table>

        <table style="width:100%;">
            <tr>
                <td style="width:5%">C</td>
                <td style="width:1%;white-space:nowrap">Enter “1” for your spouse. But, you may choose to enter “-0-” if you are married and have either a working spouse or more<br/>than one job. (Entering “-0-” may help you avoid having too little tax withheld.)</td>
                <td style="border-bottom:1px dashed #000"></td>
                <td style="width:2%;text-align:right">C</td>
                <td style="width:5%;text-align:right">3</td>
            </tr>
        </table>

        <table style="width:100%;">
            <tr>
                <td style="width:5%">D</td>
                <td style="width:1%;white-space:nowrap">Enter number of dependents (other than your spouse or yourself) you will claim on your tax return</td>
                <td style="border-bottom:1px dashed #000"></td>
                <td style="width:2%;text-align:right">D</td>
                <td style="width:5%;text-align:right">4</td>
            </tr>
        </table>

        <table style="width:100%;">
            <tr>
                <td style="width:5%">E</td>
                <td style="width:1%;white-space:nowrap">Enter “1” if you will file as head of household on your tax return (see conditions under Head of household above)</td>
                <td style="border-bottom:1px dashed #000"></td>
                <td style="width:2%;text-align:right">E</td>
                <td style="width:5%;text-align:right">5</td>
            </tr>
        </table>

        <table style="width:100%;">
            <tr>
                <td style="width:5%">F</td>
                <td style="width:1%;white-space:nowrap">
                    Enter “1” if you have at least $2,000 of child or dependent care expenses for which you plan to claim a credit<br/>
                    (Note: Do not include child support payments. See Pub. 503, Child and Dependent Care Expenses, for details.)
                </td>
                <td style="border-bottom:1px dashed #000"></td>
                <td style="width:2%;text-align:right">F</td>
                <td style="width:5%;text-align:right">6</td>
            </tr>
        </table>

        <table style="width:100%;">
            <tr>
                <td style="width:5%">G</td>
                <td style="width:1%;white-space:nowrap">
                    Add lines A through G and enter total here. (Note: This may be different from the number of exemptions you claim on your tax return.) ▶
                </td>
                <td style="border-bottom:1px dashed #000"></td>
                <td style="width:2%;text-align:right">G</td>
                <td style="width:5%;text-align:right">7</td>
            </tr>
        </table>

        <table style="width:100%;">
            <tr>
                <td style="width:5%">H</td>
                <td style="width:1%;white-space:nowrap">
                    Child Tax Credit (including additional child tax credit). See Pub. 972, Child Tax Credit, for more information.<br/>
                    • If your total income will be less than $70,000 ($100,000 if married), enter “2” for each eligible child; then less “1” if you<br/>
                    have two to four eligible children or less “2” if you have five or more eligible children.<br/>
                    • If your total income will be between $70,000 and $84,000 ($100,000 and $119,000 if married), enter “1” for each eligible child.<br/>
                </td>
                <td style="border-bottom:1px dashed #000"></td>
                <td style="width:2%;text-align:right">H</td>
                <td style="width:5%;text-align:right">8</td>
            </tr>
        </table>

        <table style="width:100%;">
            <tr>
                <td style="width:5%">&nbsp;</td>
                <td style="width:10%">
                    For accuracy, complete all worksheets that apply.
                </td>
                <td style="width:1%;white-space:nowrap;font-size:100px">&#123</td>
                <td>
                    • If you plan to itemize or claim adjustments to income and want to reduce your withholding, see the Deductions and Adjustments Worksheet on page 2.<br/>
                    • If you are single and have more than one job or are married and you and your spouse both work and the combined earnings from all jobs exceed $50,000 ($20,000 if married), see the Two-Earners/Multiple Jobs Worksheet on page 2 to avoid having too little tax withheld.<br/>
                    • If neither of the above situations applies, stop here and enter the number from line H on line 5 of Form W-4 below.<br/>
                </td>
                <td style="width:5%">&nbsp;</td>
            </tr>
        </table>

        <table style="width:100%;border-top:3px solid #000">
            <tr>
                <td><hr/></td>
                <td style="width:1%; white-space:nowrap;">Separate here and give Form W-4 to your employer. Keep the top part for your records.</td>
                <td><hr/></td>
            </tr>
        </table>

        <table style="width:100%;">
            <tr>
                <td style="width:18%;">
                    Form <h1 style="margin:0;display:inline">W-4</h1><br/>
                    Department of the Treasury<br/>Internal Revenue Service
                </td>
                <td style="text-align:center;border-left:3px solid #000;border-right:3px solid #000">
                    <h2 style="margin:0;">Employee's Withholding Allowance Certificate</h2>
                    <p style="margin:5px 0">▶ Whether you are entitled to claim a certain number of allowances or exemption from 
                        withholding is<br/>subject to review by the IRS. Your employer may be required to send a 
                        copy of this form to the IRS.</p>
                </td>
                <td style="width:15%;text-align:center">
                    OMB No. 1545-0074
                    <h1 style="margin:0">
                        2016
                        <!--<svg width="200" height="80" style="margin:0">
                        <text fill="#fff" fill-opacity="0" font-size="80" x="60" y="70" text-anchor="middle" stroke="black">20</text>
                        <text fill="#000" fill-opacity="1.0" font-size="80" x="140" y="70" text-anchor="middle" stroke="black">16</text>
                        </svg>-->
                    </h1>
                </td>
            </tr> 
        </table>

        <table style="width:100%; border-top:3px solid #000">
            <tr>
                <td style="width:30%">
                    1 &nbsp;&nbsp;&nbsp; Your first name and middle initial
                    <br/><input type="text" value="<?php echo $data['first_middle_name']; ?>" style="width:90%;border:none;padding:5px" />
                </td>
                <td style="border-left:1px solid #000;border-right:1px solid #000">
                    &nbsp; Last name
                    <br/><input type="text" value="<?php echo $data['last_name']; ?>" style="width:90%;border:none;padding:5px" />
                </td>
                <td style="width:25%">
                    2 Your social security number
                    <br/><input type="text" value="<?php echo $data['ssn']; ?>" style="width:90%;border:none;padding:5px" />
                </td>
            </tr>
        </table>

        <table style="width:100%; border-top:3px solid #000">
            <tr>
                <td style="width:50%">
                    &nbsp;&nbsp;&nbsp;&nbsp; Home address (number and street or rural route)
                    <br/><input type="text" value="<?php echo $data['home_address']; ?>" style="width:90%;border:none;padding:5px" />
                </td>
                <td style="border-left:1px solid #000">
                    3 &nbsp; <input type="checkbox" <?php echo ($data['marital_status'] == 1) ? 'checked' : ''; ?> /> Single &nbsp;
                    <input type="checkbox" <?php echo ($data['marital_status'] == 2) ? 'checked' : ''; ?> /> Married &nbsp;
                    <input type="checkbox" <?php echo ($data['marital_status'] == 3) ? 'checked' : ''; ?> /> Married, but withhold at higher Single rate.
                    <br/><span style="font-size:13px"><b>Note:</b> If married, but legally separated, or spouse is a nonresident alien, check the “Single” box.</span>
                </td>
            </tr>
        </table>

        <table style="width:100%; border-top:3px solid #000">
            <tr>
                <td style="width:50%">
                    &nbsp;&nbsp;&nbsp;&nbsp; City or town, state, and ZIP code
                    <br/><input type="text" value="<?php echo $data['city_state_zip']; ?>" style="width:90%;border:none;padding:5px" />
                </td>
                <td style="border-left:1px solid #000">
                    4 &nbsp; If your last name differs from that shown on your social security card,<br/>check here. 
                    You must call 1-800-772-1213 for a replacement card. ▶
                    <input type="checkbox" <?php echo ($data['replacement_card'] == 1) ? 'checked' : ''; ?> />
                </td>
            </tr>
        </table>

        <table style="width:100%;border-top:1px solid #000">
            <tr>
                <td style="width:5%">5</td>
                <td>Total number of allowances you are claiming (from line H above or from the applicable worksheet on page 2)</td>
                <td style="width:2%;text-align:center;hite-space:nowrap;border-left:1px solid #000;border-bottom:1px solid #000">5</td>
                <td style="width:10%;text-align:center;border-left:1px solid #000;border-bottom:1px solid #000"><input type="text" value="<?php echo $data['total_num_allowance']; ?>" style="width:90%;border:none;padding:5px" /></td>
            </tr>
        </table>

        <table style="width:100%;">
            <tr>
                <td style="width:5%">6</td>
                <td>Additional amount, if any, you want withheld from each paycheck</td>
                <td style="width:2%;text-align:center;white-space:nowrap;border-left:1px solid #000;border-bottom:1px solid #000">6</td>
                <td style="width:10%;border-bottom:1px solid #000;border-left:1px solid #000;"><input type="text" value="<?php echo '$  ' . $data['additional_amount']; ?>" style="width:90%;border:none;padding:5px" /></td>
            </tr>
        </table>

        <table style="width:100%;">
            <tr>
                <td style="width:5%">7</td>
                <td>
                    I claim exemption from withholding for 2016, and I certify that I meet both of the following conditions for exemption.
                </td>
            </tr>
        </table>

        <table style="width:100%;">
            <tr>
                <td style="width:5%">&nbsp;</td>
                <td>
                    • Last year I had a right to a refund of all federal income tax withheld because I had no tax liability, and<br/>
                    • This year I expect a refund of all federal income tax withheld because I expect to have no tax liability.<br/>
                </td>
            </tr>
        </table>

        <table style="width:100%;">
            <tr>
                <td style="width:5%">&nbsp;</td>
                <td>
                    If you meet both conditions, write “Exempt” here
                </td>
                <td style="width:2%;text-align:center;white-space:nowrap;border:1px solid #000;border-right:none !important;">7</td>
                <td style="width:20%;border:1px solid #000;border-right:none !important;"><input type="text" value="<?php echo $data['claim_exemption']; ?>" style="width:90%;border:none;padding:5px" /></td>
            </tr>
        </table>

        <table style="width:100%; border-top:1px solid #000">
            <tr>
                <td>Under penalties of perjury, I declare that I have examined this certificate and, to the best of my knowledge and belief, it is true, correct, and complete.</td>
            </tr>
        </table>

        <table style="width:100%;margin-top:30px">
            <tr>
                <td style="width:1%;white-space:nowrap">Employee’s signature<br>(This form is not valid unless you sign it.) ▶</td>
                <td>&nbsp;</td>
                <td style="width:25%;white-space:nowrap">Date ▶</td>
            </tr>
        </table>

        <table style="width:100%;border-top:1px solid #000">
            <tr>
                <td>
                    8 &nbsp;&nbsp;&nbsp; Employer’s name and address (Employer: Complete lines 8 and 10 only if sending to the IRS.)
                    <br/><input type="text" value="<?php echo $data['name_and_address']; ?>" style="width:90%;border:none;padding:5px" />
                </td>
                <td style="width:15%;border-left:1px solid #000;border-right:1px solid #000">
                    9 &nbsp;&nbsp;&nbsp; Office code (optional)
                    <br/><input type="text" value="<?php echo $data['office_code']; ?>" style="width:90%;border:none;padding:5px" />
                </td>
                <td style="width:25%">
                    10 &nbsp;&nbsp;&nbsp; Employer identification number (EIN)
                    <br/><input type="text" value="<?php echo $data['ein']; ?>" style="width:90%;border:none;padding:5px" />
                </td>
            </tr>
        </table>

        <table style="width:100%;border-top:1px solid #000">
            <tr>
                <td>
                    For Privacy Act and Paperwork Reduction Act Notice, see page 2.
                </td>
                <td style="width:15%">
                    Cat. No. 10220Q
                </td>
                <td style="width:25%">
                    Form W-4 (2016)
                </td>
            </tr>
        </table>
    </body>

    <head></head>
    <body>

        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap">
                    Form W-4 (2016)
                </td>
                <td>&nbsp;</td>
                <td style="width:1%;white-space:nowrap">
                    Page <span style="font-size:22px;font-weight:bold">2</span>
                </td>
            </tr>
        </table>
        <table style="width:100%;border:3px solid #000"><!----------Wrapper Table----------->            
            <tr><!----------Wrapper Table----------->
                <td><!----------Wrapper Table----------->                    

                    <table style="width:100%;border-bottom:3px solid #000">
                        <tr>
                            <td style="text-align:center"><h3 style="margin:0">Deductions and Adjustments Worksheet</h3></td>
                        </tr>
                    </table>

                    <table style="width:100%;">
                        <tr>
                            <td><b>Note:</b> Use this worksheet only if you plan to itemize deductions or claim certain credits or adjustments to income.</td>
                        </tr>
                    </table>

                    <table style="width:100%;">
                        <tr>
                            <td style="width:3%">1</td>
                            <td style="width:1%;white-space:nowrap">
                                Enter an estimate of your 2016 itemized deductions. These include qualifying home mortgage interest, charitable contributions, state
                            </td>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td style="width:3%">&nbsp;</td>
                            <td style="width:1%;white-space:nowrap;">
                                and local taxes, medical expenses in excess of 10% (7.5% if either you or your spouse was born before January 2, 1952) of your<br/>
                                income, and miscellaneous deductions. For 2016, you may have to reduce your itemized deductions if your income is over $311,300<br/>
                                and you are married filing jointly or are a qualifying widow(er); $285,350 if you are head of household; $259,400 if you are single and<br/>
                            </td>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td style="width:3%">&nbsp;</td>
                            <td style="width:1%;white-space:nowrap">
                                not head of household or a qualifying widow(er); or $155,650 if you are married filing separately. See Pub. 505 for details
                            </td>
                            <td style="border-bottom:1px dashed #000"></td>
                            <td style="width:2%;text-align:right">1</td>
                            <td style="width:5%;text-align:right"><?php echo '$ ' . $data['deduc_1']; ?></td>
                        </tr>
                    </table>

                    <table style="width:100%;">
                        <tr>
                            <td style="width:3%">2</td>
                            <td style="width:1%;white-space:nowrap">Enter:</td>
                            <td style="width:1%;white-space:nowrap;font-size:60px">&#123</td>
                            <td style="width:1%;white-space:nowrap">
                                $12,600 if married filing jointly or qualifying widow(er)<br/>
                                $9,300 if head of household<br/>
                                $6,300 if single or married filing separately<br/>
                            </td>
                            <td style="width:1%;white-space:nowrap;font-size:60px">&#125</td>
                            <td>
                                <hr style="border:none; border-top:1px dashed #000;height:1px;width:100%;"/>
                            </td>
                            <td style="width:2%;text-align:right">2</td>
                            <td style="width:5%;text-align:right"><?php echo '$ ' . $data['deduc_2']; ?></td>
                        </tr>
                    </table>

                    <table style="width:100%">
                        <tr>
                            <td style="width:3%">3</td>
                            <td style="width:1%;white-space:nowrap">
                                <b>Subtract</b> line 2 from line 1. If zero or less, enter “-0-”
                            </td>
                            <td style="border-bottom:1px dashed #000"></td>
                            <td style="width:2%;text-align:right">3</td>
                            <td style="width:5%;text-align:right"><?php echo '$ ' . $data['deduc_3']; ?></td>
                        </tr>
                    </table>

                    <table style="width:100%">
                        <tr>
                            <td style="width:3%">4</td>
                            <td style="width:1%;white-space:nowrap">
                                Enter an estimate of your 2016 adjustments to income and any additional standard deduction (see Pub. 505)
                            </td>
                            <td style="border-bottom:1px dashed #000"></td>
                            <td style="width:2%;text-align:right">4</td>
                            <td style="width:5%;text-align:right"><?php echo '$ ' . $data['deduc_4']; ?></td>
                        </tr>
                    </table>

                    <table style="width:100%">
                        <tr>
                            <td style="width:3%">5</td>
                            <td style="width:1%;white-space:nowrap">
                                Add lines 3 and 4 and enter the total. (Include any amount for credits from the Converting Credits to<br/>
                                Withholding Allowances for 2016 Form W-4 worksheet in Pub. 505.)
                            </td>
                            <td style="border-bottom:1px dashed #000"></td>
                            <td style="width:2%;text-align:right">3</td>
                            <td style="width:5%;text-align:right"><?php echo '$ ' . $data['deduc_5']; ?></td>
                        </tr>
                    </table>

                    <table style="width:100%">
                        <tr>
                            <td style="width:3%">6</td>
                            <td style="width:1%;white-space:nowrap">
                                Enter an estimate of your 2016 nonwage income (such as dividends or interest)
                            </td>
                            <td style="border-bottom:1px dashed #000"></td>
                            <td style="width:2%;text-align:right">6</td>
                            <td style="width:5%;text-align:right"><?php echo '$ ' . $data['deduc_6']; ?></td>
                        </tr>
                    </table>

                    <table style="width:100%">
                        <tr>
                            <td style="width:3%">7</td>
                            <td style="width:1%;white-space:nowrap">
                                <b>Subtract</b> line 6 from line 5. If zero or less, enter “-0-”
                            </td>
                            <td style="border-bottom:1px dashed #000"></td>
                            <td style="width:2%;text-align:right">7</td>
                            <td style="width:5%;text-align:right"><?php echo '$ ' . $data['deduc_7']; ?></td>
                        </tr>
                    </table>

                    <table style="width:100%">
                        <tr>
                            <td style="width:3%">8</td>
                            <td style="width:1%;white-space:nowrap">
                                <b>Divide</b> the amount on line 7 by $4,050 and enter the result here. Drop any fraction
                            </td>
                            <td style="border-bottom:1px dashed #000"></td>
                            <td style="width:2%;text-align:right">8</td>
                            <td style="width:5%;text-align:right"><?php echo $data['deduc_8']; ?></td>
                        </tr>
                    </table>

                    <table style="width:100%">
                        <tr>
                            <td style="width:3%">9</td>
                            <td style="width:1%;white-space:nowrap">
                                Enter the number from the <b>Personal Allowances Worksheet</b>, line H, page 1
                            </td>
                            <td style="border-bottom:1px dashed #000"></td>
                            <td style="width:2%;text-align:right">9</td>
                            <td style="width:5%;text-align:right"><?php echo $data['deduc_9']; ?></td>
                        </tr>
                    </table>

                    <table style="width:100%">
                        <tr>
                            <td style="width:3%">10</td>
                            <td style="width:1%;white-space:nowrap">
                                <b>Add</b> lines 8 and 9 and enter the total here. If you plan to use the <b>Two-Earners/Multiple Jobs Worksheet,</b><br/>also enter this total on line 1 below. Otherwise, stop here and enter this total on Form W-4, line 5, page 1
                            </td>
                            <td style="border-bottom:1px dashed #000"></td>
                            <td style="width:2%;text-align:right">10</td>
                            <td style="width:5%;text-align:right"><?php echo $data['deduc_10']; ?></td>
                        </tr>
                    </table>

                    <table style="width:100%;border-top:3px solid #000;border-bottom:3px solid #000">
                        <tr>
                            <td style="text-align:center"><h3 style="margin:0">Two-Earners/Multiple Jobs Worksheet <span style="font-weight:normal !important">(See Two earners or multiple jobs on page 1.)</span></h3></td>
                        </tr>
                    </table>

                    <table style="width:100%;">
                        <tr>
                            <td><b>Note:</b> Use this worksheet only if the instructions under line H on page 1 direct you here.</td>
                        </tr>
                    </table>                    

                    <table style="width:100%">
                        <tr>
                            <td style="width:3%">1</td>
                            <td style="width:1%;white-space:nowrap">
                                Enter the number from line H, page 1 (or from line 10 above if you used the <b>Deductions and Adjustments Worksheet</b>)
                            </td>
                            <td style="border-bottom:1px dashed #000"></td>
                            <td style="width:2%;text-align:right">1</td>
                            <td style="width:5%;text-align:right"><?php echo $data['multijob_1']; ?></td>
                        </tr>
                    </table>

                    <table style="width:100%;">
                        <tr>
                            <td style="width:3%">2</td>
                            <td style="width:1%;white-space:nowrap">
                                Find the number in <b>Table 1</b> below that applies to the <b>LOWEST</b> paying job and enter it here. <b>However,</b> if
                            </td>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td style="width:3%">&nbsp;</td>
                            <td style="width:1%;white-space:nowrap;">
                                you are married filing jointly and wages from the highest paying job are $65,000 or less, do not enter more
                            </td>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td style="width:3%">&nbsp;</td>
                            <td style="width:1%;white-space:nowrap">
                                than “3”
                            </td>
                            <td style="border-bottom:1px dashed #000"></td>
                            <td style="width:2%;text-align:right">2</td>
                            <td style="width:5%;text-align:right"><?php echo $data['multijob_2']; ?></td>
                        </tr>
                    </table>                    

                    <table style="width:100%">
                        <tr>
                            <td style="width:3%">3</td>
                            <td style="width:1%;white-space:nowrap">
                                If line 1 is more than or equal to line 2, subtract line 2 from line 1. Enter the result here (if zero, enter<br/> “-0-”) and on Form W-4, line 5, page 1. Do not use the rest of this worksheet
                            </td>
                            <td style="border-bottom:1px dashed #000"></td>
                            <td style="width:2%;text-align:right">3</td>
                            <td style="width:5%;text-align:right"><?php echo $data['multijob_3']; ?></td>
                        </tr>
                    </table>

                    <table style="width:100%;">
                        <tr>
                            <td><b>Note:</b> If line 1 is less than line 2, enter “-0-” on Form W-4, line 5, page 1. Complete lines 4 through 9 below to<br/>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                figure the additional withholding amount necessary to avoid a year-end tax bill.</td>
                        </tr>
                    </table>                       

                    <table style="width:100%">
                        <tr>
                            <td style="width:3%">4</td>
                            <td style="width:1%;white-space:nowrap">
                                Enter the number from line 2 of this worksheet
                            </td>
                            <td style="border-bottom:1px dashed #000"></td>
                            <td style="width:2%;text-align:right">4</td>
                            <td style="width:5%;text-align:right"><?php echo $data['multijob_4']; ?></td>
                        </tr>
                    </table>                    

                    <table style="width:100%">
                        <tr>
                            <td style="width:3%">5</td>
                            <td style="width:1%;white-space:nowrap">
                                Enter the number from line 1 of this worksheet
                            </td>
                            <td style="border-bottom:1px dashed #000"></td>
                            <td style="width:2%;text-align:right">5</td>
                            <td style="width:5%;text-align:right"><?php echo $data['multijob_5']; ?></td>
                        </tr>
                    </table>                    

                    <table style="width:100%">
                        <tr>
                            <td style="width:3%">6</td>
                            <td style="width:1%;white-space:nowrap">
                                <b>Subtract</b> line 5 from line 4
                            </td>
                            <td style="border-bottom:1px dashed #000"></td>
                            <td style="width:2%;text-align:right">6</td>
                            <td style="width:5%;text-align:right"><?php echo $data['multijob_6']; ?></td>
                        </tr>
                    </table>                    

                    <table style="width:100%">
                        <tr>
                            <td style="width:3%">7</td>
                            <td style="width:1%;white-space:nowrap">
                                Find the amount in <b>Table 2</b> below that applies to the <b>HIGHEST</b> paying job and enter it here
                            </td>
                            <td style="border-bottom:1px dashed #000"></td>
                            <td style="width:2%;text-align:right">7</td>
                            <td style="width:5%;text-align:right"><?php echo '$ ' . $data['multijob_7']; ?></td>
                        </tr>
                    </table>                    

                    <table style="width:100%">
                        <tr>
                            <td style="width:3%">8</td>
                            <td style="width:1%;white-space:nowrap">
                                <b>Multiply</b> line 7 by line 6 and enter the result here. This is the additional annual withholding needed
                            </td>
                            <td style="border-bottom:1px dashed #000"></td>
                            <td style="width:2%;text-align:right">8</td>
                            <td style="width:5%;text-align:right"><?php echo '$ ' . $data['multijob_8']; ?></td>
                        </tr>
                    </table>

                    <table style="width:100%;">
                        <tr>
                            <td style="width:3%">9</td>
                            <td style="width:1%;white-space:nowrap">
                                Divide line 8 by the number of pay periods remaining in 2016. For example, divide by 25 if you are paid every two
                            </td>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td style="width:3%">&nbsp;</td>
                            <td style="width:1%;white-space:nowrap;">
                                weeks and you complete this form on a date in January when there are 25 pay periods remaining in 2016. Enter
                            </td>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td style="width:3%">&nbsp;</td>
                            <td style="width:1%;white-space:nowrap">
                                the result here and on Form W-4, line 6, page 1. This is the additional amount to be withheld from each paycheck
                            </td>
                            <td style="border-bottom:1px dashed #000"></td>
                            <td style="width:2%;text-align:right">9</td>
                            <td style="width:5%;text-align:right"><?php echo '$ ' . $data['multijob_9']; ?></td>
                        </tr>
                    </table>    

                </td><!----------Wrapper Table----------->
            </tr><!----------Wrapper Table----------->
        </table><!----------Wrapper Table----------->

    </body>

    <style type="text/css">
        body{margin:0; font-size:13.5px}
        /* div table tr td:nth-child(even){font-style:italic !important;text-align:center}
        td span b{display:block;margin-left:3px !important}*/
    </style>

</html>