import createPersistedState from "vuex-persistedstate";
import { getField, updateField } from 'vuex-map-fields';

export default {
  namespaced: true,
  state: {
    INIT_AUTH: false,
    AUTH: {
        userId: null,
        userRole: null,
        isAdmin: null,
        isAdminTransport: null,
    },
    LOADING_AUTH: false,
  },
  mutations: {
    // Add the `updateField` mutation to the
    // `mutations` of your Vuex store instance.
    updateField,

    INIT_AUTH(state, value) {
      state.INIT_AUTH = value;
    },
    SET_AUTH(state, value) {
        state.AUTH = value;
    },
    SET_LOADING_AUTH(state, value) {
        state.LOADING_AUTH = value;
    }
  },
  actions: {
    async getAuth({ commit, state }, api) {

        let LOADING_AUTH = state.LOADING_AUTH
        if(LOADING_AUTH) return state.AUTH // ini membuat REDIRECT tidak bekerja karena telat (di akali di App.vue)
        commit('SET_LOADING_AUTH', true)
        console.log("CUSTOM AUTH")

        const response_user = await api.badasoAuthUser.user({}).catch((error) => {

            // this tidak bisa disini dan bikin error UI
            // this.errors = error.errors;
            // // this.$closeLoader();
            // this.$vs.notify({
            //     title: this.$t("alert.danger"),
            //     text: error.message,
            //     color: "danger",
            // });
        });
        commit('INIT_AUTH', true)
        commit('SET_LOADING_AUTH', false)
        console.log('utils auth', response_user)
        if(!response_user) {

            commit('SET_AUTH', {
                userId: null,
                userRole: null,
                isAdmin: null,
                isAdminTransport: null,
            })

            return {
                userId: null,
                userRole: null,
                isAdmin: null,
                isAdminTransport: null,
            }
        }
        // this.userId = response_user.data.user.id;

        let userRole = null;
        let isAdmin = null;
        let isAdminTransport = null
        for (let role of response_user?.data?.user?.roles) {
            switch (role.name) {
                // case 'customer':
                // case 'student':
                //     isAdmin = false;
                //     break;
                case 'administrator':
                case 'admin':
                    isAdmin = true;
                    break;
                case 'administrator':
                case 'admin':
                case 'admin-transport':
                    isAdmin = true;
                    isAdminTransport = true;
                    break;
                default:
                    isAdmin = false
                    isAdminTransport = false;
                    break
            }
            userRole = role.name
        }

        commit('SET_AUTH', {
            userId: response_user?.data?.user?.id,
            userRole,
            isAdmin,
            isAdminTransport,
        })
        return {
            userId: response_user?.data?.user?.id,
            userRole,
            isAdmin,
            isAdminTransport,
        }
    }
  },
  getters: {
    // Add the `getField` getter to the
    // `getters` of your Vuex store instance.
    getField,

    INIT_AUTH: (state) => {
      return state.INIT_AUTH;
    },
    getAUTH: (state) => {
      return state.AUTH;
    },
  },
  plugins: [createPersistedState()],
};
