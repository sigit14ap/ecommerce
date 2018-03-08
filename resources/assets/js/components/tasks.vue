<script>
    export default {
        data: function() {
            return {
                list: [],
                task: {
                id: ''
                }
            };
        },
        
        ready: function() {
            this.fetchTaskList();
        },
        
        methods: {
            fetchTaskList: function() {
                this.$http.get('web/{bagian}').then(function (response) {
                    this.list = response.data
                });
            },


            show: function(bagian,slug=0,slugbarang=0) {
                this.$http.get('web/{bagian}' + id).then(function(response) {
                    this.task.id = response.data.id
                })
                this.$els.taskinput.focus()
            },
        }
    }
</script>