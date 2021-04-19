const CountryRequestService = {
    all: function() {
        return axios.get('/country');
    },

    upload: function(formData) {
        let config = {
            headers: {'Content-type': 'multipart/form-data'}
        };

        return axios.post('/country-file', formData, config);
    },

    remove: function(id) {
        return axios.delete(`/country/${id}`);
    },

    store: function(data) {
        return axios.post('/country', data);
    },

    update: function(id, data) {
        return axios.put(`/country/${id}`, data);
    },

    download: function(format) {
        return axios.get('/country-file', {params: {format}});
    }
};

export default CountryRequestService;
