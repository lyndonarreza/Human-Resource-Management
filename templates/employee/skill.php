<?php
$header_path = dirname(__FILE__) . '/header.php';
$header_path = apply_filters( 'hrm_header_path', $header_path, 'employee' );

if ( file_exists( $header_path ) ) {
    require_once $header_path;
}

?>

<div class="hrm-update-notification"></div>
<?php
if ( isset( $_REQUEST['employee_id'] ) && $_REQUEST['employee_id'] ) {
    $employer_id = intval( $_REQUEST['employee_id'] );
} else {
    $employer_id = get_current_user_id();
}

$can_edit = hrm_user_can( 'edit_employee', $employer_id );
?>

<div id="hrm_personal_skill"></div>

<?php

$results = hrm_Settings::getInstance()->conditional_query_val( 'hrm_personal_skill', '*', array( 'emp_id' => $employer_id ) );

// $skill_labels = hrm_Settings::getInstance()->hrm_query( 'hrm_skill' );
// unset( $skill_labels['total_row'] );

// foreach ( $skill_labels as $key => $skill_label ) {
//     $label[$skill_label->id] = $skill_label->name;
// }

foreach ( $results as $key => $value) {

    if ( $results['total_row'] == 0 || $key === 'total_row' ) {
      continue;
    }

    // if ( !isset( $label[$value->skill] ) ) {
    //     continue;
    // }

    if ( $can_edit ) {
        $del_checkbox = '<input class="hrm-single-checked" name="hrm_check['.$value->id.']" value="" type="checkbox">';
        $delete_text  = '<a href="#" class="hrm-delete" data-id='.$value->id.'>'.__( 'Delete', 'hrm' ).'</a>';
    } else {
        $del_checkbox = '<input disabled="disabled" class="hrm-single-checked" name="" value="" type="checkbox">';
        $delete_text  = '';
    }

    
    $td_attr[][0] = 'class="hrm-table-checkbox"';

    if ( $can_edit ) {
        $name_id = '<div class="hrm-title-wrap"><a href="#" class="hrm-editable hrm-title" data-table_option="hrm_personal_skill" data-id='.$value->id.'>'.$value->skill.'</a>
        <div class="hrm-title-action"><a href="#" class="hrm-editable hrm-edit" data-table_option="hrm_personal_skill" data-id='.$value->id.'>'.__( 'Edit', 'hrm' ).'</a>'
        .$delete_text. '</div></div>';
    } else {
        $name_id = $value->skill;
    }

    $body[] = array(
        $del_checkbox,
        $name_id,
        $value->years_of_exp,
        $value->comments,

    );
}

if ( $can_edit ) { 
    $checkbox = '<input class="hrm-all-checked" type="checkbox">';
} else {
    $checkbox = '<input disabled="disabled" class="hrm-all-checked" type="checkbox">';
}

$table = array();
$table['head']       = array( 
    $checkbox, 
    __( 'Skill', 'hrm'), 
    __( 'Year of experiance', 'hrm'), 
    __( 'Comment', 'hrm') 
);

$table['body']       = isset( $body ) ? $body : array();
$table['td_attr']    = isset( $td_attr ) ? $td_attr : array();
$table['table_attr'] = array( 'class' => 'widefat' );
$table['table']      = 'hrm_personal_skill';
$table['action']     = 'hrm_delete';
$table['tab']        = $tab;
$table['subtab']     = $subtab;
$table['page']       = $page;
$table['add_btn']     = $can_edit;
$table['delete_btn']  = $can_edit;

echo hrm_Settings::getInstance()->table( $table );
$url = hrm_Settings::getInstance()->get_current_page_url( $page, $tab, $subtab ) . '&employee_id='. $employer_id;
$file_path = urlencode(__FILE__);
global $hrm_is_admin;
?>
<script type="text/javascript">
    jQuery(function($) {
        hrm_dataAttr = {
           add_form_generator_action : 'add_form',
           add_form_apppend_wrap : 'hrm_personal_skill',
           class_name : 'hrm_Employee',
           redirect : '<?php echo $url; ?>',
           function_name : 'personal_skill',
           employee_id: "<?php echo $employer_id; ?>",
           page: '<?php echo $page; ?>',
           tab: '<?php echo $tab; ?>',
           subtab: '<?php echo $subtab; ?>',
           req_frm: '<?php echo $file_path; ?>',
           is_admin : '<?php echo $hrm_is_admin; ?>'
        };
    });
</script>