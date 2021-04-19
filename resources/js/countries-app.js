import Vue from "vue";
import CountryModel from "./models/CountryModel";
import HandleErrorMixin from "./mixins/HandleErrorMixin";
import CountriesTable from "./CountriesTable";
import CountryRequestService from "./services/CountryRequestService";
import DropdownMenu from '@innologica/vue-dropdown-menu';

new Vue({
    el: '#countries-app',
    mixins: [HandleErrorMixin],
    components: {
        'countries-table': CountriesTable,
        'dropdown-menu': DropdownMenu
    },
    data: {
        loading: false,
        countries: [],
        formData: {},
        dropdownVisible: false
    },

    methods: {
        loadCountries() {
            let vm = this;

            vm.loading = true;

            CountryRequestService.all()
                .then(vm.handleResponse)
                .catch(vm.handleError);
        },

        handleResponse(res) {
            let vm = this;
            let countries = [];

            res.data.forEach(c => countries.push(new CountryModel(c)));

            vm.countries = countries;

            vm.loading = false;
        },

        fileSelected(ev) {
            let vm = this;

            vm.errors = {};

            if (!ev.target.files.length) {
                return;
            }

            const formData = new FormData();
            formData.append('countries', ev.target.files[0]);

            CountryRequestService.upload(formData)
                .then(function () {
                    vm.loadCountries();
                })
                .catch(vm.handleError);
        },

        createCountry() {
            let vm = this;

            vm.errors = {};
            vm.formData = new CountryModel({});
        },

        editCountry(ev) {
            let vm = this;

            vm.errors = {};
            vm.formData = new CountryModel(vm.countries[ev.index]);
        },

        cancelEditForm() {
            let vm = this;

            vm.formData = {};
            vm.errors = {};
        },

        removeCountry(ev) {
            let vm = this;

            vm.loading = true;

            CountryRequestService.remove(vm.countries[ev.index].id)
                .then(function () {
                    vm.countries.splice(ev.index, 1);
                    vm.loading = false;
                })
                .catch(vm.handleError);
        },

        saveCountry() {
            let vm = this;

            vm.errors = {};

            if (vm.formData.id) {
                CountryRequestService.update(vm.formData.id, vm.formData)
                    .then(function () {
                        vm.loadCountries();
                        vm.formData = {};
                    })
                    .catch(vm.handleError);

                return;
            }

            CountryRequestService.store(vm.formData)
                .then(function () {
                    vm.loadCountries();
                    vm.formData = {};
                })
                .catch(vm.handleError);
        },

        forceFileDownload(response, title) {
            const url = window.URL.createObjectURL(new Blob([response]));
            const link = document.createElement('a');
            link.href = url;
            link.setAttribute('download', title);
            document.body.appendChild(link);
            link.click();
        },

        downloadCountries(format) {
            let vm = this;

            CountryRequestService.download(format)
                .then(function(res) {
                    vm.forceFileDownload(res.data, `countries.${format}`);
                })
                .catch(vm.handleError);
        }
    },

    mounted() {
        let vm = this;

        vm.loadCountries();
    }
});

