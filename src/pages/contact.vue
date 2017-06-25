<template>
<div id="contact">
    <div class="contact__header">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1>Pošljite nam sporočilo</h1>
                    <p>Tukaj smo, da vam nudimo izkušnjo, kot bi jo želeli tudi sami. Odgovorimo na vsako vprašanje ter skupaj pridemo do optimalnih rešitev za vas in vaš projekt.</p>
                </div>
            </div>
        </div>
    </div>


    <div class="contact__content container">
        <div v-show="submitted">
            <h4 class="text-center">Hvala! Odgovorili vam bomo v najkrajšem možnem času.</h4>
        </div>
        <form id="contactForm" v-on:submit.prevent="onSubmit" v-show="!submitted">
        <div class="row">
            <div class="offset-md-2 col-md-8">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="formName">Ime in priimek</label>
                            <input type="text" name="name" id="formName" :class="{ 'form-control-danger': hasError('name'), 'form-control': true }" v-model="form.name" />
                            <p class="form-text" v-show="hasError('name')">Prosim izpolnite polje</p>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="formEmail">E-mail</label>
                            <input type="email" name="email" id="formEmail" :class="{ 'form-control-danger': hasError('email'), 'form-control': true }" v-model="form.email" />
                            <p class="form-text" v-show="hasError('email')">Prosim izpolnite polje</p>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="formTel">Telefon</label>
                            <input type="tel" name="tel" id="formTel" :class="{ 'form-control-danger': hasError('tel'), 'form-control': true }" v-model="form.tel" />
                            <p class="form-text" v-show="hasError('tel')">Prosim izpolnite polje</p>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">

                            <label>Opcijsko naložite datoteke</label>
                            <label class="file-upload">
                                <input v-on:change="onFileSelect" name="file" type="file" id="file" :class="{ 'form-control': true, 'file-upload__input': true }">
                                <span :class="{ 'form-control-danger': hasError('slika'), 'form-control': true, 'file-upload__control': true }"></span>
                            </label>
                        </div>
                    </div>


                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="forMsg">Na kratko opišite vaš projekt</label>
                            <textarea name="msg" id="formMsg" :class="{ 'form-control-danger': hasError('msg'), 'form-control': true }" rows="7" v-model="form.msg"></textarea>
                            <p class="form-text" v-show="hasError('msg')">Prosim izpolnite polje</p>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">POŠLJI</button>

                </div>

            </div>
        </div>

        </form>
    </div>

</div>
</template>

<script type="text/babel">

    export default {
        name: 'contact',
        props: ['base_url'],
        data() {
            return {
                form: {
                    name: null,
                    email: null,
                    tel: null,
                    msg: null
                },
                file: null,
                errors: [],
                submitted: false
            }
        },
        created() {
            this.$router.app.$children[0].$emit('invertHeader', false)
        },
        metaInfo() {
            return {
                title: 'Kontakt - Spletni bit',
            }
        },
        methods: {
            onFileSelect(e) {
                let file = e.target.files || [];
                if (!file.length)
                    return;

                document.styleSheets[0].addRule('.file-upload__control::before','content: "'+file[0].name+'" !important;');
                this.readFile(file[0]);
            },
            readFile(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.file = e.target.result;
                };
                reader.readAsDataURL(file)
                this.file = file;
            },
            hasError(key) {
                return this.errors.indexOf(key) != -1
            },
            onSubmit() {
                let form = document.getElementById('contactForm');
                let formData = new FormData(form);
                formData.append('file', this.file);

                this.$http.post(this.base_url + 'wp-json/spletnibit/v1/contact', formData, {
                    emulateJSON: true
                }).then(response => {
                    if (response.data == 'OK') {
                        this.submitted = true;
                    }
                }, response => {
                    this.errors = response.data.data;
                });

            }
        }
    }
</script>