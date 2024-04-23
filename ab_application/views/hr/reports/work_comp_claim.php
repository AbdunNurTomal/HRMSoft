<?php

if ($Emp_Data['company_id'] == 0) {
    echo "";
} else {
    $show_in_header = $this->Common_model->get_name($this, $Emp_Data['company_id'], 'main_company', 'show_in_header');

    if ($show_in_header == 0) {
        $company_name = $this->Common_model->get_name($this, $Emp_Data['company_id'], 'main_company', 'company_full_name');
    } else {
        $company_name = $this->Common_model->get_name($this, $Emp_Data['company_id'], 'main_company', 'company_short_name');
    }

    $company_logo = $this->Common_model->get_name($this, $Emp_Data['company_id'], 'main_company', 'company_logo');
}

$emp_name = $this->Common_model->employee_name($Emp_Data['employee_id']);

list($action_time, $time_format) = explode(" ", $Emp_Data['accident_time']);
?>


<!DOCTYPE html>
<html><body>
        <table style="width:100%;margin-bottom:30px">
            <tr>
                <td style="width:48%;text-align:right"><img width="50" src="<?php echo Get_File_Directory('uploads/companylogo/' . $company_logo) ?>" alt="Company Logo" /></td>
                <td style="font-style:normal; font-size:20px; text-align:left;"><?php echo $company_name; ?></td>
            </tr>
        </table>

        <h3 style="text-align:center">WORKERS’ COMPENSATION CLAIM FORM (DWC 1) </h3>

        <table style="width:100%;margin-top:20px">
            <tr>
                <td style="width:50%;font-weight:bold">
                    Employee—complete this section and see note above.
                </td>
                <td style="width:50%;font-weight:bold;font-style:italic">
                    Empleado—complete esta sección y note la notación arriba. 
                </td>
            </tr>
        </table>

        <table style="width:100%;margin-top:20px">
            <tr>
                <td style="width:1%;white-space:nowrap">1. Name. <i> Nombre.</i> </td>
                <td style="border-bottom:1px solid #000"><?php echo $emp_name; ?></td>
                <td style="width:1%;white-space:nowrap">Today’s Date. <i>Fecha de Hoy.</i> </td>
                <td style="border-bottom:1px solid #000"><?php echo date('m-d-Y'); ?></td>
            </tr>
        </table>

        <table style="width:100%">
            <tr>
                <td style="width:1%;white-space:nowrap">2. Home Address. <i>Dirección Residencial</i> </td>
                <td style="border-bottom:1px solid #000"><?php echo $Emp_Data['first_address']; ?></td>
            </tr>
        </table>        

        <table style="width:100%">
            <tr>
                <td style="width:1%;white-space:nowrap">3. City. <i>Ciudad.</i> </td>
                <td style="border-bottom:1px solid #000"><?php echo $Emp_Data['city']; ?></td>
                <td style="width:1%;white-space:nowrap">State. <i>Estado.</i> </td>
                <td style="border-bottom:1px solid #000"><?php echo $this->Common_model->get_name($this, $Emp_Data['state'], 'main_state', 'state_name'); ?></td>
                <td style="width:1%;white-space:nowrap">Zip. <i>Código Postal.</i> </td>
                <td style="border-bottom:1px solid #000"><?php echo $Emp_Data['zipcode']; ?></td>
            </tr>
        </table>        

        <table style="width:100%">
            <tr>
                <td style="width:1%;white-space:nowrap">4. Date of Injury. <i>Fecha de la lesión (accidente).</i> </td>
                <td style="border-bottom:1px solid #000"><?php echo $this->Common_model->show_date_formate($Emp_Data['action_date']); ?></td>
                <td style="width:1%;white-space:nowrap">Time of Injury. <i>Hora en que ocurrió.</i> </td>
                <td style="border-bottom:1px solid #000"><?php echo ($time_format == "AM") ? $action_time : "&nbsp;"; ?></td>
                <td style="width:1%;white-space:nowrap">a.m.</td>
                <td style="border-bottom:1px solid #000"><?php echo ($time_format == "PM") ? $action_time : "&nbsp;"; ?></td>
                <td style="width:1%;white-space:nowrap">p.m.</td>
            </tr>
        </table>        

        <table style="width:100%">
            <tr>
                <td style="width:1%;white-space:nowrap">5. Address and description of where injury happened. <i>Dirección/lugar dónde occurió el accidente.</i> </td>
            </tr>
            <tr>                
                <td style="border-bottom:1px solid #000;text-align:center"> <?php echo $Emp_Data['accident_location']; ?> </td>
            </tr>
        </table>        

        <table style="width:100%">
            <tr>
                <td style="width:1%;white-space:nowrap">6. Describe injury and part of body affected. <i>Describa la lesión y parte del cuerpo afectada.</i> </td>
            </tr>
            <tr>                
                <td style="border-bottom:1px solid #000; text-align:center"> 
                    <?php
                    $Injured_parts = array();
                    $injured_body_parts = $this->Common_model->get_array('bodypart_injurylist');
                    $InjARR = explode(',', $Emp_Data['injured_body_parts']);
                    foreach ($injured_body_parts as $key => $value) {
                        if (array_key_exists($key, $InjARR)) {
                            $Injured_parts[] = $value;
                        }
                    }
                    echo $Emp_Data['nature_of_injury'] . '; Injured Body Part(s): ' . implode(', ', $Injured_parts);
                    ?>
                </td>
            </tr>
        </table>

        <table style="width:100%">
            <tr>
                <td style="width:1%;white-space:nowrap">7. Social Security Number. <i>Número de Seguro Social del Empleado.</i> </td>
                <td style="border-bottom:1px solid #000"><?php echo $Emp_Data['ssn_code']; ?></td>
            </tr>
        </table>

        <table style="width:100%">
            <tr>
                <td style="text-align:justify">
                    8. <input type="checkbox" style="position:relative;vertical-align:middle;" /> Check if you agree to receive notices about your claim by email only. &nbsp;&nbsp;<input type="checkbox" style="position:relative;vertical-align:middle;" />
                    <i>Marque si usted acepta recibir notificaciones sobre su reclamo solo por correo electrónico.</i> Employee’s e-mail. <span style="text-decoration:underline"> &nbsp;&nbsp;&nbsp; <?php echo $Emp_Data['email']; ?> &nbsp;&nbsp;&nbsp; </span>
                    <i>Correo electrónico del empleado.</i> <span style="text-decoration:underline"> &nbsp;&nbsp;&nbsp; <?php echo $Emp_Data['email']; ?> &nbsp;&nbsp;&nbsp; </span> .
                    You will receive benefit notices by regular mail if you do not choose, or your claims administrator does not offer, an 
                    electronic service option. <i>Usted recibirá notificaciones de beneficios por correo ordinario si usted no escoge, o su 
                        administrador de reclamos no le ofrece, una opción de servicio electrónico.</i>
                </td>
            </tr>
        </table>        

        <table style="width:100%">
            <tr>
                <td style="width:1%;white-space:nowrap">9. Signature of employee. <i>Firma del empleado.</i> </td>
                <td style="border-bottom:1px solid #000"> &nbsp; </td>
            </tr>
        </table>

        <table style="width:100%;margin-top:20px">
            <tr>
                <td style="width:50%;font-weight:bold">
                    Employer—complete this section and see note below.
                </td>
                <td style="width:50%;font-weight:bold;font-style:italic">
                    Empleador—complete esta sección y note la notación abajo.
                </td>
            </tr>
        </table>

        <table style="width:100%;margin-top:20px">
            <tr>
                <td style="width:1%;white-space:nowrap">10. Name of employer. <i>Nombre del empleador.</i> </td>
                <td style="border-bottom:1px solid #000"></td>
            </tr>
        </table>

        <table style="width:100%">
            <tr>
                <td style="width:1%;white-space:nowrap">11. Address. <i>Dirección</i> </td>
                <td style="border-bottom:1px solid #000"></td>
            </tr>
        </table>

        <table style="width:100%">
            <tr>
                <td style="width:1%;white-space:nowrap">12. Date employer first knew of injury. <i>Fecha en que el empleador supo por primera vez de la lesión o accidente.</i> </td>
                <td style="border-bottom:1px solid #000"></td>
            </tr>
        </table>

        <table style="width:100%">
            <tr>
                <td style="width:1%;white-space:nowrap">13. Date claim form was provided to employee. <i>Fecha en que se le entregó al empleado la petición.</i> </td>
                <td style="border-bottom:1px solid #000"></td>
            </tr>
        </table>

        <table style="width:100%">
            <tr>
                <td style="width:1%;white-space:nowrap">14. Date employer received claim form. <i>Fecha en que el empleado devolvió la petición al empleador.</i> </td>
                <td style="border-bottom:1px solid #000"></td>
            </tr>
        </table>

        <table style="width:100%">
            <tr>
                <td style="width:1%;white-space:nowrap">15. Name and address of insurance carrier or adjusting agency. <i>Nombre y dirección de la compañía de seguros o agencia adminstradora de seguros.</i> </td>
            </tr>
            <tr>                
                <td style="border-bottom:1px solid #000"> &nbsp; </td>
            </tr>
        </table>

        <table style="width:100%">
            <tr>
                <td style="width:1%;white-space:nowrap">16. Insurance Policy Number. <i>El número de la póliza de Seguro.</i> </td>
                <td style="border-bottom:1px solid #000"></td>
            </tr>
        </table>

        <table style="width:100%">
            <tr>
                <td style="width:1%;white-space:nowrap">17. Signature of employer representative. <i>Firma del representante del empleador.</i> </td>
                <td style="border-bottom:1px solid #000"></td>
            </tr>
        </table>

        <table style="width:100%">
            <tr>
                <td style="width:1%;white-space:nowrap">18. Title. <i>Título.</i> </td>
                <td style="border-bottom:1px solid #000"></td>
                <td style="width:1%;white-space:nowrap"> 19. Telephone. <i>Teléfono.</i> </td>
                <td style="border-bottom:1px solid #000"></td>
            </tr>
        </table>

        <table style="width:100%;margin-top:20px">
            <tr>
                <td style="vertical-align:top;text-align:justify;width:50%;border-right:1px solid #000">
                    <b><u>Employer:</u></b> You are required to date this form and provide copies to your insurer
                    or claims administrator and to the employee, dependent or representative who
                    filed the claim within <b><u>one working day</u></b> of receipt of the form from the employee.
                    <br/><br/>SIGNING THIS FORM IS NOT AN ADMISSION OF LIABILITY 
                </td>
                <td style="vertical-align:top;text-align:justify;font-style:italic">
                    <b><u>Empleador:</u></b> Se requiere que Ud. feche esta forma y que provéa copias a su
                    compañía de seguros, administrador de reclamos, o dependiente/representante de
                    reclamos y al empleado que hayan presentado esta petición dentro del plazo de
                    <b><u>un día hábil</u></b> desde el momento de haber sido recibida la forma del empleado.
                    <br/><br/>EL FIRMAR ESTA FORMA NO SIGNIFICA ADMISION DE RESPONSABILIDAD
                </td>
            </tr>
        </table>

        <table style="width:100%;margin-top:20px">
            <tr>
                <td style="vertical-align:top;"><input type="checkbox" style="position:relative;vertical-align:middle;" /> Employer copy/Copia del Empleador</td>
                <td style="vertical-align:top;"><input type="checkbox" style="position:relative;vertical-align:middle;" /> Employee copy/Copia del Empleado</td>
                <td style="vertical-align:top;"><input type="checkbox" style="position:relative;vertical-align:middle;" /> Claims Administrator/Administrador de Reclamos</td>
                <td style="vertical-align:top;"><input type="checkbox" style="position:relative;vertical-align:middle;" /> Temporary Receipt/Recibo del Empleado</td>
            </tr>
        </table>

    </body>

    <style type="text/css">
        tr td:nth-child(even){text-align:center}
        td{font-size:11px}
    </style>

</html>