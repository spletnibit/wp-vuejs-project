<template>
<div id="project">
    <div  :class="{ 'inner__header': true, 'inner__header--inverted': item.acf.invert_header }" :style="{ backgroundColor: item.acf.color }">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1>{{ item.title.rendered }}</h1>
                    <p>{{ item.acf.short_desc }}</p>
                </div>
            </div>
        </div>
    </div>

    <div id="project__content" class="container">
        <div class="row">
            <div class="col-sm-12">
                <img class="img-fluid single-project__img" :src="item.acf.projekt_devices" />

                <div class="single-project__section">
                    <h3>Opis Projekta</h3>
                    <p v-html="item.content.rendered"></p>
                </div>

                <div class="single-project__section single-project__features">
                    <div class="single-project__feature" v-for="feature in item.acf.features">
                        <div class="single-project__feature--bg" :style="{ backgroundColor: item.acf.color,  backgroundImage: 'url(' + getFeatureIcon(feature) + ')' }">

                        </div>
                        {{ featuresDict[feature] }}
                    </div>
                </div>

                <div class="single-project__section">
                    <h4>Zaslonske slike</h4>

                    <div class="single-project__browser"></div>
                    <slider animation="fade" :interval="3000" :control-btn="false">
                        <slider-item v-for="(screenshot, key) in item.acf.screenshots" :key="key">
                            <img :src="screenshot.url" class="img-fluid" />
                        </slider-item>
                    </slider>
                </div>


                <testimonials :base_url="base_url" :items="testimonials" :rendered="testimonials.length" v-show="testimonialExist"></testimonials>
            </div>
        </div>
    </div>

    <div class="project__related">
        <div class="container">
            <div class="row">
                <h3>Drugi projekti</h3>
            </div>

            <projects :number="2" :projects="related" :rendered="related.length"></projects>
        </div>
    </div>

</div>

</template>

<script type="text/babel">

    import Projects from '../components/projects.vue';
    import { Slider, SliderItem } from 'vue-easy-slider'
    import Testimonials from '../components/testimonials.vue';

    export default {
        name: 'project',
        props: ['base_url'],
        components: {
            testimonials: Testimonials,
            projects: Projects,
            slider: Slider,
            'slider-item': SliderItem
        },
        data() {
            return {
                testimonials: [],
                testimonialExist: true,
                item: {
                    acf: {
                        color: null,
                        features: [],
                        short_desc: null,
                        screenshots: [],
                        invert_header: null,
                    },
                    title: {
                        rendered: null
                    },
                    content: {
                        rendered: null
                    }
                },
                featuresDict: {
                    rwd: 'Odziven design',
                    ux: 'Uporabniška izkušnja',
                    wp: 'Wordpress',
                    dev: 'Razvoj',
                    opencart: 'Opencart',
                    analytics: 'Analitika prodaje'
                },
                rendered: false,
                related: []

            }
        },
        watch: {
            '$route' (to, from) {
                // react to route changes...
//                if (to.path != from.path) {
//                    if (to.path.indexOf('/projekti/') !== -1) {
//                        let slug = to.path.replace('/projekti/','');
//                        this.getProject(slug);
//                    }
//                }
            },
        },
        created() {
            this.$router.app.$children[0].$emit('routeProject')
            this.getProject();
        },
        beforeRouteUpdate (to, from, next) {
            this.transitionName = 'scaleDown'
//            this.getProject(null, next);
            console.log(to.path, from.path)
            if (to.path != from.path) {
                if (to.path.indexOf('/projekti/') !== -1) {
                    let slug = to.path.replace('/projekti/','');
                    this.getProject(slug, next);
                }
            }
        },
        metaInfo() {
            return {
                title: this.item ? this.item.title.rendered : '',
                titleTemplate: '%s - Spletni bit',
            }
        },
        methods: {
            getProject(slug = null, next = null) {
                if (slug == null) {
                    slug = this.$route.params.slug;
                }
                this.$http.get(this.base_url + 'wp-json/wp/v2/projekti', {
                    params: {
                        slug: slug
                    }
                }).then(response => {
                    if (response.status == 200 && response.data.length) {
                        this.item = response.data[0];
                        window.scrollTo( 0, 0 );

                        this.getRelatedProjects();
                        this.$router.app.$children[0].$emit('headerBgColor', this.item.acf.color)

                        if (this.item.acf.invert_header) {
                            this.$router.app.$children[0].$emit('invertHeader', true)
                        }

                        if (this.item.acf.testimonial) {
                            this.$http.get(this.base_url + 'wp-json/wp/v2/reference/'+ this.item.acf.testimonial.ID, {}).then(response => {
                                if (response.status == 200) {
                                    this.testimonials.push(response.data)
                                }
                            });
                        } else {
                            this.testimonialExist = false;
                        }

                        if (next != null) next();



                    }
                });
            },
            shuffleProjects(a) {
                for (let i = a.length; i; i--) {
                    let j = Math.floor(Math.random() * i);
                    [a[i - 1], a[j]] = [a[j], a[i - 1]];
                }
                return a;
            },
            getFeatureIcon(feature) {
                if (this.item.acf.invert_header) {
                    feature += '-black';
                }
                return '/wp-content/themes/spletnibit/dist/img/icons/' + feature + '.svg';
            },
            getRelatedProjects() {
                this.$http.get(this.base_url + 'wp-json/wp/v2/projekti', {
                    params: {
                        exclude: [this.item.id]
                    }
                }).then(response => {
                    if (response.status == 200) {
                        this.related = this.shuffleProjects(response.data).slice(0, 2)
                    }
                });
            }
        }
    }
</script>