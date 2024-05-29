jQuery('document').ready(function($) {
    function librariesItem(item, inWishlist) {
        var o = $('<div class="item">'
        + '<p class="title"><a href="' + item.repository_url + '">' + item.name + '</a></p>'
        + '<p class="description"><strong>' + item.description + '</strong></p>'
        + '<p class="summary"><em>Latest release ' + item.latest_release_published_at + ', stars ' + item.stars + '</em></p>'
        + (inWishlist == null ? '<p class="add"><button class="btn btn-primary add">Add to wishlist</button><p>' : '<p>In your wishlist</p>')
        + '</div>');

        var button = o.find('button');

        button.attr('rel_platform', item.platform);
        button.attr('rel_name', item.name);

        button.on('click', function () {
            var button = $(this);
            var rel_platform = button.attr('rel_platform');
            var rel_name = button.attr('rel_name');

            button.attr('disabled', true);

            $.ajax({
                url: '/wishlist/api/add',
                type: 'POST',
                data: {
                    platform: rel_platform,
                    name: rel_name,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    button.parent().replaceWith('<p>In your wishlist</p>');
                },
                error: function (response) {
                    button.attr('disabled', false);
                }
            })
        });

        return o;
    }

    if ($('#top10php').length) {
        $.ajax({
            url: '/wishlist/api/top10php',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                $('#top10php').html('');

                for (var i in response.items) {
                    var inWishlist = response.wishlist.find(x => x.item_id == response.items[i].platform + '/' + response.items[i].name);
                    $('#top10php').append(librariesItem(response.items[i], inWishlist));
                }
            },
            error: function (response) {
                $('#results').html('<p>An error has occured</p>');
            }
        });
    }

    function search(keywords, page) {
        $('#results').html('Searching...');
        
        $.ajax({
            url: '/wishlist/api/search',
            type: 'POST',
            data: {
                q: keywords,
                page: page,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $('#results').html('<h3>Search results</h3>');

                for (var i in response.items) {
                    var inWishlist = response.wishlist.find(x => x.item_id == response.items[i].platform + '/' + response.items[i].name);
                    $('#results').append(librariesItem(response.items[i], inWishlist));

                    var paging = $('<a href="#">Next page</a>');
                    paging.on('click', function () {
                        search(keywords, ++page);

                        return false;
                    });

                    $('#results').append(paging);
                }

                if (!response.items.length) {
                    $('#results').append('<p>No matches found</p>');
                }
            },
            error: function (response) {
                $('#results').html('<p>An error has occured</p>');
            }
        });
    }

    $('form#search').submit(function () {
        var keywords = $(this).find('input[type=text]').val();

        search(keywords, 1);

        return false;
    });

    $('p.remove a').click(function () {
        return confirm('Are you sure?');
    });
});