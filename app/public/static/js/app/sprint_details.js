var app = new Vue({
    el: '#sprint-details',
    data: {
        projectId: 0,
        sprintId: 0,
        sprintDetails: [],
        errorMessage: '',
    },
    mounted: function() {
        const el = document.getElementById('sprint-details');
        this.projectId = el.dataset.projectId;
        this.sprintId = el.dataset.sprintId;
        this.getSprintDetails();
    },
    methods: {
        getSprintDetails() {
            var self = this
            var url =  `/projects/${self.projectId}/sprints-details/${self.sprintId}`
            axios.get(url)
            .then(response => {
                if (response.data.success) {
                    self.sprintDetails = response.data.data;
                } else {
                    console.error('Failed to load sprint details:', response.data);
                    self.sprintDetails = [];
                }
            })
            .catch(error => {
                console.error('Error fetching sprints details:', error);
            });
        },
        goLive() {
            var self = this

            axios.post(`/projects/${self.projectId}/sprints/${self.sprintId}/status`, { status: 1 })
                .then(response => {
                    self.getSprintDetails();    
                })
                .catch(error => {
                    console.error('Failed to update to live:', error);
                });
        },
        cancelSprint() {
            var self = this

            axios.post(`/projects/${self.projectId}/sprints/${self.sprintId}/status`, { status: 2 })
                .then(response => {
                    window.location.href = `/projects/${self.projectId}/sprints`;
                })
                .catch(error => {
                    console.error('Failed to cancel sprint:', error);
                });
        },
        endSprint() {
            var self = this

            axios.post(`/projects/${self.projectId}/sprints/${self.sprintId}/status`, { status: 3 })
                .then(response => {
                    self.getSprintDetails();
                })
                .catch(error => {
                    console.error('Failed to end sprint:', error);
                });
        },
        formatDate(dateString) {
            const options = { year: 'numeric', month: 'short', day: 'numeric' };
            return new Date(dateString).toLocaleDateString(undefined, options);
        }
    },
    computed: {
        isDraft() {
            var self = this

            return self.sprintDetails.status === 0;
        },
        isLive() {
            var self = this
            return self.sprintDetails.status === 1;
        },
        isCancelled() {
            var self = this

            return self.sprintDetails.status === 2;
        }
    }
});