export default function CountryModel(data) {
    this.id = data.id || null;
    this.name = data.name || '';
    this.capital = data.capital || '';
}
