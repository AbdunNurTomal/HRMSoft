<?php
/* ------------------------------------------------
  Converts name from 'iamaprogrammer' to 'I am a Programmer',
  base on on the table `tbl_header_helper`

  1. Array, generated for this purpose
  ------------------------------------------------ */
$resolve_arr = array();
$Array = $this->db->get_where('tbl_header_helper')->result();
foreach ($Array as $row) {
    $resolve_arr[$row->key] = $row->value;
}

/* ------------------------------------------------
  2. The Callback Function `get_resolved_header()` */

function get_resolved_header($key, $resolve_arr) {
    if (array_key_exists($key, $resolve_arr)) {
        return $resolve_arr[$key];
    } else {
        return $key;
    }
}

function customize_tbl_name($subject) {
    $var = str_replace('_', ' ', $subject);
    $var = str_replace('sample', '', $var);
    $var = ucwords($var);
    return trim($var);
}

$Qry = $this->db->get_where('sampledata_track', array('company_id' => $company_id))->result_array();
$Already_Taken = array_column($Qry, 'sample_table_name');
?>
<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb" >
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="padding:15px; box-sizing:border-box">

            <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url() . 'Con_sample_data_library/process_sample_data'; ?>" enctype="multipart/form-data" role="form" >    
                <div class="col-sm-12">
                    <h4 style="margin-bottom:40px">Master Data Tables List:</h4>
                </div>
                <br/><br/>
                <div class="col-sm-12 evalCatWrp">
                    <div class="form-group">
                        <label class="col-sm-1 control-label">&nbsp;</label>
                        <div class="col-sm-10">
                            <div class="panel-group" id="accordion">
                                <?php
                                $total_tbl = $Sample_Data_Tables->num_rows();
                                $k = 0;
                                if ($total_tbl > 0) {
                                    foreach ($Sample_Data_Tables->result() as $row) {
                                        $Tbl_Name = $row->TABLE_NAME;

                                        if (in_array($row->TABLE_NAME, $Already_Taken)) {
                                            $extra = 'title="This Table Already Imported" disabled';
                                        } else {
                                            $extra = '';
                                        }
                                        //id="' . $row->TABLE_NAME . '"
                                        $CHK_BOX = '<input type="checkbox" id="mst_chkbox" name="sample_table_name[]" class="Sample-Chk ' . $row->TABLE_NAME.'_mst" value="' . $row->TABLE_NAME . '" ' . $extra . '/> &nbsp;';
                                        $k++;
                                        ?>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">                                                    
                                                    <?php echo $CHK_BOX; ?>
                                                    <a title="Click To View Data" data-toggle="collapse" data-parent="#accordion" href="#collapse_<?php echo $k; ?>">
                                                        <?php echo get_resolved_header(customize_tbl_name($row->TABLE_NAME), $resolve_arr); ?>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapse_<?php echo $k; ?>" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <?php
                                                    $SAMPLE_TBL = $this->Common_model->get_sample_table_fields_and_data($row->TABLE_NAME);
                                                    //pr($SAMPLE_TBL);

                                                    $Sample_Data = $SAMPLE_TBL['Sample_Data'];
                                                    $Sample_Data_Fields = $SAMPLE_TBL['Sample_Data_Fields'];
                                                    ?>
                                                    <div style="max-height:400px;overflow:scroll">
                                                        <table class="table table-striped table-bordered table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <?php
                                                                    if (!empty($Sample_Data_Fields)) {
                                                                        echo '<th> </th>';
                                                                        foreach ($Sample_Data_Fields as $row) {
                                                                            echo '<th>' . get_resolved_header(customize_name($row), $resolve_arr) . '</th>';
                                                                        }
                                                                    }
                                                                    ?>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                //pr($Sample_Data);
                                                                $i=0;
                                                                if (!empty($Sample_Data)) {
                                                                    foreach ($Sample_Data as $row) {
                                                                        $i++;
                                                                        //pr($row);
                                                                        $index = 0;
                                                                        $idd=$Tbl_Name;
                                                                        echo '<tr>';
                                                                        echo '<td> <input type="checkbox" id="' . $idd .'" name="Sample_Data_Array[' . $Tbl_Name . '][' . $row['id'] . ']" class="Sample-Chk ' . $Tbl_Name . '" value="" /> </td>';
                                                                        foreach ($Sample_Data_Fields as $VAL) {
                                                                            echo '<td>' . $row[$VAL] . '</td>';
                                                                        }
                                                                        echo '</tr>';
                                                                    }
                                                                } else {
                                                                    echo '<tr><td colspan="' . count($Sample_Data_Fields) . '" class="center-align"><i>- EMPTY -</i></td></tr>';
                                                                }
                                                                ?>
                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <script type="text/javascript">
                                            //var c = this.checked ? $('#'+ id ).prop('checked', true) : $('#'+ id ).prop('checked', false);
                                            $('.<?php echo $Tbl_Name ?>_mst').change(function(){   
                                               
                                               this.checked ? $('.<?php echo $Tbl_Name ?>').prop('checked', true): $('.<?php echo $Tbl_Name ?>').prop('checked', false);
                                            });

                                           </script>
                                        <?php
                                    }
                                } else {
                                    echo '<label class="col-sm-12 control-label" style="text-align:left !important;color:red !important"><b>No Sample Data Tables Found in the Database Yet!</b></label>';
                                }
                                ?>
                            </div>
                        </div>
                        <label class="col-sm-1 control-label">&nbsp;</label>
                    </div>
                </div>
                <div class="col-sm-12">
                    <br/>
                    <div class="form-group">
                        <label class="col-sm-1 control-label">&nbsp;</label>
                        <div class="col-sm-5">
                            <button type="reset" class="btn btn-u">Reset</button>
                            <button type="submit" class="btn btn-u">Import Sample Data</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

</div><!--/row-->
</div><!--/container-->

<style type="text/css">
    .panel-heading { position: relative; }
    .panel-heading [data-toggle="collapse"]:after {
        font-family: 'Glyphicons Halflings';
        content: "\e080";
        position: absolute;
        color: #b0c5d8;
        font-size: 18px;
        line-height: 22px;
        right: 20px;
        top: calc(50% - 10px);
        /* rotate "play" icon from > (right arrow) to down arrow */
        /* -webkit-transform: rotate(-90deg);
        -moz-transform:    rotate(-90deg);
        -ms-transform:     rotate(-90deg);
        -o-transform:      rotate(-90deg);
        transform:         rotate(-90deg); */
    }
    .panel-heading [aria-expanded="true"]:after{
        content: "\e114" !important;
    }
    .panel-heading [aria-expanded="false"]:after{
        content: "\e080" !important;
    }
</style>

<!--Add item script-->       
<script type="text/javascript">

    $(function () {
        $("#sky-form11").submit(function (event) {
            event.preventDefault();

            var Check_Box_Count = $("[type='checkbox']:checked").length;

            if (Check_Box_Count == 0) {
                alert('Must select Atleast 1 Sample table!');
                return;
            } else {
                loading_box(base_url);
                var url = $(this).attr('action');
                $.ajax({
                    url: url,
                    data: $("#sky-form11").serialize(),
                    type: $(this).attr('method')
                }).done(function (data) {
                    var url = '<?php echo base_url() . "Con_sample_data_library"; ?>';
                    view_message(data, url, '', 'sky-form11');
                });
            }
        });
    });
    
//    $('.Sample-Chk').change(function(){
//    
//        //alert ('kk');
//        //var c = this.checked ? '#f00' : '#09f';
//        //alert (this.value);
//        //$('p').css('color', c);
//        var id=this.value;
//        if(this.value!="")
//        {
//            //$('#'+ id ).prop('checked', true);
//            var c = this.checked ? $('#'+ id ).prop('checked', true) : $('#'+ id ).prop('checked', false);
//        }
//        else{
//            $('#'+ id ).prop('checked', false);
//        }
//        
//    });
    
   
</script>
<!--=== End Script ===-->
