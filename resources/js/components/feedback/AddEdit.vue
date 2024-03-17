<template>
    <div class="bg-light border card">
        <div class="items-center pt-4 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-8 w-8">
                <path d="M17 6.1H3"></path>
                <path d="M21 12.1H3"></path>
                <path d="M15.1 18H3"></path>
            </svg>
            <div class="pt-3">Submit Feedback</div>
            <p class="text-sm text-muted">We value your feedback! Please share your thoughts with us.</p>
        </div>
        <form method="post" @submit.prevent="submitFeedback()">
            <div class="py-4 px-4">
                <div class="space-y-1.5">
                    <label for="title" class="form-label text-sm">Title</label>
                    <input type="text" class="form-control" id="title" placeholder="Enter feedback title"
                        v-model="feedback.title" required>
                </div>
                <div class="space-y-1.5">
                    <label for="description" class="form-label text-sm">Description</label>
                    <textarea class="form-control" id="description" rows="3" v-model="feedback.description"
                        placeholder="Enter detailed feedback here" required></textarea>
                </div>
                <div class="space-y-1.5">
                    <label for="category" class="form-label text-sm">Category</label>
                    <select class="form-select" id="category" required v-model="feedback.category">
                        <option value="" disabled selected>Select a category</option>
                        <option value="bug">Bug Report</option>
                        <option value="feature">Feature Request</option>
                        <option value="improvement">Improvement</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-dark w-100 mt-4"> Submit</button>
            </div>
        </form>
    </div>
</template>


<script>
export default {
    data() {
        return {
            feedback: {
                title: null,
                description: null,
                category: null,
                user_id: null,
            }
        }
    },
    methods: {
        submitFeedback() {
            this.feedback.user_id = this.$store.state.app.user.id;
            axios.post('/api/feedback/store', this.feedback).then((res) => {
                this.resetForm();
                this.$router.push({ name: 'dashboard' });
                // this.successHandler(res);
            }).catch((error) => {
                console.log(error);
                // this.errorHandler(error);
            }).finally(() => {

            });
        },
        resetForm() {
            this.feedback = {
                title: null,
                description: null,
                category: null,
                user_id: null,
            };
        }
    }
}
</script>