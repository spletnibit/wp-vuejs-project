<template>
    <div class="testimonials">
        <div class="container">
            <div class="row">

                <div class="spinner" v-if="!rendered">
                    <div class="rect1"></div>
                    <div class="rect2"></div>
                    <div class="rect3"></div>
                    <div class="rect4"></div>
                    <div class="rect5"></div>
                </div>

                <div class="col-sm-12" v-if="rendered">
                    <h3>Povedali so</h3>
                    <ul class="testimonials__faces">
                        <li v-for="(item, key) in items" :class="{ 'active': isActive(key) }"><img :src="item.acf.img.sizes.thumbnail" :alt="item.title.rendered" class="img-fluid rounded-circle" /></li>
                    </ul>

                    <slider animation="fade" :interval="5000" :indicators="indicators" :control-btn="showNavigation" @changeSlide="onChange">
                        <slider-item v-for="(item, key) in items" :key="key">
                            <p v-html="item.content.rendered"></p>
                            <div class="testimonials__person">
                                <b>{{ item.title.rendered }}</b>
                                <span>{{ item.acf.job }}</span>
                            </div>
                        </slider-item>
                    </slider>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import { Slider, SliderItem } from 'vue-easy-slider'



    export default {
        name: 'testimonials',
        props: ['base_url', 'items', 'rendered'],
        components: {
            Slider,
            SliderItem
        },
        data () {
            return {
                currentIndex: 0,
                showNavigation: true,
                indicators: 'center'
            }
        },
        watch: {
            rendered() {
                if (this.rendered && this.items.length == 1) {
                    this.showNavigation = false;
                    this.indicators = false;
                }
            }
        },
        methods: {
            isActive(key) {
                return key == this.currentIndex
            },
            onChange(e) {
                this.currentIndex = e.index
            }
        }
    }
</script>