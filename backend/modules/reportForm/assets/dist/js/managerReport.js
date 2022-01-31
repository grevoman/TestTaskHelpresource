(function ($) {
    let selectIndustryType = $('#monthlyreportsearch-companyrelation-industryrelation-type_id'),
        selectIndustry = $('#monthlyreportsearch-companyrelation-industry_id'),
        form = $('#search-form');


    $('select').prop('selectedIndex', 0);

    selectIndustryType.on('change', function () {
        let url = selectIndustry.data('url');
        selectIndustry.attr('disabled', true);
        selectIndustry.html('');

        if (!selectIndustryType.val()) {
            return;
        }
        $.ajax({
            method: 'GET',
            url: url,
            data: {type: $(this).val()},
            success: function (response) {
                if (response.success) {
                    selectIndustry.append($('<option></option>').attr('value', '').text(''));
                    $.each(response.data, function (value, key) {
                        selectIndustry.append($('<option></option>').attr('value', value).text(key));
                        selectIndustry.removeAttr('disabled');
                    });

                } else {
                    console.log(response);
                }
            },
        });
    });

    $('#export-button').on('click', function (event) {
        event.preventDefault();
        console.log($(this).attr('href'));
        console.log(form.attr('action'));
        form.attr('action', $(this).attr('href'))
        form.submit();
        setTimeout(function() {
            form.attr('action', form.data('default-action'))
        }, 1000);
    });
})(jQuery);
