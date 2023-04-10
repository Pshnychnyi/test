<template>
    <div class="conteiner-fluid">
        <div class="row">
            <form @submit.prevent="submitForm">
                <div class="mb-3">
                    <label for="url" class="form-label">Url</label>
                    <input type="text" class="form-control" @v-model="url" name="url" id="url" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">Введите Url aдресс</div>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

            <div v-if="shortUrl">
                <a :href='shortUrl'>{shortUrl}</a>
            </div>
        </div>
    </div>
</template>



<script>
    export default {

        data() {
            return {
                url: '',
                shortUrl: ''
            }
        },
        methods: {
            submitForm() {
                axios.post('/api/links', {url: this.url}).then(response => {
                    this.shortUrl = 'http://myapp.com/' + response.data.short_url
                })
            }
        }
    }

</script>
<style scoped>

</style>

