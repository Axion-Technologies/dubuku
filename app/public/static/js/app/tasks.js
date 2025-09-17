var app = new Vue({
    el: '#tasks',
    data: {
        all_my_tasks: [],
        filtered_my_tasks: [],
        projects: [],
        ticketPriority: '',      
        projectFilter: '',   
        tempTicketPriority: '',      
        tempProjectFilter: '',   
        applyingFilter: false, 
        showLoading: 'yes',
        errorMessage: '',

        priorityMap: {
        0: 'Low',
        1: 'Medium',
        2: 'High',
        3: 'Critical',
        },
        statusMap: {
            0: 'New',
            1: 'In Progress',
            2: 'On Hold',
            3: 'Completed',
            4: 'Deleted',
            5: 'Merged',
        }
    },
    computed: {
        displayedTasks() {
            var self = this
            return (self.filtered_my_tasks.length > 0 || self.ticketPriority || self.projectFilter)
                ? self.filtered_my_tasks
                : self.all_my_tasks;
        }
    },
    mounted: function() {
        this.fetchAllTasks();
        this.fetchProjects();
    },
    methods: {
        fetchAllTasks() {
            var self = this
            var url = '/my-tasks/all'
            axios.get(url)
            .then(response => {
                if (response.data.success) {
                    self.all_my_tasks = response.data.data;
                } else {
                    console.error('Failed to load all tasks:', response.data);
                }
                self.showLoading = 'no'
            })
            .catch(error => {
                console.error('Error fetching all tasks:', error);
                self.showLoading = 'no';
            });
        },
        fetchProjects() {
            var self = this
            var url = '/my-tasks/get-all-projects'
            axios.get(url)
                .then(response => {
                    if (response.data.success) {
                        self.projects = response.data.data;
                    }
                });
        },
        applyFilter() {
            var self = this
            self.applyingFilter = true; 

            self.ticketPriority = self.tempTicketPriority;
            self.projectFilter = self.tempProjectFilter;

            const params = {};

            if (self.ticketPriority !== '') {
                params.priority = self.ticketPriority; 
            }

            if (self.projectFilter !== '') {
                params.project_id = self.projectFilter;
            }

            var url = '/my-tasks/filter'
            axios.get(url, { params })
                .then(response => {
                    if (response.data.success) {
                        self.filtered_my_tasks = response.data.data;
                    } else {
                        self.errorMessage = response.data.error;
                        self.filtered_my_tasks = [];
                    }
                    self.showLoading ='no'
                })
                .catch(error => {
                    console.error('Error filtering tasks:', error);
                    self.errorMessage = 'Failed to apply filter.';
                })
                .finally(() => {
                    self.applyingFilter = false; 
                });
        },
        clearFilter() {
        var self = this
            self.ticketPriority = '';
            self.projectFilter = '';
            self.tempTicketPriority = '';
            self.tempProjectFilter = '';
            self.filtered_my_tasks = [];
            self.fetchAllTasks();
        },
        getPriorityLabel(value) {
            var self = this
            return self.priorityMap[value] || 'Unknown';
        },
        getStatusLabel(value) {
            var self = this
            return self.statusMap[value] || 'Unknown';
        },
        formatDate(dateString) {
            const options = { year: 'numeric', month: 'short', day: 'numeric' };
            return new Date(dateString).toLocaleDateString(undefined, options);
        }
    }
});