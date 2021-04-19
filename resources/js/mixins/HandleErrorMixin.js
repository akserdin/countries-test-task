const HandleErrorMixin = {
    data: function() {
        return {
            errors: {}
        };
    },

    methods: {
        handleError(err) {
            let vm = this;

            if (vm.hasOwnProperty('loading')) {
                vm.loading = false;
            }

            if (err.response) {
                if (err.response.status === 422) {
                    vm.handleValidationError(err.response);

                    return;
                }

                vm.handleCommonError(err.response);
            }
        },

        handleValidationError(errorResponse) {
            let vm = this;
            let errorBag = {};

            for (let key in errorResponse.data.errors) {
                if (!errorResponse.data.errors.hasOwnProperty(key)) {
                    continue;
                }

                errorBag[key] = errorResponse.data.errors[key].join(', ');
            }

            vm.errors = errorBag;
        },

        handleCommonError(errorResponse) {
            let vm = this;

            if (errorResponse.data && errorResponse.data.hasOwnProperty('message')) {
                alert(errorResponse.data.message);

                return;
            }

            alert(`Something went wrong: ${errorResponse.status}`);
            console.log(errorResponse);
        }
    }
};

export default HandleErrorMixin;
