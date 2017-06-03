var HRM_Admin_Store = new Vuex.Store({
	state: {
		is_new_department_form_visible: false,
		departments: [],
		department_id: false,
	},

	mutations: {
		isNewDepartmentForVisible: function(state, is_visible) {
			state.is_new_department_form_visible = is_visible.is_visible;
		},

		setDepartments: function(state, departments) {
			state.departments = departments.departments;
		},

		department_edit_id: function(state, department) {
			state.department_id = department.department_id;
		},

		updateDepartment: function(state, department) {
			if (department.is_update) {
				state.departments = department.departments;
			} else {
				state.departments = department.departments;
			}
		}
	}
});