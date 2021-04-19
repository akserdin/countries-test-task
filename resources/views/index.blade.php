@extends('layout.master')

@section('content')
    <div id="countries-app" class="my-5 mx-5 py-5 px-5">
        <div v-if="! countries.length" class="custom-file mb-3">
            <input @change="fileSelected($event)" type="file" class="custom-file-input" id="input-countries-file">
            <label class="custom-file-label" for="input-countries-file">Upload file with countries</label>
            <small v-if="errors.hasOwnProperty('countries')" class="text-danger" v-text="errors.countries"></small>
        </div>

        <template v-else>
            <template v-if="formData.hasOwnProperty('id')">
                <div class="form-group">
                    <label for="input-country-name">Name</label>
                    <input type="text"
                           id="input-country-name"
                           v-model="formData.name"
                           :class="{'is-invalid': errors.hasOwnProperty('name')}"
                           class="form-control">

                    <small v-if="errors.hasOwnProperty('name')" class="text-danger" v-text="errors.name"></small>
                </div>

                <div class="form-group">
                    <label for="input-country-capital">Capital</label>
                    <input type="text"
                           id="input-country-capital"
                           v-model="formData.capital"
                           :class="{'is-invalid': errors.hasOwnProperty('capital')}"
                           class="form-control">

                    <small v-if="errors.hasOwnProperty('capital')" class="text-danger" v-text="errors.capital"></small>
                </div>

                <div class="d-flex justify-content-end my-2">
                    <button @click="cancelEditForm" class="btn btn-outline-warning mr-1">Cancel</button>
                    <button @click="saveCountry" class="btn btn-success">Save</button>
                </div>
            </template>

            <template v-else>
                <div class="d-flex justify-content-end mb-2">
                    <button @click="createCountry" class="btn btn-success mr-1">Add</button>

                    <dropdown-menu
                            v-model="dropdownVisible"
                            :right="true"
                            :hover="false"
                            :interactive="true"
                    >
                        <button class="btn btn-primary dropdown-toggle">
                            Download
                        </button>
                        <div slot="dropdown">
                            <a class="dropdown-item" @click.prevent="downloadCountries('csv')" href="№">CSV</a>
                            <a class="dropdown-item" @click.prevent="downloadCountries('json')" href="#">JSON</a>
                            <a class="dropdown-item" @click.prevent="downloadCountries('xml')" href="#">XML</a>
                        </div>
                    </dropdown-menu>
                </div>
            </template>

            <countries-table @country-edited="editCountry"
                             @country-removed="removeCountry"
                             :countries="countries"></countries-table>
        </template>
    </div>
@endsection

@push('js')
    <script src="{{ mix('js/countries-app.js') }}"></script>
@endpush

