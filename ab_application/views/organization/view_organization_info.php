
<div class="col-md-10 main-content-div">
    <div class="main-content">
        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div id="org_tree" class="container tag-box tag-box-v3" style="padding:15px; box-sizing:border-box">

            <div class="col-xl-12">
                <!----- Show Existing Organogram ----->
                <div class="col-md-12 no-padding">
                    <p class="org-title">Company Organization Chart</p>
                    <div style="position:relative" id="chart_div">  </div>
                    <div id="shelter"></div>
                </div>
            </div>
        </div>
    </div>
</div>

</div><!--/row-->
</div><!--/container-->

<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/company_organogram/getorgchart.js"></script>
<link href="<?php echo base_url(); ?>assets/plugins/company_organogram/getorgchart.css" type="text/css" rel="stylesheet" />
<style type="text/css">
    #shelter{
        background:#E5FFE9 !important; 
        position:absolute !important;
        right:10px !important; 
        bottom:10px !important;
        padding:15px 0 !important;
        width:120px !important;
        z-index:2147483650 !important;
    }
    /*.get-oc-c{text-align:center}*/
</style>

<script type="text/javascript">

    var BASE_URL = '<?php echo base_url(); ?>';
    var peopleElement = document.getElementById("chart_div");
    var orgChart = new getOrgChart(peopleElement, {
        primaryFields: ["name", "title", "phone", "mail"],
        photoFields: ["image"],
        color: "green",
        enableEdit: false,
        enableZoom: true,
        enableSearch: false,
        enableGridView: false,
        enableDetailsView: false,
        enableMove: true,
        dataSource: [
            <?php foreach ($organogram as $val) :
                $detail_link = base_url() . 'con_Employees/edit_entry/' . $val["node_id"];
                $css = "cursor:pointer";
            ?>
                {
                    id: <?php echo $val["node_id"]; ?>,
                    parentId: <?php echo $val["parent_id"]; ?>,
                    name: "<a style='<?php echo $css; ?>' target='_blank' href='<?php echo $detail_link; ?>'><?php echo $val["node"]; ?></a>",
                    title: "<?php echo $val["position"]; ?>",
                    phone: "<?php echo $val["phone"]; ?>",
                    mail: "<?php echo $val["email"]; ?>",
                    image: "<?php echo base_url() . $val["img_path"]; ?>"
                },
            <?php endforeach; ?>
        ]

                /* Sample Data
                 {id: 'a', parentId: null, name: "Amber McKenzie", title: "CEO", phone: "678-772-470", mail: "lemmons@jourrapide.com", adress: "Atlanta, GA 30303", image: "images/f-11.jpg"},
                 {id: 2, parentId: 'a', name: "Ava Field", title: "Paper goods machine setter", phone: "937-912-4971", mail: "anderson@jourrapide.com", image: "images/f-10.jpg"},
                 {id: 3, parentId: 'a', name: "Evie Johnson", title: "Employer relations representative", phone: "314-722-6164", mail: "thornton@armyspy.com", image: "images/f-9.jpg"},
                 {id: 4, parentId: 'a', name: "Paul Shetler", title: "Teaching assistant", phone: "330-263-6439", mail: "shetler@rhyta.com", image: "images/f-5.jpg"},
                 {id: 5, parentId: 2, name: "Rebecca Francis", title: "Welding machine setter", phone: "408-460-0589", image: "images/f-4.jpg"},
                 {id: 6, parentId: 2, name: "Rebecca Randall", title: "Optometrist", phone: "801-920-9842", mail: "JasonWGoodman@armyspy.com", image: "images/f-8.jpg"},
                 {id: 7, parentId: 2, name: "Spencer May", title: "System operator", phone: "Conservation scientist", mail: "hodges@teleworm.us", image: "images/f-7.jpg"},
                 {id: 8, parentId: 6, name: "Max Ford", title: "Budget manager", phone: "989-474-8325", mail: "hunter@teleworm.us", image: "images/f-6.jpg"},
                 {id: 9, parentId: 7, name: "Riley Bray", title: "Structural metal fabricator", phone: "479-359-2159", image: "images/f-3.jpg"},
                 {id: 10, parentId: 7, name: "Callum Whitehouse", title: "Radar controller", phone: "847-474-8775", image: "images/f-2.jpg"}
                 */
    });

</script>
