$(document).ready(function() {
    $('#negara').change(function() {
      var countryId = $(this).val();

      $.ajax({
        url: "{{ route('getCitiesByCountry') }}",
        data: { negara: countryId },
        dataType: 'json',
        success: function(response) {
          var cities = response.cities;
          $('#kota').empty();

          cities.forEach(function(city) {
            $('#kota').append('<option value="' + city.id + '">' + city.name + '</option>');
          });
        }
      });
    });
  });
