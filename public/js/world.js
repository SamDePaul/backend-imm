$(document).ready(function() {
  $('#negara').on('change', function() {
    var countryId = this.value;
    $('#provinsi').html('<option value="">Pilih Region</option>');
    $('#kota').html('<option value="">Pilih Region Terlebih Dahulu</option>').prop('disabled', true);

    if (countryId) {
        $.ajax({
            url: '/get-regions/' + countryId,
            type: "GET",
            dataType: "json",
            success: function(data) {
                $('#provinsi').prop('disabled', false);
                $.each(data, function(key, region) {
                    $('#provinsi').append('<option value="' + region.id + '">' + region.name + '</option>');
                });
            }
        });
    } else {
        $('#provinsi').prop('disabled', true);
        $('#kota').prop('disabled', true);
    }
});

$('#provinsi').on('change', function() {
    var regionId = this.value;
    $('#kota').html('<option value="">Pilih City</option>');

    if (regionId) {
        $.ajax({
            url: '/get-cities/' + regionId,
            type: "GET",
            dataType: "json",
            success: function(data) {
                $('#kota').prop('disabled', false);
                $.each(data, function(key, city) {
                    $('#kota').append('<option value="' + city.id + '">' + city.name + '</option>');
                });
            }
        });
    } else {
        $('#kota').prop('disabled', true);
    }
});
});

