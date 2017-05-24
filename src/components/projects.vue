<template>
    <div class="row">
        <div class="col-md-7 col-sm-12">
            <div class="projects__project projects__left" :style="{ backgroundColor: project.color, backgroundImage: 'url(' + project.img + ')' }">
                <b>{{ project.name }}</b>
            </div>
        </div>
        <div class="col-md-5 col-sm-12">
            <div class="projects__project projects__right " v-for="p in projects" :style="{ backgroundColor: p.color, backgroundImage: 'url(' + p.img + ')' }">
                <b :class="{ 'white': p.invertHeader }">{{ p.name }}</b>
            </div>

        </div>

        <div class="projects__loadmore col-sm-12">
            <router-link to="/" class="btn btn-trans">Oglejte si več projektov</router-link>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'projects',
        data () {
            return {
                project: {
                    name: null,
                    color: null,
                    img: null
                },
                projects: [
                    {
                        name: 'Century 21',
                        color: '#FAE564',
                        img: '/wp-content/uploads/2017/p1.jpg'
                    },
                    {
                        name: 'Yumi Lashes',
                        color: '#120514',
                        img: '/wp-content/uploads/2017/p2.jpg',
                        invertHeader: true
                    },
                    {
                        name: 'Metroshop',
                        color: '#FF9A00',
                        img: '/wp-content/uploads/2017/p3.jpg',
                        invertHeader: true
                    }
                ]
            }
        },
        created() {
            this.project = this.projects[0];
            this.projects.splice(0,1);
        },
        methods: {


        }
    }
</script>