$(document).ready(function () {
    $('#negara').on('change', function () {
        var countryId = this.value;
        $('#provinsi').html('<option value="">Pilih Region</option>');
        $('#kota').html('<option value="">Pilih Region Terlebih Dahulu</option>').prop('disabled', true);

        if (countryId) {
            $.ajax({
                url: '/get-regions/' + countryId,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $('#provinsi').prop('disabled', false);
                    $.each(data, function (key, region) {
                        $('#provinsi').append('<option value="' + region.id + '">' + region.name + '</option>');
                    });
                }
            });
        } else {
            $('#provinsi').prop('disabled', true);
            $('#kota').prop('disabled', true);
        }
    });

    $('#provinsi').on('change', function () {
        var regionId = this.value;
        $('#kota').html('<option value="">Pilih City</option>');

        if (regionId) {
            $.ajax({
                url: '/get-cities/' + regionId,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $('#kota').prop('disabled', false);
                    $.each(data, function (key, city) {
                        $('#kota').append('<option value="' + city.id + '">' + city.name + '</option>');
                    });
                }
            });
        } else {
            $('#kota').prop('disabled', true);
        }
    });
    $('#sdg').on('change', function () {
        var sdgId = this.value;
        $('#indikator').html('<option value="">Pilih Indicator</option>');

        if (sdgId) {
            $.ajax({
                url: '/get-indicator/' + sdgId,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $('#indikator').prop('disabled', false);
                    $.each(data, function (key, indicator) {
                        $('#indikator').append('<option value="' + indicator.id + '">' + indicator.name + '</option>');
                    });
                }
            });
        } else {
            $('#indikator').prop('disabled', true);
        }
    });

    $('#tags').on('change', function () {
        var tagid = this.value;
        console.log(tagid);
        $('#matrik').html('<option value="">Pilih Indicator</option>');

        if (tagid) {
            $.ajax({
                url: '/get-metric/' + tagid,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $('#matrik').prop('disabled', false);
                    $.each(data, function (key, matrik) {
                        $('#matrik').append('<option value="' + matrik.id + '">' + matrik.name + '</option>');
                    });
                }
            });
        } else {
            $('#matrik').prop('disabled', true);
        }
    });

    new MultiSelectTag('tags', {
        // ... other MultiSelectTag options

        onChange: function (values) {
          // Handle changes in the select dropdown
          var allMetricData = [];

          if (values.length > 0) {
            // Get all selected IDs
            var selectedIdTag = [];
            for (var i = 0; i < values.length; i++) {
                selectedIdTag.push(values[i].value);
            }

            // Loop through selected IDs and fetch metric data for each
            $.each(selectedIdTag, function(index, tagid) {
              if (tagid) {
                $.ajax({
                  url: '/get-metric/' + tagid,
                  type: "GET",
                  dataType: "json",
                  success: function (data) {
                    $.each(data, function (key, data) {
                        allMetricData.push({ data: data });
                    })

                    // Update #matrik after all requests are complete
                    if (index === selectedIdTag.length - 1) {
                      updateMatrik(allMetricData);
                    }
                  },
                  error: function (jqXHR, textStatus, errorThrown) {
                    console.error("Error fetching metric data:", textStatus, errorThrown);
                    // Handle errors appropriately (e.g., display user-friendly message)
                  }
                });
              }
            });
          } else {
            // Clear #matrik when no values are selected
            updateMatrik([]);
          }
          document.getElementById('selectedIdTag').value = JSON.stringify(selectedIdTag);
        }
      });

      function updateMatrik(allMetricData) {
        $('#matrik').html('<option value="">Pilih Matrik</option>');
        $('#matrik').prop('disabled', false);


        $.each(allMetricData, function (key, matrik) {
          var option = $('<option>').val(matrik.data.id).text(matrik.data.name);
          $('#matrik').append(option);
        });
      }


});

