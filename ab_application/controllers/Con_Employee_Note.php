<?php
/**
 * @reference	Con_Contact_Employee.php
 * @modifiedby	Mahfuzul Hoque Khan
 * @initial		MHK
 * @date		30 August 2020
 */

date_default_timezone_set( 'UTC' );

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Employee_Note extends CI_Controller
{
// 	const	REMARK					= "\n--REMARK--\n";

	public $user_data				= array();
	public $user_id					= null;
	public $user_name				= null;
	public $company_id				= null;
	public $user_type				= null;
	public $user_menu				= null;
	public $user_module				= null;
	public $menu_id					= null;
	public $date_time				= null;
	public $module_data				= array();
	public $module_id				= null;
	public $companyView				= false;
	public $search_id				= 0;
	public $search_by_emplyee		= null;
	public $search_by_status		= ['0'=>'ALL','1'=>'ISSUED','2'=>'CLOSED','3'=>'DISCARDED','4'=>'HIGH','5'=>'CRITICAL'];
	public $note_tmpl				= ['i'=>[],'f'=>[],'d'=>[],'c'=>[]];
	public $note_item_tmpl			= ['i'=>'','n'=>'','d'=>'','m'=>''];
	public $note_closing_min_size	= 121;
	public $client_timezone_offset	= '-0600';
	
	public static function toUCWords( $str )
	{
		return ucwords( strtolower( $str ) );
	}
	
	public function __construct()
	{
		parent::__construct();
		
		$noteSize = $this->session->userdata( 'note_size' );
		
		if( is_null( $noteSize ) )
		{
// 			echo "<script>console.error('noteSize is: null' );</script>";
			
			$sql		= "SELECT MAX(CHARACTER_MAXIMUM_LENGTH) AS MAX_LENGTH FROM INFORMATION_SCHEMA.COLUMNS WHERE DATA_TYPE='varchar' AND TABLE_NAME='main_notes' AND COLUMN_NAME='note' AND TABLE_SCHEMA='hrcsoftc_us_hrm'";//COLUMN_NAME,DATA_TYPE,
			$query		= $this->db->query( $sql );
			$row		= $query->result()[0];
			$noteSize	= $row->MAX_LENGTH;

			$this->session->set_userdata( 'note_size', $noteSize );
			
// 			echo "<script>console.error('notes :', '". json_encode( $row, true ) ."' );</script>";
		}
		
// 		$sql		= "SELECT issued_datetime AS date FROM main_notes WHERE id=22";
// 		$query		= $this->db->query( $sql );
// 		$row		= $query->result()[0];

// 		echo "<script>console.error('timestamp is:', '$row->date' );</script>";
// 		echo "<script>console.error('noteSize is:', $noteSize );</script>";
		
		$this->user_data	= $this->session->userdata('hr_logged_in');
		$this->user_id		= $this->user_data['id'			];
		$this->user_name	= $this->user_data['name'		];
		$this->company_id	= $this->user_data['company_id'	];
		$this->user_type	= $this->user_data['usertype'	];
		$this->user_group	= $this->user_data['user_group'	];
		$this->user_menu 	= $this->user_data['user_menu'	];
		$this->user_module	= $this->user_data['user_module'];
		$this->date_time	= date("Y-m-d H:i:s");
		
		$this->module_data	= $this->session->userdata('active_module_id');
		$this->module_id	= $this->module_data['module_id'];
		
		$this->companyView	= $this->user_data['company_view'];
	}

	public function index( $val1 = null, $val2 = null )
	{
// 		echo "<script>console.error('company_id:',$this->company_id);</script>";
// 		echo "<script>console.error($val1,$val2);</script>";
		
		$this->menu_id = $this->uri->segment(3);
		$this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
		//echo "=====".$this->Common_model->generate_hrm_password();
		$this->session->unset_userdata('employee');
		
		if( !is_null( $val2 ) )
		{
			//	echo "<script>console.error($val2);</script>";
			
			$this->search_id = (int)$val2;
		}
		
		$this->initPage		( $param );
// 		$this->initSearch	( $param );
		
		$param['left_menu'	] = 'sadmin/hrm_leftmenu.php';
		$param['content'	] = 'hr/view_notes.php';
		
		$this->load->view('admin/home', $param);
	}
	
	public function setClientTimezoneOffset()
	{
		$timezoneOffset = $this->client_timezone_offset = $this->input->post( 'timezoneOffset' );
		
		$this->session->set_userdata( 'client_timezone_offset', $timezoneOffset );
		
// 		echo "<script>console.error('val:','$val');</script>";
		
		echo $timezoneOffset;
	}
	
	public function show_notes_by_employee()
	{
		$this->search_id			= 0;
		$this->search_by_emplyee	= (int)$this->uri->segment(3);
		
		$this->Common_model->is_user_valid( $this->user_id, $this->menu_id, $this->user_menu );
		//echo "=====".$this->Common_model->generate_hrm_password();
		$this->session->unset_userdata( 'employee' );
		
		$this->initPage		( $param );
// 		$this->initSearch	( $param );
		
		$param['left_menu'	] = 'sadmin/hrm_leftmenu.php';
		$param['content'	] = 'hr/view_notes.php';
		$this->load->view('admin/home', $param); 
	}
	
	public function search_note()
	{
		$this->search_id			= (int)$this->uri->segment(3);
		$this->search_by_emplyee	= null;
		
		$this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
		//echo "=====".$this->Common_model->generate_hrm_password();
		$this->session->unset_userdata('employee');
		
		$this->initPage		( $param );
// 		$this->initSearch	( $param );
		
		$param['left_menu'	] = 'sadmin/hrm_leftmenu.php';
		$param['content'	] = 'hr/view_notes.php';
		$this->load->view( 'admin/home', $param ); 
	}
	
	public function add_note()
	{
		$this->search_id = (int)$this->uri->segment(3);
		
		$this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
		
		$this->initPage( $param );
		
		
		// if ($this->session->userdata('hr_logged_in')["company_view"] == 1 || $this->user_group = $this->user_data['user_group'] == 12) {
		if( $this->user_group == 1 && $this->session->userdata('hr_logged_in')["company_view"] == 0 )
		{
			$param['usergroup_query']= $this->db->get_where('main_usergroup', array('company_id' => $this->company_id, 'isactive' => 1));
			$param['department_query']= $this->db->get_where('main_department', array('isactive' => 1));
		}
		else if( $this->user_group == 12 && $this->companyView )
		{
			// $param['usergroup_query']= $this->db->get_where('main_usergroup', array('isactive' => 1));
			$ignore = array(1, 2, 3);
			$this->db->where_not_in('id', $ignore);
			$param['usergroup_query'] = $this->db->get_where('main_usergroup', array('company_id' => $this->company_id, "isactive"=>1));
			$param['department_query']= $this->db->get_where('main_department', array('isactive' => 1));
		}
		else
		{
			/* $userGroupStr = '4,8,9,10,11';
			 $userGroupArr = explode(",", $userGroupStr);
			 $this->db->where_in('id', $userGroupArr); */
			$ignore = array(1, 2, 3, 12);
			$this->db->where_not_in('id', $ignore);
			$param['usergroup_query'] = $this->db->get_where('main_usergroup', array('company_id' => $this->company_id, 'isactive' => 1));
			
			$param['department_query'] = $this->db->get_where('main_department', array('company_id' => $this->company_id, 'isactive' => 1));
		}
		
		$param['note_size'	] = $this->getRemainingNoteSize() - $this->note_closing_min_size;
		$param['left_menu'	] = 'sadmin/hrm_leftmenu.php';
		$param['content'	] = 'hr/view_add_note.php';
		
		$this->load->view('admin/home', $param);
	}
	
	function edit_entry( $val1 = null, $val2 = null )
	{
// 		echo "<script>console.error($val1,'$val2');</script>";
		
		if( !is_null( $val2 ) )
		{
// 			echo "<script>console.error('val2:',$val2);</script>";
			
			$this->search_id = (int)$val2;
		}
		
		$note_id	= $this->uri->segment(3);
		$param['note_id'	] = $note_id;
		$param['page_id'	] = 'edit_entry';
		
		$this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
		
		$this->initPage		( $param );
// 		$this->initSearch	( $param );
		
		// if( $this->session->userdata('hr_logged_in')["company_view"] == 1 || $this->user_group = $this->user_data['user_group'] == 12 )
		if( $this->user_group == 1 && $this->session->userdata('hr_logged_in')["company_view"] == 0 )
		{
			$param['usergroup_query']= $this->db->get_where('main_usergroup', array('company_id' => $this->company_id, 'isactive' => 1));
			$param['department_query']= $this->db->get_where('main_department', array('isactive' => 1));
		}
		else if( $this->user_group == 12 && $this->companyView )
		{
			// $param['usergroup_query']= $this->db->get_where('main_usergroup', array('isactive' => 1));
			$ignore = array(1, 2, 3);
			$this->db->where_not_in('id', $ignore);
			$param['usergroup_query'] = $this->db->get_where('main_usergroup', array('company_id' => $this->company_id, "isactive"=>1));
			$param['department_query']= $this->db->get_where('main_department', array('isactive' => 1));
		}
		else
		{
			/* $userGroupStr = '4,8,9,10,11';
			 $userGroupArr = explode(",", $userGroupStr);
			 $this->db->where_in('id', $userGroupArr); */
			$ignore = array(1, 2, 3, 12);
			$this->db->where_not_in('id', $ignore);
			$param['usergroup_query'] = $this->db->get_where('main_usergroup', array('company_id' => $this->company_id, 'isactive' => 1));
			
			$param['department_query'] = $this->db->get_where('main_department', array('company_id' => $this->company_id, 'isactive' => 1));
		}
		
		$WHERE	= ['main_notes.id="' . $note_id . '"','main_notes.company_id="' . $this->company_id . '"'];
		
		
		$sql = "SELECT main_notes.id as note_id, main_notes.ref_note_id, main_notes.employee_id, main_notes.department_id, main_notes.issueby, main_notes.issued_datetime, main_notes.updateby,main_notes.updated_datetime,main_notes.priority,main_notes.status,main_notes.title,main_notes.note"
				.", main_department.department_name"
				.", main_employees.first_name, main_employees.middle_name, main_employees.last_name"
				.", main_users.name as issueby_name"
				." FROM main_notes"
				." LEFT JOIN main_employees ON main_employees.employee_id = main_notes.employee_id"
				." LEFT JOIN main_users ON main_users.id = main_notes.issueby"
				." LEFT JOIN main_department ON main_department.id = main_notes.department_id"
				." WHERE " . implode( $WHERE, ' AND ' )
				;
		
		$query	= $this->db->query($sql);
		
		if( $query )
		{
			$row = $query->result()[0];
			
			//echo $sql . '<br>' . json_encode( $param['query'] );
			//echo "<script>console.error('sql:','$sql');</script>";
			
			if( $row )
			{
				$param['row'					]	= $row;
				$param['local_updated_datetime'	]	= $this->toClientLocalDateTime	( $row->updated_datetime	);
				$param['local_issued_datetime'	]	= $this->toClientLocalDateTime	( $row->issued_datetime		);
				$param['note_item_tmpl_size'	]	= $this->getNoteItemTmplSize	(							);
				$param['note_size'				]	= $this->session->userdata		( 'note_size'				);
				$param['left_menu'				]	= 'sadmin/hrm_leftmenu.php';
				$param['content'				]	= 'hr/view_note.php';
				
				$this->load->view('admin/home', $param);
			}
		}
	}
	
	public function showNotes( $val1 = null, $val2 = null )
	{
// 		echo "<script>console.error($val1,'$val2');</script>";
		
		$sc			= (int)$this->uri->segment(3);
		$draw		= intval($this->input->get("draw"));
		$start		= intval($this->input->get("start"));
		$length		= intval($this->input->get("length"));
		$order		= $this->input->get("order");
		$search		= $this->input->get("search");
		$search		= $search['value'];
		$col		= 0;
		$dir		= "";
		
		if( is_null( $sc ) )
		{
			$sc = 0;
		}
		
		if( !is_null( $val2 ) )
		{
			$this->search_by_emplyee = $val2;
		}
		
		if( !empty( $order ) )
		{
			foreach( $order as $o )
			{
				$col = $o['column'	];
				$dir = $o['dir'		];
			}
		}
		
		if( $dir != "asc" && $dir != "desc" )
		{
			$dir = "desc";
		}
		
		$valid_columns = ['main_notes.issued_datetime'];
		
		if( !isset( $valid_columns[$col]) )
		{
			$order = null;
		}
		else
		{
			$order = $valid_columns[$col];
		}
		
		if( $order != null )
		{
			$this->db->order_by($order, $dir);
		}
		
		if( !empty( $search ) )
		{
			$x = 0;
			
			foreach( $valid_columns as $sterm )
			{
				if( $x == 0 )
				{
					$this->db->like( $sterm, $search );
				}
				else
				{
					$this->db->or_like( $sterm, $search );
				}
				
				$x++;
			}
		}
		
		$total_notes = $this->totalNotes( $sc );
		
		if( $length < 1 )
		{
			$length = $total_notes;
		}
		
		$WHERE		= [];
		$WHERE[]	= 'main_notes.company_id="' . $this->company_id . '"';
		
		if( $sc > 0 )
		{
			$WHERE[]	= 'main_notes.' . ( ( $sc < 4 ) ? 'status' : 'priority' ) .'="' . $this->search_by_status[$sc] . '"';
		}
		
		if( !is_null( $this->search_by_emplyee ) )
		{
			$WHERE[]	= 'main_notes.employee_id="' . $this->search_by_emplyee . '"';
		}
		
		if( !empty( $WHERE ) )
		{
			$WHERE = ' WHERE ' . implode( $WHERE, ' AND ' );
		}
		else
		{
			$WHERE = '';
		}
		
// 		echo "<script>console.error('$sc','$WHERE');</script>";
		
		$sql	= "SELECT main_notes.id as note_id, main_notes.ref_note_id, main_notes.employee_id, main_notes.department_id, main_notes.issueby, main_notes.issued_datetime, main_notes.updateby,main_notes.updated_datetime,main_notes.priority,main_notes.status,main_notes.title,main_notes.note"
				.", main_department.department_name"
				.", main_employees.first_name, main_employees.middle_name, main_employees.last_name"
				.", main_users.name as issueby_name"
				." FROM main_notes"
				." LEFT JOIN main_employees ON main_employees.employee_id = main_notes.employee_id"
				." LEFT JOIN main_users ON main_users.id = main_notes.issueby"
				." LEFT JOIN main_department ON main_department.id = main_notes.department_id"
				.  $WHERE
			//	." Group BY main_notes.employee_id"
				." ORDER BY main_notes.issued_datetime DESC"
				." LIMIT $start, $length"
				;
		
		$query = $this->db->query( $sql );
		$notes = $query->result();
		
// 		echo "<pre>". $sql ."</pre>";exit;
// 		echo "<pre>". print_r($notes) ."</pre>";exit;
		
		$data = [];
		
		foreach( $notes as $row )
		{
			$data[] =	[
							[ $row->note_id		
							, $row->title		
							]
						,	[ $row->first_name	. ' ' . $row->last_name	
							, $row->first_name	
							, $row->last_name	
							]
						,	$row->department_name
						,	$row->issueby_name
						,	$row->issued_datetime
						,	$row->priority
						,	$row->status
						];
		}
		
		$output =	[
						'draw'				=> $draw
					,	'recordsTotal'		=> $total_notes
					,	'recordsFiltered'	=> $total_notes
					,	'data'				=> $data
					,	'sql'				=> $sql
					];
		
		echo json_encode( $output );
		exit();
	}
	
	public function totalNotes( $sc )
	{
		$departmentId = $this->input->get("department_id");
		
		$this->db->select("COUNT(*) as num");
		
		if( $sc > 0 )
		{
			$this->db->where( ( $sc < 4 ) ? 'status' : 'priority', $this->search_by_status[$sc] );
		}
		
		$query = $this->db->get("main_notes");
		$result = $query->row();
		
		if (isset($result)) return $result->num;
		
		return 0;
	}
	
	public function showEmployees()
	{
		$draw	= intval($this->input->get( "draw"		));
		$start	= intval($this->input->get( "start"		));
		$length	= intval($this->input->get( "length"	));
		$order	= $this->input->get( "order"	);
		$search	= $this->input->get( "search"	);
		$search	= $search['value'];
		$col	= 0;
		$dir	= "";
		
		if( !empty( $order ) )
		{
			foreach( $order as $o )
			{
				$col = $o['column'	];
				$dir = $o['dir'		];
			}
		}
		
		if( $dir != "asc" && $dir != "desc")
		{
			$dir = "desc";
		}
		
		$valid_columns =	[
								0 => 'main_employees.employee_id'
							,	2 => 'main_employees.first_name'
							,	3 => 'main_employees.last_name'
							,	4 => 'main_employees.city'
							];
		
		if( !isset( $valid_columns[$col] ) )
		{
			$order = null;
		}
		else
		{
			$order = $valid_columns[$col];
		}
		
		if( $order != null )
		{
			$this->db->order_by( $order, $dir );
		}
		
		if( !empty( $search ) )
		{
			$x = 0;
			
			foreach( $valid_columns as $sterm )
			{
				if( $x == 0 )
				{
					$this->db->like( $sterm, $search );
				}
				else
				{
					$this->db->or_like( $sterm, $search );
				}
				
				$x++;
			}
		}
		
		$this->db->limit	( $length, $start );
		$this->db->select	( 'main_employees.id as employee_id, main_employees.first_name, main_employees.last_name, main_emp_workrelated.department, main_employees.mobile_phone' );
		$this->db->from		( 'main_employees' );
		
		$this->db->join		( 'main_emp_workrelated'			, 'main_employees.id = main_emp_workrelated.employee_id', 'left');
		$this->db->where	( 'main_employees.contact_via_text'	, 1 );
		$this->db->where	( 'main_employees.isactive'			, 1 );
		
		if( $this->user_group == 1 && $this->user_data["company_view"] == 0 )
		{
			
		}
		else
		{
			$this->db->where( 'main_employees.company_id', $this->company_id );
		}
		
		$employees = $this->db->get()->result();
		// echo "<pre>". print_r($employees) ."</pre>";exit;
		
		$data = array();
		
		foreach( $employees as $row )
		{
			$data[] =	[
							$row->employee_id
						,	$row->first_name
						,	$row->last_name
						,	[$row->department,$this->Common_model->get_name($this, $row->department, 'main_department', 'department_name')]
						,	$row->mobile_phone
						];
		}
		
		$total_employees = $this->totalEmployees();
		
		$output =	[
						'draw'				=> $draw
					,	'recordsTotal'		=> $total_employees
					,	'recordsFiltered'	=> $total_employees
					,	'data'				=> $data
					];
		
		echo json_encode( $output );
		exit();
	}
	
	public function totalEmployees()
	{
		$departmentId = $this->input->get( 'department_id' );
		
		$this->db->select	( 'COUNT(*) as num' );
		$this->db->join		( 'main_emp_workrelated'			, 'main_employees.employee_id = main_emp_workrelated.employee_id' );
		$this->db->where	( 'main_employees.contact_via_text'	, 1 );
		
		if( $this->user_group == 1 && $this->user_data['company_view'] == 0 )
		{
			
		}
		else
		{
			$this->db->where( 'main_employees.company_id', $this->company_id );
		}
		$this->db->where( 'main_emp_workrelated.department', $departmentId );
		
		$query	= $this->db->get( 'main_employees' );
		$result	= $query->row();
		
		if( isset( $result ) )
		{
			return $result->num;
		}
		
		return 0;
	}
	
	public function showEmployeesByDepartment()
	{
		$draw	= intval($this->input->get("draw"));
		$start	= intval($this->input->get("start"));
		$length	= intval($this->input->get("length"));
		$order	= $this->input->get("order");
		$search	= $this->input->get("search");
		$search	= $search['value'];
		$col	= 0;
		$dir	= '';
		
		if( !empty( $order ) )
		{
			foreach( $order as $o )
			{
				$col = $o['column'	];
				$dir = $o['dir'		];
			}
		}
		
		if( $dir != "asc" && $dir != "desc")
		{
			$dir = "desc";
		}
		
		$valid_columns =	[
								0 => 'main_employees.employee_id'
							,	2 => 'main_employees.first_name'
							,	3 => 'main_employees.last_name'
							,	4 => 'main_employees.city'
							];
		
		if( !isset( $valid_columns[$col] ) )
		{
			$order = null;
		}
		else
		{
			$order = $valid_columns[$col];
		}
		
		if( $order != null )
		{
			$this->db->order_by( $order, $dir );
		}
		
		if( !empty( $search ) )
		{
			$x = 0;
			
			foreach( $valid_columns as $sterm )
			{
				if( $x == 0 )
				{
					$this->db->like( $sterm, $search );
				}
				else
				{
					$this->db->or_like( $sterm, $search );
				}
				
				$x++;
			}
		}
		
		$departmentId = $this->input->get( 'department_id' );
		
		$employees = [];
		
		if( $departmentId )
		{
			$this->db->limit	( $length, $start );
			$this->db->select	( 'main_employees.id as employee_id, main_employees.first_name, main_employees.last_name, main_emp_workrelated.department, main_employees.mobile_phone' );
			$this->db->from		( 'main_employees' );
			$this->db->join		( 'main_emp_workrelated', 'main_employees.employee_id = main_emp_workrelated.employee_id', 'left' );
			
			if( $this->user_group == 1 && $this->user_data["company_view"] == 0 )
			{
			}
			else
			{
				$this->db->where( 'main_employees.company_id', $this->company_id );
			}
			$this->db->where( 'main_emp_workrelated.department'	, $departmentId );
			$this->db->where( 'main_employees.contact_via_text'	, 1 );
			$this->db->where( 'main_employees.isactive'			, 1 );
			
			$employees = $this->db->get()->result();
		}
		
		$data = [];
		
		foreach( $employees as $row )
		{
			$data[] =	[
							$row->employee_id
						,	$row->first_name
						,	$row->last_name
						,	[$row->department,$this->Common_model->get_name( $this, $row->department, 'main_department', 'department_name' )]
						,	$row->mobile_phone
						];
		}
		
		$total_employees = $this->totalEmployeesByDepartment();
		
		$output = [
				'draw'				=> $draw
			,	'recordsTotal'		=> $total_employees
			,	'recordsFiltered'	=> $total_employees
			,	'data'				=> $data
			];
		
		echo json_encode( $output );
		exit();
	}
	
	public function totalEmployeesByDepartment()
	{
		$departmentId = $this->input->get("department_id");
		
		$this->db->select("COUNT(*) as num");
		$this->db->join('main_emp_workrelated', 'main_employees.employee_id = main_emp_workrelated.employee_id');
		$this->db->where('main_employees.contact_via_text', 1);
		
		if( $this->user_group == 1 && $this->user_data["company_view"] == 0 )
		{
		}
		else
		{
			$this->db->where( 'main_employees.company_id', $this->company_id );
		}
		$this->db->where( 'main_emp_workrelated.department', $departmentId );
		
		$query	= $this->db->get( 'main_employees' );
		$result	= $query->row();
		
		if( isset( $result ) )
		{
			return $result->num;
		}
		
		return 0;
	}
	
	public function showEmployeesByGroup()
	{
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		$order = $this->input->get("order");
		$search = $this->input->get("search");
		$search = $search['value'];
		$col = 0;
		$dir = "";
		
		if( !empty( $order ) )
		{
			foreach( $order as $o )
			{
				$col = $o['column'];
				$dir= $o['dir'];
			}
		}
		
		if( $dir != "asc" && $dir != "desc" )
		{
			$dir = "desc";
		}
		
		$valid_columns = array
		(
				0=>'main_employees.id',
				2=>'main_employees.first_name',
				3=>'main_employees.last_name',
				4=>'main_employees.mobile_phone'
		);
		
		if( !isset( $valid_columns[$col] ) )
		{
			$order = null;
		}
		else
		{
			$order = $valid_columns[$col];
		}
		
		if( $order != null )
		{
			$this->db->order_by( $order, $dir );
		}
		
		if( !empty( $search ) )
		{
			$x = 0;
			
			foreach( $valid_columns as $sterm )
			{
				if( $x == 0 )
				{
					$this->db->like($sterm,$search);
				}
				else
				{
					$this->db->or_like($sterm,$search);
				}
				
				$x++;
			}
		}
		
		$usergroupId = $this->input->get("usergroup_id");
		
		$employees = array();
		
		if( $usergroupId )
		{
			$this->db->limit($length,$start);
			$this->db->select('main_employees.id as employee_id, main_employees.first_name, main_employees.last_name, main_employees.mobile_phone');
			$this->db->from('main_employees');
			$this->db->join('main_users', 'main_users.id = main_employees.emp_user_id','left');
			
			if ($this->user_group == 1 && $this->user_data["company_view"] == 0) {
			} else {
				$this->db->where('main_users.company_id', $this->company_id);
			}
			$this->db->where('main_users.user_group', $usergroupId);
			$this->db->where('main_employees.isactive', 1);
			
			$employees = $this->db->get()->result();
		}
		
		$data = array();
		
		foreach( $employees as $row )
		{
			$this->db->select('main_emp_workrelated.department')->from('main_employees');
			$this->db->join('main_emp_workrelated', 'main_employees.employee_id = main_emp_workrelated.employee_id');
			$this->db->where('main_employees.contact_via_text', 1);
			$this->db->where('main_employees.id', $row->employee_id);
			$department = $this->db->get()->result();
			$departmentId = 0;
			
			if( $department )
			{
				$departmentId = $department[0]->department;
			}
			
			$data[] = array
			(
					$row->employee_id
			,		$row->first_name
			,		$row->last_name
			,		[$departmentId,$this->Common_model->get_name($this, $departmentId, 'main_department', 'department_name')]
			,		$row->mobile_phone
			);
		}
		
		$total_usergroup = $this->totalUsers();
		
		$output = array(
				"draw" => $draw,
				"recordsTotal" => $total_usergroup,
				"recordsFiltered" => $total_usergroup,
				"data" => $data
		);
		
		echo json_encode($output);
		exit();
	}
	
	public function totalUsers()
	{
		$this->db->select("COUNT(*) as num");
		$this->db->from('main_employees');
		$this->db->join('main_users', 'main_users.id = main_employees.emp_user_id','left');
		
		if ($this->user_group == 1 && $this->user_data["company_view"] == 0) {
		} else {
			$this->db->where('main_users.company_id', $this->company_id);
		}
		$this->db->where('main_employees.isactive', 1);
		
		$usergroupId = $this->input->get("usergroup_id");
		$this->db->where('main_users.user_group', $usergroupId);
		$query = $this->db->get();
		$result = $query->row();
		
		if(isset($result)) return $result->num;
		
		return 0;
	}
	
	public function addNote()
	{
		$response = [];
		$response["status"	] = false;
		$response["msg"		] = "Unable to add note";
		
// 		$this->form_validation->set_rules( 'user'		, 'HR Representative'	, 'required', array('required' => "Please login as valid user : %s."						));
		$this->form_validation->set_rules( 'employee'	, 'Employee'			, 'required', array('required' => "Please select a employee : %s."							));
// 		$this->form_validation->set_rules( 'datetime'	, 'Date & Time'			, 'required', array('required' => "Someting went wrong. App couldn't set date & time : %s."	));
// 		$this->form_validation->set_rules( 'department'	, 'Department'			, 'required', array('required' => "Please select the required field, for more Info : %s."	));
		$this->form_validation->set_rules( 'title'		, 'Title'				, 'required', array('required' => "Please enter the required field, for more Info : %s."	));
		$this->form_validation->set_rules( 'note'		, 'Note'				, 'required', array('required' => "Please enter the required field, for more Info : %s."	));
// 		$this->form_validation->set_rules( 'priority'	, 'Priority'			, 'required', array('required' => "Please select the required field, for more Info : %s."	));
		
		if( $this->form_validation->run() == FALSE )
		{
			$response['errorMsg'	] = $this->Common_model->show_validation_massege( validation_errors(), 2 );
		}
		else
		{
// 			$noteTmpl			=	$this->note_tmpl		;//['i'=>[],'f'=>[],'d'=>[],'c'=>[]];
// 			$noteItemTmpl		=	$this->note_item_tmpl	;//['i'=>'','n'=>'','d'=>'','m'=>''];
			
			$user				=	$this->input->post	( 'user'		);
// 			$date				=	$this->input->post	( 'datetime'	);
			
// 			$noteItemTmpl['i']	=	$this->input->post	( 'user'		);
// 			$noteItemTmpl['n']	=	$this->input->post	( 'name'		);
// 			$noteItemTmpl['m']	=	$this->input->post	( 'note'		);
// 			$noteItemTmpl['d']	=	$date;
// 			$noteTmpl	 ['i']	=	$noteItemTmpl;
			
			$note				=	'';//json_encode			( $noteTmpl		);
			
			$data				= 
			[
				'company_id'		=> $this->company_id
			,	'issueby'			=> $user							//hr_representative_id
// 			,	'issued_datetime'	=> $this->input->post( 'datetime'	)
			,	'employee_id'		=> $this->input->post( 'employee'	)
			,	'department_id'		=> $this->input->post( 'department'	)
			,	'title'				=> $this->input->post( 'title'		)
			,	'note'				=> $note							//$this->input->post( 'note'		)
			,	'priority'			=> $this->input->post( 'priority'	)
// 			,	'status'			=> $this->input->post( 'status'		)
			];
			
			$res = $this->Common_model->insert_data( 'main_notes', $data );

			$response["debug"		] = [[
											'POST'		=> json_encode( $_POST			)
										//,	'datetime'	=> json_encode( $date			)
										,	'SQL'		=> json_encode( $data			)
										,	'Res'		=> json_encode( $res			)
										]];
			
			if( $res === true ) 
			{
				$id						= $this->getlastInsertId();
				$date					= $this->getDateById( $id, 'issued_datetime' );
				
				$noteTmpl				=	$this->note_tmpl		;//['i'=>[],'f'=>[],'d'=>[],'c'=>[]];
				$noteItemTmpl			=	$this->note_item_tmpl	;//['i'=>'','n'=>'','d'=>'','m'=>''];
				$noteItemTmpl['i']		=	$this->input->post	( 'user'		);
				$noteItemTmpl['n']		=	$this->input->post	( 'name'		);
				$noteItemTmpl['m']		=	$this->input->post	( 'note'		);
				$noteItemTmpl['d']		=	$date;
				$noteTmpl	 ['i']		=	$noteItemTmpl;
				$note					=	json_encode			( $noteTmpl		);
					
				$data					=
				[
					'note'				=>	$note
				,	'issued_datetime'	=>	$date
				];
				
				$res					=	$this->Common_model->update_data( 'main_notes', $data, ['id' => $id] );
				
				if( $res === true )
				{
					$response["debug"][		] =	[
													'datetime'	=> json_encode( $date			)
												,	'UPDATE'	=> json_encode( $data			)
												,	'Res'		=> json_encode( $res			)
												];
					
					$response["status"		] = true;
					$response["msg"			] = "Note successfully added";
					$response["successMsg"	] = "Note successfully added";
				}
				else
				{
					$response['errorMsg'	] = "Unable to add note";
				}
			}
			else
			{
				$response['errorMsg'	] = "Unable to add note";
			}
		}
		
		echo json_encode( $response );
	}
	
	public function updateNote()
	{
		$response = [];
		$response["status"	] = false;
		$response["msg"		] = "Unable to update note";
		
// 		$this->form_validation->set_rules( 'user'		, 'HR Representative'	, 'required', array('required' => "Please login as valid user : %s."						));
// 		$this->form_validation->set_rules( 'employee'	, 'Employee'			, 'required', array('required' => "Please select a employee : %s."							));
// 		$this->form_validation->set_rules( 'datetime'	, 'Date & Time'			, 'required', array('required' => "Someting went wrong. App couldn't set date & time : %s."	));
// 		$this->form_validation->set_rules( 'department'	, 'Department'			, 'required', array('required' => "Please select the required field, for more Info : %s."	));
// 		$this->form_validation->set_rules( 'title'		, 'Title'				, 'required', array('required' => "Please enter the required field, for more Info : %s."	));
// 		$this->form_validation->set_rules( 'note'		, 'Note'				, 'required', array('required' => "Please enter the required field, for more Info : %s."	));
		$this->form_validation->set_rules( 'remark'		, 'Remark'				, 'required', array('required' => "Please enter the required field, for more Info : %s."	));
// 		$this->form_validation->set_rules( 'priority'	, 'Priority'			, 'required', array('required' => "Please select the required field, for more Info : %s."	));
// 		$this->form_validation->set_rules( 'type'		, 'type'				, 'required', array('required' => "Please select the required field, for more Info : %s."	));
		
		if( $this->form_validation->run() == FALSE )
		{
			$response['errorMsg'	] = $this->Common_model->show_validation_massege( validation_errors(), 2 );
		}
		else
		{
// 			$status	= $this->input->post( 'status'	);
// 			$status = self::toUCWords	( $status	);
// 			$status	= str_replace		( 'ed', 'ing of ', $status );
// 			$remark	= $status . self::REMARK .  $this->input->post( 'remark'		);

// 			$noteItemTmpl		=	$this->note_item_tmpl	;
// 			$noteTmpl			=	$this->session->userdata( 'note_json_str' );
			
			$id					=	$this->input->post	( 'id'			);
			$user				=	$this->input->post	( 'user'		);
			$status				=	$this->input->post	( 'status'		);
// 			$date				=	$this->input->post	( 'datetime'	);
// 			$noteItemTmpl['i']	=	$this->input->post	( 'user'		);
// 			$noteItemTmpl['n']	=	$this->input->post	( 'name'		);
// 			$noteItemTmpl['m']	=	$this->input->post	( 'remark'		);
// // 			$noteItemTmpl['d']	=	$date;
// 			$ky					=	strtolower( $status[0] );
			
// // 			echo '/*1. '. $noteTmpl . ' -> ' . gettype( $noteTmpl ) . "*/\n";
			
// 			$noteTmpl			=	json_decode			( $noteTmpl, true	);
			
// // 			echo '/*2. '. json_encode( $noteTmpl ) . ' -> ' . gettype( $noteTmpl ) . "*/\n";
			
			
// 			if( 'FOLLOWUP' == $status )
// 			{
// 				$noteTmpl[$ky][]=	$noteItemTmpl;
// 			}
// 			else
// 			{
// 				$noteTmpl[$ky]	=	$noteItemTmpl;
// 			}
			
// 			$note				=	json_encode			( $noteTmpl		);
			
// 			echo '/*3. '. $note . ' -> ' . gettype( $note ) . "*/\n";
			
			$data	=
			[
				'updateby'			=> $user//$this->input->post( 'user'		)//hr_representative_id
// 			,	'updated_datetime'	=> $date							 //$this->input->post( 'datetime'	)
// 			,	'note'				=> $this->input->post( 'note'		)
// 									.  self::REMARK
// 									.  $this->input->post( 'remark'		)
			,	'note'				=> ''
			,	'status'			=> $status							//$this->input->post( 'status'		)
// 			,	'employee_id'		=> $this->input->post( 'employee'	)
// 			,	'department_id'		=> $this->input->post( 'department'	)
// 			,	'title'				=> $this->input->post( 'title'		)
// 			,	'priority'			=> $this->input->post( 'priority'	)
			];
			
			$res = $this->Common_model->update_data( 'main_notes', $data, array( 'id' => $id ) );
			
			$response["debug"		] = [
											'POST'	=> json_encode( $_POST	)
										,	'SQL'	=> json_encode( $data	)
										,	'Res'	=> json_encode( $res	)
// 										,	'Note'	=> json_encode( $note	)
										];
			
			if( $res === true )
			{
				$date					= $this->getDateById( $id, 'updated_datetime' );
				
				$noteTmpl				=	$this->session->userdata( 'note_json_str' );
				$noteItemTmpl			=	$this->note_item_tmpl;
				$noteItemTmpl['n']		=	$this->input->post	( 'name'			);
				$noteItemTmpl['m']		=	$this->input->post	( 'remark'			);
				$noteItemTmpl['d']		=	$date;
				$noteItemTmpl['i']		=	$user;
				$ky						=	strtolower			( $status[0]		);
				
				$noteTmpl				=	json_decode			( $noteTmpl, true	);
				
				if( 'FOLLOWUP' == $status )
				{
					$noteTmpl[$ky][]	=	$noteItemTmpl;
				}
				else
				{
					$noteTmpl[$ky]		=	$noteItemTmpl;
				}
				$note					=	json_encode( $noteTmpl		);
				
				$data					=
				[
					'note'				=>	$note
				,	'updated_datetime'	=>	$date
				];
				
				$res					=	$this->Common_model->update_data( 'main_notes', $data, ['id' => $id] );
				
				if( $res === true )
				{
					$response["status"		] = true;
					$response["msg"			] = "Note successfully updated";
					$response["successMsg"	] = "Note successfully updated";
				}
				else
				{
					$response['errorMsg'	] = "1.Unable to update note";
				}
			}
			else
			{
				$response['errorMsg'	] = "2.Unable to update note";
			}
			
			$this->session->unset_userdata( 'note_json_str' );
		}
		
		echo json_encode( $response );
	}
	
	private function getNoteTmplSize()
	{
		return strlen( json_encode( $this->note_tmpl ) );
	}
	
	private function getNoteItemTmplSize()
	{
		return strlen( json_encode( $this->note_item_tmpl ) );
	}
	
	private function getRemainingNoteSize()
	{
		return $this->session->userdata( 'note_size' ) - ( $this->getNoteTmplSize() + $this->getNoteItemTmplSize() );
	}
	
	private function hasCompanySelected()
	{
		return !is_null( $this->company_id ) && $this->company_id != 0;
	}
	
	private function getDateById( $id, $field )
	{
		$sql		= "SELECT $field AS date FROM main_notes WHERE id='$id'";
		$query		= $this->db->query( $sql );
		$row		= $query->result()[0];
		$date		= $row->date;
		
		//echo "<script>console.error('getDateById->$field:', '$date' );</script>";
		
		return $date;
	}
	
	private function getlastInsertId()
	{
		$sql		= "SELECT LAST_INSERT_ID() as id";
		$query		= $this->db->query( $sql );
		//echo "<script>console.error('getlastInsertId->result:', '".$query->result()."', '".print_r($query->result(),true)."' );</script>";
		$row		= $query->result()[0];
		//echo "<script>console.error('getlastInsertId->row:', '$row' );</script>";
		$id			= $row->id;
		//echo "<script>console.error('getlastInsertId->id:', '$id' );</script>";
		
		return $id;
	}
	
	private function toClientLocalDateTime( $datetime )
	{
		if( !is_null( $datetime ) && !empty( $datetime ) )
		{
			try
			{
				$to = $this->session->userdata( 'client_timezone_offset' );
				
				$tz = new DateTimeZone	( $to		);
				$dt = new DateTime		( $datetime	);
				$dt->setTimezone		( $tz		);
			
				echo "<script>console.error('toClientLocalDateTime:', '".$dt->format( 'r' )."', ', toffset:', '$to', ', given:', '$datetime' );</script>";
				
				return $dt->format( 'r' );
			}
			catch( Exception $e )
			{
				echo "<script>console.error('toClientLocalDateTime->error:', '".$e->getMessage()."', given:', '$datetime' );</script>";
				return $to;//$this->client_timezone_offset;//$e->getMessage() . ' (' . $this->client_timezone_offset . ')';
			}
		}
		else
		{
			echo "<script>console.error('toClientLocalDateTime->error:', given:', '$datetime' );</script>";
			return '';
		}
	}
	
	private function initSearch( &$param )
	{
		if( $this->hasCompanySelected() )
		{
			$sc								  = (int)$this->search_id;
			$param['search_id'				] = $sc;
			$param['show_result'			] = $sc > 0;
			$param['search_by_emplyee'		] = $this->search_by_emplyee;
			$param['search_by_status'		] = '"' . $this->search_by_status[$sc]	. '"';
			$param['page_id_header'			] = '<i class="fa fa-search" aria-hidden="true"></i> ' . self::toUCWords( $this->search_by_status[$sc] );
		}
	}
	
	private function initPage( &$param )
	{
// 		$time		= time();
// 		$date		= date( 'Y-m-d H:i:s', $time );
// 		$datetime	= $this->Common_model->show_date_formate( date( 'Y-m-d', $time ) ) ." ".  date( 'h:i a', $time );//
		
		$param['menu_id'				] = $this->menu_id;
		$param['module_id'				] = $this->module_id;
		$param['company_id'				] = $this->company_id;
		$param['user_id'				] = $this->user_id;
		$param['user_name'				] = $this->user_name;
		$param['has_company_selected'	] = $this->hasCompanySelected();
		$param['note_closing_min_size'	] = $this->note_closing_min_size;
		$param['page_header'			] = 'Employee Notes';
// 		$param['server_time'			] = $time;
// 		$param['server_date'			] = $date;
// 		$param['server_datetime'		] = $datetime;
// 		$param['local_datetime'			] = $this->toClientLocalDateTime( $datetime );
		//$param['page_id_header'		] = '';
		
		$this->initSearch( $param );
	}
}
