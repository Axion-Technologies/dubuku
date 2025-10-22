var app = new Vue({
    el: '#sprints',
    data: {
        projectId: 0,
        sprints: [],
        errorMessage: '',
    },
    mounted: function() {
        this.projectId = document.getElementById('sprints').dataset.projectId;
        this.getSprints();
    },
    methods: {
        getSprints() {
            var self = this
            var url =  '/projects/sprints/get/' + self.projectId;
            axios.get(url)
            .then(response => {
                if (response.data.success) {
                    self.sprints = response.data.data;
                } else {
                    console.error('Failed to load all sprints:', response.data);
                    self.sprints = [];
                }
            })
            .catch(error => {
                console.error('Error fetching all sprints:', error);
            });
        },
        formatDate(dateString) {
            const options = { year: 'numeric', month: 'short', day: 'numeric' };
            return new Date(dateString).toLocaleDateString(undefined, options);
        }
    }
});