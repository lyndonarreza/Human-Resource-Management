HRM_Router.routes.push(
	{ 
    	path: '/attendance', 
    	components: { 'hrm-attendace-records': hrm_attendace_records }, 
    	name: 'attendance_records',

    	children: [
            { 
            	path: '/attendance/search/', 
            	components: { 'attendance_search': hrm_attendace_user_search } , 
            	name: 'attendance_search' 
            },
        ]   

	}

);

HRM_Router.routes.push(
    {
        path: '/attendance-configuration', 
        components: { 'hrm-attendance-configuration': hrm_attendace_configuration }, 
        name: 'attendance_configuration',
    }
);