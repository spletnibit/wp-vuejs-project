<template>
<div id="projects">
    <div class="inner-projects__heading inner-projects--border-bottom">
        <div class="container">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1>Projekti</h1>

                        <p>Fusce vehicula dolor arcu, sit amet blandit dolor mollis nec. Donec viverra eleifend lacus, vitae ullamcorper metus. Sed sollicitudin ipsum quis.</p>
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

                    <div class="inner-projects__item col-sm-12" v-for="item in items" :style="{ backgroundColor: item.acf.color }" v-show="rendered">



                        <div :class="{ 'inner-projects__item--float': true, 'inner-projects__item--inverted': item.acf.invert_header }">
                            <h3>{{ item.title.rendered }}</h3>

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
            this.$router.app.$children[0].$emit('invertHeader', false)
            this.$http.get(this.base_url + 'wp-json/wp/v2/projekti', {}).then(response => {
                if (response.status == 200) {
                    this.items = response.data
                    this.getACF();
                }
            });
        },
        methods: {
            getLink(slug) {
                return '/projekti/' + slug;
            },
            search(id) {
                for (var i=0; i < this.items.length; i++) {
                    if (this.items[i].id === id) {
                        return this.items[i];
                    }
                }
            },
            getACF() {
                this.$http.get(this.base_url + 'wp-json/acf/v3/projekti').then(response => {
                    if (response.status == 200) {
                        var item;
                        for (item in response.data) {
                            this.search(response.data[item].id).acf = response.data[item].acf
                        }
                        this.rendered = true;



                    }
                });
            }
        }
    }
</script>