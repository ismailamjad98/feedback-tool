import { createStore } from 'vuex';
import createPersistedState from "vuex-persistedstate";

const store = createStore({
    plugins: [createPersistedState()],
    state() {
        return {
            app: {
                user: {},
                authenticated: false,
            },
        };
    },

    getters: {
        authenticated(state) {
            return state.app.authenticated
        },
        user(state) {
            return state.app.user
        }
    },
    mutations: {
        SET_AUTHENTICATED(state, value) {
            state.app.authenticated = value
        },
        SET_USER(state, user) {
            state.app.user = user
        },
        CLEAR_STATE(state) {
            state.app.user = {};
            state.app.authenticated = false;
        },
    },
    actions: {
        login({ commit }, credentials) {
            return axios.post('/login', credentials)
                .then(response => {
                    commit('SET_AUTHENTICATED', true);
                    commit('SET_USER', response.data.user);
                    return response.data;
                }).catch((error) => {
                    throw error.response.data.message; // Throw error message
                });
        },
        logout({ commit }) {
            commit('CLEAR_STATE'); // Clear the state
        }
    }
});

export default store;