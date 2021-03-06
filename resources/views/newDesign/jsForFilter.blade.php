<script>

    $(document).ready(function () {

        var filter = new (function () {
            function getFilters() {
                return {
                    regions: $('select[name="selected-region"]').val(),
                    industries: $('select[name="selected-indastry"]').val(),
                    specialisations: $('select[name="selected-specialization"]').val(),
                    sortRatings: $('.sort-rating').hasClass('toggleFilter') ? 'drop' : $('.sort-rating').hasClass('active') ? 'desc' : 'asc',
                    sortDate: $('.sort-date').hasClass('toggleFilter') ? 'drop' : $('.sort-date').hasClass('active') ? 'asc' : 'desc',
                    startDate: $('#datepicker1').val(),
                    endDate: $('#datepicker2').val()
                }
            }

            function applyFilter() {

                let li = '#list-selected-specialization > div > div > ul > li > a > label > input[type="checkbox"]';

                $.ajax({
                    url: '{{ route(Route::currentRouteName()) }}',
                    data: getFilters(),
                    cache: false,
                    success: function (data) {
                        $.ajax({
                            url: '{{ route('vacancy.search.byIndustries') }}',
                            data: getFilters(),
                            cache: false,
                            success: function (data) {
                                if (data.length !== 0) {
                                    $(li).each(function () {
                                        let count = 0;
                                        for (let d in data) {
                                            if (this.value === data[d].position) {
                                                count = 1;
                                                break;
                                            }
                                        }
                                        if (count === 0 && !$(this).closest("li").hasClass('multiselect-all')) {
                                            $(this).closest("li").hide();
                                        } else {
                                            $(this).closest("li").show();
                                        }
                                    });
                                    hideShow(1);
                                } else if (data.length === 0 && getFilters().industries) {
                                    $(li).each(function () {
                                        $(this).closest("li").hide();
                                    });
                                    hideShow(0);
                                } else {
                                    $(li).each(function () {
                                        $(this).closest("li").show();
                                    });
                                    hideShow(1);
                                }
                            }
                        });
                        $('.test').html(data);
                    }
                });
            }

            function hideShow(showHide) {
                let liNotFoundMessage = '#list-selected-specialization > div > div > ul > li.not-found-message';
                let liMultiselectItemFilter = '#list-selected-specialization > div > div > ul > li.multiselect-item.filter';

                if (showHide) {
                    $(liNotFoundMessage).hide();
                    $(liMultiselectItemFilter).show();
                } else {
                    $(liNotFoundMessage).show();
                    $(liMultiselectItemFilter).hide();
                }
            }

            function sortByRating(context) {
                $('.sort-rating').toggleClass('active');
                $('.sort-by-rating').removeClass('hidden');
                $(context).addClass('hidden');
                $('.sort-rating').removeClass('toggleFilter');
                $('.sort-date').addClass('toggleFilter');
                applyFilter();
            }

            function sortByDate(context) {
                $('.sort-date').toggleClass('active');
                $('.sort-by-date').removeClass('hidden');
                $(context).addClass('hidden');
                $('.sort-date').removeClass('toggleFilter');
                $('.sort-rating').addClass('toggleFilter');
                applyFilter();
            }

            this.applyFilter = applyFilter;
            this.getFilters = getFilters;

            $('.getting-list-selected-box').on('change', function () {
                applyFilter();
            });

            $('.sort-by-rating').unbind('click').click(function (e) {
                sortByRating(this);
            });

            $('.sort-by-date').unbind('click').click(function (e) {
                sortByDate(this);
            });

            $('.datePicker').on('change', function () {
                applyFilter();
            });

            $(document).on('click', '.pagination a', function (event) {
                event.preventDefault();
                var props = getFilters();
                var url = $(this).attr('href');
                var dest = $('.test');

                $.ajax({
                    url: url,
                    data: props,
                    success: function (resp) {
                        var result = $(resp).filter('.test').children('div');
                        $(dest).empty();
                        $("html, body").animate({scrollTop: 120}, 50);
                        $(result).each(function (index) {
                            var item = this;
                            setTimeout(function () {
                                $(item).addClass('animated fadeInUpBig').appendTo(dest);
                            }, 200 * index);
                        });
                    }
                });
            });

        })();

        $('.pag-block-by').click(function () {
            $('.active-pag-block').removeClass('active-pag-block');
            $(this).toggleClass('active-pag-block');
        });

        $(function () {
            $("#datepicker1").datepicker({
                dateFormat: "yy-mm-dd"
            });
            $("#datepicker2").datepicker({
                dateFormat: "yy-mm-dd"
            });
        });

        $('#close-top-vac').on('click', function (e) {
            e.preventDefault();
            if ($('#news').hasClass('hidden')) {
                $('#topvac').addClass('hidden');
                $('#left-content-column').removeClass('col-xs-9');
                $('#right-content-column').removeClass('col-xs-3');
                $('#left-content-column').addClass('col-xs-12');
            } else {
                $('#topvac').addClass('hidden');
            }
        });

        $('#close-news').on('click', function (e) {
            e.preventDefault();
            if ($('#topvac').hasClass('hidden')) {
                $('#news').addClass('hidden');
                $('#left-content-column').removeClass('col-xs-9');
                $('#right-content-column').removeClass('col-xs-3');
                $('#left-content-column').addClass('col-xs-12');
            } else {
                $('#news').addClass('hidden');
            }
        });

    })
</script>
