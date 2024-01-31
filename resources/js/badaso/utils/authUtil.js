export default {
    async getAuth(api) {
        const response_user = await api.badasoAuthUser.user({}).catch((error) => {
            this.errors = error.errors;
            // this.$closeLoader();
            this.$vs.notify({
                title: this.$t("alert.danger"),
                text: error.message,
                color: "danger",
            });
        });
        console.log('utils auth', response_user)
        // this.userId = response_user.data.user.id;

        let userRole = null;
        let isAdmin = null;
        for (let role of response_user.data.user.roles) {
            switch (role.name) {
                case 'customer':
                case 'student':
                    isAdmin = false;
                    break;
                case 'administrator':
                case 'admin':
                    isAdmin = true;
                    break;
            }
            userRole = role.name
        }

        return {
            userId: response_user.data.user.id,
            userRole,
            isAdmin
        }
    }
}
