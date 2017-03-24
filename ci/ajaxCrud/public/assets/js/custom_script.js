function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}
var User = {
    init: function() {
        User.addPrevNextLink();
        User.registerAjax();
        User.validateAndSubmitForm();
    },
    registerAjax: function() {
        // Load user
        $('ul.pagination li a').on('click', function(event) {
            event.stopPropagation();
            event.preventDefault();
            var cur = $('.paginationLink').html();
            $this = $(this);
            var url = $this.attr('href');
            var id = $this.html();
            $prev = $('li.prev');
            $next = $('li.next');
            var num_links = $('ul.pagination').data('nums');
            if (id == cur) { // Check if click on active index
                return ;
            }
            /* update id */
            if (id == '«') {
                id = parseInt(cur) - 1;
                // Check if begin of pagination
                if (id == 0) {
                    return ;
                }
                $this = $('li.active').prev().children('a').first();
            } else if (id == '»') {
                id = parseInt(cur) + 1;
                $this = $('li.active').next().children('a').first();
                // check end of pagination
                if($this.parent().hasClass('next')) {
                    return;
                }
            }
            /* Update table */
            User.getUser(id, url);
            /* Update pagination */
            $parent = $this.parent('li');
            $active = $('li.active');
            $active.children('a.paginationLink').removeClass('paginationLink');
            $active.removeClass("active");
            $parent.addClass('active');
            $this.addClass('paginationLink');
            id = parseInt(id);
            if($next) {
                if (id  == parseInt(num_links)) {
                    $next.addClass('hidden');
                } else {
                    $next.removeClass('hidden');
                    $next.children('a').attr('data-ci-pagination-page', id + 1);
                }
            }
            if ($prev) {
                if (id == 1) {
                    $prev.addClass('hidden');
                } else {
                    $prev.removeClass('hidden');
                    $prev.children('a').attr('data-ci-pagination-page', id - 1);
                }
            }
        });
        // Delete user
        $('#users-tbody').on('click', '.delUsers-btn',function() {
            var id = $(this).data('user-id');
            var url = $(this).data('url');
            User.deleteUser(id, url);
            $(this).parent().parent().remove();
        });
    },
    getUser: function(id, url) {
        $.ajax({
            url: url,
            method: 'GET',
            cache: false,
            data: {
                id: id,
                ajax: true
            },
            dataType: "json",
            success: function(data) {
                var users = data.data;
                var stt = data.stt;
                var url = data.editUrl;
                var del_url = data.deleteUrl;
                var html = '';
                if (users.length == 0) {
                    window.location.reload();
                }
                $.each(users, function(index, element) {
                    html += '<tr id="user-'+ element.user_id +'">' + "\n";
                    html += '<td>' + ++stt + '</td>' + "\n";
                    html += '<td>' + element.user_name + '</td>' + "\n";
                    html += '<td>' + element.user_email + '</td>' + "\n";
                    html += '<td>' + element.created_at + '</td>' + "\n";
                    html += '<td><a href="'+ url + '/'+ element.user_id +'">Edit</a>';
                    html += ' / ';
                    html += '<button data-url="'+ del_url +'" class="delUsers-btn" id="del-' +element.user_id +'" data-user-id="'+ element.user_id +'">Delete</button>';
                    html += '</td></tr>' + "\n";
                });
                /* Update html */
                $('#users-tbody').html(html);
            },
            error: function(data) {
            }
        });
    },
    addPrevNextLink: function() {
        $active = $('li.active');
        var id = parseInt($('a.paginationLink').html());
        var prev_id = (id - 1) > 0 ? (id - 1) : id;
        var next_id = (id + 1) > 0 ? (id + 1) : id;
        $prev = $('ul.pagination li.prev');
        if ($prev.html() == undefined) {
            // create prev link
            $('ul.pagination').prepend('<li class="prev"><a rel="prev" data-ci-pagination-page="'+ prev_id +'" href="/index.php/base/user/index">«</a></li>');
        }

        $next = $('ul.pagination li.next');
        if ($next.html() == undefined) {
            // create prev link
            $('ul.pagination').append('<li class="next"><a rel="next" data-ci-pagination-page="'+ next_id +'" href="/index.php/base/user/index/3">»</a></li>');
        }
    },
    deleteUser: function(id, url) {
        if (confirm('Are you sure to delete')) {
            // delete
            $.ajax({
                url: url + '/' + id,
                method: 'GET',
                cache: false,
                data: {
                    ajax: true
                },
                dataType: "json",
                success: function(data) {
                },
                error: function(data) {
                }
            });
        }
    },
    validateAndSubmitForm: function() {
        $('#user-form button#submit').on('click', function(event) {
            event.stopPropagation();
            event.preventDefault();
            var user_name = $('#user-form div #user_name').val();
            var user_email = $('#user-form div #user_email').val();
            var url = $('#user-form').attr('action');
            console.log(url);
            var error = false;
            /* check required: user name, user email*/
            if (user_name == ''){
                error = true;
                $('#user-form div #user_name').parent().children('.alert-message').first().html('User name is not empty!');
            } else {
                $('#user-form div #user_name').parent().children('.alert-message').first().html('');
            }
            if (user_email == ''){
                error = true;
                $('#user-form div #user_email').parent().children('.alert-message').first().html('User email is not empty!');
            } else {
                $('#user-form div #user_email').parent().children('.alert-message').first().html('');
            }
            /* check validate email */
            if (! isEmail(user_email)) {
                error = true;
                $html = new Array($('#user-form div #user_email').parent().children('.alert-message').first().html());
                $html.push('Email is not valid!');
                $html = $html.join(', ');
                $('#user-form div #user_email').parent().children('.alert-message').first().html($html);
            }

            /* Check error before send request */
            if (! error) {
                $(this).prop('disabled', true);
                $.ajax({
                    url: url,
                    method: 'POST',
                    cache: false,
                    data: {
                        user_name: user_name,
                        user_email: user_email,
                        ajax: true
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#user-form button#submit').prop('disabled', false);
                        $('div.messages').html(data.messages);
                        if (data.action == 'create') {
                            $('#user-form div #user_name').html();
                            $('#user-form div #user_email').html();
                        }
                    },
                    error: function(data) {
                        window.location.reload();
                    }
                });
            }
        });
    }
};
$(document).ready(function() {
    User.init();
});