var fb = module.exports = {
    data() {
        return {
            likeCount: 0
        }
    },
    methods: {
        getLikeCount(url) {
            this.$http.get('http://graph.facebook.com/?id=' + url).then(response => {
                if (response.status==200) {
                    this.likeCount = response.data.share.share_count;
                }
            });
        },
    },
    computed: {
        getLikeWord() {
            if (this.likeCount == 0 || this.likeCount > 4) {
                return "všečkov";
            } else if (this.likeCount == 1) {
                return 'všeček'
            } else if (this.likeCount == 2) {
                return 'všečka'
            } else if (this.likeCount == 3 || this.likeCount == 4) {
                return 'všečki'
            }
        }
    }
}