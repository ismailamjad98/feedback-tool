<template>
    <div class="card p-3">
        <div class="d-flex justify-content-between">
            <h5>Feedbacks</h5>
            <router-link to="/feedback">
                <button type="button" class="btn btn-dark">Add New</button>
            </router-link>
        </div>
        <hr>
        <div>
            <div class="card border-top border-gray-200 mt-3">
                <div class="card-body d-flex align-items-start p-4" v-for="(feedback, index) in feedbacks" :key="index">
                    <div class="gap-2 d-grid">
                        <img src="https://media.istockphoto.com/id/1327592449/vector/default-avatar-photo-placeholder-icon-grey-profile-picture-business-man.jpg?s=170667a&w=0&k=20&c=qDvsvfQdmm_cvI_BQH4PdIt8-P-VDAq7ufOobicPBu0="
                            alt="User Avatar" class="w-10 h-10 rounded-circle" width="40" height="40"
                            style="object-fit: cover;">
                        {{ feedback.user.full_name }}
                    </div>

                    <div class="flex-grow-1 px-4">
                        <p class="text-sm font-weight-bold m-0">{{ feedback.title }} <span
                                class="badge mx-3 text-bg-primary">{{ feedback.category }}</span>
                        </p>
                        <p class="text-sm text-muted my-2">{{ feedback.description }}.</p>
                        <div class="d-flex gap-3" v-if="!feedback.showInput">
                            <a class="btn-link cursor-pointer" @click="toggleInput(feedback.id)">Reply</a>
                            <button class="btn btn-sm btn-outline-danger"
                                @click="deleteFeedback(feedback.id)">Delete</button>
                        </div>
                        <div v-if="feedback.showInput">
                            <div class="card-body d-flex align-items-start p-4">
                                <div class="flex-shrink-0">
                                    <img src="https://media.istockphoto.com/id/1327592449/vector/default-avatar-photo-placeholder-icon-grey-profile-picture-business-man.jpg?s=170667a&w=0&k=20&c=qDvsvfQdmm_cvI_BQH4PdIt8-P-VDAq7ufOobicPBu0="
                                        alt="User Avatar" class="w-10 h-10 rounded-circle" width="40" height="40"
                                        style="object-fit: cover;">
                                </div>
                                <div class="flex-grow-1 px-4">
                                    <at-ta :members="members">
                                        <textarea v-model="comment" class="form-control border-2 mb-3"></textarea>
                                    </at-ta>

                                    <button @click="reply(feedback.id)" class="btn btn-dark">Reply</button>
                                    <button @click="toggleInput(feedback.id)" class="btn">Cancel</button>
                                </div>
                            </div>
                        </div>

                        <div v-if="feedback.replies.length > 0">
                            <div class="card-body d-flex align-items-start p-4" v-for="reply in feedback.replies">
                                <div class="flex-shrink-0">
                                    <img src="https://media.istockphoto.com/id/1327592449/vector/default-avatar-photo-placeholder-icon-grey-profile-picture-business-man.jpg?s=170667a&w=0&k=20&c=qDvsvfQdmm_cvI_BQH4PdIt8-P-VDAq7ufOobicPBu0="
                                        alt="User Avatar" class="w-10 h-10 rounded-circle" width="40" height="40"
                                        style="object-fit: cover;">
                                </div>
                                <div class="px-4">
                                    <p class="text-sm font-weight-bold m-0">{{ reply.user.full_name }}
                                        <small class="badge mx-3 text-black">{{ formatDate(reply.created_at) }}</small>
                                    </p>
                                    <p class="text-sm text-muted my-2">{{ reply.comment }}</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import At from 'vue-at'
import AtTa from 'vue-at/dist/vue-at-textarea' // for textarea

export default {
    components: { At, AtTa },
    data() {
        return {
            feedbacks: [],
            showInput: false,
            comment: null,
            members: []
        }
    },
    methods: {
        deleteFeedback(id) {
            axios.delete(`/api/feedback/delete/${id}`).then((res) => {
                this.feedbacks = this.feedbacks.filter((item) => item.id != id);
                this.$toast.success("Deleted Successfully", {
                    position: 'top-right'
                })
            }).catch((error) => {
                console.log(error);
            }).finally(() => {

            });
        },
        getFeedbacks() {
            axios.get('/api/feedback').then((res) => {
                this.feedbacks = res.data.feedbacks;
            }).catch((error) => {
                console.error(error);
            }).finally(() => {
            });
        },
        toggleInput(FeedbackId) {
            this.feedbacks.forEach(feedback => {
                if (feedback.id == FeedbackId) {
                    feedback.showInput = !feedback.showInput;
                } else {
                    feedback.showInput = false;
                }
            });
        },
        reply(id) {
            let obj = {
                feedback_id: id,
                user_id: this.$store.state.app.user.id,
                comment: this.comment,
            }
            axios.post(`/api/feedback/comment`, obj).then((res) => {
                this.comment = null
                this.getFeedbacks();
            }).catch((error) => {
                console.error(error);
            }).finally(() => {

            });
        },
        formatDate(dateString) {
            const date = new Date(dateString);
            const options = { year: 'numeric', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' };
            return new Intl.DateTimeFormat('en-US', options).format(date);
        },

        getAllUsers() {
            axios.get('/api/users').then((res) => {
                let users = res.data.users;
                users.forEach(user => {
                    this.members.push(user.full_name);
                });
            }).catch((error) => {
                console.error(error);
            }).finally(() => {
            });
        },

        formatMessage(message) {
            // Regular expression to match @username
            const mentionRegex = /@(\w+)/g;
            // Replace @username with <b>username</b>
            return message.replace(mentionRegex, "<b>$1</b>");
        }

    },
    mounted() {
        this.getFeedbacks();
        this.getAllUsers();
    }
}
</script>