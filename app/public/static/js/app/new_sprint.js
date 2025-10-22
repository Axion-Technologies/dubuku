var app = new Vue({
    el: '#new-sprint',
    data: {
        projectId: 0,
        title: '',
        description: '',
        startDate: '',
        endDate: '',
        errorMessage: '',
        successMessage: ''
    },
    methods: {
        createSprint() {
            var self = this
            self.errorMessage = '';
            self.successMessage = '';

            self.projectId = self.$refs.project_id.value;   

            if (self.title === '' || self.title === null) {
                self.errorMessage = 'Title field is required.';
                return false;
            }
            else if(self.startDate === '' || self.startDate === null) {
                self.errorMessage = 'Start date is required.';
                return false;
            }
            else if(self.endDate === '' || self.endDate === null) {
                self.errorMessage = 'End date is required.';
                return false;
            }

            var url = '/projects/sprints/create'
            axios.post(url, 
                {
                    project_id: self.projectId,
                    title: self.title,
                    description: self.description,
                    start_date: self.startDate,
                    end_date: self.endDate
                })
                .then(response => {
                    if (response.data.success) {
                        self.successMessage = response.data.message;
                        self.projectId = 0
                        self.title = ''
                        self.description = ''
                        self.startDate = ''
                        self.endDate = ''
                    } else {
                        self.errorMessage = response.data.error;
                    }
                })
                .catch(error => {
                    self.errorMessage = error.response?.data?.error || 'An error occurred.';
                });
        }
    } 
})