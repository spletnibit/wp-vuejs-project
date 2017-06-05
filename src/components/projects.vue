<template>
    <div class="row">
        <div class="spinner" v-if="!rendered">
            <div class="rect1"></div>
            <div class="rect2"></div>
            <div class="rect3"></div>
            <div class="rect4"></div>
            <div class="rect5"></div>
        </div>

        <div class="col-md-7 col-sm-12" v-if="number==3 && typeof projects[0] !== 'undefined'">
            <router-link :to="getLink(projects[0].slug)" class="projects__project projects__left" :style="{ backgroundColor: projects[0].acf.color, backgroundImage: 'url(' + projects[0].acf.homepage_image + ')' }">
                <b :class="{ 'black': projects[0].acf.invert_header }">{{ projects[0].title.rendered }}</b>

            </router-link>
        </div>

        <div class="col-md-5 col-sm-12" v-if="number==3 && typeof projects[2] !== 'undefined'">
            <router-link :to="getLink(projects[1].slug)" class="projects__project projects__right " :style="{ backgroundColor: projects[1].acf.color, backgroundImage: 'url(' + projects[1].acf.homepage_image + ')' }">
                <b :class="{ 'black': projects[1].acf.invert_header }">{{ projects[1].title.rendered }}</b>
            </router-link>

            <router-link :to="getLink(projects[2].slug)" class="projects__project projects__right " :style="{ backgroundColor: projects[2].acf.color, backgroundImage: 'url(' + projects[2].acf.homepage_image + ')' }">
                <b :class="{ 'black': projects[2].acf.invert_header }">{{ projects[2].title.rendered }}</b>
            </router-link>
        </div>

        <div class="projects__loadmore col-sm-12" v-if="number==3">
            <router-link to="/projekti" class="btn btn-trans">Oglejte si več projektov</router-link>
        </div>

        <div class="col-md-6 col-sm-12" v-if="number===2 && projects.length" v-for="p in projects">
            <router-link :to="getLink(p.slug)" class="projects__project" :style="{ backgroundColor: p.acf.color, backgroundImage: 'url(' + p.acf.projekti_desktop + ')' }">
                <b :class="{ 'white': !p.acf.invert_header, 'black': p.acf.invert_header }">{{ p.title.rendered }}</b>
            </router-link>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'projects',
        props: ['number', 'projects', 'rendered'],
        data () {
            return {
            }
        },
        methods: {
            getLink(slug) {
                return '/projekti/' + slug
            }

        }
    }
</script>