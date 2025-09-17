var app = new Vue({
    el: '#tasks',
    data: {
        topTasks: [],
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
    mounted: function() {
        this.fetchTopTasks();
    },
    methods: {
        fetchTopTasks() {
            var self = this
            var url = '/my-tasks/top-five'
            axios.get(url)
            .then(response => {
                if (response.data.success) {
                    self.topTasks = response.data.data;
                } else {
                    console.error('Failed to load top tasks:', response.data);
                }
                self.showLoading = 'no'
            })
            .catch(error => {
                console.error('Error fetching top tasks:', error);
            });
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