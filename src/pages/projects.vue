<template>
<div id="projects">
    <div class="inner-projects__heading inner-projects--border-bottom">
        <div class="container">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1>Projekti</h1>

                        <p>Pridružite se podjetnikom, ki so svoje spletne rešitve že prepustili nam in tudi vi povečajte prodajo ter zadovoljstvo vaših strank.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="inner-projects">
        <div class="container">
            <div class="container">
                <div class="row">

                    <div class="spinner" v-show="!rendered">
                        <div class="rect1"></div>
                        <div class="rect2"></div>
                        <div class="rect3"></div>
                        <div class="rect4"></div>
                        <div class="rect5"></div>
                    </div>

                    <div v-for="(item, key) in items" :class="{ 'inner-projects__item': true, 'col-sm-12': true, 'inner-projects__item--odd': isOdd( key) }" :style="{ backgroundColor: item.acf.color }" v-show="rendered">

                        <div :class="{ 'inner-projects__item--float': true, 'inner-projects__item--inverted': item.acf.invert_header }">
                            <h3><router-link :to="getLink(item.slug)">{{ item.title.rendered }}</router-link></h3>

                            <p v-html="item.acf.short_desc"></p>

                            <router-link :to="getLink(item.slug)" class="btn">VEČ</router-link>
                        </div>

                        <div class="inner-projects__mobile" :style="{ 'background-image': 'url(' + item.acf.projekti_mobile + ')' }"></div>
                        <div class="inner-projects__desktop" :style="{ 'background-image': 'url(' + item.acf.projekti_desktop + ')' }"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script type="text/babel">
    export default {
        name: 'projects',
        props: ['base_url'],
        data() {
            return {
                items: [],
                rendered: false
            }
        },
        created() {
            this.$router.app.$children[0].$emit('headerBgColor','#fff')
            this.$http.get(this.base_url + 'wp-json/wp/v2/projekti', {}).then(response => {
                if (response.status == 200) {
                    this.items = response.data
                    this.rendered = true;
                }
            });
        },
        metaInfo() {
            return {
                title: 'Projekti - Spletni bit',
            }
        },
        methods: {
            isOdd(key) {
                return key%2 == 0;
            },
            getLink(slug) {
                return '/projekti/' + slug;
            }
        }
    }
</script>