var latest = module.exports = {
    data() {
        return {
            recepti: []
        }
    },
    created() {
        var ret = [];
        this.$http.get(this.base_url + 'wp-json/wp/v2/recepti', {
            params: {
                per_page: 3
            }
        }).then(response => {
            if (response.status == 200) {
                this.recepti = response.data;
            }
        }, response => {
            // error callback
        });

    }
}