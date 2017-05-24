<template>
    <div class="testimonials">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h3>Povedali so</h3>

                    <ul class="testimonials__faces">
                        <li v-for="item in data"><img :src="item.img" :alt="item.name" /></li>
                    </ul>

                    <div v-for="item in data">
                        <p>{{ item.content }}</p>
                    </div>

                    <div v-for="item in data">
                        <div class="testimonials__person">
                            <b>{{ item.name }}</b>
                            <span>{{ item.job }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        name: 'testimonials',
        props: ['data'],
        data () {
            return {

            }
        },
        created() {
            console.log(this.data);
        }
    }
</script>